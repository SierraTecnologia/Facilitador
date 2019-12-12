<?php

use Illuminate\Http\Request;

$routePrefix = config('cms.backend-route-prefix', 'cms');

Route::group(['middleware' => 'web'], function () use ($routePrefix) {

    /*
    |--------------------------------------------------------------------------
    | APIs
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => $routePrefix.'/api'], function () use ($routePrefix) {
        Route::group(['middleware' => ['cms-api']], function () use ($routePrefix) {
            Route::get('blog', 'ApiController@all');
            Route::get('blog/{id}', 'ApiController@find');

            Route::get('events', 'ApiController@all');
            Route::get('events/{id}', 'ApiController@find');

            Route::get('faqs', 'ApiController@all');
            Route::get('faqs/{id}', 'ApiController@find');

            Route::get('files', 'ApiController@all');
            Route::get('files/{id}', 'ApiController@find');

            Route::get('images', 'ApiController@all');
            Route::get('images/{id}', 'ApiController@find');

            Route::get('pages', 'ApiController@all');
            Route::get('pages/{id}', 'ApiController@find');

            Route::get('widgets', 'ApiController@all');
            Route::get('widgets/{id}', 'ApiController@find');
        });
    });
});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {
    // Credit Card Controller
    // Route::post('/cards/register',				'CreditCardController@register');
    // Route::post('/cards/edit',				    'CreditCardController@edit');
    // Route::post('/cards/delete',				'CreditCardController@delete');
    // Route::post('/cards/user',				    'CreditCardController@user');
    // Route::post('/cards/validation',		    'CreditCardController@validation');
    // Route::post('/cards/validate-token',		'CreditCardController@validateToken');
    // Route::post('/cards/valid',				    'CreditCardController@valid');

    // // Customer Controller
    // Route::post('/users/register',				'CustomerController@register');
    // Route::post('/users/user-token',			'CustomerController@userToken');

    // // Order Controller
    // Route::post('/orders/register',				'OrderController@register');
    // Route::post('/orders/find',				    'OrderController@find');
});

