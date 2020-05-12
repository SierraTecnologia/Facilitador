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
            

Route::group(['as' => 'facilitador.'], function () {
    event(new Routing());

    Route::namespace('Auth')->group(function () {
        Route::get('login', ['uses' => 'FacilitadorAuthController@login',     'as' => 'login']);
        Route::post('login', ['uses' => 'FacilitadorAuthController@postLogin', 'as' => 'postlogin']);
    });

    Route::namespace('User')->group(function () {
        Route::group(['middleware' => 'admin.user'], function () {
            event(new RoutingAdmin());

            // Main Admin and Logout Route
            Route::get('/', ['uses' => 'FacilitadorController@index',   'as' => 'dashboard']);
            Route::post('logout', ['uses' => 'FacilitadorController@logout',  'as' => 'logout']);
            Route::post('upload', ['uses' => 'FacilitadorController@upload',  'as' => 'upload']);

            Route::get('profile', ['uses' => 'FacilitadorUserController@profile', 'as' => 'profile']);

            event(new RoutingAdminAfter());
        });

        //Asset Routes
        Route::get('facilitador-assets', ['uses' => 'FacilitadorController@assets', 'as' => 'facilitador_assets']);

        event(new RoutingAfter());
    });
});
