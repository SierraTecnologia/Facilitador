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

    protected $modelClass;

    public function __construct($modelClass)
    {
        $this->modelClass = new $modelClass;
    }

    public function getModelQuery()
    {
        return $this->modelClass::query();
    }

    /**
     * Set the form maker connection.
     *
     * @param string $connection
     */
    public function viewIndexJson()
    {
        return DataTables::of($this->getModelQuery())->toJson();
    }


}
