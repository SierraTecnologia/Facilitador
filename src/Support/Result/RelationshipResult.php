<?php

namespace SierraTecnologia\Facilitador\Support\Result;

use SierraTecnologia\Facilitador\Support\Eloquent\Relationship;
use Illuminate\Support\Collection;
use SierraTecnologia\Facilitador\Services\ModelService;
use SierraTecnologia\Facilitador\Services\RepositoryService;

class RelationshipResult
{
    public $relationShip;
    public $results;
    public $repository;

    public function __construct(Relationship $relationShip, Collection $results)
    {
        $this->relationShip = $relationShip;
        $this->results = $results;
        $this->repository = new RepositoryService(new ModelService($relationShip->model));
    }
}
