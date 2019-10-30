<?php

namespace SierraTecnologia\Facilitador;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Facilitador\Services\FacilitadorService;

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
