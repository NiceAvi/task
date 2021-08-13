<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\bill_header_items;
use Faker\Generator as Faker;

$factory->define(BillHeaderItems::class, function (Faker $faker) {
    return [
        'bill_id' => factory(\App\BillHeader::class),
        'item_id' => factory(\App\Item::class),
        'rate' => $faker->randomFloat(2, 0, 999999.99),
        'qty' => $faker->word,
        'base_amount' => $faker->randomFloat(2, 0, 999999.99),
    ];
});
