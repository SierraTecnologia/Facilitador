<?php

namespace Facilitador\Traits\Providers;

use Support\Helpers\Traits\Models\ConsoleTools;

trait FacilitadorRegisterPublishes
{
    use ConsoleTools;

       
    /****************************************************************************************************
     ************************************************** NO BOOT *************************************
     ****************************************************************************************************/


    protected function publishMigrations()
    {
        
       
    }
       
    protected function publishAssets()
    {
        
        // Publish facilitador css and js to public directory
        $this->publishes([
            $this->getDistPath('facilitador') => public_path('assets/facilitador')
        ], ['public',  'sitec', 'sitec-public']);

    }

    protected function publishConfigs()
    {
        
        // Publish config files
        $this->publishes([
            // Paths
            $this->getPublishesPath('config/sitec') => config_path('sitec'),
            // Files
            $this->getPublishesPath('config/crudmaker.php') => config_path('crudmaker.php'),
            $this->getPublishesPath('config/debug-server.php') => config_path('debug-server.php'),
            $this->getPublishesPath('config/debugbar.php') => config_path('debugbar.php'),
            $this->getPublishesPath('config/eloquentfilter.php') => config_path('eloquentfilter.php'),
            $this->getPublishesPath('config/excel.php') => config_path('excel.php'),
            $this->getPublishesPath('config/form-maker.php') => config_path('form-maker.php'),
            $this->getPublishesPath('config/gravatar.php') => config_path('gravatar.php'),
            $this->getPublishesPath('config/tinker.php') => config_path('tinker.php'),
            $this->getPublishesPath('config/facilitador-hooks.php') => config_path('facilitador-hooks.php'),
            $this->getPublishesPath('config/facilitador.php') => config_path('facilitador.php')
        ], ['config',  'sitec', 'sitec-config']);

    }
    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/



}
