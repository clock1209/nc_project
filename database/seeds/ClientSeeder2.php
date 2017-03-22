<?php

use Illuminate\Database\Seeder;

class ClientSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Client::class)->create([
        	'name' => 'Pedro',
            'lastNameFather' => 'Sola',
            'lastNameMother' => 'Fernandez',
        	'email' => 'pedro@email.net',
        	'address' => 'delicias #334 col. Miravelle',
        	'homePhone' => '3317334533',
        	'cellPhone' => '',
        ]);

        factory(App\Client::class, 70)->create();
    }
}
