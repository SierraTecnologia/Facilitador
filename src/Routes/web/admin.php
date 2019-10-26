<?php

Route::prefix('admin')->group(function () {

    
    // ADmin Router
    Route::get('/', 'AdminController@index');

    /**
     * By Model
     */
    Route::namespace('Universal')->group(function () {
        Route::get('/{facilitadorService}', 'RepositoryController@index');
        Route::post('/{facilitadorService}', 'RepositoryController@store');

        Route::get('/{facilitadorService}/{repositoryService}', 'RegisterController@show');
        Route::get('/{facilitadorService}/{repositoryService}/edit', 'RegisterController@edit');
        Route::put('/{facilitadorService}/{repositoryService}', 'RegisterController@update');
        Route::delete('/{facilitadorService}/{repositoryService}', 'RegisterController@destroy');
    });
});