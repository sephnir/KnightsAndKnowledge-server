<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Character::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'experience' => $faker->randomNumber(),
        'money' => $faker->randomNumber(),
    ];
});
