<?php

use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
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
            'product' => 'Puff Balón Rugby',
            'quantity' => 1,
            'unitary_price' => 400,
        	'subtotal' => 400,
        ]);

        $this->createSales();
    }

    protected function createSales()
    {
        for ($i=121; $i < 171 ; $i++) { 
            $product = App\Products::find(random_int(1, 50));
            $cant = rand(1, 3);
            $price = $product->sale_price;
            $res = $cant * $price;

            factory(App\Sale::class)->create([
                'folio' => $i,
                'product' => $product->name,
                'quantity' => $cant,
                'unitary_price' => $price,
                'subtotal' => $res,
            ]);
        }
    }

}
