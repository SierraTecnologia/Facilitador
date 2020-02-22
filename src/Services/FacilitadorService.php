<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

use Support\Coder\Parser\ComposerParser;

/**
 * 
 */
class FacilitadorService
{

    protected $config;

    protected $modelServices = false;

    public function __construct($config = false)
    {
        if (!$this->config = $config) {
            $this->config = config('sitec.discover.models_alias');
        }
    }

    public function getModelServicesToArray($onlyConfig = true)
    {

// dd((new \Support\Services\DatabaseService(config('sitec.discover.models_alias'), new ComposerParser))->getAllModels());
        $models = $this->getModelServices(); 
        if (!$onlyConfig) {
            $allModels = collect((new \Support\Services\DatabaseService(config('sitec.discover.models_alias'), new ComposerParser))->getAllModels())->map(function($file, $class) {
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
                    'icon' => \Support\Template\Layout\Icons::getForNameAndCache($model->getName()),
                    'name' => $model->getName(),
                ];
            } catch(\Symfony\Component\Debug\Exception\FatalThrowableError $e) {
                // dd($e);
                //@todo fazer aqui
            } catch(\Exception $e) {
                // @todo Tratar aqui
            } catch(\Throwable $e) {
                // dd($e);
                // @todo Tratar aqui
            }
        }
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
