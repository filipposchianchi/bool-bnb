<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Promo;
use Faker\Generator as Faker;

$factory->define(Promo::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement($array = array ('a','b','c'))
    ];
});
