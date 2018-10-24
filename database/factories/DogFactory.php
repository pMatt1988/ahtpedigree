<?php

use Faker\Generator as Faker;

$factory->define(App\Dog::class, function (Faker $faker) {
    return [
        'regname' => $faker->name,
        'sire' => $faker->name,
        'dam' => $faker->name
    ];
});
