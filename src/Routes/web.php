<?php

// Public routes
Route::group([
    'prefix' => config('sitec.core.dir', 'admin'),
    'middleware' => 'web',
], function () {                                                                                                                       
    $alias = 'public.';
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "manager.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "voyager.php";
});    