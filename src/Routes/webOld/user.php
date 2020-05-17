<?php

Route::post(
    'pusher/auth', function () {
        return auth()->user();
    }
);


Route::group(
    ['prefix' => 'user', 'middleware' => 'auth:user'], function () {
        $a = 'user.';
        Route::get('/', ['as' => $a . 'home', 'uses' => 'UserController@getHome']);

        Route::group(
            ['middleware' => 'activated'], function () {
                $m = 'activated.';
                Route::get('protected', ['as' => $m . 'protected', 'uses' => 'UserController@getProtected']);
            }
        );

    }
);

Route::group(
    ['middleware' => 'auth:all'], function () {
        $a = 'authenticated.';
        Route::get('/logout', ['as' => $a . 'logout', 'uses' => 'Auth\LoginController@logout']);
        Route::get('/activate/{token}', ['as' => $a . 'activate', 'uses' => 'User\ActivateController@activate']);
        Route::get('/activate', ['as' => $a . 'activation-resend', 'uses' => 'User\ActivateController@resend']);
        Route::get(
            'not-activated', ['as' => 'not-activated', 'uses' => function () {
                return view('errors.not-activated');
            }]
        );
    }
);


Auth::routes(['login' => 'auth.login']);


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(
    ['middleware' => 'user', 'prefix' => 'user', 'as'=>'user.', 'namespace' => 'User'], function () {
 
        Route::group(
            ['prefix' => 'notifications'], function () {
                Route::get('/', 'NotificationController@index');
                Route::get('{uuid}/read', 'NotificationController@read');
                Route::delete('{uuid}/delete', 'NotificationController@delete');
                Route::get('search', 'NotificationController@search');
            }
        );
    
        Route::get('settings', 'SettingsController@settings');
        Route::post('settings', 'SettingsController@update');
        Route::get('password', 'PasswordController@password');
        Route::post('password', 'PasswordController@update');
    }
);


