<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{

    protected $modelClass;

    public function __construct(Request $request, $crypto = true)
    {
        $modelClass = $request->input('modelClass');
        // $modelClass
        if ($crypto) {
            $modelClass = Crypto::decrypt($modelClass);
        }
        $this->modelClass = $modelClass;
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
    public function getUrl()
    {
        return url('facilitador/repository');
    }


    public function getName()
    {
        return $this->modelClass::getClass()->getName();
    }

    /**
     * Contagens E querys
     */
    public function count()
    {
        return $this->modelClass::count();
    }

    public function getModelQuery()
    {
        return $this->modelClass::query();
    }

    public function getAll()
    {
        return $this->modelClass::all();
    }

    /**
     * Relações
     */
    public function getAtributes()
    {
        $modelInstance = new $this->modelClass;
        $relations = $modelInstance->getRelations();
        return $relations;
    }
    public function getRelations()
    {
        $modelInstance = new $this->modelClass;
        $relations = $modelInstance->getRelations();
        return $relations;
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
        return [
            'identity' => [
                'title' => [
                    'type' => 'string',
                ],
                'url' => [
                    'type' => 'string',
                ],
                'tags' => [
                    'type' => 'string',
                    'class' => 'tags',
                ],
            ],
            'content' => [
                'entry' => [
                    'type' => 'text',
                    'class' => 'redactor',
                    'alt_name' => 'Content',
                ],
                'hero_image' => [
                    'type' => 'file',
                    'alt_name' => 'Hero Image',
                ],
            ],
            'seo' => [
                'seo_description' => [
                    'type' => 'text',
                    'alt_name' => 'SEO Description',
                ],
                'seo_keywords' => [
                    'type' => 'string',
                    'class' => 'tags',
                    'alt_name' => 'SEO Keywords',
                ],
            ],
            'publish' => [
                'is_published' => [
                    'type' => 'checkbox',
                    'alt_name' => 'Published',
                ],
                'published_at' => [
                    'type' => 'string',
                    'class' => 'datetimepicker',
                    'alt_name' => 'Publish Date',
                    'custom' => 'autocomplete="off"',
                    'after' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>',
                ],
            ],
        ];
    }

}
