<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace Facilitador\Services;

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
            $this->config = config('sitec.facilitador.models');
        }
    }

    public function getModelServicesToArray()
    {

        $models = $this->getModelServices(); 
        $array = [];

        foreach ($models as $model) {
            $array[] = [
                'model' => $model,
                'url' => $model->getUrl(),
                'count' => $model->getRepository()->count(),
                'icon' => \Support\Template\Layout\Icons::getForNameAndCache($model->getName()),
                'name' => $model->getName(),
            ];
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
