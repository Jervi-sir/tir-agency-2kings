<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Place;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    return [
      	'vol_id'        => $faker->numberBetween(1, 5),
        'code_place'    => $faker->numberBetween(1, 300),
        'numero_place'  => $faker->numberBetween(1, 300),
        'prix_place'    => $faker->numberBetween(15, 300) * 100 ,
        'occupee'       => $faker->boolean(50) ,
        'economique'    => $faker->boolean(50) ,
        'type_service'  => 'places',
        'type_place'    => $faker->sentence(1),
    ];
});
