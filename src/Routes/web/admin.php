<?php

Route::prefix('admin')->group(function () {

    
    // ADmin Router
    Route::get('/', 'AdminController@index');
    Route::get('/search', 'AdminController@search');

    /**
     * By Model
     */
    Route::namespace('Universal')->group(function () {
        Route::prefix('{repositoryService}')->group(function () {
            Route::get('/', 'RepositoryController@index');
            Route::post('/', 'RepositoryController@store');
            Route::get('/search', 'RepositoryController@search');
            Route::prefix('{registerService}')->group(function () {
                Route::get('/', 'RegisterController@index');
                Route::get('/edit', 'RegisterController@edit');
                Route::put('/', 'RegisterController@update');
                Route::delete('/', 'RegisterController@destroy');
            });
        });
    });
});