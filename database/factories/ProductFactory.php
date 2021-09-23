<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\product;
use Faker\Generator as Faker;

$factory->define(product::class, function (Faker $faker) {
    $randomDigit = $faker->randomDigit;
    return [
        'name' => $faker->company(),
        'quantity'=>$randomDigit,
        'stock' =>$randomDigit,
        'price' => $faker->numberBetween(100000,1000000)
    ];
});
