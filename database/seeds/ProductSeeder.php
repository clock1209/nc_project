<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Products::class)->create([
    		'name' => 'puff balón rugby',
    		'details' => 'negro mate',
    		'sale_price' => 450,
    	    'category' => 'Hogar',
    	    'production_cost' => 200,
    	    'description' => 'puff de balón deportivo',
    	    'quantity' => '10',
    	]);

        factory(App\Products::class, 50)->create();
    }
}
