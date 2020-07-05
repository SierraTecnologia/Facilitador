<?php

namespace Facilitador\Models;

use Illuminate\Database\Eloquent\Model;
use Facilitador\Facades\Facilitador;

class Role extends Model
{

    /**
     * Acesso Deus para usuários de Infra
     *
     * @var array
     */
    public static $GOOD = 1;

    /**
     * Acesso Deus para usuários de Infra
     *
     * @var array
     */
    public static $ADMIN = 2;

    /**
     * São consumidores dos Clientes dos Usuários do Payment
     *
     * @var array
     */
    public static $CUSTOMER = 3;

    /**
     * Usuários do Organização
     *
     * @var array
     */
    public static $USER = 4;

    /**
     * São clientes dos Usuários do Payment.
     *
     * @var array
     */
    public static $CLIENT = 5;

    protected $guarded = [];

    public function users()
    {
        $userModel = Facilitador::modelClass('User');

        return $this->belongsToMany($userModel, 'user_roles')
            ->select(app($userModel)->getTable().'.*')
            ->union($this->hasMany($userModel))->getQuery();
    }

    public function permissions()
    {
        return $this->belongsToMany(Facilitador::modelClass('Permission'));
    }
}
