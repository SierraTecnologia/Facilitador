<?php

namespace Facilitador\Http\Controllers\Universal;

use Facilitador\Http\Controllers\Controller as SierraTecnologiaController;
use Facilitador\Services\FacilitadorService;
use Facilitador\Services\RepositoryService;

class Controller extends SierraTecnologiaController
{
    
    /**
     * The user repository instance.
     */
    protected $repositoryService;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $repositoryService
     * @return void
     */
    public function __construct(FacilitadorService $facilitadorService, RepositoryService $repositoryService)
    {
        $this->repositoryService = $repositoryService;
        parent::__construct($facilitadorService);
    }

}