<?php

$factory->define(
    \Porteiro\Models\Role::class, function (Faker\Generator $faker) {
        $role = $faker->word;

        return [
        'name'         => strtolower($role),
        'display_name' => ucfirst($role),
        ];
    }
);
