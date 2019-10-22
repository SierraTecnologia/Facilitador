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

    public function __construct($identify)
    {
        $this->identify = Crypto::decrypt($identify);
    }

    public function load(RepositoryService $repository)
    {
        if ($this->repositoryService) {
            return false;
        }

        $this->repositoryService = $repository;
        $this->instance = $this->repositoryService->getModelService()->find($this->identify);
        return $this;
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


}
