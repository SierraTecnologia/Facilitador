<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionMethod;
use App;

/**
 * ModelService helper to make table and object form mapping easy.
 */
class ModelService
{

    protected $modelClass;

    // public function __construct(Request $request, $crypto = true)
    public function __construct(string $modelClass, $crypto = true)
    {
        // $modelClass = $request->input('modelClass');
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
        return url('admin/'.$this->getCryptName());
    }


    public function getCryptName()
    {
        return Crypto::encrypt($this->modelClass);
    }

    public function getName()
    {
        $reflection = new ReflectionClass($this->modelClass);
        return $reflection->getShortName();
    }

    /**
     * Contagens E querys
     */
    public function getModelQuery()
    {
        return $this->modelClass::query();
    }

    public function count()
    {
        return $this->modelClass::count();
    }

    public function find($identity)
    {
        return $this->modelClass::find($identity);
    }

    public function getAll()
    {
        return $this->modelClass::all();
    }

    /**
     * Caracteristicas das Tabelas
     */
    public function getPrimaryKey()
    {
        return App::make($this->modelClass)->relationsToArray();
    }

    /**
     * Relações
     */
    public function getAtributes()
    {
        return App::make($this->modelClass);
    }
    public function getRelations()
    {
        $model = new $this->modelClass;
        $reflector = new ReflectionClass($model);
        // $relations = [];
        // dd($reflector->getMethods(ReflectionMethod::IS_PUBLIC));
        // dd(App::make($this->modelClass)->relationsToArray());
        // foreach ($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $reflectionMethod) {
        //     $returnType = $reflectionMethod->getReturnType();
        //     var_dump($returnType);
        //     if ($returnType) {
        //         if (in_array(class_basename($returnType->getName()), ['HasOne', 'HasMany', 'BelongsTo', 'BelongsToMany', 'MorphToMany', 'MorphTo'])) {
        //             $relations[] = $reflectionMethod;
        //         }
        //     }
        // }

        // dd($relations);
        // return App::make($this->modelClass);



        $relationships = [];

        foreach($reflector->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch(ErrorException $e) {}
        }

        dd($relationships);
        return $relationships;
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
