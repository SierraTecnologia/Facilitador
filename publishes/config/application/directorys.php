<?php

/*
|--------------------------------------------------------------------------
| CrudMaker Config
|--------------------------------------------------------------------------
|
| WARNING! do not change any thing that starts and ends with _
|
*/

return [
    'models' => [
        'persons' => \Population\Models\Identity\Actors\Person::class,
        'attribute' => \Facilitador\Models\Attribute::class,
        'attribute_entity' => \Facilitador\Models\AttributeEntity::class,
    ],


    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /*********
      * LARAVEL ATRIBUTE    ****************** 
*/
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */

    // Attributes Database Tables
    'tables' => [

        'attributes' => 'attributes',
        'attribute_entity' => 'attribute_entity',
        'attribute_boolean_values' => 'attribute_boolean_values',
        'attribute_datetime_values' => 'attribute_datetime_values',
        'attribute_integer_values' => 'attribute_integer_values',
        'attribute_text_values' => 'attribute_text_values',
        'attribute_varchar_values' => 'attribute_varchar_values',

    ],


    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /*********
      * ELOQUENT FILTER    ****************** 
*/
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */
    /***************************************************** */

    /*
     |--------------------------------------------------------------------------
     | Eloquent Filter Settings
     |--------------------------------------------------------------------------
     |
     | This is the namespace all you Eloquent Model Filters will reside
     |
     */

    'namespace' => 'App\\ModelFilters\\',



    'template_source' => app()->basePath().'/resources/crudmaker',

    /*
    |--------------------------------------------------------------------------
    | Single CRUD
    |--------------------------------------------------------------------------
    | The config for CRUDs which which are simple tables:
    | roles, settings etc.
    */

    'single' => [
        '_path_facade_' => app()->path().'/Facades',
        '_path_service_' => app()->path().'/Services',
        '_path_model_' => app()->path().'/Models',
        '_path_controller_' => app()->path().'/Http/Controllers/',
        '_path_api_controller_' => app()->path().'/Http/Controllers/Api',
        '_path_views_' => app()->basePath().'/resources/views',
        '_path_tests_' => app()->basePath().'/tests',
        '_path_request_' => app()->path().'/Http/Requests/',
        '_path_routes_' => app()->basePath().'/routes/web.php',
        '_path_api_routes_' => app()->basePath().'/routes/api.php',
        'routes_prefix' => '',
        'routes_suffix' => '',
        '_app_namespace_' => 'App\\',
        '_namespace_services_' => 'App\\'.'Services',
        '_namespace_facade_' => 'App\\'.'Facades',
        '_namespace_model_' => 'App\\'.'Models',
        '_namespace_controller_' => 'App\\'.'Http\Controllers',
        '_namespace_api_controller_' => 'App\\'.'Http\Controllers\Api',
        '_namespace_request_' => 'App\\'.'Http\Requests',
    ],

    /*
    |--------------------------------------------------------------------------
    | Sectioned CRUD
    |--------------------------------------------------------------------------
    | The config for CRUDs which are like as sections such as various admin tables:
    | admin_role, admin_settings etc.
    */

    'sectioned' => [
        '_path_facade_' => app()->path().'/Facades',
        '_path_service_' => app()->path().'/Services/_section_',
        '_path_model_' => app()->path().'/Models/_section_',
        '_path_controller_' => app()->path().'/Http/Controllers/_section_/',
        '_path_api_controller_' => app()->path().'/Http/Controllers/Api/_section_/',
        '_path_views_' => app()->basePath().'/resources/views/_sectionLowerCase_',
        '_path_tests_' => app()->basePath().'/tests',
        '_path_request_' => app()->path().'/Http/Requests/_section_',
        '_path_routes_' => app()->basePath().'/routes/web.php',
        '_path_api_routes_' => app()->basePath().'/routes/api.php',
        'routes_prefix' => "\n\nRoute::group(['namespace' => '_section_', 'prefix' => '_sectionLowerCase_', 'as' => '_sectionLowerCase_', 'middleware' => ['web']], function () { \n",
        'routes_suffix' => "\n});",
        '_app_namespace_' => 'App\\',
        '_namespace_services_' => 'App\\'.'Services',
        '_namespace_facade_' => 'App\\'.'Facades',
        '_namespace_model_' => 'App\\'.'Models\_section_',
        '_namespace_controller_' => 'App\\'.'Http\Controllers',
        '_namespace_api_controller_' => 'App\\'.'Http\Controllers\Api',
        '_namespace_request_' => 'App\\'.'Http\Requests',
    ],

];
