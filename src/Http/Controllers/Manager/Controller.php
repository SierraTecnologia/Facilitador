<?php

namespace Facilitador\Http\Controllers\Manager;

use Facilitador\Http\Controllers\Controller as SierraTecnologiaController;
use Facilitador\Services\FacilitadorService;
use Facilitador\Services\RepositoryService;
use Facilitador\Http\Controllers\Traits\BreadRelationshipParser;

class Controller extends SierraTecnologiaController
{
    use BreadRelationshipParser;
    
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