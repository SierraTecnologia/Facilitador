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

trait FacilitadorRegisterPublishes
{
    use ConsoleTools;

       
    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/


    protected function publishMigrations()
    {
        
       
    }
       
    protected function publishAssets()
    {
        
        // Publish facilitador css and js to public directory
        $this->publishes([
            $this->getDistPath('facilitador') => public_path('assets/facilitador')
        ], ['public',  'sitec', 'sitec-public']);

    }

    protected function publishConfigs()
    {
        
        // Publish config files
        $this->publishes([
            // Paths
            $this->getPublishesPath('config/sitec') => config_path('sitec'),
            // Files
            $this->getPublishesPath('config/crudmaker.php') => config_path('crudmaker.php'),
            $this->getPublishesPath('config/debug-server.php') => config_path('debug-server.php'),
            $this->getPublishesPath('config/debugbar.php') => config_path('debugbar.php'),
            $this->getPublishesPath('config/eloquentfilter.php') => config_path('eloquentfilter.php'),
            $this->getPublishesPath('config/excel.php') => config_path('excel.php'),
            $this->getPublishesPath('config/form-maker.php') => config_path('form-maker.php'),
            $this->getPublishesPath('config/gravatar.php') => config_path('gravatar.php'),
            $this->getPublishesPath('config/tinker.php') => config_path('tinker.php'),
            $this->getPublishesPath('config/voyager-hooks.php') => config_path('voyager-hooks.php'),
            $this->getPublishesPath('config/voyager.php') => config_path('voyager.php')
        ], ['config',  'sitec', 'sitec-config']);

    }
    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/



}
