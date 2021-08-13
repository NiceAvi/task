<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\items;
use Faker\Generator as Faker;

$factory->define(Items::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2, 0, 999999.99),
    ];
});
