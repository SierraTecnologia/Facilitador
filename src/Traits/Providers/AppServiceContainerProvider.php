<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Facilitador\Services\FacilitadorService;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use SierraTecnologia\Crypto\Services\Crypto;
use Log;
use App;
use Config;
use Facilitador\Facades\Facilitador as FacilitadorFacade;
use Facilitador\Facilitador;

trait AppServiceContainerProvider
{

    

    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/

    

    /****************************************************************************************************
     * ************************************************* NO REGISTER *************************************
     ****************************************************************************************************/
    protected function loadAlias()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Facilitador', FacilitadorFacade::class);


    }
    protected function loadServiceContainerSingletons()
    {
        
        $this->app->singleton(
            'facilitador', function () {
                return new Facilitador();
            }
        );
        // @todo Apaguei, nao sei pra q serve
        // // Register HTML view helpers as "Decoy".  So they get invoked like: `Facilitador::title()`
        // $this->app->singleton('facilitador', function ($app) {
        //     return new \Facilitador\Helpers;
        // });

        // Registers explicit rotues and wildcarding routing
        $this->app->singleton(
            'facilitador.router', function ($app) {
                $dir = \Illuminate\Support\Facades\Config::get('application.routes.main');

                return new \Support\Routing\Router($dir);
            }
        );

        // Wildcard router
        $this->app->singleton(
            'facilitador.wildcard', function ($app) {
                $request = $app['request'];

                return new \Support\Routing\Wildcard(
                    \Illuminate\Support\Facades\Config::get('application.routes.main'),
                    $request->getMethod(),
                    $request->path()
                );
            }
        );

        // Return the active user account
        $this->app->singleton(
            'facilitador.user', function ($app) {
                $guard = \Illuminate\Support\Facades\Config::get('painel.adminer.guard');
                return $app['auth']->guard($guard)->user(); // tinha isso aqui tirei \App\Models\User::first(); //
            }
        );

        // Return a redirect response with extra stuff
        $this->app->singleton(
            'facilitador.acl_fail', function ($app) {
                return $app['redirect']
                    ->guest(route('facilitador.account@login'))
                    ->withErrors([ 'error message' => __('facilitador::login.error.login_first')]);
            }
        );

        // Register URL Generators as "FacilitadorURL".
        $this->app->singleton(
            'facilitador.url', function ($app) {
                return new \Support\Routing\UrlGenerator($app['request']->path());
            }
        );

        // Build the Elements collection
        $this->app->singleton(
            'facilitador.elements', function ($app) {
                return with(new \Facilitador\Collections\Elements)->setModel(\Facilitador\Models\Element::class);
            }
        );

        // Register Decoy's custom handling of some exception
        $this->app->singleton(ExceptionHandler::class, \Facilitador\Exceptions\Handler::class);



        /*
        |--------------------------------------------------------------------------
        | Register the Utilities
        |--------------------------------------------------------------------------
        */
        /**
         * Singleton Facilitador
         */
        $this->app->singleton(
            FacilitadorService::class, function ($app) {
                Log::debug('Singleton Facilitador');
                // try {
                //     throw new \Exception();
                // } catch (\Exception $e) {
                //     dd($e);
                // }
                return new FacilitadorService(\Illuminate\Support\Facades\Config::get('generators.loader.models'));
            }
        );

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'facilitador',
            'facilitador.acl_fail',
            'rica.breadcrumbs',
            'facilitador.elements',
            'facilitador.router',
            'facilitador.url',
            'facilitador.user',
            'facilitador.wildcard',
        ];
    }


}
