<?php

namespace Facilitador\Providers;

use Arrilot\Widgets\ServiceProvider as WidgetServiceProvider;
use Illuminate\Support\ServiceProvider;

class FacilitadorDummyServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(WidgetServiceProvider::class);

        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
        }
    }

    /**
     * Register the publishes files.
     *
     * @return void
     */
    private function registerPublishableResources(): void
    {
        $publishesPath = dirname(__DIR__).'/../publishes';

        $publishes = [
            'dummy_seeds' => [
                "{$publishesPath}/database/dummy_seeds/" => database_path('seeds'),
            ],
            'dummy_content' => [
                "{$publishesPath}/dummy_content/" => storage_path('app/public'),
            ],
            // 'dummy_config' => [
            //     "{$publishesPath}/config/facilitador_dummy.php" => config_path('facilitador.php'),
            // ],
            'dummy_migrations' => [
                "{$publishesPath}/database/migrations/" => database_path('migrations'),
            ],

        ];

        foreach ($publishes as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    public function registerConfigs(): void
    {
        // $this->mergeConfigFrom(
        //     dirname(__DIR__).'/../publishes/config/facilitador_dummy.php', 'facilitador'
        // );
    }
}
