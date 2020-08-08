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
        ];
        event(new Routing());
        foreach ($loadingRoutes as $loadingRoute) {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "public". DIRECTORY_SEPARATOR . $loadingRoute.".php";
        }
        event(new RoutingAfter());
    }
);    