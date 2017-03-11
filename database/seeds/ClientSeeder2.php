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
        factory(App\Client::class, 70)->create();
    }
}
