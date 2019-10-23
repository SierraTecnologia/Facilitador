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

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getModelsClass()
    {
        return config('sitec-facilitador.models');
    } 

    public function getModelServices()
    {
        return $this->getModelsClass()->map(function ($value) {
            return new ModelService($value, false);
        });
    }

}
