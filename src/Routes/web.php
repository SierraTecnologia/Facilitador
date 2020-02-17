<?php

Route::group(['middleware' => ['web']], function () {                                                                                                                         
    $alias = 'public.';
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "manager.php";
    include dirname(__FILE__) . DIRECTORY_SEPARATOR . "web". DIRECTORY_SEPARATOR . "facilitador.php";
});    