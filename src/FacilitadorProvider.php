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

class FacilitadorProvider extends ServiceProvider
{
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
        $this->setProviders();
        $this->commands(MakeEloquentFilter::class);

        /*
        |--------------------------------------------------------------------------
        | Providers
        |--------------------------------------------------------------------------
        */

        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('DataTables', \Yajra\DataTables\Facades\DataTables::class);

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

        $this->app->bind(ModelService::class, function($app)
        {
            Log::info('Bind Model Service');
            $modelClass = '';
            if (isset($app['router']->current()->parameters['modelClass'])) {
                $modelClass = Crypto::decrypt($app['router']->current()->parameters['modelClass']);
            }

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
            Log::info('Bind Register Service');
            $identify = '';
            if (isset($app['router']->current()->parameters['identify'])) {
                $identify = Crypto::decrypt($app['router']->current()->parameters['identify']);
            }

            return new RegisterService($identify);
        });

        Route::bind('modelClass', function ($value) {
            Log::info('Route Bind ModelClass');
            return new ModelService($value);
        });
        Route::bind('identify', function ($value) {
            Log::info('Route Bind Identify');
            return new RegisterService($value);
        });

        // $this->app->when(ModelService::class)
        //     ->needs('$modelClass')
        //   ->give(function ($modelClassValue) {
        //       $request = $modelClassValue['request'];
        //         dd($request->has('modelClassValue'));
        //     //   dd();
        //       return $modelClassValue;
        //   });

    }
    protected function setProviders()
    {
        
        /**
         * Internos
         */
        $this->app->register(\Facilitador\Providers\ServicesProvider::class);
        $this->app->register(\Facilitador\Providers\FacilitadorRouteProvider::class);
        $this->app->register(\Facilitador\Providers\FormMakerProvider::class);
        
        /*
         * Dependencias
         */
        $this->app->register(\SierraTecnologia\Crypto\CryptoProvider::class);
        
        /**
         * Externos
         */
        $this->app->register(\Facilitador\Providers\GravatarServiceProvider::class);
        

        /**
         * Layoults
         */
        $this->app->register(\JeroenNoten\LaravelAdminLte\ServiceProvider::class);
        $this->app->register(\RicardoSierra\Minify\MinifyServiceProvider::class);
        $this->app->register(\CipeMotion\Medialibrary\ServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Laracasts\Flash\FlashServiceProvider::class);

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
}
