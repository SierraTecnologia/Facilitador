<?php

use Facilitador\Facades\Facilitador;
use Illuminate\Support\Str;
use Pedreiro\Events\Routing;
use Pedreiro\Events\RoutingAdmin;
use Pedreiro\Events\RoutingAdminAfter;
use Pedreiro\Events\RoutingAfter;

// Public routes
Route::group(
    [
    'middleware' => 'web',
    ], function () {
        $loadingRoutes = [
        'public',
        ];
        event(new Routing());
        foreach ($loadingRoutes as $loadingRoute) {
            include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . $loadingRoute.".php";
        }
        event(new RoutingAfter());
    }
);
