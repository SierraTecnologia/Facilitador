<?php

namespace SierraTecnologia\Facilitador\Http\Controllers\Universal;

use Illuminate\Http\Request;
use SierraTecnologia\Facilitador\Services\FacilitadorService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class Controller
{
    /**
     * The user repository instance.
     */
    protected $facilitadorService;
    
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
        $this->facilitadorService = $facilitadorService;
    }

}