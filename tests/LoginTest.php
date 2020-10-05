<?php

namespace Facilitador\Tests;

use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    public function testSuccessfulLoginWithDefaultCredentials()
    {
        $this->visit(route('rica.login'))
            ->type('admin@admin.com', 'email')
            ->type('password', 'password')
            ->press(__('pedreiro::generic.login'))
            ->seePageIs(route('rica.dashboard'));
    }

    public function testShowAnErrorMessageWhenITryToLoginWithWrongCredentials()
    {
        session()->setPreviousUrl(route('rica.login'));

        $this->visit(route('rica.login'))
            ->type('john@Doe.com', 'email')
            ->type('pass', 'password')
            ->press(__('pedreiro::generic.login'))
            ->seePageIs(route('rica.login'))
            ->see(__('auth.failed'))
            ->seeInField('email', 'john@Doe.com');
    }

    public function testRedirectIfLoggedIn()
    {
        Auth::loginUsingId(1);

        $this->visit(route('profile.login'))
            ->seePageIs(route('profile.dashboard'));
    }

    public function testRedirectIfNotLoggedIn()
    {
        $this->visit(route('profile.profile'))
            ->seePageIs(route('profile.login'));
    }

    public function testCanLogout()
    {
        Auth::loginUsingId(1);

        $this->visit(route('profile.dashboard'))
            ->press(__('pedreiro::generic.logout'))
            ->seePageIs(route('profile.login'));
    }

    public function testGetsLockedOutAfterFiveAttempts()
    {
        session()->setPreviousUrl(route('profile.login'));

        for ($i = 0; $i <= 5; $i++) {
            $t = $this->visit(route('profile.login'))
                ->type('john@Doe.com', 'email')
                ->type('pass', 'password')
                ->press(__('pedreiro::generic.login'));
        }

        $t->see(__('auth.throttle', ['seconds' => 60]));
    }
}
