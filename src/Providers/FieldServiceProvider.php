<?php

namespace Facilitador\Support\Entities\Fields;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('select-auto-complete', __DIR__.'/../dist/js/field.js');
            Nova::style('select-auto-complete', __DIR__.'/../dist/css/field.css');
        });
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-money-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-money-field', __DIR__.'/../dist/css/field.css');
        });
        Nova::serving(function (ServingNova $event) {
            Nova::script('radio-field', __DIR__.'/../dist/js/field.js');
            Nova::style('radio-field', __DIR__.'/../dist/css/field.css');
        });
    }

    public function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }
        Route::middleware(['nova'])
             ->prefix('nova-vendor/select-auto-complete')
             ->group(__DIR__ . '/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
