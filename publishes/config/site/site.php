<?php

return [

    /**
     * The name of the site is shown in the header of all pages
     *
     * @var string
     */
    'name' => \Illuminate\Support\Facades\Config::get('app.name', 'SiravelAdmin'),

    /**
     * A hash of localization slugs and readable labels for all the locales for this
     * site.  Localization UI will only appear if the count > 1.
     *
     * @var array
     */
    'locales' => [
        'en' => 'English',
        'pt' => 'Português',
        // 'es' => 'Spanish',
        // 'fr' => 'French',
    ],

    /*
    |--------------------------------------------------------------------------
    | Multilingual configuration
    |--------------------------------------------------------------------------
    |
    | Here you can specify if you want Facilitador to ship with support for
    | multilingual and what locales are enabled.
    |
    */

    'multilingual' => [
        /*
         * Set whether or not the multilingual is supported by the BREAD input.
         */
        'enabled' => true,

        /*
         * Select default language
         */
        'default' => 'pt',

        /*
         * Select languages that are supported.
         */
        'locales' => [
            'en',
            'pt',
        ],
    ],

];
