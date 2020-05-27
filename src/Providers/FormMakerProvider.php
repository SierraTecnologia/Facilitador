<?php

namespace Facilitador\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Facilitador\Services\FormMaker\FormMaker;
use Facilitador\Services\FormMaker\InputMaker;

class FormMakerProvider extends ServiceProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
