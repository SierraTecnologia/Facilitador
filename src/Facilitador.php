<?php

namespace Facilitador;

use App\Models\User;
use Arrilot\Widgets\Facade as Widget;
use Muleta\Library;
use Config;
use Crypto;
use Siravel\Models\Negocios\Menu;
use Siravel\Models\Negocios\MenuItem;
use Facilitador\Models\Permission;
use Porteiro\Models\Role;
use Facilitador\Models\Setting;
use Facilitador\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ReflectionClass;
use Request;
use Session;
use Siravel\Models\Blog\Category;
use Siravel\Models\Blog\Post;
use Siravel\Models\Negocios\Page;
use Support;
use Pedreiro\Elements\FormFields\After\HandlerInterface as AfterHandlerInterface;
use Pedreiro\Elements\FormFields\HandlerInterface;
use Pedreiro\Events\AlertsCollection;
use Support\Models\Application\DataRelationship;
use Support\Models\Application\DataRow;
use Support\Models\Application\DataType;
use Pedreiro\Template\Actions\DeleteAction;
use Pedreiro\Template\Actions\EditAction;
use Pedreiro\Template\Actions\RestoreAction;
use Pedreiro\Template\Actions\ViewAction;
use Translation\Traits\HasTranslations;
use View;

class Facilitador
{
    protected $version;
    protected $filesystem;

    protected $alerts = [];
    protected $alertsCollected = false;

    protected $formFields = [];
    protected $afterFormFields = [];

    protected $viewLoadingEvents = [];

    protected $actions = [
        DeleteAction::class,
        RestoreAction::class,
        EditAction::class,
        ViewAction::class,
    ];

    /**
     * Caso selecionado, modelos craidos que podem se relacionar com ele serão ligados
     */
    protected $influenciaModel = false;

    protected $models = [
        'Category'          => Category::class,
        'DataRow'           => DataRow::class,
        'DataRelationship'  => DataRelationship::class,
        'DataType'          => DataType::class,
        'Menu'              => Menu::class,
        'MenuItem'          => MenuItem::class,
        'Page'              => Page::class,
        'Permission'        => Permission::class,
        'Post'              => Post::class,
        'Role'              => Role::class,
        'Setting'           => Setting::class,
        'User'              => User::class,
        'Translation'       => Translation::class,
    ];

    public $setting_cache = null;

    /**
     * The current locale, cached in memory
     *
     * @var string
     */
    private $locale;

    public function __construct()
    {
        $this->filesystem = app(Filesystem::class);

        $this->findVersion();
    }

    /**
     * @param string $name
     */
    public function model(string $name)
    {
        return app($this->models[Str::studly($name)]);
    }

    public function modelClass($name)
    {
        return $this->models[$name];
    }

    /**
     * @return static
     */
    public function useModel($name, $object): self
    {
        if (is_string($object)) {
            $object = app($object);
        }

        $class = get_class($object);

        if (isset($this->models[Str::studly($name)]) && !$object instanceof $this->models[Str::studly($name)]) {
            throw new \Exception("[{$class}] must be instance of [{$this->models[Str::studly($name)]}].");
        }

        $this->models[Str::studly($name)] = $class;

        return $this;
    }

    public function view($name, array $parameters = [])
    {
        foreach (Arr::get($this->viewLoadingEvents, $name, []) as $event) {
            $event($name, $parameters);
        }


        $layout = View::make(\Illuminate\Support\Facades\Config::get('painel.core.layout', 'pedreiro::layouts.adminlte.master'));

        $requestUrl = str_replace(['https://', 'http://'], '', Request::url());
        $requestUrl = explode('/', str_replace(route('rica.dashboard'), '', $requestUrl));
        array_shift($requestUrl);
        $layout->segments = array_filter($requestUrl);
        $layout->url = route('rica.dashboard');


        // The view
        if (is_string($name)) {
            $layout->content = View::make($name);
        } else {
            $layout->content = $name;
        }

        // Set vars
        $layout->title = $this->title();
        $layout->description = $this->description();
        // View::share('controller', $this->controller);

        // Make sure that the content is a Laravel view before applying vars.
        // to it.  In the case of the index view, `content` is a Fields\Listing
        // instance, not a Laravel view
        if (is_a($layout->content, 'Illuminate\View\View')) {
            $layout->content->with($parameters);
        }

        // Return the layout View
        return $layout;

        // return view($name, $parameters);
    }

    public function onLoadingView($name, \Closure $closure): void
    {
        if (!isset($this->viewLoadingEvents[$name])) {
            $this->viewLoadingEvents[$name] = [];
        }

        $this->viewLoadingEvents[$name][] = $closure;
    }

    public function formField($row, $dataType, $dataTypeContent)
    {
        return \Support::formField($row, $dataType, $dataTypeContent);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function afterFormFields($row, $dataType, $dataTypeContent): self
    {
        return collect($this->afterFormFields)->filter(
            function ($after) use ($row, $dataType, $dataTypeContent) {
                return $after->visible($row, $dataType, $dataTypeContent, $row->details);
            }
        );
    }

    /**
     * @return static
     */
    public function addFormField($handler): self
    {
        if (!$handler instanceof HandlerInterface) {
            $handler = app($handler);
        }

        $this->formFields[$handler->getCodename()] = $handler;

        return $this;
    }

    /**
     * @return static
     */
    public function addAfterFormField($handler): self
    {
        if (!$handler instanceof AfterHandlerInterface) {
            $handler = app($handler);
        }

        $this->afterFormFields[$handler->getCodename()] = $handler;

        return $this;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function formFields(): self
    {
        $connection = \Illuminate\Support\Facades\Config::get('database.default');
        $driver = \Illuminate\Support\Facades\Config::get("database.connections.{$connection}.driver", 'mysql');

        return collect($this->formFields)->filter(
            function ($after) use ($driver) {
                return $after->supports($driver);
            }
        );
    }

    public function addAction($action): void
    {
        array_push($this->actions, $action);
    }

    public function replaceAction($actionToReplace, $action): void
    {
        $key = array_search($actionToReplace, $this->actions);
        $this->actions[$key] = $action;
    }

    public function actions()
    {
        return $this->actions;
    }

    /**
     * Get a collection of the dashboard widgets.
     *
     * @return \Arrilot\Widgets\WidgetGroup
     */
    public function dimmers()
    {
        $widgetClasses = \Illuminate\Support\Facades\Config::get('sitec.rica.dashboard.widgets');
        $dimmers = Widget::group('facilitador::dimmers');

        foreach ($widgetClasses as $widgetClass) {
            $widget = app($widgetClass);

            if ($widget->shouldBeDisplayed()) {
                $dimmers->addWidget($widgetClass);
            }
        }

        return $dimmers;
    }

    public function setting($key, $default = null)
    {
        $globalCache = \Illuminate\Support\Facades\Config::get('sitec.facilitador.settings.cache', false);

        if ($globalCache && Cache::tags('settings')->has($key)) {
            return Cache::tags('settings')->get($key);
        }

        if ($this->setting_cache === null) {
            if ($globalCache) {
                // A key is requested that is not in the cache
                // this is a good opportunity to update all keys
                // albeit not strictly necessary
                Cache::tags('settings')->flush();
            }

            foreach (self::model('Setting')->all() as $setting) {
                $keys = explode('.', $setting->key);
                @$this->setting_cache[$keys[0]][$keys[1]] = $setting->value;

                if ($globalCache) {
                    Cache::tags('settings')->forever($setting->key, $setting->value);
                }
            }
        }

        $parts = explode('.', $key);

        if (count($parts) == 2) {
            return @$this->setting_cache[$parts[0]][$parts[1]] ?: $default;
        } else {
            return @$this->setting_cache[$parts[0]] ?: $default;
        }
    }

    public function image($file, $default = '')
    {
        if (!empty($file)) {
            return str_replace('\\', '/', Storage::disk(\Illuminate\Support\Facades\Config::get('sitec.facilitador.storage.disk'))->url($file));
        }

        return $default;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function addAlert(Alert $alert): void
    {
        $this->alerts[] = $alert;
    }

    public function alerts()
    {
        if (!$this->alertsCollected) {
            event(new AlertsCollection($this->alerts));

            $this->alertsCollected = true;
        }

        return $this->alerts;
    }

    /**
     * @return void
     */
    protected function findVersion()
    {
        if (!is_null($this->version)) {
            return;
        }

        if ($this->filesystem->exists(base_path('composer.lock'))) {
            // Get the composer.lock file
            $file = json_decode(
                $this->filesystem->get(base_path('composer.lock'))
            );

            // Loop through all the packages and get the version of facilitador
            foreach ($file->packages as $package) {
                if ($package->name == 'sierratecnologia/facilitador') {
                    $this->version = $package->version;
                    break;
                }
            }
        }
    }

    /**
     * @param string|Model|Collection $model
     *
     * @return bool
     */
    public function translatable($model)
    {
        if (!\Illuminate\Support\Facades\Config::get('sitec.facilitador.multilingual.enabled')) {
            return false;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof Collection) {
            $model = $model->first();
        }

        if (!is_subclass_of($model, Model::class)) {
            return false;
        }

        $traits = class_uses_recursive(get_class($model));

        return in_array(Translatable::class, $traits);
    }

    public function getLocales(): array
    {
        return array_diff(scandir(realpath(__DIR__.'/../publishes/lang')), ['..', '.']);
    }




    /**
     * veio do decoy
     */

    /**
     * Generate title tags based on section content
     *
     * @return string
     */
    public function title()
    {
        return Support::title();
    }
    public function description()
    {
        return Support::description();
    }

    /**
     * Get the site name
     *
     * @return string
     */
    public function site()
    {
        $site = Config::get('sitec.site.name');
        if (is_callable($site)) {
            $site = call_user_func($site);
        }

        return $site;
    }

    /**
     * Add the controller and action as CSS classes on the body tag
     *
     * @return string
     */
    public function bodyClass(): string
    {
        $path = Request::path();
        $classes = [];

        // Special condition for the elements
        if (strpos($path, '/elements/field/') !== false) {
            return 'elements field';
        }

        // Special condition for the reset page, which passes the token in as part of the route
        if (strpos($path, '/reset/') !== false) {
            return 'login reset';
        }

        // Tab-sidebar views support deep links that would normally affect the
        // class of the page.
        if (strpos($path, '/elements/') !== false) {
            return 'elements index';
        }

        // Get the controller and action from the URL
        preg_match('#/([a-z-]+)(?:/\d+)?(?:/(create|edit))?$#i', $path, $matches);
        $controller = empty($matches[1]) ? 'login' : $matches[1];
        $action = empty($matches[2]) ? 'index' : $matches[2];
        array_push($classes, $controller, $action);

        // Add the admin roles
        if ($admin = app('facilitador.user')) {
            $classes[] = 'role-'.$admin->role;
        }

        // Return the list of classes
        return implode(' ', $classes);
    }

    /**
     * Convert a key named with array syntax (i.e 'types[marquee][video]') to one
     * named with dot syntax (i.e. 'types.marquee.video]').  The latter is how fields
     * will be stored in the db
     *
     * @param  string $attribute
     * @return string
     */
    public function convertToDotSyntax($key)
    {
        return str_replace(['[', ']'], ['.', ''], $key);
    }

    /**
     * Do the reverse of convertKeyToDotSyntax()
     *
     * @param  string $attribute
     * @return string
     */
    public function convertToArraySyntax($key)
    {
        if (strpos($key, '.') === false) {
            return $key;
        }
        $key = str_replace('.', '][', $key);
        $key = preg_replace('#\]#', '', $key, 1);

        return $key.']';
    }


    /**
     * Is Decoy handling the request?  Check if the current path is exactly "admin" or if
     * it contains admin/*
     *
     * @return boolean
     */
    private $is_handling;

    public function handling()
    {
        if (!is_null($this->is_handling)) {
            return $this->is_handling;
        }
        if (env('DECOY_TESTING')) {
            return true;
        }
        $this->is_handling = preg_match('#^'.Config::get('application.routes.main').'($|/)'.'#i', Request::path());

        return $this->is_handling;
    }

    /**
     * Force Decoy to believe that it's handling or not handling the request
     *
     * @param  boolean $bool
     * @return void
     */
    public function forceHandling($bool)
    {
        $this->is_handling = $bool;
    }

    /**
     * Set or return the current locale.  Default to the first key from
     * `facilitador::site.locale`.
     *
     * @param  string $locale A key from the `facilitador::site.locale` array
     * @return string
     */
    public function locale($locale = null)
    {
        // Set the locale if a valid local is passed
        if ($locale
            && ($locales = Config::get('sitec.site.locales'))
            && is_array($locales)
            && isset($locales[$locale])
        ) {
            return Session::put('locale', $locale);
        }

        // Return the current locale or default to first one.  Store it in a local var
        // so that multiple calls don't have to do any complicated work.  We're assuming
        // the locale won't change within a single request.
        if (!$this->locale) {
            $this->locale = Session::get('locale', $this->defaultLocale());
        }

        return $this->locale;
    }

    /**
     * Get the default locale, aka, the first locales array key
     *
     * @return string
     */
    public function defaultLocale()
    {
        if (($locales = Config::get('sitec.site.locales'))
            && is_array($locales)
        ) {
            reset($locales);

            return key($locales);
        }
    }

    /**
     * Get the model class string from a controller class string
     *
     * @param  string $controller ex: "App\Http\Controllers\Admin\People"
     * @return string ex: "App\Person"
     */
    public function modelForController($controller)
    {
        // Swap out the namespace if facilitador
        $model = str_replace(
            'Facilitador\Http\Controllers\Admin',
            'Facilitador\Models',
            $controller,
            $is_facilitador
        );
        $model = str_replace(
            'Support\Http\Controllers\Admin',
            'Support\Models',
            $model,
            $is_support
        );

        // Replace non-facilitador controller's with the standard model namespace
        if (!$is_facilitador || !$is_support) {
            $namespace = ucfirst(Config::get('application.routes.main'));
            $model = str_replace('App\Http\Controllers\\'.$namespace.'\\', 'App\\', $model);
        }

        // Make it singular
        $offset = strrpos($model, '\\') + 1;
        return substr($model, 0, $offset).Str::singular(substr($model, $offset));
    }

    /**
     * Get the controller class string from a model class string
     *
     * @param  string $controller ex: "App\Person"
     * @return string ex: "App\Http\Controllers\Admin\People"
     */
    public function controllerForModel($model)
    {
        // Swap out the namespace if facilitador
        $controller = str_replace('Facilitador\Models', 'Facilitador\Http\Controllers\Admin', $model, $is_facilitador);

        // Replace non-facilitador controller's with the standard model namespace
        if (!$is_facilitador) {
            // $namespace = ucfirst(Config::get('application.routes.main'));
            // $controller = str_replace('App\\', 'App\Http\Controllers\\'.$namespace.'\\', $controller);
            $controller = str_replace('App\Models\\', 'App\Http\Controllers\Admin\\', $controller);
        }

        // Make it plural
        $offset = strrpos($controller, '\\') + 1;
        return substr($controller, 0, $offset).Str::plural(substr($controller, $offset));
    }

    /**
     * Get the belongsTo relationship name given a model class name
     *
     * @param  string $model "App\SuperMan"
     * @return string "superMan"
     */
    public function belongsToName($model)
    {
        $reflection = new ReflectionClass($model);

        return lcfirst($reflection->getShortName());
    }

    /**
     * Get the belongsTo relationship name given a model class name
     *
     * @param  string $model "App\SuperMan"
     * @return string "superMen"
     */
    public function hasManyName($model)
    {
        return Str::plural($this->belongsToName($model));
    }

    /**
     * Get all input but filter out empty file fields. This prevents empty file
     * fields from overriding existing files on a model. Using this assumes that
     * we are filling a model and then validating the model attributes.
     *
     * @return array
     */
    public function filteredInput()
    {
        $files = $this->arrayFilterRecursive(Request::file());
        $input = array_replace_recursive(Request::input(), $files);

        return Library\Utils\Collection::nullEmpties($input);
    }

    /**
     * Run array_filter recursively on an array
     *
     * @link http://stackoverflow.com/a/6795671
     *
     * @param  array $array
     * @return array
     */
    protected function arrayFilterRecursive($array)
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = $this->arrayFilterRecursive($value);
            }
        }

        return array_filter($array);
    }


    /**
     * Get a module's asset
     *
     * @param string $module      Module name
     * @param string $path        Path to module asset
     * @param string $contentType Asset type
     *
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function asset($path, $contentType = 'null', $fullURL = true)
    {
        if (!$fullURL) {
            return base_path(__DIR__.'/../Assets/'.$path);
        }

        return url('/asset/'.Crypto::urlEncode($path).'/'.Crypto::urlEncode($contentType));
        // return url($this->backendRoute.'/asset/'.Crypto::url_encode($path).'/'.Crypto::url_encode($contentType));
    }


    /**
     * Set Influencia
     *
     * @return void
     */
    public function setInfluencia($influencia = false): void
    {
        $this->influenciaModel = $influencia;
    }
    public function getInfluencia()
    {
        return $this->influenciaModel;
    }
    public function emptyInfluencia(): void
    {
        $this->setInfluencia();
    }
}
