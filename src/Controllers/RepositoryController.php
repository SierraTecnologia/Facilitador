<?php

namespace SierraTecnologia\Facilitador\Controllers;

use Illuminate\Http\Request;
use Siravel\Models\Components\Code\Commit;
namespace SierraTecnologia\Facilitador\Services\RepositoryService;

class RepositoryController extends Controller
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