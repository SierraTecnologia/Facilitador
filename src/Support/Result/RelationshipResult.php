<?php

namespace Facilitador\Support\Result;

use Support\Elements\Entities\Relationship;
use Illuminate\Support\Collection;
use Support\Services\ModelService;
use Support\Services\RepositoryService;

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
