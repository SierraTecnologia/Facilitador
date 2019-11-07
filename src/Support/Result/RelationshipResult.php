<?php

namespace Facilitador\Support\Result;

use Facilitador\Support\Eloquent\Relationship;
use Illuminate\Support\Collection;
use Facilitador\Services\ModelService;
use Facilitador\Services\RepositoryService;

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