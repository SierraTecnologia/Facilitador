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


Route::post('pusher/auth', function() {
    return auth()->user();
  });
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
    ['as' => 'profile.'], function () {

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

                        Route::get('/', 'ProfileController@index')->name('home');
                        Route::get('/show', 'ProfileController@show')->name('profile.show');

                        Route::get('/messages', 'MessagesController@index')->name('messages.index');
                        Route::get('/messages/to/{id}', 'MessagesController@create')->name('messages.create');
                        Route::post('/messages', 'MessagesController@store')->name('messages.store');
                        Route::get('/messages/{id}', 'MessagesController@show')->name('messages.show');
                        Route::put('/messages/{id}', 'MessagesController@update')->name('messages.update');

                        Route::group(['prefix' => 'notifications'], function () {
                            Route::get('/', 'NotificationController@index');
                            Route::get('{uuid}/read', 'NotificationController@read');
                            Route::delete('{uuid}/delete', 'NotificationController@delete');
                            Route::get('search', 'NotificationController@search');

                            /**
                             * Veio separdo
                             */

                            Route::get('/unread', 'NotificationsController@unread')->name('notifications.unread');
                            // Route::get('/', 'NotificationsController@index')->name('notifications.index');
                            Route::get('/count', 'NotificationsController@count')->name('notifications.count');

                        });
                        
                        Route::get('settings', 'SettingsController@settings');
                        Route::post('settings', 'SettingsController@update');
                        Route::get('password', 'PasswordController@password');
                        Route::post('password', 'PasswordController@update');

                        event(new RoutingAdminAfter());
                    }
                // );
            // }
        );
    }
);


// Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function()
// {
//     $a = 'user.';
//     Route::get('/', ['as' => $a . 'home', 'uses' => 'UserController@getHome']);

//     Route::group(['middleware' => 'activated'], function ()
//     {
//         $m = 'activated.';
//         Route::get('protected', ['as' => $m . 'protected', 'uses' => 'UserController@getProtected']);
//     });

// });





// /*
// |--------------------------------------------------------------------------
// | User Routes
// |--------------------------------------------------------------------------
// */
// Route::group(['middleware' => 'user', 'prefix' => 'user', 'as'=>'user.', 'namespace' => 'User'], function () {
 
//     Route::group(['prefix' => 'notifications'], function () {
//         Route::get('/', 'NotificationController@index');
//         Route::get('{uuid}/read', 'NotificationController@read');
//         Route::delete('{uuid}/delete', 'NotificationController@delete');
//         Route::get('search', 'NotificationController@search');
//     });
    
//     Route::get('settings', 'SettingsController@settings');
//     Route::post('settings', 'SettingsController@update');
//     Route::get('password', 'PasswordController@password');
//     Route::post('password', 'PasswordController@update');
// });

