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
        	'email' => 'octavio@example.com',
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

        factory(App\User::class)->create([
            'name' => 'Blas Emmanuel',
            'lastNameFather' => 'Jimenez',
            'lastNameMother' => 'Sedano',
            'username' => 'conejo.blas',
            'email' => 'blas@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Jouse',
            'lastNameFather' => 'Rodriguez',
            'lastNameMother' => 'Velazquez',
            'username' => 'joshu.gogo',
            'email' => 'josue@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Adan',
            'lastNameFather' => 'Jimenez',
            'lastNameMother' => 'Sedano',
            'username' => 'adan.peluca',
            'email' => 'adan@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Joceline',
            'lastNameFather' => 'Diaz',
            'lastNameMother' => 'Velasquez',
            'username' => 'joss.stop',
            'email' => 'joceline@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class)->create([
            'name' => 'Manuel',
            'lastNameFather' => 'Esmerio',
            'lastNameMother' => 'Baez',
            'username' => 'chapo.esmerio',
            'email' => 'esmerio@example.com',
            'password' => bcrypt('123456'),
        ]);

        factory(App\User::class, 15)->create();
    }
}
