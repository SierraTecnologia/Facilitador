<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use SierraTecnologia\Facilitador\Support\Result\RelationshipResult;

/**
 * RegisterService helper to make table and object form mapping easy.
 */
class RegisterService
{

    protected $identify;
    protected $instance;
    protected $repositoryService = false;

    public function __construct(string $identify)
    {
        $this->identify = $identify;
    }

    public function load(RepositoryService $repository)
    {
        if ($this->repositoryService) {
            return false;
        }

        $this->repositoryService = $repository;
        return $this;
    }

    public function getInstance()
    {
        if (!$this->instance) {
            $modelClass = $this->getModelService()->getModelClass();
            $this->instance = $modelClass::find($this->identify);
        }
        return $this->instance;
    }

    public function getModelService()
    {
        return $this->repositoryService->getModelService();
    }




    // /**
    //  * Set the form maker user.
    //  *
    //  * @param string $user
    //  */
    // public function viewEdit($user)
    // {
    //     $this->user = $user;

    //     return $this;
    // }


    // /**
    //  * Set the form maker.
    //  *
    //  */
    // public function viewShow()
    // {
    //     $results = $this->getRelationsResults();
    //     return $results;
    // }

    /**
     * Trabalhos Pesados
     */

    public function getRelationsResults($returnEmptys = false)
    {
        $results = new Collection;
        $this->getModelService()->getRelations()->map(function ($value) use ($results, $returnEmptys) {
            $tmpRelationResults = $this->getInstance()->{$value->name}()->get();
            
            if ($returnEmptys || count($tmpRelationResults)>0) {
                $results[$value->name] = new RelationshipResult($value, $tmpRelationResults);
            }
        });

        return $results;
    }
}
