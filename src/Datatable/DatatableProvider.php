<?php

namespace SierraTecnologia\Facilitador\Datatable;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use SierraTecnologia\Facilitador\Datatable\Services\Datatable;
use SierraTecnologia\Facilitador\Datatable\Services\InputMaker;

class DatatableProvider extends ServiceProvider
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
            return "<?php echo Datatable::fromTable($expression); ?>";
        });

        Blade::directive('form_maker_array', function ($expression) {
            return "<?php echo Datatable::fromArray($expression); ?>";
        });

        Blade::directive('form_maker_object', function ($expression) {
            return "<?php echo Datatable::fromObject($expression); ?>";
        });

        Blade::directive('form_maker_columns', function ($expression) {
            return "<?php echo Datatable::getTableColumns($expression); ?>";
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

        $this->app->singleton('Datatable', function () {
            return new Datatable();
        });

        $this->app->singleton('InputMaker', function () {
            return new InputMaker();
        });

        $loader = AliasLoader::getInstance();

        $loader->alias('Datatable', \SierraTecnologia\Facilitador\Datatable\Facades\Datatable::class);
        $loader->alias('InputMaker', \SierraTecnologia\Facilitador\Datatable\Facades\InputMaker::class);

        // Thrid party
        $loader->alias('Form', \Collective\Html\FormFacade::class);
        $loader->alias('HTML', \Collective\Html\HtmlFacade::class);
    }
}
