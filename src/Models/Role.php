<?php

namespace Facilitador\Models;

use Illuminate\Database\Eloquent\Model;
use TCG\Facilitador\Facades\Facilitador;

class Role extends \TCG\Facilitador\Models\Role
{
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
