<?php

namespace Facilitador\Http\Controllers\Decoy;

use Auth;
use Decoy;
use Former;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Facilitador\Models\Admin;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Handle logging in of users.  This is based on the AuthController.php and
 * PasswordController that Laravel's `php artisan make:auth` generates.
 */
class ResetPassword extends Base
{
    use ResetsPasswords;

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null               $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        // Pass validation rules
        Former::withRules([
            'email'                 => 'required|email',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        // Set the breadcrumbs
        app('facilitador.breadcrumbs')->set([
            route('facilitador::account@login') => 'Login',
            route('facilitador::account@forgot') => 'Forgot Password',
            url()->current() => 'Reset Password',
        ]);

        // Show the page
        $this->title = 'Reset Password';
        $this->description = 'Almost done.';

        return $this->populateView('facilitador::account.reset', [
            'token' => $token,
        ]);
    }

    /**
     * Get the post register / login redirect path. This is set to the login route
     * so that the guest middleware can pick it up and redirect to the proper
     * start page.
     *
     * @return string
     */
    public function redirectPath()
    {
        return route('facilitador::account@login');
    }

    /**
     * Subclass the resetPassword method so that it doesn't `bcrypt()` the
     * password.  We're trusting to the model's onSaving callback for this.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword $user
     * @param  string                                      $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $password,
            'remember_token' => Str::random(60),
        ])->save();

        Auth::login($user);
    }
}
