<?php

use Illuminate\Database\Seeder;

class VentaTotalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\VentaTotal::class, 70)->create();
    }
}
