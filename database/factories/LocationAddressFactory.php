<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\User;
use App\LocationAddress;
use Faker\Generator as Faker;

$factory->define(LocationAddress::class, function (Faker $faker) {
    return [
        //
        'unit_number' => $faker->randomDigitNot(0),
        'complexe_name' => $faker->secondaryAddress,
        'street_name' => $faker->streetName,
        'province_name' => 'Gauteng',
        'city_name' => 'Johannesburg',

        'user_id' => function(){
            return User::all()->random();
        }
    ];
});
