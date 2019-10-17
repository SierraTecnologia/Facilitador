<?php

namespace SierraTecnologia\Facilitador\Http\Controllers;

use Illuminate\Http\Request;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class RepositoryController
{
    protected $service;

    public function __construct(RepositoryService $repositoryService)
    {
        $this->service = $repositoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = $this->service->getTableData();

        return view(
            'facilitador::repositories.index',
            compact('registros')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTableJson()
    {
        return $this->service->getTableJson();
    }
}