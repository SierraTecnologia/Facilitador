<?php

namespace Facilitador\Traits\Providers;

use Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Auth\Access\Gate;
use Facilitador\Http\Middleware\FacilitadorAdminMiddleware;

trait AppMiddlewaresProvider
{

    

    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/
    /**
     * Boot Decoy's auth integration
     *
     * @return void
     */
    public function bootAuth()
    {
        // Inject Decoy's auth config
        Config::set(
            'auth.guards.facilitador', [
            'driver'   => 'session',
            'provider' => 'facilitador',
            ]
        );

        Config::set(
            'auth.providers.facilitador', [
            'driver' => 'eloquent',
            'model'  => \Illuminate\Support\Facades\Config::get('application.auth.model', \App\Models\User::class),
            ]
        );

        Config::set(
            'auth.passwords.facilitador', [
            'provider' => 'facilitador',
            'email'    => 'facilitador::emails.reset',
            'table'    => 'password_resets',
            'expire'   => 60,
            ]
        );

        // Point to the Gate policy
        $this->app[Gate::class]->define('facilitador.auth', \Illuminate\Support\Facades\Config::get('application.auth.policy'));
    }

    /**
     * Things that happen only if the request is for the admin
     */
    public function usingAdmin()
    {

        // @todo Desfazer
        // // Use Decoy's auth by default, while at an admin path
        // Config::set(
        //     'auth.defaults', [
        //     'guard'     => 'facilitador',
        //     'passwords' => 'facilitador',
        //     ]
        // );

        // Set the default mailer settings
        Config::set(
            'mail.from', [
            'address' => Config::get('site.core.mail_from_address'),
            'name' => Config::get('site.core.mail_from_name'),
            ]
        );


        // Delegate events to Decoy observers
        $this->delegateAdminObservers();

        // Use Boostrap 3 classes in Laravel 5.6
        if (method_exists(Paginator::class, 'useBootstrapThree')) {
            Paginator::useBootstrapThree();
        }
    }

    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/

}
