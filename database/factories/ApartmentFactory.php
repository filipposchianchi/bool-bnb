<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apartment;
use Faker\Generator as Faker;

$factory->define(Apartment::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement($array = array (
            'Appartamento al Centro',
            'Su baraccu',
            'Al porto Appartamento',
            'Spaziosa appartamento',
            'Bella vista',
            'Al centro',
            'Trullo edera',
            'Confortevole',
            'Luna di miele',
            'Vista bellissima',
            'Casa romantica',
            'Top casa 100% soddisfatti',
            'Casa da hollywood Star',
            'Appartamento da VIP',
            'Vacanza fantastica',
            'Appartamento economico 2 passi dal centro',
            'Appartamento Green friendly ',
            'Appartamento storico de rosa',
            'Uno piu uno = 3',
            'Casa da brivido',
        )),
        'address' => $faker->address,
        'description' => $faker->sentence,
        'image' => $faker->randomElement($array = array (
            'house1.jpg',
            'house2.jpg',
            'house3.jpg',
            'house4.jpg',
            'house5.jpg',
            'house6.jpg',
            'house7.jpg',
            'house8.jpeg',
            'house9.jpg',
            'house10.jpg',
            'house11.jpg',
            'house12.jpg',
            'house13.jpg',
            'house14.jpg',
            'house15.jpg',
            'house16.jpg',
            'house17.jpg',
            'house18.jpg',
            'house19.jpg',
            'house20.jpg',
            'house21.jpg',
            'house22.jpg',
            'house23.jpg',
            'house24.jpg',
            'house25.jpg',
        )),
        'roomNum' => rand(1,5),
        'bedNum' => rand(1,3),
        'mQ' => rand(50,200),
        'wcNum' => rand(1,2),
        'view' => rand(0,100),
        "visible" => rand(0,1),
        'sponsored' => rand(0,3),
        'startDaySponsor' => $faker -> dateTime,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});
