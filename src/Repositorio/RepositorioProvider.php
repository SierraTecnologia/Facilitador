<?php

namespace SierraTecnologia\Facilitador\Repositorio;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Facilitador\Repositorio\Services\Repositorio;
use SierraTecnologia\Facilitador\Repositorio\Services\InputMaker;

class RepositorioProvider extends ServiceProvider
{
    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/form-maker.php' => base_path('config/form-maker.php'),
        ]);
        

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        // Form Maker
        Blade::directive('form_maker_table', function ($expression) {
            return "<?php echo Repositorio::fromTable($expression); ?>";
        });

        Blade::directive('form_maker_array', function ($expression) {
            return "<?php echo Repositorio::fromArray($expression); ?>";
        });

        Blade::directive('form_maker_object', function ($expression) {
            return "<?php echo Repositorio::fromObject($expression); ?>";
        });

        Blade::directive('form_maker_columns', function ($expression) {
            return "<?php echo Repositorio::getTableColumns($expression); ?>";
        });

        // Label Maker
        Blade::directive('input_maker_label', function ($expression) {
            return "<?php echo InputMaker::label($expression); ?>";
        });

        Blade::directive('input_maker_create', function ($expression) {
            return "<?php echo InputMaker::create($expression); ?>";
        });
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /*
        |--------------------------------------------------------------------------
        | Providers
        |--------------------------------------------------------------------------
        */

        $this->app->register(\Collective\Html\HtmlServiceProvider::class);

        /*
        |--------------------------------------------------------------------------
        | Register the Utilities
        |--------------------------------------------------------------------------
        */

        $this->app->singleton('Repositorio', function () {
            return new Repositorio();
        });

        $this->app->singleton('InputMaker', function () {
            return new InputMaker();
        });

        $loader = AliasLoader::getInstance();

        $loader->alias('Repositorio', \SierraTecnologia\Facilitador\Repositorio\Facades\Repositorio::class);
        $loader->alias('InputMaker', \SierraTecnologia\Facilitador\Repositorio\Facades\InputMaker::class);

        // Thrid party
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
    }
}
