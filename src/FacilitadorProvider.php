<?php

namespace Facilitador;

use App;
use Config;
use Facilitador\Facades\Facilitador as FacilitadorFacade;

use Siravel\Models\Negocios\MenuItem;
use Facilitador\Models\Setting;
use Facilitador\Policies\BasePolicy;
use Facilitador\Policies\MenuItemPolicy;
use Facilitador\Policies\SettingPolicy;
use Facilitador\Traits\Providers\AppEventsProvider;
use Facilitador\Traits\Providers\AppMiddlewaresProvider;
use Facilitador\Traits\Providers\AppServiceContainerProvider;
use Facilitador\Traits\Providers\FacilitadorLoadClasses;

use Facilitador\Traits\Providers\FacilitadorRegisterPackages;
use Facilitador\Traits\Providers\FacilitadorRegisterPublishes;
use Facilitador\Traits\Providers\VoyagerProviderTrait;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
/**
 * POr causa do voyager estamos usando o segundo (registerPolicy)
 */
// use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
/**
 * Verificar se ta usando
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Muleta\Traits\Providers\ConsoleTools;

class FacilitadorProvider extends ServiceProvider
{
    use AppEventsProvider, AppMiddlewaresProvider, AppServiceContainerProvider, FacilitadorLoadClasses, FacilitadorRegisterPackages, FacilitadorRegisterPublishes, VoyagerProviderTrait;

    use ConsoleTools;

    public $packageName = 'facilitador';
    const pathVendor = 'sierratecnologia/facilitador';

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
        // // 'User|50' => [
        //     // [
        //     //     'text'        => 'Home',
        //     //     'route'       => 'profile.home',
        //     //     'icon'        => 'fas fa-fw fa-industry',
        //     //     'icon_color'  => 'blue',
        //     //     'label_color' => 'success',
        //     //     // 'access' => \Porteiro\Models\Role::$ADMIN
        //     // ],
        //     // [
        //     //     'text'        => 'Profile',
        //     //     'route'       => 'profile.porteiro.profile',
        //     //     'icon'        => 'fas fa-fw fa-industry',
        //     //     'icon_color'  => 'blue',
        //     //     'label_color' => 'success',
        //     //     // 'access' => \Porteiro\Models\Role::$ADMIN
        //     // ],
        //     // [
        //     //     'text'        => 'Show Profile',
        //     //     'route'       => 'profile.porteiro.profile.show',
        //     //     'icon'        => 'fas fa-fw fa-industry',
        //     //     'icon_color'  => 'blue',
        //     //     'label_color' => 'success',
        //     //     // 'access' => \Porteiro\Models\Role::$ADMIN
        //     // ],
        // // ],
        // 'Admin|400' => [
        //     [
        //         'text'        => 'Permissions',
        //         'route'       => 'admin.permissions.index',
        //         'icon'        => 'lock',
        //         'section'       => 'admin',
        //         'level'       => 3,
        //     ],
        //     [
        //         'text'        => 'Roles',
        //         'route'       => 'admin.roles.index',
        //         'icon'        => 'key',
        //         'section'       => 'admin',
        //         'level'       => 3,
        //     ],
            [
                'text' => 'Tools',
                'icon' => 'fas fa-fw fa-th',
                'icon_color' => "blue",
                'label_color' => "success",
                'section'      => 'rica',
                'order' => 4250,
                'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
            ],
        //     // 'Information' => [
        //     // ],
        //     'Site' => [
        //         [
        //             'text'        => 'Decoy',
        //             'url'         => 'admin',
        //             'icon'        => 'fas fa-fw fa-cog',
        //             'icon_color'  => 'blue',
        //             'label_color' => 'success',
        //             'section'      => 'admin',
        //             'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
        //             // 'access' => \Porteiro\Models\Role::$ADMIN
        //         ],
                [
                    'text'        => 'elements',
                    'route'       => 'pedreiro.elements',
                    'icon'        => 'fas fa-fw fa-laptop',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'      => 'admin',
                    'order' => 2300,
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Redirects',
                    'route'       => 'admin.facilitador.redirect-rules.index',
                    'icon'        => 'fas fa-fw fa-share',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'       => 'admin',
                    'order' => 2300,
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'settings',
                    'route'       => 'rica.facilitador.settings.index',
                    'icon'        => 'fas fa-fw fa-industry',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'order' => 2300,
                    'section'      => 'admin',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Medias',
                    'route'       => 'master.media.index',
                    'icon'        => 'fas fa-fw fa-cog',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'      => 'admin',
                    'order' => 2250,
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Compass',
                    'route'       => 'rica.facilitador.compass.index',
                    'icon'        => 'fas fa-fw fa-cog',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'      => 'rica',
                    'order' => 4250,
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                // [
                //     'text'        => 'Menu Builder',
                //     'route'       => 'facilitador.menus.builder',
                //     'icon'        => 'fas fa-fw fa-cog',
                //     'icon_color'  => 'blue',
                //     'label_color' => 'success',
                //     // 'access' => \Porteiro\Models\Role::$ADMIN
                // ],
        //     ],
            'Tools' => [
                // [
                //     'text'        => 'encode',
                //     'route'       => 'facilitador.encode',
                //     'icon'        => 'fas fa-fw fa-industry',
                //     'icon_color'  => 'blue',
                //     'label_color' => 'success',
                //     // 'access' => \Porteiro\Models\Role::$ADMIN
                // ],
                [
                    'text'        => 'Workers',
                    'route'       => 'facilitador.workers',
                    'icon'        => 'fas fa-fw fa-coffee',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'      => 'rica',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
                [
                    'text'        => 'Hooks',
                    'route'       => 'rica.facilitador.hooks',
                    'icon'        => 'fas fa-fw fa-share',
                    'icon_color'  => 'blue',
                    'label_color' => 'success',
                    'section'      => 'rica',
                    'level'       => 3, // 0 (Public), 1, 2 (Admin) , 3 (Root)
                    // 'access' => \Porteiro\Models\Role::$ADMIN
                ],
            ],
        // ],
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

        /**
         * Transmissor; Routes
         */
        $this->loadRoutesForRiCa(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'routes');
        

        // Configure Decoy auth setup
        $this->bootAuth();
        
        // @todo ajeitar
        // Do bootstrapping that only matters if user has requested an admin URL
        // if ($this->app['facilitador']->handling()) {
        $this->usingAdmin();
        // }

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
     *
     * @return void
     */
    public function loadAuth(): void
    {
        return ; // @todo Ver Policy com problema nos can
        
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
