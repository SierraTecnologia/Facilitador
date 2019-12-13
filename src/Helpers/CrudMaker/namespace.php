<?php

if (!function_exists('app_namespace')) {
    function app_namespace()
    {
        return app('Facilitador\Services\CrudMaker\AppService')
            ->getAppNamespace();
    }
}
