<?php

Route::resource('settings', 'SettingController', ['except' => ['show', 'create', 'store', 'edit']]);
Route::get('settings/configure/{codeSetting}', 'SettingController@configure')->name('settings.configure');
Route::post('settings/store/{codeSetting}', 'SettingController@store')->name('settings.store');
