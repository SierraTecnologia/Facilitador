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
        

            // Route::group(
            //     ['middleware' => 'admin.user'], function () {
event(new RoutingAdmin());

// @todo nao fazer mais, mts rotas a toa
// try {
//     foreach (Facilitador::model('DataType')::all() as $dataType) {
//         $breadController = $dataType->controller
//                         ? Str::start($dataType->controller, '\\')
//                         : 'FacilitadorBaseController';
//         $routeName = Crypto::shareableEncrypt($dataType->slug);

//         Route::get($routeName.'/order', $breadController.'@order')->name($routeName.'.order');
//         Route::post($routeName.'/action', $breadController.'@action')->name($routeName.'.action');
//         Route::post($routeName.'/order', $breadController.'@update_order')->name($routeName.'.order');
//         Route::get($routeName.'/{id}/restore', $breadController.'@restore')->name($routeName.'.restore');
//         Route::get($routeName.'/relation', $breadController.'@relation')->name($routeName.'.relation');
//         Route::post($routeName.'/remove', $breadController.'@remove_media')->name($routeName.'.media.remove');
//         Route::resource($routeName, $breadController, ['parameters' => [$routeName => 'id']]);
//     }
// } catch (\InvalidArgumentException $e) {
//     throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
// } catch (\Exception $e) {
//     // do nothing, might just be because table not yet migrated.
// }

// Role Routes
Route::resource('roles', 'FacilitadorRoleController');

// Menu Routes
Route::group(
    [
    'as'     => 'menus.',
    'prefix' => 'menus/{menu}',
    ], function () {
        Route::get('builder', ['uses' => 'FacilitadorMenuController@builder',    'as' => 'builder']);
        Route::post('order', ['uses' => 'FacilitadorMenuController@order_item', 'as' => 'order']);

        Route::group(
            [
            'as'     => 'item.',
            'prefix' => 'item',
            ], function () {
                Route::delete('{id}', ['uses' => 'FacilitadorMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => 'FacilitadorMenuController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => 'FacilitadorMenuController@update_item', 'as' => 'update']);
            }
        );
    }
);

// Settings
Route::group(
    [
    'as'     => 'settings.',
    'prefix' => 'settings',
    ], function () {
        Route::get('/', ['uses' => 'FacilitadorSettingsController@index',        'as' => 'index']);
        Route::post('/', ['uses' => 'FacilitadorSettingsController@store',        'as' => 'store']);
        Route::put('/', ['uses' => 'FacilitadorSettingsController@update',       'as' => 'update']);
        Route::delete('{id}', ['uses' => 'FacilitadorSettingsController@delete',       'as' => 'delete']);
        Route::get('{id}/move_up', ['uses' => 'FacilitadorSettingsController@move_up',      'as' => 'move_up']);
        Route::get('{id}/move_down', ['uses' => 'FacilitadorSettingsController@move_down',    'as' => 'move_down']);
        Route::put('{id}/delete_value', ['uses' => 'FacilitadorSettingsController@delete_value', 'as' => 'delete_value']);
    }
);


// BREAD Routes
Route::group(
    [
    'as'     => 'bread.',
    'prefix' => 'bread',
    ], function () {
        Route::get('/', ['uses' => 'BreadController@index',              'as' => 'index']);
        Route::get('{table}/create', ['uses' => 'BreadController@create',     'as' => 'create']);
        Route::post('/', ['uses' => 'BreadController@store',   'as' => 'store']);
        Route::get('{table}/edit', ['uses' => 'BreadController@edit', 'as' => 'edit']);
        Route::put('{id}', ['uses' => 'BreadController@update',  'as' => 'update']);
        Route::delete('{id}', ['uses' => 'BreadController@destroy',  'as' => 'delete']);
        Route::post('relationship', ['uses' => 'BreadController@addRelationship',  'as' => 'relationship']);
        Route::get('delete_relationship/{id}', ['uses' => 'BreadController@deleteRelationship',  'as' => 'delete_relationship']);
    }
);

// Compass Routes
Route::group(
    [
    'as'     => 'compass.',
    'prefix' => 'compass',
    ], function () {
        Route::get('/', ['uses' => 'FacilitadorCompassController@index',  'as' => 'index']);
        Route::post('/', ['uses' => 'FacilitadorCompassController@index',  'as' => 'post']);
    }
);



/**
 * Para Corrigir Bugs
 */
$breadController = 'FacilitadorBaseController';
$modelRouterPrefix = 'posts';
Route::get($modelRouterPrefix.'/order', $breadController.'@order')->name($modelRouterPrefix.'.order');
Route::post($modelRouterPrefix.'/action', $breadController.'@action')->name($modelRouterPrefix.'.action');
Route::post($modelRouterPrefix.'/order', $breadController.'@update_order')->name($modelRouterPrefix.'.order');
Route::get($modelRouterPrefix.'/{id}/restore', $breadController.'@restore')->name($modelRouterPrefix.'.restore');
Route::get($modelRouterPrefix.'/relation', $breadController.'@relation')->name($modelRouterPrefix.'.relation');
Route::post($modelRouterPrefix.'/remove', $breadController.'@remove_media')->name($modelRouterPrefix.'.media.remove');
Route::resource($modelRouterPrefix, $breadController);


$breadController = 'FacilitadorBaseController';
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

        // }
    // );
