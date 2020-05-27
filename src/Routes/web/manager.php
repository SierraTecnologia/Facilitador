<?php

// Route::group(['middleware' => 'admin.user'], function () {
    Route::name('facilitador.')->group(
        function () {
            Route::prefix('manager')->group(
                function () {
            
                    Route::namespace('System')->group(
                        function () {

                            // ADmin Router
                            Route::get('/', 'AdminController@index')->name('dashboard');
                            Route::get('/search', 'AdminController@search')->name('globalsearch');
                        }
                    );
                }
            );
        }
    );
    // });