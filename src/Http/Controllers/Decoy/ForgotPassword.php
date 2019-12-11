<?php

namespace Facilitador\Http\Controllers\Decoy;

use Auth;
use Decoy;
use Former;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Facilitador\Models\Admin;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPassword extends Base
{

    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        // Pass validation rules
        Former::withRules([
            'email' => 'required|email',
        ]);

        // Set the breadcrumbs
        app('facilitador.breadcrumbs')->set([
            route('facilitador::account@login') => 'Login',
            url()->current() => 'Forgot Password',
        ]);

        // Show the page
        $this->title = 'Forgot Password';
        $this->description = 'You know the drill.';

        return $this->populateView('facilitador::account.forgot');
    }
}
