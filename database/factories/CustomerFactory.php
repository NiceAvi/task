<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->word,
        'city' => $faker->city,
    ];
});
