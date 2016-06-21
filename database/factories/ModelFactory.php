<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function(Faker\Generator $faker){
    return [
        'title'         => $faker->words(3, true),
        'description'   => $faker->text(),
        'image'         => $faker->imageUrl(),
        'price'         => $faker->randomFloat(2, 2.95, 1000),
        'vat_percentage'=> $faker->randomElement([0, 0.06, 0.21]),
    ];
});
