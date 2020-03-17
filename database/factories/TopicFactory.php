<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'sprite_path' => $faker->word,
    ];
});
