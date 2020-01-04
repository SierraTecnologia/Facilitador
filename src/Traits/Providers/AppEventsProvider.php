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

trait AppEventsProvider
{
    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/


    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/

    /**
     * Delegate events to Decoy observers
     *
     * @return void
     */
    protected function delegateAdminObservers()
    {
        $this->app['events']->listen('eloquent.saving:*',
            '\Facilitador\Observers\Localize');
        $this->app['events']->listen('eloquent.saving:*',
            '\Facilitador\Observers\Encoding@onSaving');
        $this->app['events']->listen('eloquent.saved:*',
            '\Facilitador\Observers\ManyToManyChecklist');
        $this->app['events']->listen('eloquent.deleted:*',
            '\Facilitador\Observers\Encoding@onDeleted');
        $this->app['events']->listen('facilitador::model.validating:*',
            '\Facilitador\Observers\ValidateExistingFiles@onValidating');
    }


    protected function bootEvents($events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            $event->menu->add('Facilitador');
            $event->menu->add([
                'text'    => 'Facilitador',
                'icon'    => 'cog',
                'nivel' => \App\Models\Role::$GOOD,
                'submenu' => \Facilitador\Services\MenuService::getAdminMenu(),
            ]);
            $event->menu->add([
                'text'    => 'Decoy',
                'icon'    => 'cog',
                'nivel' => \App\Models\Role::$GOOD,
                'submenu' => \Facilitador\Services\MenuService::getDecoyMenu(),
            ]);
            $event->menu->add([
                'text'    => 'Voyager',
                'icon'    => 'cog',
                'nivel' => \App\Models\Role::$GOOD,
                'submenu' => \Facilitador\Services\MenuService::getVoyagerMenu(),
            ]);
        });


        // Wire up model event callbacks even if request is not for admin.  Do this
        // after the usingAdmin call so that the callbacks run after models are
        // mutated by Decoy logic.  This is important, in particular, so the
        // Validation observer can alter validation rules before the onValidation
        // callback runs.
        $this->app['events']->listen('eloquent.*',
            'Facilitador\Observers\ModelCallbacks');
        $this->app['events']->listen('facilitador::model.*',
            'Facilitador\Observers\ModelCallbacks');
    }

}
