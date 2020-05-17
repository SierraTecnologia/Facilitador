<?php

namespace Facilitador\Http\Policies;

use Facilitador\Contracts\User;

class SettingPolicy extends BasePolicy
{

    public function __construct()
    {

        dd('Polyci: aqui foi3 ');
    }

    /**
     * Determine if the given user can browse the model.
     *
     * @param \Facilitador\Contracts\User $user
     * @param $model
     *
     * @return bool
     */
    public function browse(User $user, $model)
    {
        return $user->hasPermission('browse_settings');
    }

    /**
     * Determine if the given model can be viewed by the user.
     *
     * @param \Facilitador\Contracts\User $user
     * @param $model
     *
     * @return bool
     */
    public function read(User $user, $model)
    {
        return $user->hasPermission('read_settings');
    }

    /**
     * Determine if the given model can be edited by the user.
     *
     * @param \Facilitador\Contracts\User $user
     * @param $model
     *
     * @return bool
     */
    public function edit(User $user, $model)
    {
        return $user->hasPermission('edit_settings');
    }

    /**
     * Determine if the given user can create the model.
     *
     * @param \Facilitador\Contracts\User $user
     * @param $model
     *
     * @return bool
     */
    public function add(User $user, $model)
    {
        return $user->hasPermission('add_settings');
    }

    /**
     * Determine if the given model can be deleted by the user.
     *
     * @param \Facilitador\Contracts\User $user
     * @param $model
     *
     * @return bool
     */
    public function delete(User $user, $model)
    {
        return $user->hasPermission('delete_settings');
    }
}
