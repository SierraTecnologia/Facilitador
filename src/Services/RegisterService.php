<?php
/**
 * Serviço referente a linha no banco de dados
 */

namespace SierraTecnologia\Facilitador\Services;

use SierraTecnologia\Crypto\Services\Crypto;
use Illuminate\Http\Request;

/**
 * RegisterService helper to make table and object form mapping easy.
 */
class RegisterService
{

    protected $identify;
    protected $instance;
    protected $repositoryService = false;

    public function __construct(string $identify, $crypto = true)
    // public function __construct(Request $request, $crypto = true)
    {
        // $identify = $request->input('identify');
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

    public function getModelService()
    {
        return $this->repositoryService->getModelService();
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
