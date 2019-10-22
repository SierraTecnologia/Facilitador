<?php

namespace SierraTecnologia\Facilitador\Http\Controllers\Universal;

use SierraTecnologia\Facilitador\Http\Controllers\Controller as SierraTecnologiaController;
use SierraTecnologia\Facilitador\Services\FacilitadorService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

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