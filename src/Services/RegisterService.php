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

    protected $model;
    protected $user;

    public function __construct($model)
    {
        $this->model = new $model;
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
