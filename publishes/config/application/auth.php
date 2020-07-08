<?php

return [

    // Auth guard and policy to use
    'guard'  => 'facilitador', //'web', //
    'model'  => \App\Models\User::class,
    'policy' => 'Facilitador\Auth\Policy@check',

    // Use a password input field for admins
    'obscure_admin_password' => false,
];
