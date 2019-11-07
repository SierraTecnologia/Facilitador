<?php
Route::name('facilitador.')->group(function () {
    Route::prefix('admin')->group(function () {

        
        // ADmin Router
        Route::get('/', 'AdminController@index')->name('dash');
        Route::get('/search', 'AdminController@search')->name('globalsearch');

        /**
         * By Model
         */
        Route::namespace('Universal')->group(function () {
            Route::prefix('{modelClass}')->group(function () {
                Route::get('/', 'RepositoryController@index')->name('index');
                Route::get('/create', 'RegisterController@create')->name('create');
                Route::post('/', 'RepositoryController@store')->name('store');
                Route::get('/search', 'RepositoryController@search')->name('search');
                Route::prefix('{identify}')->group(function () {
                    Route::get('/', 'RegisterController@index')->name('show');
                    Route::get('/edit', 'RegisterController@edit')->name('edit');
                    Route::put('/', 'RegisterController@update')->name('update');
                    Route::delete('/', 'RegisterController@destroy')->name('destroy');
                });
            });
        });
    });
});