<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Motive;

class WebSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
    	$user = User::find(random_int(1, 12));
    	$motive = Motive::find(random_int(1, 10));

    	factory(App\webSupport::class)->create([
    		'user' => $user->username,
    		'motive' => $motive->description,
    	]);

    	$user = User::find(random_int(1, 12));
    	$motive = Motive::find(random_int(1, 10));

    	factory(App\webSupport::class)->create([
    		'user' => $user->username,
    		'motive' => $motive->description,
    	]);

    	$user = User::find(random_int(1, 12));
    	$motive = Motive::find(random_int(1, 10));

    	factory(App\webSupport::class)->create([
    		'user' => $user->username,
    		'motive' => $motive->description,
    	]);

    	$user = User::find(random_int(1, 12));
    	$motive = Motive::find(random_int(1, 10));

    	factory(App\webSupport::class)->create([
    		'user' => $user->username,
    		'motive' => $motive->description,
    	]);

    	$user = User::find(random_int(1, 12));
    	$motive = Motive::find(random_int(1, 10));

    	factory(App\webSupport::class)->create([
    		'user' => $user->username,
    		'motive' => $motive->description,
    	]);

    	
    }
}
