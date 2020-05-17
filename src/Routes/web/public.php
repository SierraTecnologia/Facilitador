<?php

use Illuminate\Support\Str;
use Facilitador\Events\Routing;
use Facilitador\Events\RoutingAdmin;
use Facilitador\Events\RoutingAdminAfter;
use Facilitador\Events\RoutingAfter;
use Facilitador\Facades\Facilitador;

// Route::group(['prefix' => 'facilitador'], function () {
//     Facilitador::routes();
// });

/*
|--------------------------------------------------------------------------
| Facilitador Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Facilitador.
|
*/
            

Route::group(
    ['as' => 'facilitador.'], function () {
        Route::namespace('NoRestrict')->group(
            function () {
                // Route::group(['middleware' => 'admin.user'], function () {

                //Asset Routes
                Route::get('facilitador-assets', ['uses' => 'SitecFeatureController@assets', 'as' => 'facilitador_assets']);

            }
        );
    }
);
