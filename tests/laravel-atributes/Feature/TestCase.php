<?php

declare(strict_types=1);

namespace Facilitador\Attributes\Tests\Feature;

use Facilitador\Models\Attribute;
use Facilitador\Attributes\Tests\Stubs\User;
use Facilitador\Providers\AttributesServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void: void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);
        $this->loadLaravelMigrations('testing');
        $this->withFactories(__DIR__.'/Factories');

        // Registering the core type map
        Attribute::typeMap(
            [
            'text' => \Support\Elements\Entities\Type\Text::class,
            'bool' => \Support\Elements\Entities\Type\Boolean::class,
            'integer' => \Support\Elements\Entities\Type\Integer::class,
            'varchar' => \Support\Elements\Entities\Type\Varchar::class,
            'datetime' => \Support\Elements\Entities\Type\Datetime::class,
            ]
        );

        // Push your entity fully qualified namespace
        app('facilitador.attributes.entities')->push(User::class);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set(
            'database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            ]
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AttributesServiceProvider::class,
        ];
    }
}
