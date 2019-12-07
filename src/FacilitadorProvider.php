<?php

namespace Facilitador;

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
use Facilitador\Console\Commands\MakeEloquentFilter;
use Illuminate\Support\Collection;
use App;
use Config;
use Former\Former;
use Facilitador\Observers\Validation;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class FacilitadorProvider extends ServiceProvider
{

    public static $aliasProviders = [
        'TranslationCache' => \RicardoSierra\Translation\Facades\TranslationCache::class,
        'Translation' => \RicardoSierra\Translation\Facades\Translation::class,

        /**
         * Decoy
         */
        'Decoy' => \Facilitador\Facades\Decoy::class,
        'DecoyURL' => \Facilitador\Facades\DecoyURL::class,
        // Form field generation
        'Former' => \Former\Facades\Former::class,
        // Image resizing
        'Croppa' => \Bkwld\Croppa\Facade::class,
        // BrowserDetect
        'Agent' => \Jenssegers\Agent\Facades\Agent::class,
    ];

    public static $providers = [
        // \Facilitador\Providers\ServicesProvider::class,
        // \Facilitador\Providers\FacilitadorRouteProvider::class,
        // \Facilitador\Providers\FormMakerProvider::class,

        \Tracking\TrackingProvider::class,
        
        /**
         * Internos
         */
        \Facilitador\Providers\ServicesProvider::class,
        \Facilitador\Providers\FacilitadorRouteProvider::class,
        \Facilitador\Providers\FormMakerProvider::class,
        \Tracking\TrackingProvider::class,
        
        /**
         * Externos
         */
        \Facilitador\Providers\GravatarServiceProvider::class,
        
        // \Facilitador\Providers\ExtendedBreadFormFieldsServiceProvider::class,
        // \Facilitador\Providers\FieldServiceProvider::class,

        /**
         * Base
         */
        \RicardoSierra\Translation\TranslationServiceProvider::class,

        /**
         * VEio pelo Decoy
         **/
        \Former\FormerServiceProvider::class,
        // Image resizing
        \Bkwld\Croppa\ServiceProvider::class,
        // PHP utils
        \Bkwld\Library\ServiceProvider::class,
        // HAML
        \Bkwld\LaravelHaml\ServiceProvider::class,
        // BrowserDetect
        \Jenssegers\Agent\AgentServiceProvider::class,
        // File uploading
        \Bkwld\Upchuck\ServiceProvider::class,
        // Creation of slugs
        \Cviebrock\EloquentSluggable\ServiceProvider::class,
        // Support for cloning models
        \Bkwld\Cloner\ServiceProvider::class,

        /**
         * Outros meus
         */
        \Laravel\Tinker\TinkerServiceProvider::class,
    ];

    /**
     * Boot method.
     *
     * @return void
     */
    public function boot()
    {

        // Register configs, migrations, etc
        $this->registerDirectories();
        
        // Register the routes.
        if (config('facilitador.core.register_routes') && !$this->app->routesAreCached()) {
            $this->app['facilitador.router']->registerAll();
        }

        // Configure Decoy auth setup
        $this->bootAuth();

        // Do bootstrapping that only matters if user has requested an admin URL
        if ($this->app['facilitador']->handling()) {
            $this->usingAdmin();
        }

        // Wire up model event callbacks even if request is not for admin.  Do this
        // after the usingAdmin call so that the callbacks run after models are
        // mutated by Decoy logic.  This is important, in particular, so the
        // Validation observer can alter validation rules before the onValidation
        // callback runs.
        $this->app['events']->listen('eloquent.*',
            'Facilitador\Observers\ModelCallbacks');
        $this->app['events']->listen('facilitador::model.*',
            'Facilitador\Observers\ModelCallbacks');
        // Log model change events after others in case they modified the record
        // before being saved.
        $this->app['events']->listen('eloquent.*',
            'Facilitador\Observers\Changes');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        // Merge own configs into user configs 
        $this->mergeConfigFrom($this->getPublishesPath('config/facilitador/sitec.php'), 'facilitador.sitec');
        $this->mergeConfigFrom($this->getPublishesPath('config/facilitador/site.php'), 'facilitador.site');
        $this->mergeConfigFrom($this->getPublishesPath('config/facilitador/core.php'), 'facilitador.core');
        $this->mergeConfigFrom($this->getPublishesPath('config/facilitador/encode.php'), 'facilitador.encode');
        $this->mergeConfigFrom($this->getPublishesPath('config/crudmaker.php'), 'crudmaker');
        $this->mergeConfigFrom($this->getPublishesPath('config/eloquentfilter.php'), 'eloquentfilter');
        $this->mergeConfigFrom($this->getPublishesPath('config/form-maker.php'), 'form-maker');
        $this->mergeConfigFrom($this->getPublishesPath('config/gravatar.php'), 'gravatar');

        // Register external packages
        $this->setProviders();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register HTML view helpers as "Decoy".  So they get invoked like: `Decoy::title()`
        $this->app->singleton('facilitador', function ($app) {
            return new \Facilitador\Helpers;
        });

        // Registers explicit rotues and wildcarding routing
        $this->app->singleton('facilitador.router', function ($app) {
            $dir = config('facilitador.core.dir');

            return new \Facilitador\Routing\Router($dir);
        });

        // Wildcard router
        $this->app->singleton('facilitador.wildcard', function ($app) {
            $request = $app['request'];

            return new \Facilitador\Routing\Wildcard(
                config('facilitador.core.dir'),
                $request->getMethod(),
                $request->path()
            );
        });

        // Return the active user account
        $this->app->singleton('facilitador.user', function ($app) {
            $guard = config('facilitador.core.guard');

            return $app['auth']->guard($guard)->user();
        });

        // Return a redirect response with extra stuff
        $this->app->singleton('facilitador.acl_fail', function ($app) {
            return $app['redirect']
                ->guest(route('facilitador::account@login'))
                ->withErrors([ 'error message' => __('facilitador::login.error.login_first')]);
        });

        // Register URL Generators as "DecoyURL".
        $this->app->singleton('facilitador.url', function ($app) {
            return new \Facilitador\Routing\UrlGenerator($app['request']->path());
        });

        // Build the Elements collection
        $this->app->singleton('facilitador.elements', function ($app) {
            return with(new \Facilitador\Collections\Elements)->setModel(Models\Decoy\Element::class);
        });

        // Build the Breadcrumbs store
        $this->app->singleton('facilitador.breadcrumbs', function ($app) {
            $breadcrumbs = new \Facilitador\Layout\Breadcrumbs();
            $breadcrumbs->set($breadcrumbs->parseURL());

            return $breadcrumbs;
        });

        // Register Decoy's custom handling of some exception
        $this->app->singleton(ExceptionHandler::class, \Facilitador\Exceptions\Handler::class);



        /*
        |--------------------------------------------------------------------------
        | Register the Utilities
        |--------------------------------------------------------------------------
        */
        /**
         * Singleton Facilitador
         */
        $this->app->singleton(FacilitadorService::class, function($app)
        {
            Log::info('Singleton Facilitador');
            return new FacilitadorService(config('facilitador.sitec.models'));
        });

        Route::bind('modelClass', function ($value) {
            Log::info('Route Bind ModelClass - '.$value);
            return new ModelService($value);
        });
        Route::bind('identify', function ($value) {
            Log::info('Route Bind Identify - '.$value);
            return new RegisterService($value);
        });

        $this->app->bind(ModelService::class, function($app)
        {
            $modelClass = false;
            if (isset($app['router']->current()->parameters['modelClass'])) {
                $modelClass = Crypto::decrypt($app['router']->current()->parameters['modelClass']);
            }
            
            Log::info('Bind Model Service - '.$modelClass);
            return new ModelService($modelClass);
        });
        $this->app->bind(RepositoryService::class, function($app)
        {
            Log::info('Bind Repository Service');
            $modelService = $app->make(ModelService::class);
            return new RepositoryService($modelService);
        });
        $this->app->bind(RegisterService::class, function($app)
        {
            $identify = '';
            if (isset($app['router']->current()->parameters['identify'])) {
                $identify = Crypto::decrypt($app['router']->current()->parameters['identify']);
            }

            Log::info('Bind Register Service - '.$identify);
            return new RegisterService($identify);
        });

        // $this->app->when(ModelService::class)
        //     ->needs('$modelClass')
        //   ->give(function ($modelClassValue) {
        //       $request = $modelClassValue['request'];
        //         dd($request->has('modelClassValue'));
        //     //   dd();
        //       return $modelClassValue;
        //   });

        // Register commands
        $this->commands([\Facilitador\Console\Commands\Generate\Generate::class]);
        $this->commands([\Facilitador\Console\Commands\Generate\Admin::class]);
        $this->commands(MakeEloquentFilter::class);
    }

    

    /**
     * Things that happen only if the request is for the admin
     */
    public function usingAdmin()
    {

        // Define constants that Decoy uses
        if (!defined('FORMAT_DATE')) {
            define('FORMAT_DATE', __('facilitador::base.constants.format_date'));
        }
        if (!defined('FORMAT_DATETIME')) {
            define('FORMAT_DATETIME', __('facilitador::base.constants.format_datetime'));
        }
        if (!defined('FORMAT_TIME')) {
            define('FORMAT_TIME', __('facilitador::base.constants.format_time'));
        }

        // Register global and named middlewares
        $this->registerMiddlewares();

        // Use Decoy's auth by default, while at an admin path
        Config::set('auth.defaults', [
            'guard'     => 'facilitador',
            'passwords' => 'facilitador',
        ]);

        // Set the default mailer settings
        Config::set('mail.from', [
            'address' => Config::get('facilitador.core.mail_from_address'),
            'name' => Config::get('facilitador.core.mail_from_name'),
        ]);

        // Config Former
        $this->configureFormer();

        // Delegate events to Decoy observers
        $this->delegateAdminObservers();

        // Use Boostrap 3 classes in Laravel 5.6
        if (method_exists(Paginator::class, 'useBootstrapThree')) {
            Paginator::useBootstrapThree();
        }
    }

    /**
     * Boot Decoy's auth integration
     *
     * @return void
     */
    public function bootAuth()
    {
        // Inject Decoy's auth config
        Config::set('auth.guards.facilitador', [
            'driver'   => 'session',
            'provider' => 'facilitador',
        ]);

        Config::set('auth.providers.facilitador', [
            'driver' => 'eloquent',
            'model'  => \Facilitador\Models\Decoy\Admin::class,
        ]);

        Config::set('auth.passwords.facilitador', [
            'provider' => 'facilitador',
            'email'    => 'facilitador::emails.reset',
            'table'    => 'password_resets',
            'expire'   => 60,
        ]);

        // Point to the Gate policy
        $this->app[Gate::class]->define('facilitador.auth', config('facilitador.core.policy'));
    }

    /**
     * Config Former
     *
     * @return void
     */
    protected function configureFormer()
    {
        // Use Bootstrap 3
        Config::set('former.framework', 'TwitterBootstrap3');

        // Reduce the horizontal form's label width
        Config::set('former.TwitterBootstrap3.labelWidths', []);

        // Change Former's required field HTML
        Config::set('former.required_text', ' <span class="glyphicon glyphicon-exclamation-sign js-tooltip required" title="' .
            __('facilitador::login.form.required') . '"></span>');

        // Make pushed checkboxes have an empty string as their value
        Config::set('former.unchecked_value', '');

        // Add Decoy's custom Fields to Former so they can be invoked using the "Former::"
        // namespace and so we can take advantage of sublassing Former's Field class.
        $this->app['former.dispatcher']->addRepository('Facilitador\\Fields\\');
    }

    /**
     * Delegate events to Decoy observers
     *
     * @return void
     */
    protected function delegateAdminObservers()
    {
        $this->app['events']->listen('eloquent.saving:*',
            '\Facilitador\Observers\Localize');
        $this->app['events']->listen('eloquent.saving:*',
            '\Facilitador\Observers\Encoding@onSaving');
        $this->app['events']->listen('eloquent.saved:*',
            '\Facilitador\Observers\ManyToManyChecklist');
        $this->app['events']->listen('eloquent.deleted:*',
            '\Facilitador\Observers\Encoding@onDeleted');
        $this->app['events']->listen('facilitador::model.validating:*',
            '\Facilitador\Observers\ValidateExistingFiles@onValidating');
    }

    /**
     * Register middlewares
     *
     * @return void
     */
    protected function registerMiddlewares()
    {

        // Register middleware individually
        foreach ([
            'facilitador.auth'          => \Facilitador\Http\Middleware\Auth::class,
            'facilitador.edit-redirect' => \Facilitador\Http\Middleware\EditRedirect::class,
            'facilitador.guest'         => \Facilitador\Http\Middleware\Guest::class,
            'facilitador.save-redirect' => \Facilitador\Http\Middleware\SaveRedirect::class,
        ] as $key => $class) {
            $this->app['router']->aliasMiddleware($key, $class);
        }

        // This group is used by public facilitador routes
        $this->app['router']->middlewareGroup('facilitador.public', [
            'web',
        ]);

        // The is the starndard auth protected group
        $this->app['router']->middlewareGroup('facilitador.protected', [
            'web',
            'facilitador.auth',
            'facilitador.save-redirect',
            'facilitador.edit-redirect',
        ]);

        // Require a logged in admin session but no CSRF token
        $this->app['router']->middlewareGroup('facilitador.protected_endpoint', [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            'facilitador.auth',
        ]);

        // An open endpoint, like used by Zendcoder
        $this->app['router']->middlewareGroup('facilitador.endpoint', [
            'api'
        ]);
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'facilitador',
            'facilitador.acl_fail',
            'facilitador.breadcrumbs',
            'facilitador.elements',
            'facilitador.router',
            'facilitador.url',
            'facilitador.user',
            'facilitador.wildcard',
        ];
    }

    /**
     * Register configs, migrations, etc
     *
     * @return void
     */
    public function registerDirectories()
    {
        // Publish config files
        $this->publishes([
            // Paths
            $this->getPublishesPath('config/facilitador') => config_path('facilitador'),
            // Files
            $this->getPublishesPath('config/crudmaker.php') => config_path('crudmaker.php'),
            $this->getPublishesPath('config/eloquentfilter.php') => config_path('eloquentfilter.php'),
            $this->getPublishesPath('config/form-maker.php') => config_path('form-maker.php'),
            $this->getPublishesPath('config/gravatar.php') => config_path('gravatar.php')
        ], 'config');

        // Publish facilitador css and js to public directory
        $this->publishes([
            $this->getDistPath('facilitador') => public_path('assets/facilitador')
        ], 'assets');


        $this->loadViews();
        $this->loadTranslations();

    }

    private function loadViews()
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'facilitador');
        $this->publishes([
            $viewsPath => base_path('resources/views/vendor/facilitador'),
        ], 'views');


        // Publish lanaguage files
        $this->publishes([
            $this->getResourcesPath('lang') => resource_path('lang/vendor/facilitador')
        ], 'lang');

        // Load translations
        $this->loadTranslationsFrom($this->getResourcesPath('lang'), 'facilitador');
    }
    
    private function loadTranslations()
    {
        $translationsPath = $this->getResourcesPath('lang');
        $this->loadTranslationsFrom($translationsPath, 'facilitador');
        $this->publishes([
            $translationsPath => resource_path('lang/vendor/facilitador'),
        ], 'translations');// @todo ou lang, verificar (invez de translations)
    }

    /**
     * Configs Paths
     */
    private function getResourcesPath($folder)
    {
        return __DIR__.'/../resources/'.$folder;
    }

    private function getPublishesPath($folder)
    {
        return __DIR__.'/../publishes/'.$folder;
    }

    private function getDistPath($folder)
    {
        return __DIR__.'/../dist/'.$folder;
    }

    /**
     * Load Alias and Providers
     */
    private function setProviders()
    {
        $this->setDependencesAlias();
        (new Collection(self::$providers))->map(function ($provider) {
            $this->app->register($provider);
        });
    }
    private function setDependencesAlias()
    {
        $loader = AliasLoader::getInstance();
        (new Collection(self::$aliasProviders))->map(function ($class, $alias) use ($loader) {
            $loader->alias($alias, $class);
        });
    }
}
