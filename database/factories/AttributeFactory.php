<?php

declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(
    Pedreiro\Models\Attribute::class, function (Faker $faker) {
        return [
        'slug' => $faker->slug,
        'type' => $faker->randomElement(['boolean', 'datetime', 'integer', 'text', 'varchar']),
        'name' => $faker->name,
        'entities' => $faker->randomElement(['App\Models\Company', 'App\Models\Product', \Illuminate\Support\Facades\Config::get('application.auth.model', \App\Models\User::class)]),
        ];
    }
);
