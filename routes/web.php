<?php

use Illuminate\Support\Str;
use Support\Events\Routing;
use Support\Events\RoutingAdmin;
use Support\Events\RoutingAdminAfter;
use Support\Events\RoutingAfter;
use Facilitador\Facades\Facilitador;

// Public routes
Route::group(
    [
    'middleware' => 'web',
    ], function () {
        $loadingRoutes = [
        'public',
        'auth',
        'user',
        ];
        event(new Routing());
        foreach ($loadingRoutes as $loadingRoute) {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . $loadingRoute.".php";
        }
        event(new RoutingAfter());
    }
);    

// RiCa routes
Route::group(
    [
    'prefix' => \Illuminate\Support\Facades\Config::get('application.routes.main', 'admin'),
    'middleware' => 'web',
    ], function () {
        $loadingRoutes = [
        'manager',
        'voyager'
        ];
        event(new Routing());
        foreach ($loadingRoutes as $loadingRoute) {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . $loadingRoute.".php";
        }
        event(new RoutingAfter());
    }
);    