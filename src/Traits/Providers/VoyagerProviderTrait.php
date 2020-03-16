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
use Facilitador\Events\FormFieldsRegistered;
use Facilitador\Facades\Facilitador as FacilitadorFacade;
use Facilitador\FormFields\After\DescriptionHandler;
use Facilitador\Http\Middleware\FacilitadorAdminMiddleware;
use Facilitador\Models\MenuItem;
use Facilitador\Models\Setting;
use Facilitador\Policies\BasePolicy;
use Facilitador\Policies\MenuItemPolicy;
use Facilitador\Policies\SettingPolicy;
use Facilitador\Providers\FacilitadorDummyServiceProvider;
use Facilitador\Providers\FacilitadorEventServiceProvider;
use Facilitador\Translator\Collection as TranslatorCollection;
use Facilitador\Facilitador;
    
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

        $this->app->singleton('facilitador', function () {
            return new Facilitador();
        });

        $this->app->singleton('FacilitadorGuard', function () {
            return config('auth.defaults.guard', 'web');
        });

        $this->loadHelpers();

        $this->registerAlertComponents();
        $this->registerFormFields();

        $this->registerConfigs();

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerConsoleCommands();
        }

        if (!$this->app->runningInConsole() || config('app.env') == 'testing') {
            $this->registerAppCommands();
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function voyagerBoot(Router $router, Dispatcher $event)
    {
        if (config('facilitador.user.add_default_role_on_register')) {
            $model = Auth::guard(app('FacilitadorGuard'))->getProvider()->getModel();
            call_user_func($model.'::created', function ($user) use ($model) {
                if (is_null($user->role_id)) {
                    call_user_func($model.'::findOrFail', $user->id)
                        ->setRole(config('facilitador.user.default_role'))
                        ->save();
                }
            });
        }

        $this->loadViewsFrom(__DIR__.'/../../../resources/views', 'facilitador');

        $router->aliasMiddleware('admin.user', FacilitadorAdminMiddleware::class);

        $this->loadTranslationsFrom(realpath(__DIR__.'/../../../publishes/lang'), 'facilitador');

        if (config('facilitador.database.autoload_migrations', true)) {
            if (config('app.env') == 'testing') {
                $this->loadMigrationsFrom(realpath(__DIR__.'/migrations'));
            }

            $this->loadMigrationsFrom(realpath(__DIR__.'/../../../migrations'));
        }

        $this->loadAuth();

        $this->registerViewComposers();

        $event->listen('facilitador.alerts.collecting', function () {
            $this->addStorageSymlinkAlert();
        });

        $this->bootTranslatorCollectionMacros();
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }

    /**
     * Register view composers.
     */
    protected function registerViewComposers()
    {
        // Register alerts
        View::composer('facilitador::*', function ($view) {
            $view->with('alerts', FacilitadorFacade::alerts());
        });
    }

    /**
     * Add storage symlink alert.
     */
    protected function addStorageSymlinkAlert()
    {
        if (app('router')->current() !== null) {
            $currentRouteAction = app('router')->current()->getAction();
        } else {
            $currentRouteAction = null;
        }
        $routeName = is_array($currentRouteAction) ? Arr::get($currentRouteAction, 'as') : null;

        if ($routeName != 'facilitador.dashboard') {
            return;
        }

        $storage_disk = (!empty(config('facilitador.storage.disk'))) ? config('facilitador.storage.disk') : 'public';

        if (request()->has('fix-missing-storage-symlink')) {
            if (file_exists(public_path('storage'))) {
                if (@readlink(public_path('storage')) == public_path('storage')) {
                    rename(public_path('storage'), 'storage_old');
                }
            }

            if (!file_exists(public_path('storage'))) {
                $this->fixMissingStorageSymlink();
            }
        } elseif ($storage_disk == 'public') {
            if (!file_exists(public_path('storage')) || @readlink(public_path('storage')) == public_path('storage')) {
                $alert = (new Alert('missing-storage-symlink', 'warning'))
                    ->title(__('facilitador::error.symlink_missing_title'))
                    ->text(__('facilitador::error.symlink_missing_text'))
                    ->button(__('facilitador::error.symlink_missing_button'), '?fix-missing-storage-symlink=1');
                FacilitadorFacade::addAlert($alert);
            }
        }
    }

    protected function fixMissingStorageSymlink()
    {
        app('files')->link(storage_path('app/public'), public_path('storage'));

        if (file_exists(public_path('storage'))) {
            $alert = (new Alert('fixed-missing-storage-symlink', 'success'))
                ->title(__('facilitador::error.symlink_created_title'))
                ->text(__('facilitador::error.symlink_created_text'));
        } else {
            $alert = (new Alert('failed-fixing-missing-storage-symlink', 'danger'))
                ->title(__('facilitador::error.symlink_failed_title'))
                ->text(__('facilitador::error.symlink_failed_text'));
        }

        FacilitadorFacade::addAlert($alert);
    }

    /**
     * Register alert components.
     */
    protected function registerAlertComponents()
    {
        $components = ['title', 'text', 'button'];

        foreach ($components as $component) {
            $class = 'Facilitador\\Alert\\Components\\'.ucfirst(Str::camel($component)).'Component';

            $this->app->bind("facilitador.alert.components.{$component}", $class);
        }
    }

    protected function bootTranslatorCollectionMacros()
    {
        Collection::macro('translate', function () {
            $transtors = [];

            foreach ($this->all() as $item) {
                $transtors[] = call_user_func_array([$item, 'translate'], func_get_args());
            }

            return new TranslatorCollection($transtors);
        });
    }

    /**
     * Register the publishes files.
     */
    private function registerPublishableResources()
    {
        $publishesPath = dirname(__DIR__).'/../../publishes';

        $publishes = [
            'facilitador_avatar' => [
                "{$publishesPath}/dummy_content/users/" => storage_path('app/public/users'),
            ],
            'seeds' => [
                "{$publishesPath}/database/seeds/" => database_path('seeds'),
            ],
            'config' => [
                "{$publishesPath}/config/facilitador.php" => config_path('facilitador.php'),
            ],

        ];

        foreach ($publishes as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    public function registerConfigs()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/../../publishes/config/facilitador.php', 'facilitador'
        );
    }

    protected function registerFormFields()
    {
        $formFields = [
            'checkbox',
            'multiple_checkbox',
            'color',
            'date',
            'file',
            'image',
            'multiple_images',
            'media_picker',
            'number',
            'password',
            'radio_btn',
            'rich_text_box',
            'code_editor',
            'markdown_editor',
            'select_dropdown',
            'select_multiple',
            'text',
            'text_area',
            'time',
            'timestamp',
            'hidden',
            'coordinates',
        ];

        foreach ($formFields as $formField) {
            $class = Str::studly("{$formField}_handler");

            FacilitadorFacade::addFormField("Facilitador\\FormFields\\{$class}");
        }

        FacilitadorFacade::addAfterFormField(DescriptionHandler::class);

        event(new FormFieldsRegistered($formFields));
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(\Facilitador\Commands\InstallCommand::class);
        $this->commands(\Facilitador\Commands\ControllersCommand::class);
        $this->commands(\Facilitador\Commands\AdminCommand::class);
    }

    /**
     * Register the commands accessible from the App.
     */
    private function registerAppCommands()
    {
        $this->commands(\Facilitador\Commands\MakeModelCommand::class);
    }
}
