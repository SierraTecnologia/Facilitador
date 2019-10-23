<?php

Route::prefix('admin')->group(function () {

    
    // ADmin Router
    Route::get('/', 'AdminController@index');

    /**
     * By Model
     */
    Route::namespace('Universal')->group(function () {
        Route::get('/{modelClass}', 'RepositoryController@index');
        Route::post('/{modelClass}', 'RepositoryController@store');

        Route::get('/{modelClass}/{identify}', 'RegisterController@show');
        Route::get('/{modelClass}/{identify}/edit', 'RegisterController@edit');
        Route::put('/{modelClass}/{identify}', 'RegisterController@update');
        Route::delete('/{modelClass}/{identify}', 'RegisterController@destroy');
    });
});