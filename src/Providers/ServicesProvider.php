<?php

namespace SierraTecnologia\Facilitador\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use App\Services\BlogService;
use App\Services\CryptoService;
use App\Services\EventService;
use App\Services\ModuleService;
use App\Services\Negocios\PageService;
use App\Services\Midia\FileService;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('CryptoService', \App\Facades\CryptoServiceFacade::class);
        $loader->alias('FileService', \App\Services\Midia\FileService::class);

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });

        $this->app->bind('FileService', function ($app) {
            return new FileService();
        });
    }
}
