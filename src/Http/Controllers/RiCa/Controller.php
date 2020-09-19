<?php

namespace Facilitador\Http\Controllers\RiCa;

use Facilitador\Services\FacilitadorService;
use Facilitador\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Support\Events\FileDeleted;
use Pedreiro\Elements\ContentTypes\Checkbox;
use Pedreiro\Elements\ContentTypes\Coordinates;
use Pedreiro\Elements\ContentTypes\File;
use Pedreiro\Elements\ContentTypes\Image as ContentImage;
use Pedreiro\Elements\ContentTypes\MultipleCheckbox;
use Pedreiro\Elements\ContentTypes\MultipleImage;
use Pedreiro\Elements\ContentTypes\Password;
use Pedreiro\Elements\ContentTypes\Relationship;
use Pedreiro\Elements\ContentTypes\SelectMultiple;
use Pedreiro\Elements\ContentTypes\Text;
use Pedreiro\Elements\ContentTypes\Timestamp;
use Facilitador\Traits\AlertsMessages;
use Validator;

class Controller extends BaseController
{
    /**
     * The user repository instance.
     */
    protected $facilitadorService;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository $repositoryService
     * @return void
     */
    public function __construct(FacilitadorService $facilitadorService)
    {
        // @debug

        // dd((new \Support\Services\DatabaseService(\Illuminate\Support\Facades\Config::get('generators.loader.models_alias'), new \Support\Components\Coders\Parser\ComposerParser))->getAllModels());
        // $database = new \Support\Components\Database\Mount\DatabaseMount();
        // $model = new \Support\Services\ModelService(\Telefonica\Models\Actors\Person::class);
        // $model = new \Support\Services\ModelService('OTQ4ODUzYThiZDY2MTcyNGFhdUhXZnJheUl6VUt6SUtkU1NCdUhFaW54aldLZHh0ZEZJMnVyOGJJL2c9');
        $this->facilitadorService = $facilitadorService;
    }

    public function getSlug(Request $request)
    {
        if (isset($this->slug)) {
            $slug = $this->slug;
        } else {
            $slug = explode('.', $request->route()->getName())[1];
        }

        return $slug;
    }

    public function insertUpdateData($request, $slug, $rows, $data)
    {
        $multi_select = [];

        /*
         * Prepare Translations and Transform data
         */
        $translations = is_bread_translatable($data)
                        ? $data->prepareTranslations($request)
                        : [];

        foreach ($rows as $row) {
            // if the field for this row is absent from the request, continue
            // checkboxes will be absent when unchecked, thus they are the exception
            if (!$request->hasFile($row->field) && !$request->has($row->field) && $row->type !== 'checkbox') {
                // if the field is a belongsToMany relationship, don't remove it
                // if no content is provided, that means the relationships need to be removed
                if (isset($row->details->type) && $row->details->type !== 'belongsToMany') {
                    continue;
                }
            }

            // Value is saved from $row->details->column row
            if ($row->type == 'relationship' && $row->details->type == 'belongsTo') {
                continue;
            }

            $content = $this->getContentBasedOnType($request, $slug, $row, $row->details);

            if ($row->type == 'relationship' && $row->details->type != 'belongsToMany') {
                $row->field = @$row->details->column;
            }

            /*
             * merge ex_images and upload images
             */
            if ($row->type == 'multiple_images' && !is_null($content)) {
                if (isset($data->{$row->field})) {
                    $ex_files = json_decode($data->{$row->field}, true);
                    if (!is_null($ex_files)) {
                        $content = json_encode(array_merge($ex_files, json_decode($content)));
                    }
                }
            }

            if (is_null($content)) {

                // If the image upload is null and it has a current image keep the current image
                if ($row->type == 'image' && is_null($request->input($row->field)) && isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }

                // If the multiple_images upload is null and it has a current image keep the current image
                if ($row->type == 'multiple_images' && is_null($request->input($row->field)) && isset($data->{$row->field})) {
                    $content = $data->{$row->field};
                }

                // If the file upload is null and it has a current file keep the current file
                if ($row->type == 'file') {
                    $content = $data->{$row->field};
                    if (!$content) {
                        $content = json_encode([]);
                    }
                }

                if ($row->type == 'password') {
                    $content = $data->{$row->field};
                }
            }

            if ($row->type == 'relationship' && $row->details->type == 'belongsToMany') {
                // Only if select_multiple is working with a relationship
                $multi_select[] = ['model' => $row->details->model, 'content' => $content, 'table' => $row->details->pivot_table];
            } else {
                $data->{$row->field} = $content;
            }
        }

        if (isset($data->additional_attributes)) {
            foreach ($data->additional_attributes as $attr) {
                if ($request->has($attr)) {
                    $data->{$attr} = $request->{$attr};
                }
            }
        }

        $data->save();

        // Save translations
        if (count($translations) > 0) {
            $data->saveTranslations($translations);
        }

        foreach ($multi_select as $sync_data) {
            $data->belongsToMany($sync_data['model'], $sync_data['table'])->sync($sync_data['content']);
        }

        // Rename folders for newly created data through media-picker
        if ($request->session()->has($slug.'_path') || $request->session()->has($slug.'_uuid')) {
            $old_path = $request->session()->get($slug.'_path');
            $uuid = $request->session()->get($slug.'_uuid');
            $new_path = str_replace($uuid, $data->getKey(), $old_path);
            $folder_path = substr($old_path, 0, strpos($old_path, $uuid)).$uuid;

            $rows->where('type', 'media_picker')->each(
                function ($row) use ($data, $uuid) {
                    $data->{$row->field} = str_replace($uuid, $data->getKey(), $data->{$row->field});
                }
            );
            $data->save();
            if ($old_path != $new_path && !Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->exists($new_path)) {
                $request->session()->forget([$slug.'_path', $slug.'_uuid']);
                Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->move($old_path, $new_path);
                Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->deleteDirectory($folder_path);
            }
        }

        return $data;
    }

    /**
     * Validates bread POST request.
     *
     * @param array  $data The data
     * @param array  $rows The rows
     * @param string $slug Slug
     * @param int    $id   Id of the record to update
     *
     * @return mixed
     */
    public function validateBread($data, $rows, $name = null, $id = null)
    {
        $rules = [];
        $messages = [];
        $customAttributes = [];
        $is_update = $name && $id;

        $fieldsWithValidationRules = $this->getFieldsWithValidationRules($rows);

        foreach ($fieldsWithValidationRules as $field) {
            $fieldRules = $field->details->validation->rule;
            $fieldName = $field->field;

            // Show the field's display name on the error message
            if (!empty($field->display_name)) {
                $customAttributes[$fieldName] = $field->getTranslatedAttribute('display_name');
            }

            // Get the rules for the current field whatever the format it is in
            $rules[$fieldName] = is_array($fieldRules) ? $fieldRules : explode('|', $fieldRules);

            if ($id && property_exists($field->details->validation, 'edit')) {
                $action_rules = $field->details->validation->edit->rule;
                $rules[$fieldName] = array_merge($rules[$fieldName], (is_array($action_rules) ? $action_rules : explode('|', $action_rules)));
            } elseif (!$id && property_exists($field->details->validation, 'add')) {
                $action_rules = $field->details->validation->add->rule;
                $rules[$fieldName] = array_merge($rules[$fieldName], (is_array($action_rules) ? $action_rules : explode('|', $action_rules)));
            }
            // Fix Unique validation rule on Edit Mode
            if ($is_update) {
                foreach ($rules[$fieldName] as &$fieldRule) {
                    if (strpos(strtoupper($fieldRule), 'UNIQUE') !== false) {
                        $fieldRule = \Illuminate\Validation\Rule::unique($name)->ignore($id);
                    }
                }
            }

            // Set custom validation messages if any
            if (!empty($field->details->validation->messages)) {
                foreach ($field->details->validation->messages as $key => $msg) {
                    $messages["{$fieldName}.{$key}"] = $msg;
                }
            }
        }

        return Validator::make($data, $rules, $messages, $customAttributes);
    }

    public function getContentBasedOnType(Request $request, $slug, $row, $options = null)
    {
        switch ($row->type) {
            /**********
 * PASSWORD TYPE 
**********/
        case 'password':
            return (new Password($request, $slug, $row, $options))->handle();
            /**********
 * CHECKBOX TYPE 
**********/
        case 'checkbox':
            return (new Checkbox($request, $slug, $row, $options))->handle();
            /**********
 * MULTIPLE CHECKBOX TYPE 
**********/
        case 'multiple_checkbox':
            return (new MultipleCheckbox($request, $slug, $row, $options))->handle();
            /**********
 * FILE TYPE 
**********/
        case 'file':
            return (new File($request, $slug, $row, $options))->handle();
            /**********
 * MULTIPLE IMAGES TYPE 
**********/
        case 'multiple_images':
            return (new MultipleImage($request, $slug, $row, $options))->handle();
            /**********
 * SELECT MULTIPLE TYPE 
**********/
        case 'select_multiple':
            return (new SelectMultiple($request, $slug, $row, $options))->handle();
            /**********
 * IMAGE TYPE 
**********/
        case 'image':
            return (new ContentImage($request, $slug, $row, $options))->handle();
            /**********
 * TIMESTAMP TYPE 
**********/
        case 'timestamp':
            return (new Timestamp($request, $slug, $row, $options))->handle();
            /**********
 * COORDINATES TYPE 
**********/
        case 'coordinates':
            return (new Coordinates($request, $slug, $row, $options))->handle();
            /**********
 * RELATIONSHIPS TYPE 
**********/
        case 'relationship':
            return (new Relationship($request, $slug, $row, $options))->handle();
            /**********
 * ALL OTHER TEXT TYPE 
**********/
        default:
            return (new Text($request, $slug, $row, $options))->handle();
        }
    }

    public function deleteFileIfExists($path)
    {
        if (Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->exists($path)) {
            Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->delete($path);
            event(new FileDeleted($path));
        }
    }

    /**
     * Get fields having validation rules in proper format.
     *
     * @param array $fieldsConfig
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getFieldsWithValidationRules($fieldsConfig)
    {
        return $fieldsConfig->filter(
            function ($value) {
                if (empty($value->details)) {
                    return false;
                }

                return !empty($value->details->validation->rule);
            }
        );
    }
}