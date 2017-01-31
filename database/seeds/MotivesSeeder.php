<?php

use Illuminate\Database\Seeder;

class MotivesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Motive::class, 10)->create();
    }
}
