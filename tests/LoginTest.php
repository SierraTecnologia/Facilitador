<?php

namespace Facilitador\Tests;

use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('facilitador.login'))
             ->type('admin@admin.com', 'email')
             ->type('password', 'password')
             ->press(__('facilitador::generic.login'))
             ->seePageIs(route('facilitador.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        session()->setPreviousUrl(route('facilitador.login'));

        $this->visit(route('facilitador.login'))
             ->type('john@Doe.com', 'email')
             ->type('pass', 'password')
             ->press(__('facilitador::generic.login'))
             ->seePageIs(route('facilitador.login'))
             ->see(__('auth.failed'))
             ->seeInField('email', 'john@Doe.com');
    }

    public function testRedirectIfLoggedIn()
    {
        Auth::loginUsingId(1);

        $this->visit(route('facilitador.login'))
             ->seePageIs(route('facilitador.dashboard'));
    }

    public function testRedirectIfNotLoggedIn()
    {
        $this->visit(route('facilitador.profile'))
             ->seePageIs(route('facilitador.login'));
    }

    public function testCanLogout()
    {
        Auth::loginUsingId(1);

        $this->visit(route('facilitador.dashboard'))
             ->press(__('facilitador::generic.logout'))
             ->seePageIs(route('facilitador.login'));
    }

    public function testGetsLockedOutAfterFiveAttempts()
    {
        session()->setPreviousUrl(route('facilitador.login'));

        for ($i = 0; $i <= 5; $i++) {
            $t = $this->visit(route('facilitador.login'))
                 ->type('john@Doe.com', 'email')
                 ->type('pass', 'password')
                 ->press(__('facilitador::generic.login'));
        }

        $t->see(__('auth.throttle', ['seconds' => 60]));
    }
}
