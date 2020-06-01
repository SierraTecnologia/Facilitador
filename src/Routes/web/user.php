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

        Route::namespace('User')->group(
            function () {
                // Route::group(
                //     ['middleware' => 'admin.user'], function () {
                        event(new RoutingAdmin());

                        // Main Admin and Logout Route
                        Route::get('/', ['uses' => 'FacilitadorController@index',   'as' => 'dashboard']);
                        Route::post('logout', ['uses' => 'FacilitadorController@logout',  'as' => 'logout']);
                        Route::post('upload', ['uses' => 'FacilitadorController@upload',  'as' => 'upload']);

                        Route::get('profile', ['uses' => 'FacilitadorUserController@profile', 'as' => 'profile']);

                        Route::get('/', 'ProfileController@index')->name('profile');
                        Route::get('/show', 'ProfileController@show')->name('profile.show');

                        Route::get('/notifications/unread', 'NotificationsController@unread')->name('notifications.unread');
                        Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');
                        Route::get('/notifications/count', 'NotificationsController@count')->name('notifications.count');

                        Route::get('/messages', 'MessagesController@index')->name('messages.index');
                        Route::get('/messages/to/{id}', 'MessagesController@create')->name('messages.create');
                        Route::post('/messages', 'MessagesController@store')->name('messages.store');
                        Route::get('/messages/{id}', 'MessagesController@show')->name('messages.show');
                        Route::put('/messages/{id}', 'MessagesController@update')->name('messages.update');
                        event(new RoutingAdminAfter());
                    }
                // );
            // }
        );
    }
);
