<?php

namespace Facilitador\Traits\Providers;

use Muleta\Traits\Providers\ConsoleTools;

trait FacilitadorRegisterPublishes
{
    use ConsoleTools;

       
    /****************************************************************************************************
     * ************************************************* NO BOOT *************************************
     ****************************************************************************************************/


    protected function publishMigrations(): void
    {
        
       
    }
       
    protected function publishAssets(): void
    {
        
        // Publish facilitador css and js to public directory
        $this->publishes(
            [
            $this->getDistPath('facilitador') => public_path('assets/facilitador')
            ], ['public',  'sitec', 'sitec-public']
        );

    }

    protected function publishConfigs(): void
    {
        
        // Publish config files
        $this->publishes(
            [
            // Paths
            $this->getPublishesPath('config/application') => config_path('application'),
            $this->getPublishesPath('config/painel') => config_path('painel'),
            $this->getPublishesPath('config/site') => config_path('site'),
            // Files
            $this->getPublishesPath('config/gravatar.php') => config_path('gravatar.php'),
            $this->getPublishesPath('config/facilitador-hooks.php') => config_path('facilitador-hooks.php'),
            $this->getPublishesPath('config/facilitador.php') => config_path('facilitador.php')
            ], ['config',  'sitec', 'sitec-config']
        );

    }
    /****************************************************************************************************
     ************************************************** NO REGISTER *************************************
     ****************************************************************************************************/



}
