<?php

namespace SierraTecnologia\Facilitador;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Facilitador\Services\FacilitadorService;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use SierraTecnologia\Facilitador\Services\RegisterService;
use SierraTecnologia\Facilitador\Services\RepositoryService;
use SierraTecnologia\Facilitador\Services\ModelService;

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
            __DIR__.'/../Publishes/config/sitec-facilitador.php' => base_path('config/sitec-facilitador.php'),
        ]);

        // $this->app->bind(RepositoryService::class, function($app)
        // {
        //     dd('Bind Repository', $app);
        //     return new RepositoryService();
        // });
        // $this->app->bind(RegisterService::class, function($app)
        // {
        //     // dd('Bind Register', $app);
        //     return new RegisterService();
        // });

        Route::bind('modelService', function ($value) {
            // dd('Route Repository', $value);
            return new ModelService($value);
        });
        Route::bind('repositoryService', function ($value) {
            // dd('Route Repository', $value);
            return new RepositoryService($value);
        });
        Route::bind('registerService', function ($value) {
            // dd('Route Register', $value);
            return new RegisterService($value);
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setProviders();

        $this->app->singleton(FacilitadorService::class, function($app)
        {
            Log::info('Singleton Facilitador');
            return new FacilitadorService(config('sitec-facilitador.models'));
        });

        // View namespace
        $this->loadViewsFrom(__DIR__.'/Views', 'facilitador');

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

        // $this->app->singleton('Facilitador', function () {
        //     return new Facilitador();
        // });

        // $this->app->singleton('InputMaker', function () {
        //     return new InputMaker();
        // });

        $this->app->when(ModelService::class)
            ->needs('$modelClass')
          ->give(function ($modelClassValue) {
              dd($modelClassValue['request'])->has('modelClassValue');
              return $modelClassValue;
          });

    }
    protected function setProviders()
    {
        
        /**
         * Internos
         */
        $this->app->register(\SierraTecnologia\Facilitador\Providers\ServicesProvider::class);
        $this->app->register(\SierraTecnologia\Facilitador\Providers\FacilitadorRouteProvider::class);
        $this->app->register(\SierraTecnologia\Facilitador\Providers\FormMakerProvider::class);
        
        /*
         * Dependencias
         */
        $this->app->register(\SierraTecnologia\Crypto\CryptoProvider::class);
        
        /**
         * Externos
         */
        $this->app->register(\SierraTecnologia\Facilitador\Providers\GravatarServiceProvider::class);
        

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
}
