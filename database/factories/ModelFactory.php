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
    static $password;

    return [
        'name' => $faker->name,
        'lastNameFather' => $faker->lastname,
        'lastNameMother' => $faker->lastname,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'homePhone' => $faker->unique()->phoneNumber,
        'cellPhone' => $faker->unique()->phoneNumber,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Motive::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
    ];
});
