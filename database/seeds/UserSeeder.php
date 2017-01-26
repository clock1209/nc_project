<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
        	'name' => 'Octavio',
            'lastNameFather' => 'Cornejo',
            'lastNameMother' => 'Trujillo',
            'username' => 'octavio.cornejo',
        	'email' => 'saber_oct@live.com',
        	'password' => bcrypt('123456'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Claudia Elizabeth',
            'lastNameFather' => 'Amezcua',
            'lastNameMother' => 'Gonzalez',
            'username' => 'claudia.amezcua',
            'email' => 'claudia@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class, 10)->create();
    }
}
