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

trait FacilitadorLoadClasses
{


    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/
    protected function loadViews()
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'facilitador');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/facilitador'),
        ], ['views',  'sitec', 'sitec-views']);
        
        // Publish tracking css and js to public directory
        $this->publishes([
            $this->getPublishesPath('public/adminlte') => public_path('vendor/adminlte')
        ], ['public',  'sitec', 'sitec-public']);

    }
    
    protected function loadTranslations()
    {
        // Publish lanaguage files
        $this->publishes([
            $this->getResourcesPath('lang') => resource_path('lang/vendor/facilitador')
        ], ['lang',  'sitec', 'sitec-lang', 'translations']);

        // Load translations
        $this->loadTranslationsFrom($this->getResourcesPath('lang'), 'facilitador');
    }


    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/




    protected function loadCommands()
    {

 

        // Register commands
        $this->registerCommandFolders([
            base_path('vendor/sierratecnologia/facilitador/src/Console/Commands') => '\Facilitador\Console\Commands',
        ]);


    }
       
    protected function loadMigrations()
    {
        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
       
    }

    protected function loadConfigs()
    {
        
        // Merge own configs into user configs 
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/discover.php'), 'sitec.discover');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/generator.php'), 'sitec.generator');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/facilitador.php'), 'sitec.facilitador');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/site.php'), 'sitec.site');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/core.php'), 'sitec.core');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/encode.php'), 'sitec.encode');
        // @todo Remover mais pra frente esse aqui
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/attributes.php'), 'sitec.attributes');
        
        $this->mergeConfigFrom($this->getPublishesPath('config/crudmaker.php'), 'crudmaker');
        $this->mergeConfigFrom($this->getPublishesPath('config/debug-server.php'), 'debug-server');
        $this->mergeConfigFrom($this->getPublishesPath('config/debugbar.php'), 'debugbar');
        $this->mergeConfigFrom($this->getPublishesPath('config/eloquentfilter.php'), 'eloquentfilter');
        $this->mergeConfigFrom($this->getPublishesPath('config/excel.php'), 'excel');
        $this->mergeConfigFrom($this->getPublishesPath('config/form-maker.php'), 'form-maker');
        $this->mergeConfigFrom($this->getPublishesPath('config/gravatar.php'), 'gravatar');
        $this->mergeConfigFrom($this->getPublishesPath('config/tinker.php'), 'tinker');
        $this->mergeConfigFrom($this->getPublishesPath('config/voyager-hooks.php'), 'voyager-hooks');
        $this->mergeConfigFrom($this->getPublishesPath('config/voyager.php'), 'voyager');
    }
}
