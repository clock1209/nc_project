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
        'name' => $faker->firstName,
        'lastNameFather' => $faker->lastname,
        'lastNameMother' => $faker->lastname,
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'address' => $faker->streetAddress,
        'homePhone' => $faker->unique()->regexify('/^([0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})$/'),
        'cellPhone' => $faker->unique()->regexify('/^(33-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})$/'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'lastNameFather' => $faker->lastname,
        'lastNameMother' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->streetAddress,
        'homePhone' => $faker->unique()->regexify('/^([0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})$/'),
        'cellPhone' => $faker->unique()->regexify('/^(33-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2})$/'),
    ];
});

$factory->define(App\Products::class, function (Faker\Generator $faker) {
    $costo = $faker->numberBetween(1000, 3000);
    $precio = $costo * 1.30;
    return [
        'code'              => $faker->bothify('????####'),
        'name'              => $faker->word,
        'details'           => $faker->word,
        'category'          => $faker->randomElement($array = array('Oficina', 'Hogar', 'Negocio', 'infantil')),
        'sale_price'        => $precio,     
        'production_cost'   => $costo,
        'quantity'          => $faker->numberBetween($min = 1, $max = 15),
        'description'       => $faker->sentence($nbWords = 5, $variableNbWords = true),
    ];
});

// $factory->define(App\Motive::class, function (Faker\Generator $faker) {
//     return [
//         'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
//     ];
// });

// $factory->define(App\webSupport::class, function (Faker\Generator $faker) {
//     return [
//         'date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = 'now', $timezone = date_default_timezone_get()),
//         'user' => $faker->userName,
//         'client' => $faker->name,
//         'domain' => $faker->domainName,
//         'motive' => $faker->sentence($nbWords = 4, $variableNbWords = true),
//         'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
//         'status' => $faker->randomElement($array = array('En espera del cliente', 'Resuelto', 'Cancelado')),
//         'attentiontime' => $faker->regexify('/^ ?\d{1,2}[hm] (\d{1,2}[m])?$/'),
//     ];
// });
