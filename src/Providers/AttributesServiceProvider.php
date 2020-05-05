<?php

declare(strict_types=1);

namespace Facilitador\Providers;

use Illuminate\Support\ServiceProvider;
use Facilitador\Models\Attribute;
use Facilitador\Models\AttributeEntity;
use Facilitador\Console\Commands\MigrateCommand;
use Facilitador\Console\Commands\PublishCommand;
use Facilitador\Console\Commands\RollbackCommand;
use Support\Helpers\Traits\Models\ConsoleTools;

class AttributesServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.facilitador.attributes.migrate',
        PublishCommand::class => 'command.facilitador.attributes.publish',
        RollbackCommand::class => 'command.facilitador.attributes.rollback',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'facilitador.attributes');

        // Bind eloquent models to IoC container
        $this->app->singleton('facilitador.attributes.attribute', $attributeyModel = $this->app['config']['facilitador.attributes.models.attribute']);
        $attributeyModel === Attribute::class || $this->app->alias('facilitador.attributes.attribute', Attribute::class);

        $this->app->singleton('facilitador.attributes.attribute_entity', $attributeEntityModel = $this->app['config']['facilitador.attributes.models.attribute_entity']);
        $attributeEntityModel === AttributeEntity::class || $this->app->alias('facilitador.attributes.attribute_entity', AttributeEntity::class);

        // Register attributes entities
        $this->app->singleton('facilitador.attributes.entities', function ($app) {
            return collect();
        });

        // Register console commands
        ! $this->app->runningInConsole() || $this->registerCommands();
    }

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        // Publish Resources
        ! $this->app->runningInConsole() || $this->publishesConfig('facilitador/laravel-attributes');
        ! $this->app->runningInConsole() || $this->publishesMigrations('facilitador/laravel-attributes');
    }
}
