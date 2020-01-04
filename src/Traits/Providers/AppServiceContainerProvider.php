<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Facilitador\Services\FacilitadorService;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Facilitador\Services\RegisterService;
use Facilitador\Services\RepositoryService;
use Facilitador\Services\ModelService;
use SierraTecnologia\Crypto\Services\Crypto;
use Log;
use App;
use Config;
use Facilitador\Console\Commands\MakeEloquentFilter;
use Illuminate\Support\Collection;
use Former\Former;
use Facilitador\Observers\Validation;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugService;
use Laravel\Dusk\DuskServiceProvider;
use Support\ClassesHelpers\Traits\Models\ConsoleTools;





use Facilitador\Facades\Facilitador as FacilitadorFacade;
use Facilitador\Facilitador;

trait AppServiceContainerProvider
{

    

    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/

    

    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/
    protected function loadAlias()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Facilitador', FacilitadorFacade::class);


    }
    protected function loadServiceContainerSingletons()
    {
        
        $this->app->singleton('facilitador', function () {
            return new Facilitador();
        });
        // @todo Apaguei, nao sei pra q serve
        // // Register HTML view helpers as "Decoy".  So they get invoked like: `Facilitador::title()`
        // $this->app->singleton('facilitador', function ($app) {
        //     return new \Facilitador\Helpers;
        // });

        // Registers explicit rotues and wildcarding routing
        $this->app->singleton('facilitador.router', function ($app) {
            $dir = config('sitec.core.dir');

            return new \Facilitador\Routing\Router($dir);
        });

        // Wildcard router
        $this->app->singleton('facilitador.wildcard', function ($app) {
            $request = $app['request'];

            return new \Facilitador\Routing\Wildcard(
                config('sitec.core.dir'),
                $request->getMethod(),
                $request->path()
            );
        });

        // Return the active user account
        $this->app->singleton('facilitador.user', function ($app) {
            $guard = config('sitec.core.guard');

            return $app['auth']->guard($guard)->user();
        });

        // Return a redirect response with extra stuff
        $this->app->singleton('facilitador.acl_fail', function ($app) {
            return $app['redirect']
                ->guest(route('facilitador::account@login'))
                ->withErrors([ 'error message' => __('facilitador::login.error.login_first')]);
        });

        // Register URL Generators as "FacilitadorURL".
        $this->app->singleton('facilitador.url', function ($app) {
            return new \Facilitador\Routing\UrlGenerator($app['request']->path());
        });

        // Build the Elements collection
        $this->app->singleton('facilitador.elements', function ($app) {
            return with(new \Facilitador\Collections\Elements)->setModel(Models\Element::class);
        });

        // Build the Breadcrumbs store
        $this->app->singleton('facilitador.breadcrumbs', function ($app) {
            $breadcrumbs = new \Support\Template\Layout\Breadcrumbs();
            $breadcrumbs->set($breadcrumbs->parseURL());

            return $breadcrumbs;
        });

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
        $this->app->singleton(FacilitadorService::class, function($app)
        {
            Log::info('Singleton Facilitador');
            return new FacilitadorService(config('sitec.facilitador.models'));
        });

    }

    protected function loadServiceContainerRouteBinds()
    {
        
        
        /**
         * @todo Ta passando duas vezes por aqui
         */
        Route::bind('modelClass', function ($value) {
            Log::info('Route Bind ModelClass - '.Crypto::decrypt($value));
            return new ModelService(Crypto::decrypt($value));
        });
        Route::bind('identify', function ($value) {
            Log::info('Route Bind Identify - '.Crypto::decrypt($value));
            return new RegisterService(Crypto::decrypt($value));
        });
    }

    protected function loadServiceContainerBinds()
    {

        $this->app->bind(ModelService::class, function($app)
        {
            $modelClass = false;
            if (isset($app['router']->current()->parameters['modelClass'])) {
                $modelClass = Crypto::decrypt($app['router']->current()->parameters['modelClass']);
            }
            
            Log::info('Bind Model Service - '.$modelClass);

            return new ModelService($modelClass);

            /**
             * Cryptos
             * @todo Verificar pq isso ta aqui
             */
            $this->app->bind('CryptoService', function ($app) {
                return new CryptoService();
            });



            // Arrumar um jeito de fazer o Base do facilitador passar por cima do support
            // use Support\Models\Base;
            // @todo
        });
        $this->app->bind(RepositoryService::class, function($app)
        {
            Log::info('Bind Repository Service');
            $modelService = $app->make(ModelService::class);
            return new RepositoryService($modelService);
        });
        $this->app->bind(RegisterService::class, function($app)
        {
            $identify = '';
            if (isset($app['router']->current()->parameters['identify'])) {
                $identify = Crypto::decrypt($app['router']->current()->parameters['identify']);
            }

            Log::info('Bind Register Service - '.$identify);
            return new RegisterService($identify);
        });
    }

    protected function loadServiceContainerReplaceClasses()
    {

        
        // $this->app->when(ModelService::class)
        //     ->needs('$modelClass')
        //   ->give(function ($modelClassValue) {
        //       $request = $modelClassValue['request'];
        //         dd($request->has('modelClassValue'));
        //     //   dd();
        //       return $modelClassValue;
        //   });
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
