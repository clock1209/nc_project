<?php

use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* CREATE NEW ROLE'S */
        $owner = new Role();
    	$owner->name         = 'owner';
		$owner->display_name = 'Project Owner'; // optional
		$owner->description  = 'User is the owner of a given project'; // optional
		$owner->save();

		$admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'User Administrator'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		$user = App\User::where('name', '=', 'Octavio Cornejo')->first();

		/* ASSIGN THE ROLE'S  */
        // Role attach alias
        $user->attachRole($admin); // parameter can be an Role object, array, or id

        // or eloquent's original technique
		$user->roles()->attach($admin->id); // id only}}

		/* CREATE NEW PERMISSION'S */
		$createUser = new App\Permission();
		$createUser->name 			= 'create_user';
		$createUser->display_name 	= 'Create User'; /*OPTIONAL*/
		// Allow a user to...
		$createUser->description 	= 'Create a new user'; /*OPTIONAL*/
		$createUser->save();

		$editUser = new App\Permission();
		$editUser->name 			= 'edit_user';
		$editUser->display_name 	= 'Edit User'; /*OPTIONAL*/
		// Allow a user to...
		$editUser->description 	= 'Edit a user'; /*OPTIONAL*/
		$editUser->save();

		/* ASSIGN PERMISSION'S */
		$admin->attachPermission($createUser);

		$owner->attachPermission($createUser);
		$owner->attachPermission($editUser);
    }
}
