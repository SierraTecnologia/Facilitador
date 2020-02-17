<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;
use Support\Coder\Discovers\Eloquent\Relationships;
use App;
use Log;
use Exception;
use Artisan;
use Illuminate\Support\Collection;
use Support\Elements\Entities\DataTypes\Varchar;
use Support\Coder\Discovers\Eloquent\EloquentColumn;
use ReflectionClass;
use Support\Coder\Discovers\Database\Schema\SchemaManager;
use Support\Services\EloquentService;
use Facilitador\Routing\UrlGenerator;
use Facilitador\Models\DataRow;
use Facilitador\Models\DataType;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{
    protected $repository = false;
    protected $modelDataType = false;
    protected $modelClass;

    public function __construct($modelClass = false)
    {
        if ($this->modelClass = $modelClass) {
            if (!is_string($modelClass)) {
                throw new Exception(
                    "Essa classe deveria ser uma string: ".print_r($modelClass, true),
                    400
                );
            }
            $this->getDiscoverService();
        }
    }

    public function getRepository()
    {
        if (!$this->repository) {
            $this->repository = new RepositoryService($this);
        }
        return $this->repository;
    }
    public function getDiscoverService()
    {
        if (!$this->modelDataType) {

            $this->modelDataType = $this->dataType('model_name', $this->getModelClass());
            if (!$this->modelDataType->exists) {
                $eloquentService = new EloquentService($this->getModelClass());
                if (!$managerArray = $eloquentService->managerToArray()) {
                    return false;
                }
                $managerArray = $managerArray['modelManager'];
                // dd(
                //     $eloquentService,
                //     $eloquentService->toArray(),
                //     $managerArray
                // );
                // Name e Slug sao unicos
                $this->modelDataType->fill([
                    'name'                  => $eloquentService->getModelClass(), //strtolower($eloquentService->getName(true)),
                    'slug'                  => $eloquentService->getModelClass(), //strtolower($eloquentService->getName(true)),
                    'display_name_singular' => $eloquentService->getName(false),
                    'display_name_plural'   => $eloquentService->getName(true),
                    'icon'                  => \Support\Template\Layout\Icons::getForNameAndCache($eloquentService->getName(), false),
                    'model_name'            => $eloquentService->getModelClass(),
                    'controller'            => '',
                    'generate_permissions'  => 1,
                    'description'           => '',
                    'table_name'              => $managerArray['table'],
                    'key_name'                => $managerArray['getKeyName'],
                    'key_type'                => $managerArray['getKeyType'],
                    'foreign_key'             => $managerArray['getForeignKey'],
                ])->save();

                $order = 1;
                foreach ($eloquentService->getColumns() as $column) {
                    // dd(
                    //     $eloquentService->getColumns(),
                    //     $column,
                    //     $column->getData('notnull')
                    // );

                    $dataRow = $this->dataRow($this->modelDataType, $column->getColumnName());
                    if (!$dataRow->exists) {
                        $dataRow->fill([
                            // 'type'         => 'select_dropdown',
                            'type'         => $column->getColumnType(),
                            'display_name' => $column->getName(),
                            'required'     => $column->isRequired() ? 1 : 0,
                            'browse'     => $column->isBrowse() ? 1 : 0,
                            'read'     => $column->isRead() ? 1 : 0,
                            'edit'     => $column->isEdit() ? 1 : 0,
                            'add'     => $column->isAdd() ? 1 : 0,
                            'delete'     => $column->isDelete() ? 1 : 0,
                            'details'      => $column->getDetails(),
                            'order' => $order,
                        ])->save();
                        ++$order;
                    }
                }
            }
        }
        return $this->modelDataType;
    }

    public function getPrimaryKey()
    {
        return $this->getDiscoverService()->getPrimaryKey();   
    }

    /**
     * Verificadores
     *
     * @param [type] $modelClass
     * @return boolean
     */
    public function isModelClass($modelClass)
    {
        return $this->modelClass == $modelClass;
    }

    /**
     * Atributos da Classe
     *
     * @return void
     */
    public function getUrl($page = '')
    {
        return UrlGenerator::managerRoute($this->modelClass, $page);
    }


    public function getCryptName()
    {
        return Crypto::encrypt($this->modelClass);
    }

    public function getName($plural = false)
    {
        return $this->getDiscoverService()->getName($plural);
    }
    public function getModelClass()
    {
        if (Crypto::isCrypto($this->modelClass)) {
            $this->modelClass = Crypto::decrypt($this->modelClass);
        }

        if (empty($this->modelClass)) {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            // return redirect()->route('facilitador.dash');
            throw new Exception('Criptografia inválida ' . $this->modelClass);
        }
        return $this->modelClass;
    }

    /**
     * Contagens E querys
     */
    public function getModelQuery()
    {
        return $this->modelClass::query();
    }

    /**
     * Campos
     *
     * @return void
     */
    public function getFieldForForm()
    {
        $atributes = $this->getColumnsForForm();
        $formGroup = 'identity';
        $fieldsArray = [];

        foreach ($atributes as $atribute) {
            if (!isset($fieldsArray[$formGroup])) {
                $fieldsArray[$formGroup] = [];
            }
            //@todo COnsertando erro pois da conflito
            if ($atribute->getName()=='name') {
                continue;
            }
            $nameType = $atribute->getType()->getName();
            $fieldsArray[$formGroup][$atribute->getName()] = [];
            $fieldsArray[$formGroup][$atribute->getName()]['type'] = $nameType;
                // 'class' => 'redactor',
                // 'alt_name' => 'Content',

            // // Caso seja Data // @todo Removido
            // if ($nameType = 'datetime') {
            //     $fieldsArray[$formGroup][$atribute->getName()]['type'] = 'string';
            //     $fieldsArray[$formGroup][$atribute->getName()]['class'] = 'datetimepicker';
            // }
        }

        // dd( $fieldsArray);
        // return $fieldsArray;  // @todo Sections nao funcionando
        return $fieldsArray[$formGroup];

        // return [
        //     'identity' => [
        //         'title' => [
        //             'type' => 'string',
        //         ],
        //         'url' => [
        //             'type' => 'string',
        //         ],
        //         'tags' => [
        //             'type' => 'string',
        //             'class' => 'tags',
        //         ],
        //     ],
        //     'content' => [
        //         'entry' => [
        //             'type' => 'text',
        //             'class' => 'redactor',
        //             'alt_name' => 'Content',
        //         ],
        //         'hero_image' => [
        //             'type' => 'file',
        //             'alt_name' => 'Hero Image',
        //         ],
        //     ],
        //     'seo' => [
        //         'seo_description' => [
        //             'type' => 'text',
        //             'alt_name' => 'SEO Description',
        //         ],
        //         'seo_keywords' => [
        //             'type' => 'string',
        //             'class' => 'tags',
        //             'alt_name' => 'SEO Keywords',
        //         ],
        //     ],
        //     'publish' => [
        //         'is_published' => [
        //             'type' => 'checkbox',
        //             'alt_name' => 'Published',
        //         ],
        //         'published_at' => [
        //             'type' => 'string',
        //             'class' => 'datetimepicker',
        //             'alt_name' => 'Publish Date',
        //             'custom' => 'autocomplete="off"',
        //             'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
        //         ],
        //     ],
        // ];
    }



    /**
     * Caracteristicas das Tabelas
     */

    public function getColumnsForForm()
    {
        // dd($this->getDiscoverService()->getColumns(), $this->getDiscoverService()->schemaManagerTable->toArray(), $this->getDiscoverService()->getColumns());
        return $this->getDiscoverService()->getColumns();
    }

    public function getRelationsByGroup()
    {

        $classes = $this->getDiscoverService()->getRelations();
        
        $group = [];
        foreach ($classes as $class) {
            if (!isset($group[$class->type])) {
                $group[$class->type] = [];
            }
            $group[$class->type][] = $class;
        }
        return $group;
    }



    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
                'data_type_id' => $type->id,
                'field'        => $field,
            ]);
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
