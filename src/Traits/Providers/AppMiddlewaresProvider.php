<?php

namespace Facilitador\Traits\Providers;

use Config;
use Illuminate\Pagination\Paginator;
use Illuminate\Contracts\Auth\Access\Gate;

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
            'model'  => \Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class),
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
        $this->app[Gate::class]->define('facilitador.auth', \Illuminate\Support\Facades\Config::get('sitec.core.policy'));
    }

    /**
     * Things that happen only if the request is for the admin
     */
    public function usingAdmin()
    {

        // Define constants that Decoy uses
        if (!defined('FORMAT_DATE')) {
            define('FORMAT_DATE', __('facilitador::base.constants.format_date'));
        }
        if (!defined('FORMAT_DATETIME')) {
            define('FORMAT_DATETIME', __('facilitador::base.constants.format_datetime'));
        }
        if (!defined('FORMAT_TIME')) {
            define('FORMAT_TIME', __('facilitador::base.constants.format_time'));
        }

        // Register global and named middlewares
        $this->registerMiddlewares();

        // Use Decoy's auth by default, while at an admin path
        Config::set(
            'auth.defaults', [
            'guard'     => 'facilitador',
            'passwords' => 'facilitador',
            ]
        );

        // Set the default mailer settings
        Config::set(
            'mail.from', [
            'address' => Config::get('sitec.core.mail_from_address'),
            'name' => Config::get('sitec.core.mail_from_name'),
            ]
        );


        // Delegate events to Decoy observers
        $this->delegateAdminObservers();

        // Use Boostrap 3 classes in Laravel 5.6
        if (method_exists(Paginator::class, 'useBootstrapThree')) {
            Paginator::useBootstrapThree();
        }
    }

    /**
     * Register middlewares
     *
     * @return void
     */
    protected function registerMiddlewares()
    {

        // Register middleware individually
        foreach ([
            'facilitador.auth'          => \Facilitador\Http\Middleware\Auth::class,
            'facilitador.edit-redirect' => \Facilitador\Http\Middleware\EditRedirect::class,
            'facilitador.guest'         => \Facilitador\Http\Middleware\Guest::class,
            'facilitador.save-redirect' => \Facilitador\Http\Middleware\SaveRedirect::class,
        ] as $key => $class) {
            $this->app['router']->aliasMiddleware($key, $class);
        }

        // This group is used by public facilitador routes
        $this->app['router']->middlewareGroup(
            'facilitador.public', [
            'web',
            ]
        );

        // The is the starndard auth protected group
        $this->app['router']->middlewareGroup(
            'facilitador.protected', [
            'web',
            'facilitador.auth',
            'facilitador.save-redirect',
            'facilitador.edit-redirect',
            ]
        );

        // Require a logged in admin session but no CSRF token
        $this->app['router']->middlewareGroup(
            'facilitador.protected_endpoint', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            'facilitador.auth',
            ]
        );

        // An open endpoint, like used by Zendcoder
        $this->app['router']->middlewareGroup(
            'facilitador.endpoint', [
            'api'
            ]
        );
    }

    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/

}
