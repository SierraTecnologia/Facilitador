<?php

Route::group(['middleware' => ['web']], function () {                                                                                                                         
    $alias = 'public.';
    Route::name('facilitador.')->group(function () {
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "tools.php";
        include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "admin.php";
    );    
});    