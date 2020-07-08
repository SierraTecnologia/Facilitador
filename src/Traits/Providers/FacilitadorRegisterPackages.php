<?php

namespace Facilitador\Traits\Providers;

use Illuminate\Support\ServiceProvider;
use Log;
use App;
use Config;




use Laravel\Dusk\DuskServiceProvider;
use Muleta\Traits\Providers\ConsoleTools;




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
        \Population\PopulationProvider::class,
        \Tracking\TrackingProvider::class,
        

        /**
         * Base
         */
        \RicardoSierra\Translation\TranslationServiceProvider::class,
        \Locaravel\LocaravelProvider::class,
        \Gamer\GamerProvider::class,
        
        /**
         * Serviços
         */
        \Cmgmyr\Messenger\MessengerServiceProvider::class,
        
        /*
         * Dependencias
         */
        /**
         * Layoults
         */
        \JeroenNoten\LaravelAdminLte\ServiceProvider::class,


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
