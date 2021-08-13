<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\bill_header;
use Faker\Generator as Faker;

$factory->define(BillHeader::class, function (Faker $faker) {
    return [
        'bill_no' => $faker->word,
        'date' => $faker->date(),
        'customer_id' => factory(\App\Customer::class),
        'total_amount' => $faker->randomFloat(2, 0, 999999.99),
    ];
});
