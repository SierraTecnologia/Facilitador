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
use Support\Coder\Discovers\Eloquent\ModelEloquent;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{
    protected $repository = false;
    protected $discoverModel = false;
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
        if (!$this->discoverModel) {
            $this->discoverModel = new ModelEloquent($this->getModelClass());
        }
        return $this->discoverModel;
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
    public function getModelClass()
    {
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
        // dd($this->getDiscoverService()->getAtributes(), $this->getDiscoverService()->schemaManagerTable->toArray(), $this->getDiscoverService()->getColumns());
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
}
