<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
<<<<<<< HEAD
        // 'address' => $faker->address,
=======
>>>>>>> master
        'address' => $faker->address,
        'description' => $faker->sentence,
        'image' => 'house1.jpg',
        'roomNum' => rand(1,5),
        'bedNum' => rand(1,3),
        'mQ' => rand(50,200),
        'wcNum' => rand(1,2),
        'view' => rand(0,100),
        "visible" => rand(0,1),
        'sponsored' => rand(0,1),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});
