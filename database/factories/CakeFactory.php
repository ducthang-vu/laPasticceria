<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cake;
use App\Cake_type;
use Faker\Generator as Faker;

$factory->define(Cake::class, function (Faker $faker) {
    $days = $faker->boolean(50) ? '1' : '5';
    return [
        'cake_type_id' => Cake_type::all()->random()->id,
        'created_at' => $faker->dateTimeInInterval($startDate = '-' . $days . ' days', $interval = '+' . $days . ' days')
    ];
});
