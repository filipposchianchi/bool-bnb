<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'wifi' => rand(0,1),
        'garage' => rand(0,1),
        'pool' => rand(0,1),
        'reception' => rand(0,1),
        'sauna' => rand(0,1),
        'seaView' => rand(0,1)
    ];
});
