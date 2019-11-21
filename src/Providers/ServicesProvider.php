<?php

namespace Facilitador\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Facilitador\Services\CryptoService;
use Facilitador\Services\Midia\FileService;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $this->registerPackages();
        $loader = AliasLoader::getInstance();

        $loader->alias('CryptoService', \Facilitador\Facades\CryptoServiceFacade::class);

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });
    }

    /**
     * Register external dependencies
     */
    private function registerPackages()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('DataTables', \Yajra\DataTables\Facades\DataTables::class);
        $this->app->register(\Yajra\DataTables\DataTablesServiceProvider::class);
        
        /*
         * Dependencias
         */
        $this->app->register(\Locaravel\LocaravelProvider::class);
        $this->app->register(\SierraTecnologia\Crypto\CryptoProvider::class);
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
