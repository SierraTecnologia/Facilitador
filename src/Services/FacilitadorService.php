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

    public function __construct($config = false)
    {
        if (!$this->config = $config) {
            $this->config = config('sitec-facilitador.models');
        }
    }

    public function getModelServices()
    {
        return $this->config->map(function ($value) {
            return new ModelService($value, false);
        });
    }

}
