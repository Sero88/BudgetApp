<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BudgetCategory;
use Faker\Generator as Faker;

$factory->define(BudgetCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text(200),
        'budget' => $faker->randomFloat(2 , 1, 9999),
        'balance_id' => $faker->randomDigitNotNull,
    ];
});
