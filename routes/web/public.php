<?php

use Illuminate\Support\Str;
use Support\Events\Routing;
use Support\Events\RoutingAdmin;
use Support\Events\RoutingAdminAfter;
use Support\Events\RoutingAfter;
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


        /*
        |--------------------------------------------------------------------------
        | Public Assets
        |--------------------------------------------------------------------------
        */

        Route::get('public-preview/{encFileName}', 'AssetController@asPreview');
        Route::get('public-asset/{encFileName}', 'AssetController@asPublic');
        Route::get('public-download/{encFileName}/{encRealFileName}', 'AssetController@asDownload');
        Route::get('asset/{path}/{contentType}', 'AssetController@asset');
        Route::group(['prefix' => 'sitec'], function () {
            Route::get('asset/{path}/{contentType}', 'AssetController@asset');
        });


        Route::namespace('NoRestrict')->group(
            function () {

                // Route::group(['middleware' => 'admin.user'], function () {

                //Asset Routes
                Route::get('facilitador-assets', ['uses' => 'SitecFeatureController@assets', 'as' => 'facilitador_assets']);

            }
        );
    }
);
