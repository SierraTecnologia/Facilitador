<?php

namespace Facilitador;

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
use Facilitador\Console\Commands\MakeEloquentFilter;
use Illuminate\Support\Collection;

class FacilitadorProvider extends ServiceProvider
{
    public static $providers = [
        // \Facilitador\Providers\ServicesProvider::class,
        // \Facilitador\Providers\FacilitadorRouteProvider::class,
        // \Facilitador\Providers\FormMakerProvider::class,

        \Tracking\TrackingProvider::class,
        
        /**
         * Internos
         */
        \Facilitador\Providers\ServicesProvider::class,
        \Facilitador\Providers\FacilitadorRouteProvider::class,
        \Facilitador\Providers\FormMakerProvider::class,
        \Tracking\TrackingProvider::class,
        
        /**
         * Externos
         */
        \Facilitador\Providers\GravatarServiceProvider::class,
        
        \Facilitador\Providers\DecoyProvider::class,
        // \Facilitador\Providers\ExtendedBreadFormFieldsServiceProvider::class,
        // \Facilitador\Providers\FieldServiceProvider::class,
    ];

    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../publishes/config/sitec-facilitador.php' => config_path('sitec-facilitador.php'),
            __DIR__.'/../publishes/config/eloquentfilter.php' => config_path('eloquentfilter.php'),
        ]);

        $this->loadViews();
        $this->loadTranslations();
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setDependencesAlias();
        $this->setProviders();

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
            return new FacilitadorService(config('sitec-facilitador.models'));
        });

        Route::bind('modelClass', function ($value) {
            Log::info('Route Bind ModelClass - '.$value);
            return new ModelService($value);
        });
        Route::bind('identify', function ($value) {
            Log::info('Route Bind Identify - '.$value);
            return new RegisterService($value);
        });

        $this->app->bind(ModelService::class, function($app)
        {
            $modelClass = false;
            if (isset($app['router']->current()->parameters['modelClass'])) {
                $modelClass = Crypto::decrypt($app['router']->current()->parameters['modelClass']);
            }
            
            Log::info('Bind Model Service - '.$modelClass);
            return new ModelService($modelClass);
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

        // $this->app->when(ModelService::class)
        //     ->needs('$modelClass')
        //   ->give(function ($modelClassValue) {
        //       $request = $modelClassValue['request'];
        //         dd($request->has('modelClassValue'));
        //     //   dd();
        //       return $modelClassValue;
        //   });

        $this->commands(MakeEloquentFilter::class);
    }

    /**
     * Set Alias dependencies
     */
    private function setDependencesAlias()
    {

        $loader = AliasLoader::getInstance();
        $loader->alias('Decoy', \Facilitador\Facades\Decoy::class);
        $loader->alias('DecoyURL', \Facilitador\Facades\DecoyURL::class);
    }

    private function loadViews()
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'facilitador');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/facilitador'),
        ], 'views');
    }
    
    private function loadTranslations()
    {
        $translationsPath = $this->getResourcesPath('lang');
        $this->loadTranslationsFrom($translationsPath, 'facilitador');
        $this->publishes([
            $translationsPath => base_path('resources/lang/vendor/facilitador'),
        ], 'translations');
    }

    private function getResourcesPath($folder)
    {
        return __DIR__.'/../resources/'.$folder;
    }

    private function setProviders()
    {
        (new Collection(self::$providers))->map(function ($provider) {
            $this->app->register($provider);
        });
    }
}
