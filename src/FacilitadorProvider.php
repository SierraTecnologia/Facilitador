<?php

namespace Facilitador;



use Support\ClassesHelpers\Traits\Models\ConsoleTools;
use Illuminate\Contracts\Events\Dispatcher;

use Facilitador\Traits\Providers\AppEventsProvider;
use Facilitador\Traits\Providers\AppMiddlewaresProvider;
use Facilitador\Traits\Providers\FacilitadorLoadClasses;
use Facilitador\Traits\Providers\AppServiceContainerProvider;
use Facilitador\Traits\Providers\FacilitadorRegisterPackages;
use Facilitador\Traits\Providers\FacilitadorRegisterPublishes;

/**
 * Verificar se ta usando
 */
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



class FacilitadorProvider extends ServiceProvider
{
    use ConsoleTools;

    use AppEventsProvider, AppMiddlewaresProvider, AppServiceContainerProvider, FacilitadorLoadClasses, FacilitadorRegisterPackages, FacilitadorRegisterPublishes;

    /**
     * Boot method.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        
        // Register configs, migrations, etc
        $this->publishConfigs();
        $this->publishAssets();
        $this->publishMigrations();

        $this->loadViews();
        $this->loadTranslations();
        
        // Register the routes.
        if (config('sitec.core.register_routes') && !$this->app->routesAreCached()) {
            $this->app['facilitador.router']->registerAll();
        }

        // Configure Decoy auth setup
        $this->bootAuth();

        // Do bootstrapping that only matters if user has requested an admin URL
        if ($this->app['facilitador']->handling()) {
            $this->usingAdmin();
        }

        $this->bootEvents($events);
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigs();

        // Register external packages
        $this->loadExternalPackages();
        $this->loadLocalExternalPackages();

        $this->loadMigrations();
        $this->loadAlias();


        $this->loadServiceContainerSingletons();
        $this->loadServiceContainerRouteBinds();
        $this->loadServiceContainerBinds();
        $this->loadServiceContainerReplaceClasses();


        $this->loadCommands();

    }


}
