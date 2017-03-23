<?php

use Illuminate\Database\Seeder;

class VentaTotalSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\VentaTotal::class, 100)->create();
    }
}
