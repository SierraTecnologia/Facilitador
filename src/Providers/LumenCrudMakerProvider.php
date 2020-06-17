<?php

namespace Facilitador\Providers;

class LumenCrudMakerProvider extends CrudMakerProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->app->configure('crudmaker');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->commands(
            [
            \Siravel\Console\Commands\CrudMaker\Publish::class,
            ]
        );
    }
}
