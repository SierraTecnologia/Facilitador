<?php

namespace SierraTecnologia\Facilitador\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * RepositoryService helper to make table and object form mapping easy.
 */
class RepositoryService
{

    protected $modelService;

    public function __construct($modelClass)
    {
        $this->modelService = new ModelService($modelClass);
    }

    public function getTableData()
    {
        return $this->modelService->getAll();
    }

    /**
     * Set the form maker connection.
     *
     * @param string $connection
     */
    public function getTableJson()
    {
        return DataTables::of($this->modelService->getModelQuery())->toJson();
    }


}
