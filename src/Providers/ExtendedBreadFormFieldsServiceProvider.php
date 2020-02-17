<?php

namespace Facilitador\Providers;

use Facilitador\Facades\Facilitador;
use Illuminate\Support\ServiceProvider;
use Support\Elements\FormFields\MultipleImagesWithAttrsFormField;
use Support\Elements\FormFields\KeyValueJsonFormField;

class ExtendedBreadFormFieldsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'extended-fields');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Facilitador::addFormField(KeyValueJsonFormField::class);
        Facilitador::addFormField(MultipleImagesWithAttrsFormField::class);

        $this->app->bind(
            'Facilitador\Http\Controllers\FacilitadorBaseController',
            'ExtendedBreadFormFields\Controllers\ExtendedBreadFormFieldsController'
        );

        $this->app->bind(
            'Facilitador\Http\Controllers\FacilitadorMediaController',
            'ExtendedBreadFormFields\Controllers\ExtendedBreadFormFieldsMediaController'
        );
    }
}
