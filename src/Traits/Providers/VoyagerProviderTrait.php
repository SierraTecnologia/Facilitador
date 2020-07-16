<?php

namespace Facilitador\Traits\Providers;
    
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Intervention\Image\ImageServiceProvider;
use Larapack\DoctrineSupport\DoctrineSupportServiceProvider;
use FacilitadorHooks\FacilitadorHooksServiceProvider;
use Facilitador\Facades\Facilitador as FacilitadorFacade;
use Facilitador\Models\MenuItem;
use Facilitador\Models\Setting;
use Facilitador\Policies\BasePolicy;
use Facilitador\Policies\MenuItemPolicy;
use Facilitador\Policies\SettingPolicy;
use Facilitador\Providers\FacilitadorDummyServiceProvider;
use Facilitador\Providers\FacilitadorEventServiceProvider;
use Facilitador\Facilitador;
use Support\Alert;
    
trait VoyagerProviderTrait
{

    /**
     * Register the application services.
     */
    public function voyagerRegister()
    {
        $this->app->register(FacilitadorEventServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
        $this->app->register(FacilitadorDummyServiceProvider::class);
        $this->app->register(FacilitadorHooksServiceProvider::class);
        $this->app->register(DoctrineSupportServiceProvider::class);

        $loader = AliasLoader::getInstance();
        $loader->alias('Facilitador', FacilitadorFacade::class);

        $this->app->singleton(
            'facilitador', function () {
                return new Facilitador();
            }
        );

        $this->app->singleton(
            'FacilitadorGuard', function () {
                return \Illuminate\Support\Facades\Config::get('auth.defaults.guard', 'web');
            }
        );


        if (!$this->app->runningInConsole() || \Illuminate\Support\Facades\Config::get('app.env') == 'testing') {

            $this->registerPublishableResources();
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function voyagerBoot(Router $router, Dispatcher $event)
    {
        if (\Illuminate\Support\Facades\Config::get('sitec.facilitador.user.add_default_role_on_register')) {
            $model = Auth::guard(app('FacilitadorGuard'))->getProvider()->getModel();
            call_user_func(
                $model.'::created', function ($user) use ($model) {
                    if (is_null($user->role_id)) {
                        call_user_func($model.'::findOrFail', $user->id)
                        ->setRole(\Illuminate\Support\Facades\Config::get('sitec.facilitador.user.default_role'))
                        ->save();
                    }
                }
            );
        }

        $this->loadAuth();
    }

    /**
     * Register the publishes files.
     */
    private function registerPublishableResources()
    {
        $publishesPath = dirname(__DIR__).'/../../../publishes';

        $publishes = [
            'facilitador_avatar' => [
                "{$publishesPath}/dummy_content/users/" => storage_path('app/public/users'),
            ],
            'seeds' => [
                "{$publishesPath}/database/seeds/" => database_path('seeds'),
            ],

        ];

        foreach ($publishes as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }


}
