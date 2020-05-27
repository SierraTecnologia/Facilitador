<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use App;
use Config;




use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Barryvdh\Debugbar\ServiceProvider as DebugService;
use Laravel\Dusk\DuskServiceProvider;
use Support\Traits\Providers\ConsoleTools;




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

        // Image resizing
        'Croppa' => \Bkwld\Croppa\Facade::class,
        // BrowserDetect
        'Agent' => \Jenssegers\Agent\Facades\Agent::class,
    ];

    // public static $providers = [
    public static $providers = [
        // /**
        //  * Support
        //  **/
        /**
         * Internos
         */
        \Support\SupportServiceProvider::class,
        \Tracking\TrackingProvider::class,
        

        /**
         * Base
         */
        \RicardoSierra\Translation\TranslationServiceProvider::class,
        
        
        /*
         * Dependencias
         */
        \Locaravel\LocaravelProvider::class,
        /**
         * Layoults
         */
        \JeroenNoten\LaravelAdminLte\ServiceProvider::class,


        /**
         * Externos
         */
        \Facilitador\Providers\FormMakerProvider::class,
        // \Facilitador\Providers\ExtendedBreadFormFieldsServiceProvider::class,
        // \Facilitador\Providers\FieldServiceProvider::class,
        \Facilitador\Providers\GravatarServiceProvider::class,

        /**
         * VEio pelo Decoy
         **/
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
         * Services Providers
         */
        \Yajra\DataTables\DataTablesServiceProvider::class,
    ];

    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/


    /****************************************************************************************************
     * ************************************************* NO REGISTER *************************************
     ****************************************************************************************************/


    protected function loadExternalPackages()
    {
        $this->setProviders();
    }



}
