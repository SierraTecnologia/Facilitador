<?php

namespace Facilitador;



use Muleta\Traits\Providers\ConsoleTools;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;

use Facilitador\Traits\Providers\AppEventsProvider;
use Facilitador\Traits\Providers\AppMiddlewaresProvider;
use Facilitador\Traits\Providers\FacilitadorLoadClasses;
use Facilitador\Traits\Providers\AppServiceContainerProvider;
use Facilitador\Traits\Providers\FacilitadorRegisterPackages;
use Facilitador\Traits\Providers\FacilitadorRegisterPublishes;
use Facilitador\Traits\Providers\VoyagerProviderTrait;
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
        [
            'text' => 'Painel',
            'icon' => 'fas fa-fw fa-search',
            'icon_color' => "blue",
            'label_color' => "success",
            'level'       => 1, // 0 (Public), 1, 2 (Admin) , 3 (Root)
        ],
        // 'User|50' => [
        //     [
        //         'text'        => 'Dashboard',
        //         'route'       => 'profile.dashboard',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Home',
        //         'route'       => 'profile.home',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Profile',
        //         'route'       => 'profile.profile',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Show Profile',
        //         'route'       => 'profile.profile.show',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Notifications',
        //         'route'       => 'profile.notifications.index',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Messages',
        //         'route'       => 'profile.messages.index',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        //     [
        //         'text'        => 'Logout',
        //         'route'       => 'profile.logout',
        //         'icon'        => 'fas fa-fw fa-industry',
        //         'icon_color'  => 'blue',
        //         'label_color' => 'success',
        //         // 'access' => \App\Models\Role::$ADMIN
        //     ],
        // ],
        'System|350' => [
            // [
            //     'text' => 'Information',
            //     'icon' => 'fas fa-fw fa-book',
            //     'icon_color' => "blue",
            //     'label_color' => "success",
            // ],
            [
                'text' => 'Site',
                'icon' => 'fas fa-book',
                'icon_color' => "blue",
                'label_color' => "success",
                'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
            ],
            [
                'text' => 'Tools',
                'icon' => 'fas fa-fw fa-th',
                'icon_color' => "blue",
                'label_color' => "success",
                'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
            ],
            // 'Information' => [
            // ],
            'Site' => [
                [
                    'text'        => 'Decoy',
                    'url'         => 'admin',
                    'icon'        => 'fas fa-fw fa-cog',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Compass',
                    'route'       => 'facilitador.compass.index',
                    'icon'        => 'fas fa-fw fa-cog',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                // [
                //     'text'        => 'Menu Builder',
                //     'route'       => 'facilitador.menus.builder',
                //     'icon'        => 'fas fa-fw fa-cog',
                //     'icon_color'  => 'blue',
                //     'label_color' => 'success',
                //     // 'access' => \App\Models\Role::$ADMIN
                // ],
                [
                    'text'        => 'Medias',
                    'route'       => 'facilitador.media.index',
                    'icon'        => 'fas fa-fw fa-cog',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'elements',
                    'route'       => 'facilitador.elements',
                    'icon'        => 'fas fa-fw fa-laptop',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Redirects',
                    'url'         => '/siravel/redirect-rules',
                    'icon'        => 'fas fa-fw fa-share',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'settings',
                    'route'       => 'facilitador.settings.index',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
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
                    'icon'        => 'fas fa-fw fa-coffee',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \App\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Hooks',
                    'route'       => 'facilitador.hooks',
                    'icon'        => 'fas fa-fw fa-share',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
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
        if (\Illuminate\Support\Facades\Config::get('site.core.register_routes') && !$this->app->routesAreCached()) {
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

        $this->loadMigrations();
        $this->loadAlias();


        $this->loadServiceContainerSingletons();


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
                        && class_exists($dataType->policy_name)
                    ) {
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
            Gate::define(
                $gate, function ($user) use ($gate) {
                    return $user->hasPermission($gate);
                }
            );
        }
    }

}
