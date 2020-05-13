<?php

namespace Facilitador;



use Support\Traits\Providers\ConsoleTools;
use Illuminate\Contracts\Events\Dispatcher;

use Facilitador\Traits\Providers\AppEventsProvider;
use Facilitador\Traits\Providers\AppMiddlewaresProvider;
use Facilitador\Traits\Providers\FacilitadorLoadClasses;
use Facilitador\Traits\Providers\AppServiceContainerProvider;
use Facilitador\Traits\Providers\FacilitadorRegisterPackages;
use Facilitador\Traits\Providers\FacilitadorRegisterPublishes;
use Facilitador\Traits\Providers\VoyagerProviderTrait;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Facilitador\Facades\Facilitador as FacilitadorFacade;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Facilitador\Models\MenuItem;
use Facilitador\Models\Setting;
use Facilitador\Policies\BasePolicy;
use Facilitador\Policies\MenuItemPolicy;
use Facilitador\Policies\SettingPolicy;
/**
 * POr causa do voyager estamos usando o segundo (registerPolicy)
 */
// use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
/**
 * Verificar se ta usando
 */
use App;
use Config;



class FacilitadorProvider extends ServiceProvider
{

    use AppEventsProvider, AppMiddlewaresProvider, AppServiceContainerProvider, FacilitadorLoadClasses, FacilitadorRegisterPackages, FacilitadorRegisterPublishes, VoyagerProviderTrait;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Setting::class  => SettingPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
    ];

    protected $gates = [
        'browse_admin',
        'browse_bread',
        'browse_database',
        'browse_media',
        'browse_compass',
        'browse_hooks',
    ];

    /**
     * Rotas do Menu
     */
    public static $menuItens = [
        'Painel' => [
            [
                'text' => 'User',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            'User' => [
                [
                    'text'        => 'Home',
                    'url'       => '/',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Profile',
                    'route'       => 'facilitador.profile',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Logout',
                    'route'       => 'facilitador.logout',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
        ],
        'Admin' => [
            [
                'text' => 'Site',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            [
                'text' => 'Tools',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            'Site' => [
                [
                    'text'        => 'elements',
                    'route'       => 'facilitador.elements',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Redirects',
                    'url'       => '/siravel/redirect-rules',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'settings',
                    'route'       => 'facilitador.settings.index',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
            'Tools' => [
                // [
                //     'text'        => 'Tools',
                //     'route'       => 'facilitador.hooks',
                //     'icon'        => 'fas fa-fw fa-industry',
                //     'icon_color'  => 'blue',
                //     'label_color' => 'success',
                //     // 'access' => \App\Models\Role::$ADMIN
                // ],
                // [
                //     'text'        => 'encode',
                //     'route'       => 'facilitador.encode',
                //     'icon'        => 'fas fa-fw fa-industry',
                //     'icon_color'  => 'blue',
                //     'label_color' => 'success',
                //     // 'access' => \App\Models\Role::$ADMIN
                // ],
                [
                    'text'        => 'Workers',
                    'route'       => 'facilitador.workers',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Commands',
                    'route'       => 'facilitador.commands',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Hooks',
                    'route'       => 'facilitador.hooks',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
        ],
        'System' => [
            [
                'text' => 'Information',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            [
                'text' => 'Manager',
                'icon' => 'fas fa-fw fa-bomb',
                'icon_color' => "blue",
                'label_color' => "success",
            ],
            'Information' => [
                [
                    'text'        => 'Decoy',
                    'url'         => 'admin',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Manager',
                    'route'       => 'facilitador.dash',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
            ],
            'Manager' => [
                [
                    'text'        => 'Manager Errors',
                    'route'       => 'facilitador.dash',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Bread',
                    'route'       => 'facilitador.bread.index',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Database',
                    'route'       => 'facilitador.database.index',
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
    public function boot(Router $router, Dispatcher $events)
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

        $this->voyagerBoot($router, $events);

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

        $this->voyagerRegister();

    }

    /**
     * Veio do Voyager
     */
    public function loadAuth()
    {
        // DataType Policies

        // This try catch is necessary for the Package Auto-discovery
        // otherwise it will throw an error because no database
        // connection has been made yet.
        try {
            if (Schema::hasTable(FacilitadorFacade::model('DataType')->getTable())) {
                $dataType = FacilitadorFacade::model('DataType');
                $dataTypes = $dataType->select('policy_name', 'model_name')->get();

                foreach ($dataTypes as $dataType) {
                    $policyClass = BasePolicy::class;
                    if (isset($dataType->policy_name) && $dataType->policy_name !== ''
                        && class_exists($dataType->policy_name)) {
                        $policyClass = $dataType->policy_name;
                    }

                    $this->policies[$dataType->model_name] = $policyClass;
                }

                $this->registerPolicies();
            }
        } catch (\PDOException $e) {
            Log::error('No Database connection yet in FacilitadorServiceProvider loadAuth()');
        }

        // Gates
        foreach ($this->gates as $gate) {
            Gate::define($gate, function ($user) use ($gate) {
                return $user->hasPermission($gate);
            });
        }
    }

}
