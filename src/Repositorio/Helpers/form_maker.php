<?php

if (!function_exists('form_maker_table')) {
    function form_maker_table($table, $columns = null, $class = 'form-control', $view = null, $reformatted = true, $populated = false, $idAndTimestamps = false)
    {
        return app('Repositorio')->fromTable($table, $columns, $class, $view, $reformatted, $populated, $idAndTimestamps);
    }
}

if (!function_exists('form_maker_object')) {
    function form_maker_object($object, $columns = null, $view = null, $class = 'form-control', $populated = true, $reformatted = false, $idAndTimestamps = false)
    {
        return app('Repositorio')->fromObject($object, $columns, $view, $class, $populated, $reformatted, $idAndTimestamps);
    }
}

if (!function_exists('form_maker_array')) {
    function form_maker_array($array, $columns = null, $view = null, $class = 'form-control', $populated = true, $reformatted = false, $idAndTimestamps = false)
    {
        return app('Repositorio')->fromArray($array, $columns, $view, $class, $populated, $reformatted, $idAndTimestamps);
    }
}

if (!function_exists('form_maker_columns')) {
    function form_maker_columns($table)
    {
        return app('Repositorio')->getTableColumns($table);
    }
}
