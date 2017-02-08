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

$factory->define(App\webSupport::class, function (Faker\Generator $faker) {
    return [
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user' => $faker->userName,
        'client' => $faker->name,
        'domain' => $faker->domainName,
        'motive' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'status' => $faker->randomElement($array = array('En espera del cliente', 'Resuelto', 'Cancelado')),
        'attentiontime' => $faker->regexify('/^ ?\d{1,2}[hm] (\d{1,2}[m])?$/'),
    ];
});
