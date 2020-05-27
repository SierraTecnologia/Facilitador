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
                $dir = \Illuminate\Support\Facades\Config::get('sitec.core.dir');

                return new \Facilitador\Routing\Router($dir);
            }
        );

        // Wildcard router
        $this->app->singleton(
            'facilitador.wildcard', function ($app) {
                $request = $app['request'];

                return new \Facilitador\Routing\Wildcard(
                    \Illuminate\Support\Facades\Config::get('sitec.core.dir'),
                    $request->getMethod(),
                    $request->path()
                );
            }
        );

        // Return the active user account
        $this->app->singleton(
            'facilitador.user', function ($app) {
                $guard = \Illuminate\Support\Facades\Config::get('sitec.core.guard');
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
                return new \Facilitador\Routing\UrlGenerator($app['request']->path());
            }
        );

        // Build the Elements collection
        $this->app->singleton(
            'facilitador.elements', function ($app) {
                return with(new \Facilitador\Collections\Elements)->setModel(\Facilitador\Models\Element::class);
            }
        );

        // Build the Breadcrumbs store
        $this->app->singleton(
            'facilitador.breadcrumbs', function ($app) {
                $breadcrumbs = new \Support\Template\Layout\Breadcrumbs();
                $breadcrumbs->set($breadcrumbs->parseURL());

                return $breadcrumbs;
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
                Log::channel('sitec-providers')->debug('Singleton Facilitador');
                // try {
                //     throw new \Exception();
                // } catch (\Exception $e) {
                //     dd($e);
                // }
                return new FacilitadorService(\Illuminate\Support\Facades\Config::get('sitec.discover.models'));
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
            'facilitador.breadcrumbs',
            'facilitador.elements',
            'facilitador.router',
            'facilitador.url',
            'facilitador.user',
            'facilitador.wildcard',
        ];
    }


}
