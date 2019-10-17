<?php

namespace SierraTecnologia\Facilitador;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Facilitador\Services\Facilitador;
use SierraTecnologia\Facilitador\Services\InputMaker;

class FacilitadorProvider extends ServiceProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        // $this->publishes([
        //     __DIR__.'/../config/form-maker.php' => base_path('config/form-maker.php'),
        // ]);
        
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->setProviders();

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
        $this->app->register(\SierraTecnologia\Facilitador\Providers\FormMakerProvider::class);
        
        
        /**
         * Externos
         */
        $this->app->register(\SierraTecnologia\Facilitador\Providers\GravatarServiceProvider::class);
        

        /**
         * Layoults
         */
        $this->app->register(\JeroenNoten\LaravelAdminLte\ServiceProvider::class);

    }
}
