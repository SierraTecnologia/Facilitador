<?php

Route::prefix('admin')->group(function () {

    
    // ADmin Router
    Route::get('/gerenciar/{modulo}', 'AdminController@index');
    Route::get('/gerenciar/{modulo}/{id}', 'AdminController@show');
    Route::post('/gerenciar/{modulo}/', 'AdminController@store');
    Route::get('/gerenciar/{modulo}/{id}/edit', 'AdminController@edit');
    Route::put('/gerenciar/{modulo}/{id}', 'AdminController@update');
    Route::delete('/gerenciar/{modulo}/{id}', 'AdminController@destroy');

});