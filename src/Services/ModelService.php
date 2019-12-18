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
use Exception;
use Artisan;
use Illuminate\Support\Collection;
use Facilitador\Support\Entities\DataTypes\Varchar;
use Facilitador\Support\Eloquent\EloquentColumn;
use ReflectionClass;
use TCG\Voyager\Database\Schema\SchemaManager;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{

    protected $modelClass;
    protected $repository = false;
    protected $schemaManagerTable = false;

    public function __construct($modelClass = false)
    {
        if ($this->modelClass = $modelClass) {
            $this->renderTableInfos();
        }
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
        return url('manager/'.$this->getCryptName().$page);
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
        Log::warning($name);

        if (!class_exists($name)) {
            throw new Exception('Class não encontrada no ModelService' . $name);
        }

        $model = new $name;
        return $model->getTable();
    }
    public function getModelClass()
    {
        if (empty($this->modelClass)) {
            Artisan::call('cache:clear');
            Artisan::call('down');
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
    public function getFields()
    {
        
    }

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


    private function renderTableInfos()
    {
        $this->schemaManagerTable = SchemaManager::listTableDetails($this->getTableName());
        // dd($this->schemaManagerTable);
    }

    /**
     * Caracteristicas das Tabelas
     */
    public function getPrimaryKey()
    {
        return App::make($this->modelClass)->getKeyName();
    }

    public function getColumnsForForm()
    {
        // dd($this->getAtributes(), $this->schemaManagerTable->toArray(), $this->getColumns());
        return $this->getColumns();
    }

    public function getColumns()
    {
        // dd($this->getAtributes(), $this->schemaManagerTable->getColumns());
        return $this->schemaManagerTable->getColumns();
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
        // dd($key, (new Relationships($this->modelClass)),(new Relationships($this->modelClass))($key));
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
}
