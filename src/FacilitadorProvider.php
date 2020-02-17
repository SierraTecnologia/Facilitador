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

use Illuminate\Support\ServiceProvider;

/**
 * Verificar se ta usando
 */
use App;
use Config;



class FacilitadorProvider extends ServiceProvider
{

    use AppEventsProvider, AppMiddlewaresProvider, AppServiceContainerProvider, FacilitadorLoadClasses, FacilitadorRegisterPackages, FacilitadorRegisterPublishes;


    /**
     * Rotas do Menu
     */
    public static $menuItens = [
        'Admin' => [
            [
                'text' => 'Facilitador',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            'Facilitador' => [
                [
                    'text'        => 'Manager',
                    'route'       => 'facilitador.dash',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
            'Decoy' => [
                [
                    'text'        => 'Decoy',
                    'url'         => 'admin',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
            'Facilitador' => [
                [
                    'text'        => 'Tools',
                    'url'         => 'facilitador/hooks',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'hooks',
                    'url'         => 'facilitador/hooks',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'bread',
                    'url'         => 'facilitador/bread',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Database',
                    'url'         => 'facilitador/database',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'settings',
                    'url'         => 'facilitador/settings',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
        ],
    ];

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
