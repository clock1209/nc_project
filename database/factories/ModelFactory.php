<?php

use Carbon\Carbon;
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
    $costo = $faker->numberBetween(400, 2000);
    $precio = $costo * 1.40;
    return [
        'name'              => $faker->product,
        'details'           => $faker->color,
        'category'          => $faker->randomElement($array = array('Oficina', 'Hogar', 'Negocio', 'infantil')),
        'sale_price'        => $precio,     
        'production_cost'   => $costo,
        'quantity'          => $faker->numberBetween($min = 1, $max = 15),
        'description'       => $faker->sentence($nbWords = 5, $variableNbWords = true),
    ];
});

$factory->define(App\Sale::class, function (Faker\Generator $faker) {
    // $folio 
        $r = null;
       $product = App\Products::find(random_int(1, 50));
         $folio = App\Sale::all('folio');

        foreach($folio as $fol){
            $r = $fol->folio;
        }
        $resfolio = $r + 1;
       // $resfolio = 120;
       $cant = $faker->numberBetween($min = 1, $max = 3);
       $price = $product->sale_price;
       $res = $cant * $price;

       return [
       'folio' => $resfolio,
       'product' => $product->name,
       'quantity' => $cant,
       'unitary_price' => $price,
       'subtotal' => $res,
       ];
    
   
});

$factory->define(App\Quote::class, function (Faker\Generator $faker) {
    $client = App\Client::find(random_int(1, 70));
    $nclient = $client->name .' '. $client->lastNameFather .' '. $client->lastNameMother;
    $user = App\User::find(random_int(1, 32));
    $phone = ($client->cellPhone == null) ? $client->homePhone : $client->cellPhone;
    $date = $faker->dateTimeBetween($startDate = '-4 days', $endDate = 'now', $timezone = date_default_timezone_get());
    $tomorrow = Carbon::tomorrow();
    // $expDate = Carbon::createFromFormat('Y-m-d', $tomorrow)->toDateString();
    // $expDate = $expDate->addDays(5);


    return [
        'client' => $nclient,
        'user' => $user->username,
        'quote_date' => $date,
        'phone_number' => $phone,
        'email' => $client->email,
        'address' => $client->address,
        'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'budget' => $faker->randomFloat($nbMaxDecimals = 0, $min = 500, $max = 3000),
        'expiration_date' => $tomorrow,
        'status' => 'Detenido',
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    $client = App\Client::find(random_int(1, 70));
    $nclient = $client->name .' '. $client->lastNameFather .' '. $client->lastNameMother;
    $user = App\User::find(random_int(1, 32));
    $phone = ($client->cellPhone == null) ? $client->homePhone : $client->cellPhone;
    $date = $faker->dateTimeBetween($startDate = '-4 days', $endDate = 'now', $timezone = date_default_timezone_get());
    $dedate = $faker->dateTimeBetween($startDate = 'now', $endDate = '5 days', $timezone = date_default_timezone_get());
    $presupuesto = $faker->randomFloat($nbMaxDecimals = 0, $min = 500, $max = 3000);
    $anticipo = $presupuesto * .30;

    return [
        'client' => $nclient,
        'user' => $user->username,
        'quote_date' => $date,
        'phone_number' => $phone,
        'email' => $client->email,
        'address' => $client->address,
        'description' => $faker->sentence($nbWords = 4, $variableNbWords = true),
        'budget' => $presupuesto,
        'retainer' => $anticipo,
        'delivery_date' => $dedate,
        'priority' => $faker->randomElement($array = array('Alta', 'Normal', 'Baja')),
        'status' => $faker->randomElement($array = array('En progreso', 'Detenido', 'Listo', 'Entregado')),
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
