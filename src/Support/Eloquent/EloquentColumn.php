<?php

namespace SierraTecnologia\Facilitador\Support\Eloquent;

use SierraTecnologia\Facilitador\Support\Eloquent\Relationship;
use Illuminate\Support\Collection;
use SierraTecnologia\Facilitador\Services\ModelService;
use SierraTecnologia\Facilitador\Services\RepositoryService;
use SierraTecnologia\Facilitador\Support\Entities\DataType;
use Illuminate\Database\Eloquent\Model;

class EloquentColumn
{
    public $column;
    public $type;
    public $fillable;

    public function __construct(string $column, DataType $type, bool $filliable = false)
    {
        $this->column = $column;
        $this->type = $type;
        $this->filliable = $filliable;
    }

    public function getColumnName()
    {
        return $this->column;
    }

    public function getName()
    {
        return ucfirst($this->column);
    }

    public function displayFromModel(Model $resultModel)
    {
        $column = $this->getColumnName();
        return $resultModel->$column;
    }
}
