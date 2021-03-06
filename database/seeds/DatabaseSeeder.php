<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
    	$this->call(PermissionRoleSeeder::class);
        $this->call(ClientSeeder2::class);
        $this->call(ProductSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(QuoteSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(VentaTotalSeeder::class);
    }
}
