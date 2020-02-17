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

    $namespacePrefix = '\\'.config('facilitador.controllers.namespace').'\\';
    $namespacePrefix = '';

    Route::get('login', ['uses' => $namespacePrefix.'FacilitadorAuthController@login',     'as' => 'login']);
    Route::post('login', ['uses' => $namespacePrefix.'FacilitadorAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // Main Admin and Logout Route
        Route::get('/', ['uses' => $namespacePrefix.'FacilitadorController@index',   'as' => 'dashboard']);
        Route::post('logout', ['uses' => $namespacePrefix.'FacilitadorController@logout',  'as' => 'logout']);
        Route::post('upload', ['uses' => $namespacePrefix.'FacilitadorController@upload',  'as' => 'upload']);

        Route::get('profile', ['uses' => $namespacePrefix.'FacilitadorUserController@profile', 'as' => 'profile']);

        try {
            foreach (Facilitador::model('DataType')::all() as $dataType) {
                $breadController = $dataType->controller
                                 ? Str::start($dataType->controller, '\\')
                                 : $namespacePrefix.'FacilitadorBaseController';
                $routeName = Crypto::encrypt($dataType->slug);

                Route::get($routeName.'/order', $breadController.'@order')->name($routeName.'.order');
                Route::post($routeName.'/action', $breadController.'@action')->name($routeName.'.action');
                Route::post($routeName.'/order', $breadController.'@update_order')->name($routeName.'.order');
                Route::get($routeName.'/{id}/restore', $breadController.'@restore')->name($routeName.'.restore');
                Route::get($routeName.'/relation', $breadController.'@relation')->name($routeName.'.relation');
                Route::post($routeName.'/remove', $breadController.'@remove_media')->name($routeName.'.media.remove');
                Route::resource($routeName, $breadController, ['parameters' => [$routeName => 'id']]);
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
        } catch (\Exception $e) {
            // do nothing, might just be because table not yet migrated.
        }

        // Role Routes
        Route::resource('roles', $namespacePrefix.'FacilitadorRoleController');

        // Menu Routes
        Route::group([
            'as'     => 'menus.',
            'prefix' => 'menus/{menu}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'FacilitadorMenuController@builder',    'as' => 'builder']);
            Route::post('order', ['uses' => $namespacePrefix.'FacilitadorMenuController@order_item', 'as' => 'order']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () use ($namespacePrefix) {
                Route::delete('{id}', ['uses' => $namespacePrefix.'FacilitadorMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => $namespacePrefix.'FacilitadorMenuController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => $namespacePrefix.'FacilitadorMenuController@update_item', 'as' => 'update']);
            });
        });

        // Settings
        Route::group([
            'as'     => 'settings.',
            'prefix' => 'settings',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'FacilitadorSettingsController@index',        'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'FacilitadorSettingsController@store',        'as' => 'store']);
            Route::put('/', ['uses' => $namespacePrefix.'FacilitadorSettingsController@update',       'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'FacilitadorSettingsController@delete',       'as' => 'delete']);
            Route::get('{id}/move_up', ['uses' => $namespacePrefix.'FacilitadorSettingsController@move_up',      'as' => 'move_up']);
            Route::get('{id}/move_down', ['uses' => $namespacePrefix.'FacilitadorSettingsController@move_down',    'as' => 'move_down']);
            Route::put('{id}/delete_value', ['uses' => $namespacePrefix.'FacilitadorSettingsController@delete_value', 'as' => 'delete_value']);
        });

        // Admin Media
        Route::group([
            'as'     => 'media.',
            'prefix' => 'media',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'FacilitadorMediaController@index',              'as' => 'index']);
            Route::post('files', ['uses' => $namespacePrefix.'FacilitadorMediaController@files',              'as' => 'files']);
            Route::post('new_folder', ['uses' => $namespacePrefix.'FacilitadorMediaController@new_folder',         'as' => 'new_folder']);
            Route::post('delete_file_folder', ['uses' => $namespacePrefix.'FacilitadorMediaController@delete', 'as' => 'delete']);
            Route::post('move_file', ['uses' => $namespacePrefix.'FacilitadorMediaController@move',          'as' => 'move']);
            Route::post('rename_file', ['uses' => $namespacePrefix.'FacilitadorMediaController@rename',        'as' => 'rename']);
            Route::post('upload', ['uses' => $namespacePrefix.'FacilitadorMediaController@upload',             'as' => 'upload']);
            Route::post('crop', ['uses' => $namespacePrefix.'FacilitadorMediaController@crop',             'as' => 'crop']);
        });

        // BREAD Routes
        Route::group([
            'as'     => 'bread.',
            'prefix' => 'bread',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'FacilitadorBreadController@index',              'as' => 'index']);
            Route::get('{table}/create', ['uses' => $namespacePrefix.'FacilitadorBreadController@create',     'as' => 'create']);
            Route::post('/', ['uses' => $namespacePrefix.'FacilitadorBreadController@store',   'as' => 'store']);
            Route::get('{table}/edit', ['uses' => $namespacePrefix.'FacilitadorBreadController@edit', 'as' => 'edit']);
            Route::put('{id}', ['uses' => $namespacePrefix.'FacilitadorBreadController@update',  'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'FacilitadorBreadController@destroy',  'as' => 'delete']);
            Route::post('relationship', ['uses' => $namespacePrefix.'FacilitadorBreadController@addRelationship',  'as' => 'relationship']);
            Route::get('delete_relationship/{id}', ['uses' => $namespacePrefix.'FacilitadorBreadController@deleteRelationship',  'as' => 'delete_relationship']);
        });

        // Database Routes
        Route::resource('database', $namespacePrefix.'FacilitadorDatabaseController');

        // Compass Routes
        Route::group([
            'as'     => 'compass.',
            'prefix' => 'compass',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'FacilitadorCompassController@index',  'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'FacilitadorCompassController@index',  'as' => 'post']);
        });



        /**
         * Para Corrigir Bugs
         */

        $breadController = $namespacePrefix.'FacilitadorUserController';
        $modelRouterPrefix = 'users';
        Route::get($modelRouterPrefix.'/order', $breadController.'@order')->name($modelRouterPrefix.'.order');
        Route::post($modelRouterPrefix.'/action', $breadController.'@action')->name($modelRouterPrefix.'.action');
        Route::post($modelRouterPrefix.'/order', $breadController.'@update_order')->name($modelRouterPrefix.'.order');
        Route::get($modelRouterPrefix.'/{id}/restore', $breadController.'@restore')->name($modelRouterPrefix.'.restore');
        Route::get($modelRouterPrefix.'/relation', $breadController.'@relation')->name($modelRouterPrefix.'.relation');
        Route::post($modelRouterPrefix.'/remove', $breadController.'@remove_media')->name($modelRouterPrefix.'.media.remove');
        Route::resource($modelRouterPrefix, $breadController);


        $breadController = $namespacePrefix.'FacilitadorBaseController';
        $modelRouterPrefix = 'posts';
        Route::get($modelRouterPrefix.'/order', $breadController.'@order')->name($modelRouterPrefix.'.order');
        Route::post($modelRouterPrefix.'/action', $breadController.'@action')->name($modelRouterPrefix.'.action');
        Route::post($modelRouterPrefix.'/order', $breadController.'@update_order')->name($modelRouterPrefix.'.order');
        Route::get($modelRouterPrefix.'/{id}/restore', $breadController.'@restore')->name($modelRouterPrefix.'.restore');
        Route::get($modelRouterPrefix.'/relation', $breadController.'@relation')->name($modelRouterPrefix.'.relation');
        Route::post($modelRouterPrefix.'/remove', $breadController.'@remove_media')->name($modelRouterPrefix.'.media.remove');
        Route::resource($modelRouterPrefix, $breadController);


        $breadController = $namespacePrefix.'FacilitadorBaseController';
        $modelRouterPrefix = 'pages';
        Route::get($modelRouterPrefix.'/order', $breadController.'@order')->name($modelRouterPrefix.'.order');
        Route::post($modelRouterPrefix.'/action', $breadController.'@action')->name($modelRouterPrefix.'.action');
        Route::post($modelRouterPrefix.'/order', $breadController.'@update_order')->name($modelRouterPrefix.'.order');
        Route::get($modelRouterPrefix.'/{id}/restore', $breadController.'@restore')->name($modelRouterPrefix.'.restore');
        Route::get($modelRouterPrefix.'/relation', $breadController.'@relation')->name($modelRouterPrefix.'.relation');
        Route::post($modelRouterPrefix.'/remove', $breadController.'@remove_media')->name($modelRouterPrefix.'.media.remove');
        Route::resource($modelRouterPrefix, $breadController);

         /**
          * Fim do Para Corrigir Bugs
          */

        event(new RoutingAdminAfter());
    });

    //Asset Routes
    Route::get('facilitador-assets', ['uses' => $namespacePrefix.'FacilitadorController@assets', 'as' => 'facilitador_assets']);

    event(new RoutingAfter());
});
