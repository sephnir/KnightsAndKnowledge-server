<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Guild::class, function (Faker $faker) {
    return [
        'guild_token' => $faker->word,
        'name' => $faker->name,
    ];
});
