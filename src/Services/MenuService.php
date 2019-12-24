<?php

namespace Facilitador\Services;

class MenuService
{

    public static function getAdminMenu()
    {
        
        $facilitador = [];
        $facilitador[] = [
            'text'        => 'Manager',
            'url'         => route('facilitador.dash'),
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];
        
        /**
         * Audits
         */
        $facilitador[] = [
            'text'    => 'Audits',
            'icon'    => 'cog',
            'nivel' => \App\Models\Role::$GOOD,
            'submenu' => \Audit\Services\MenuService::getAdminMenu(),
        ];
        /**
         * Tracking
         */
        $facilitador[] = [
            'text'    => 'Trackings',
            'icon'    => 'cog',
            'nivel' => \App\Models\Role::$GOOD,
            'submenu' => \Tracking\Services\MenuService::getAdminMenu(),
        ];

        return $facilitador;
    }

    public static function getDecoyMenu()
    {
        
        $decoy = [];
        $decoy[] = [
            'text'        => 'Decoy',
            'url'         => 'admin',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];

        return $decoy;
    }
    
    public static function getVoyagerMenu()
    {
        
        $voyager = [];
        $voyager[] = [
            'text'        => 'Tools',
            'url'         => 'voyager/hooks',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];
        $voyager[] = [
            'text'        => 'hooks',
            'url'         => 'voyager/hooks',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];
        $voyager[] = [
            'text'        => 'bread',
            'url'         => 'voyager/bread',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];
        $voyager[] = [
            'text'        => 'Database',
            'url'         => 'voyager/database',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];
        $voyager[] = [
            'text'        => 'settings',
            'url'         => 'voyager/settings',
            'icon'        => 'dashboard',
            'icon_color'  => 'blue',
            'label_color' => 'success',
            // 'access' => \App\Models\Role::$ADMIN
        ];

        return $voyager;
    }
}
