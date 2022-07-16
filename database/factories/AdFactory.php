<?php

/** @var Factory $factory */

use App\Ad;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Ad::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text(1000),
        'price' => $faker->randomNumber(2, 100),
        'contacts' => $faker->phoneNumber,
    ];
});
