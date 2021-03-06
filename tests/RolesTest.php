<?php

namespace Facilitador\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Porteiro\Models\Role;

class RolesTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testRoles()
    {
        $this->visit(route('rica.login'))
            ->type('admin@admin.com', 'email')
            ->type('password', 'password')
            ->press(__('pedreiro::generic.login'))
            ->seePageIs(route('rica.dashboard'));

        // Adding a New Role
        $this->visit(route('rica.facilitador.roles.create'))
            ->type('superadmin', 'name')
            ->type('Super Admin', 'display_name')
            ->press(__('pedreiro::generic.submit'))
            ->seePageIs(route('rica.facilitador.roles.index'))
            ->seeInDatabase('roles', ['name' => 'superadmin']);

        // Editing a Role
        $this->visit(route('rica.facilitador.roles.edit', 2))
            ->type('regular_user', 'name')
            ->press(__('pedreiro::generic.submit'))
            ->seePageIs(route('rica.facilitador.roles.index'))
            ->seeInDatabase('roles', ['name' => 'regular_user']);

        // Editing a Role
        $this->visit(route('rica.facilitador.roles.edit', 2))
            ->type('user', 'name')
            ->press(__('pedreiro::generic.submit'))
            ->seePageIs(route('rica.facilitador.roles.index'))
            ->seeInDatabase('roles', ['name' => 'user']);

        // Get the current super admin role
        $superadmin_role = Role::where('name', '=', 'superadmin')->first();

        // Deleting a Role
        $response = $this->call('DELETE', route('rica.facilitador.roles.destroy', $superadmin_role->id), ['_token' => csrf_token()]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->notSeeInDatabase('roles', ['name' => 'superadmin']);
    }
}
