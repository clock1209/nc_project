<?php

use Illuminate\Database\Seeder;

class QuoteSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Quote::class, 30)->create();
    }
}
