<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Facilitador\Services\FacilitadorService;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Facilitador\Services\RegisterService;
use Facilitador\Services\RepositoryService;
use Facilitador\Services\ModelService;
use SierraTecnologia\Crypto\Services\Crypto;
use Log;
use App;
use Config;
use Facilitador\Console\Commands\MakeEloquentFilter;
use Illuminate\Support\Collection;
use Former\Former;
use Facilitador\Observers\Validation;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugService;
use Laravel\Dusk\DuskServiceProvider;
use Support\ClassesHelpers\Traits\Models\ConsoleTools;


use Facilitador\Facades\Facilitador as FacilitadorFacade;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;




use Facilitador\Traits\Providers\AppEventsProvider;
use Facilitador\Traits\Providers\AppMiddlewaresProvider;
use Facilitador\Traits\Providers\FacilitadorLoadClasses;
use Facilitador\Traits\Providers\AppServiceContainerProvider;
use Facilitador\Traits\Providers\FacilitadorRegisterPackages;
use Facilitador\Traits\Providers\FacilitadorRegisterPublishes;

trait FacilitadorConfig
{
    

    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/

    /**
     * Config Former
     *
     * @return void
     */
    protected function configureFormer()
    {
        // Use Bootstrap 3
        Config::set('former.framework', 'TwitterBootstrap3');

        // Reduce the horizontal form's label width
        Config::set('former.TwitterBootstrap3.labelWidths', []);

        // Change Former's required field HTML
        Config::set('former.required_text', ' <span class="glyphicon glyphicon-exclamation-sign js-tooltip required" title="' .
            __('facilitador::login.form.required') . '"></span>');

        // Make pushed checkboxes have an empty string as their value
        Config::set('former.unchecked_value', '');

        // Add Decoy's custom Fields to Former so they can be invoked using the "Former::"
        // namespace and so we can take advantage of sublassing Former's Field class.
        $this->app['former.dispatcher']->addRepository('Facilitador\\Fields\\');
    }

    

    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/
}
