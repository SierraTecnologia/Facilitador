<?php

/*
 * --------------------------------------------------------------------------
 * Role Factory
 * --------------------------------------------------------------------------
*/

$factory->define(Porteiro\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => 'member',
        'label' => 'Member',
    ];
});
