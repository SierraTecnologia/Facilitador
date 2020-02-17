<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use App;
use Config;





use Barryvdh\Debugbar\ServiceProvider as DebugService;
use Laravel\Dusk\DuskServiceProvider;
use Support\ClassesHelpers\Traits\Models\ConsoleTools;




trait FacilitadorRegisterPackages
{
    use ConsoleTools;

    public static $aliasProviders = [
        'TranslationCache' => \RicardoSierra\Translation\Facades\TranslationCache::class,
        'Translation' => \RicardoSierra\Translation\Facades\Translation::class,

        /**
         * Decoy
         */
        'Facilitador' => \Facilitador\Facades\Facilitador::class,
        'FacilitadorURL' => \Facilitador\Facades\FacilitadorURL::class,
        // Form field generation
        'Former' => \Former\Facades\Former::class,
        // Image resizing
        'Croppa' => \Bkwld\Croppa\Facade::class,
        // BrowserDetect
        'Agent' => \Jenssegers\Agent\Facades\Agent::class,
    ];

    // public static $providers = [
    public static $providers = [
        /**
         * Internos
         */
        \Tracking\TrackingProvider::class,
        
        /**
         * Externos
         */
        \Facilitador\Providers\FormMakerProvider::class,
        // \Facilitador\Providers\ExtendedBreadFormFieldsServiceProvider::class,
        // \Facilitador\Providers\FieldServiceProvider::class,
        \Facilitador\Providers\GravatarServiceProvider::class,
        

        /**
         * Base
         */
        \RicardoSierra\Translation\TranslationServiceProvider::class,

        \Laravel\Tinker\TinkerProvider::class,
        /**
         * Facilitador
         **/
        \Facilitador\FacilitadorServiceProvider::class,

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

        /**
         * Services Providers
         */
        \Yajra\DataTables\DataTablesServiceProvider::class,
        
        /*
         * Dependencias
         */
        \Locaravel\LocaravelProvider::class,
        /**
         * Layoults
         */
        \JeroenNoten\LaravelAdminLte\ServiceProvider::class,
        \RicardoSierra\Minify\MinifyServiceProvider::class,
        \Collective\Html\HtmlServiceProvider::class,
        \Laracasts\Flash\FlashServiceProvider::class,
    ];

    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/




    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/


    protected function loadExternalPackages()
    {
        $this->setProviders();
    }

    protected function loadLocalExternalPackages()
    {

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
        if ($this->app->environment('local')) {
            $this->app->register(DebugService::class);
        }
    }

}
