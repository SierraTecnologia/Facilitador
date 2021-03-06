<?php

use Illuminate\Support\Facades\File;

class TestCase extends Orchestra\Testbench\TestCase
{
    protected $app;

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set(
            'database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
            ]
        );
        $app->make('Illuminate\Contracts\Http\Kernel');
    }

    protected function getPackageProviders($app)
    {
        return [
            \SierraTecnologia\FormMaker\FormMakerProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Form' => \Collective\Html\FormFacade::class,
            'HTML' => \Collective\Html\HtmlFacade::class,
            'FormMaker' => \SierraTecnologia\FormMaker\Facades\FormMaker::class,
            'InputMaker' => \SierraTecnologia\FormMaker\Facades\InputMaker::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $destinationDir = realpath(__DIR__.'/../vendor/orchestra/testbench-core/laravel/database/migrations');
        File::copyDirectory(realpath(__DIR__.'/migrations'), $destinationDir);

        $this->artisan(
            'migrate', [
            '--database' => 'testbench',
            ]
        );

        $this->withoutMiddleware();
        $this->withoutEvents();
    }
}
