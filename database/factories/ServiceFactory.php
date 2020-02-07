<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'wifi' => $faker->rand(0,1),
        'garage' => $faker->rand(0,1),
        'pool' => $faker->rand(0,1),
        'reception' => $faker->rand(0,1),
        'sauna' => $faker->rand(0,1),
        'seaView' => $faker->rand(0,1)
    ];
});
