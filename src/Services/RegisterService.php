<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

/**
 * RegisterService helper to make table and object form mapping easy.
 */
class RegisterService
{

    protected $identify;
    protected $instance;
    protected $repositoryService = false;

    public function __construct($identify, $crypto = true)
    {
        if ($crypto) {
            $identify = Crypto::decrypt($identify);
        }
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

    protected function getInstance()
    {
        if (!$this->instance) {
            $this->instance = $this->repositoryService->getModelService()->find($this->identify);
        }
        return $this->instance;
    }

    /**
     * Relações
     */
    public function getAtributes()
    {
        $modelInstance = $this->getInstance();
        $relations = $modelInstance->getRelations();
        return $relations;
    }
    public function getRelations()
    {
        $modelInstance = $this->getInstance();
        $relations = $modelInstance->getRelations();
        return $relations;
    }


    /**
     * Set the form maker user.
     *
     * @param string $user
     */
    public function viewEdit($user)
    {
        $this->user = $user;

        return $this;
    }


    /**
     * Set the form maker connection.
     *
     * @param string $connection
     */
    public function viewShow($connection)
    {
        $this->connection = $connection;

        return $this;
    }


    /**
     * Set the form maker connection.
     *
     * @param string $connection
     */
    public function find()
    {
        return $this->getInstance();
    }


}
