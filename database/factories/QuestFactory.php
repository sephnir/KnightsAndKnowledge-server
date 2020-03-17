<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Quest::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'boss' => $faker->boolean,
        'level' => $faker->boolean,
        'dungeon_seed' => $faker->word
    ];
});
