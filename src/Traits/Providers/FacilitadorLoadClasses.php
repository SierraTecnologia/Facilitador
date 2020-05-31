<?php

namespace Facilitador\Traits\Providers;

use Support\Traits\Providers\ConsoleTools;

trait FacilitadorLoadClasses
{
    use ConsoleTools;


    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/
    protected function loadViews()
    {
        // View namespace
        $viewsPath = $this->getResourcesPath('views');
        $this->loadViewsFrom($viewsPath, 'facilitador');
        $this->publishes(
            [
            $viewsPath => base_path('resources/views/vendor/facilitador'),
            ], ['views',  'sitec', 'sitec-views']
        );
        
        // Publish tracking css and js to public directory
        $this->publishes(
            [
            $this->getPublishesPath('public/adminlte') => public_path('vendor/adminlte')
            ], ['public',  'sitec', 'sitec-public']
        );

    }
    
    protected function loadTranslations()
    {
        // Publish lanaguage files
        $this->publishes(
            [
            $this->getResourcesPath('lang') => resource_path('lang/vendor/facilitador')
            ], ['lang',  'sitec', 'sitec-lang', 'translations']
        );

        // Load translations
        $this->loadTranslationsFrom($this->getResourcesPath('lang'), 'facilitador');
    }


    /****************************************************************************************************
     * ************************************************* NO REGISTER *************************************
     ****************************************************************************************************/




    protected function loadCommands()
    {

 

        // Register commands
        $this->registerCommandFolders(
            [
            base_path('vendor/sierratecnologia/facilitador/src/Console/Commands') => '\Facilitador\Console\Commands',
            ]
        );


    }
       
    protected function loadMigrations()
    {
        // Register Migrations
        $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');
       
    }

    protected function loadConfigs()
    {
        
        // Merge own configs into user configs 
        $this->mergeConfigFrom($this->getPublishesPath('config/application/core.php'), 'application.core');
        $this->mergeConfigFrom($this->getPublishesPath('config/application/directorys.php'), 'application.directorys');
        $this->mergeConfigFrom($this->getPublishesPath('config/application/hooks.php'), 'application.hooks');
        $this->mergeConfigFrom($this->getPublishesPath('config/application/modelagem.php'), 'application.modelagem');
        $this->mergeConfigFrom($this->getPublishesPath('config/painel/core.php'), 'painel.core');
        $this->mergeConfigFrom($this->getPublishesPath('config/painel/adminer.php'), 'painel.adminer');
        $this->mergeConfigFrom($this->getPublishesPath('config/painel/elements.php'), 'painel.elements');
        $this->mergeConfigFrom($this->getPublishesPath('config/painel/layout.php'), 'painel.layout');
        $this->mergeConfigFrom($this->getPublishesPath('config/site/core.php'), 'site.core');
        // $this->mergeConfigFrom($this->getPublishesPath('config/site/elements.yaml'), 'site.elements');
        $this->mergeConfigFrom($this->getPublishesPath('config/site/layout.php'), 'site.layout');
        $this->mergeConfigFrom($this->getPublishesPath('config/site/profiles.php'), 'site.profiles');
        $this->mergeConfigFrom($this->getPublishesPath('config/site/site.php'), 'site.site');
        $this->mergeConfigFrom($this->getPublishesPath('config/gravatar.php'), 'gravatar');
        // $this->mergeConfigFrom($this->getPublishesPath('config/facilitador-hooks.php'), 'facilitador-hooks');
        // $this->mergeConfigFrom($this->getPublishesPath('config/facilitador.php'), 'facilitador');
    }
}
