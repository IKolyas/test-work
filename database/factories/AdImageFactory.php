<?php

/** @var Factory $factory */

use App\AdImage;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(AdImage::class, function (Faker $faker) {
    return [
        'url' => $faker->url,
        'priority' => 1,
    ];
});
