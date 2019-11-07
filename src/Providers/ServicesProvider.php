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
        $loader = AliasLoader::getInstance();

        $loader->alias('CryptoService', \Facilitador\Facades\CryptoServiceFacade::class);

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });
    }
}
