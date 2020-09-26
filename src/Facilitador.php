<?php

namespace Facilitador;

use App\Models\User;
use Arrilot\Widgets\Facade as Widget;
use Bkwld\Library;
use Config;
use Crypto;
use Facilitador\Models\Menu;
use Facilitador\Models\MenuItem;
use Facilitador\Models\Permission;
use Facilitador\Models\Role;
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
use Support\Events\AlertsCollection;
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
    protected Filesystem $filesystem;

    protected $alerts = [];
    protected bool $alertsCollected = false;

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

    /**
     * @var array[]|null
     *
     * @psalm-var array<string, array<string, mixed>>|null
     */
    public ?array $setting_cache = null;

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

    public function model(string $name)
    {
        return app($this->models[Str::studly($name)]);
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
     * Is Decoy handling the request?  Check if the current path is exactly "admin" or if
     * it contains admin/*
     *
     * @return boolean
     *
     * @var bool|int|null
     */
    private $is_handling;

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
     * @return string
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


}
