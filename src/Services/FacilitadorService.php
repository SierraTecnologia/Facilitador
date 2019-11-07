<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

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
            $this->config = config('sitec-facilitador.models');
        }
    }

    public function getModelServices()
    {
        if (!$this->modelServices) {
            $this->modelServices = collect($this->config)->map(function ($value) {
                return new ModelService($value, false);
            });
        }

        return $this->modelServices;
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
