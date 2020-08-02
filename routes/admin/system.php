<?php

          
Route::namespace('Admin')->group(
    function () {
        Route::resource('settings', 'SettingController', ['except' => ['show', 'create', 'store', 'edit']]);
        Route::get('settings/configure/{slugSetting}', 'SettingController@configure')->name('settings.configure');
        Route::post('settings/store/{slugSetting}', 'SettingController@store')->name('settings.store');

    }
);