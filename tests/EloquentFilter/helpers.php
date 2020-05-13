<?php

/**
 * Replacement for our config function.
 */
if (! function_exists('config')) {
    function \Illuminate\Support\Facades\Config::get($key, $default)
    {
        return $default;
    }
}
