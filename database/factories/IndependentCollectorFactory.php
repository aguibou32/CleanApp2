<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\IndependentCollector;

$factory->define(IndependentCollector::class, function (Faker $faker) {
    return [
        //
        'identification' => 'indetifications/identification.pdf',
        'driver_license' => 'driver licenses/driver_license.pdf',
        'criminal_record' => 'criminal records/criminal_record.pdf',
    ];
});
