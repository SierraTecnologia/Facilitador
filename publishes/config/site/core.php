<?php

return [


    // Mail FROM info
    'mail_from_name'    => 'Site Admin',
    'mail_from_address' => 'postmaster@'.(app()->runningInConsole() ?
        'locahost' : parse_url(url()->current(), PHP_URL_HOST)),

    // Allow regex in redirect rules
    'allow_regex_in_redirects' => false,

    // Register routes automatically in ServiceProvider->boot().  You might set
    // this to false if the App needed to register some /admin routes and didn't
    // want them to get trampled by the Decoy wildcard capture.
    'register_routes' => true,

    // Set up the default stylesheet and script tags
    'stylesheet' => '/facilitador-assets/app.css',
    'script' => '/facilitador-assets/app.js',

];
