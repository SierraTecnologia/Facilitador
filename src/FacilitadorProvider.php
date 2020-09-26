<?php

namespace Facilitador;

use App;
use Config;
use Facilitador\Facades\Facilitador as FacilitadorFacade;

use Facilitador\Models\MenuItem;
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

    public string $packageName = 'facilitador';
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
