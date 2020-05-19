<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

use Support\Components\Coders\Parser\ComposerParser;
use Support\Traits\Debugger\HasErrors;


use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Exception;
use ErrorException;
use LogicException;
use OutOfBoundsException;
use RuntimeException;
use TypeError;
use Throwable;
use Watson\Validating\ValidationException;
/**
 * 
 */
class FacilitadorService
{
    use HasErrors;

    protected $config;

    protected $modelServices = false;

    public function __construct($config = false)
    {
        if (!$this->config = $config) {
            $this->config = \Illuminate\Support\Facades\Config::get('sitec.discover.models', []);
        }
        $this->getModelServicesToArray(false);
    }

    public function getDatabaseService()
    {
        return resolve(\Support\Services\DatabaseService::class);
    }

    public function getModelServicesToArray($onlyConfig = true)
    {
        $models = $this->getModelServices(); 

        if (!$onlyConfig) {

            // INvez de usar pela classe ta usando direto o eloquentENtity
            // $allModels = collect($this->getDatabaseService()->getAllModels())->map(function($file, $class) {
            $allModels = collect($this->getDatabaseService()->getAllEloquentsEntitys())->reject(
                function ($class) {
                    return empty($class);
                }
            )->map(
                function ($class) {
                    return new ModelService($class);
                }
            )->values()->all();
            $models = array_merge(
                $models,
                $allModels
            );
        }

        /////////////
        $array = [];

        foreach ($models as $model) {

            if (!$model->getEloquentEntity()) {
                $this->setErrors(
                    'Entity retornando falso para modelo: '.$model->getModelClass()
                );
            } else {
                try {
                    $array[] = [
                        'model' => $model,
                        'url' => $model->getUrl(),
                        'count' => $model->getRepository()->count(),
                        'icon' => $model->getIcon(),
                        'name' => $model->getName(),
                        'group_package' => $model->getGroupPackage(),
                        'group_type' => $model->getGroupType(),
                        'history_type' => $model->getHistoryType(),
                        'register_type' => $model->getRegisterType(),
                    ];

                } catch(LogicException|ErrorException|RuntimeException|OutOfBoundsException|TypeError|ValidationException|FatalThrowableError|FatalErrorException|Exception|Throwable  $e) {
                    $this->setErrors($e);
                    // dd(
                    //     'a',
                    //     $model->getEloquentEntity(),
                    //     $model,
                    //     $e
                    // );
                } 
            }
        }
        // dd('Modelos', $array);
        return collect($array);
    }

    public function getModelServices()
    {
        if (!$this->modelServices) {
            $this->modelServices = $this->recoverModelsFromConfig($this->config);
        }

        return $this->modelServices;
    }

    private function recoverModelsFromConfig($configModels)
    {
        $models = [];
        if (empty($configModels)) {
            return $models;
        }
        foreach ($configModels as $model) {
            if (is_array($model)) {
                $models = array_merge(
                    $models,
                    $this->recoverModelsFromConfig($model)
                );
            } else {
                $models[] = new ModelService($model);
            }
        }
        return $models;
    }

    public function modelIsValid($model)
    {
        $services = $this->getModelServices();

        if (!is_array($services)) {
            return false;
        }

        foreach ($services as $service) {
            if ($service->isModelClass($model)) {
                return true;
            }
        }
        
        return false;
    }

}
