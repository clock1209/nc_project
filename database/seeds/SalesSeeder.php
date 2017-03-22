<?php

use Illuminate\Database\Seeder;


class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        


            factory(App\Sale::class)->create([
            	'folio' => 120,
            	'product' => 'puff balón rugby',
            	'quantity' => 1,
                'unitary_price' => 450,
                'subtotal' => 450,
            ]);

            factory(App\VentaTotal::class)->create([
            	'folio' => 120,
            	'id_client' => 1,
            	'id_user' => 1,
                'client' => 'Pedro Sola Fernandez',
                'user' => 'octavio.cornejo',
                'total' => 450,
            ]);
        
    }
}
