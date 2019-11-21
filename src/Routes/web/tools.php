<?php
Route::prefix('tools')->group(function () {

    /**
     * By Model
     */
    Route::namespace('Tools')->group(function () {
        Route::post('switchuser', 'UserSwitchController@switchUser')->name('user.switch');
        Route::get('restoreuser', 'UserSwitchController@restoreUser')->name('user.restore');
    });
});