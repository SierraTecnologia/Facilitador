<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;
use Facilitador\Support\Eloquent\Relationships;
use App;
use Log;
use Illuminate\Support\Collection;
use Facilitador\Support\Entities\DataTypes\Varchar;
use Facilitador\Support\Eloquent\EloquentColumn;
use ReflectionClass;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{

    protected $modelClass;
    protected $repository = false;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function getRepository()
    {
        if (!$this->repository) {
            $this->repository = new RepositoryService($this);
        }
        return $this->repository;
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
        return url('admin/'.$this->getCryptName().$page);
    }


    public function getCryptName()
    {
        return Crypto::encrypt($this->modelClass);
    }

    public function getName($plural = false)
    {
        $reflection = new ReflectionClass($this->modelClass);
        $name = $reflection->getShortName();

        if ($plural) {
            $name .= '\'s';
        }

        return $name;
    }
    public function getTableName()
    {
        $name = $this->getModelClass();
        $model = new $name;
        return $model->getTable();
    }
    public function getModelClass()
    {
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
     * Caracteristicas das Tabelas
     */
    public function getPrimaryKey()
    {
        return App::make($this->modelClass)->getKeyName();
    }

    /**
     * Relações
     */
    public function getAtributes()
    {
        // dd(\Schema::getColumnListing($this->modelClass));
        $fillables = collect(App::make($this->modelClass)->getFillable())->map(function ($value) {
            return new EloquentColumn($value, new Varchar, true);
        });
        return $fillables;
    }
    public function getRelations($key = false)
    {
        return (new Relationships($this->modelClass))($key);
    }

    public function getRelationsByGroup()
    {

        $classes = $this->getRelations();
        
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
     * Campos
     *
     * @return void
     */
    public function getFields()
    {
        
    }

    public function getFieldForForm()
    {
        $atributes = $this->getAtributes();
        $fields = [
            'identity' =>  $atributes->all(),
        ];
        return $fields;

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

}
