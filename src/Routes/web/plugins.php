<?php

/*
|--------------------------------------------------------------------------
| Root Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'admin', 'prefix' => 'plugins', 'as'=>'admin.', 'namespace' => 'Plugins'], function () {
    
    /**
     * Social
     */
    Route::group(['namespace' => 'Social'], function () {
        Route::resource('accounts', 'AccountController');
    });
});

/**
 * Public
 */
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');