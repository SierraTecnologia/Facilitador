<?php

namespace Facilitador\Http\Controllers;

use Facilitador\Services\FacilitadorService;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * The user repository instance.
     */
    protected $facilitadorService;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $repositoryService
     * @return void
     */
    public function __construct(FacilitadorService $facilitadorService)
    {
        $this->facilitadorService = $facilitadorService;
    }

}