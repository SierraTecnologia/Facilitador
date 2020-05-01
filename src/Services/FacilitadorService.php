<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

use Support\Parser\ComposerParser;
use Support\ClassesHelpers\Development\HasErrors;

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
            $this->config = config('sitec.discover.models', []);
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
            $allModels = collect($this->getDatabaseService()->getAllEloquentsEntitys())->reject(function ($class) {
                return empty($class);
            })->map(function($class) {
                return new ModelService($class);
            })->values()->all();
            $models = array_merge(
                $models,
                $allModels
            );
        }

        /////////////
        $array = [];

        foreach ($models as $model) {
            try {
                $array[] = [
                    'model' => $model,
                    'url' => $model->getUrl(),
                    'count' => $model->getRepository()->count(),
                    // @todo Remover Daqui
                    'icon' => \Support\Template\Layout\Icons::getForNameAndCache($model->getName()),
                    'name' => $model->getName(),
                ];
            } catch(\Symfony\Component\Debug\Exception\FatalThrowableError $e) {
                dd($e); 
                $this->setErrors($e);
            } catch(\Exception $e) {
                dd($e); 
                $this->setErrors($e);
            } catch(\Throwable $e) {
                dd($e); 
                $this->setErrors($e);
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
