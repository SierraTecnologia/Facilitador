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
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/discover.php'), 'sitec.discover');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/generator.php'), 'sitec.generator');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/facilitador.php'), 'sitec.facilitador');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/site.php'), 'sitec.site');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/core.php'), 'sitec.core');
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/encode.php'), 'sitec.encode');
        // @todo Remover mais pra frente esse aqui
        $this->mergeConfigFrom($this->getPublishesPath('config/sitec/attributes.php'), 'sitec.attributes');
        
        $this->mergeConfigFrom($this->getPublishesPath('config/crudmaker.php'), 'crudmaker');
        $this->mergeConfigFrom($this->getPublishesPath('config/debug-server.php'), 'debug-server');
        $this->mergeConfigFrom($this->getPublishesPath('config/debugbar.php'), 'debugbar');
        $this->mergeConfigFrom($this->getPublishesPath('config/eloquentfilter.php'), 'eloquentfilter');
        $this->mergeConfigFrom($this->getPublishesPath('config/excel.php'), 'excel');
        $this->mergeConfigFrom($this->getPublishesPath('config/form-maker.php'), 'form-maker');
        $this->mergeConfigFrom($this->getPublishesPath('config/gravatar.php'), 'gravatar');
        $this->mergeConfigFrom($this->getPublishesPath('config/tinker.php'), 'tinker');
        // $this->mergeConfigFrom($this->getPublishesPath('config/facilitador-hooks.php'), 'facilitador-hooks');
        // $this->mergeConfigFrom($this->getPublishesPath('config/facilitador.php'), 'facilitador');
    }
}
