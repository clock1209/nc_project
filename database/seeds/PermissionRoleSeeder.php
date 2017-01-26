<?php

use Illuminate\Database\Seeder;
use App\User;

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
        $owner = new App\Role();
    	$owner->name         = 'owner';
		$owner->display_name = 'Owner'; // optional
		$owner->description  = 'User is the owner of a given project'; // optional
		$owner->save();

		$admin = new App\Role();
		$admin->name         = 'admin';
		$admin->display_name = 'Admin'; // optional
		$admin->description  = 'User is allowed to manage and edit other users'; // optional
		$admin->save();

		// $user = App\User::where('name', '=', 'Octavio Cornejo')->first();

		// /* ASSIGN THE ROLE'S  */
  //       // Role attach alias
  //       $user->attachRole($owner); // parameter can be an Role object, array, or id

  //       // or eloquent's original technique
		// $user->roles()->attach($admin->id); // id only}}

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

		$seeUser = new App\Permission();
		$seeUser->name 			= 'see_user';
		$seeUser->display_name 	= 'See Users List'; /*OPTIONAL*/
		// Allow a user to...
		$seeUser->description 	= 'See users list'; /*OPTIONAL*/
		$seeUser->save();

		$deleteUser = new App\Permission();
		$deleteUser->name 			= 'delete_user';
		$deleteUser->display_name 	= 'Delete User'; /*OPTIONAL*/
		// Allow a user to...
		$deleteUser->description 	= 'Delete a user'; /*OPTIONAL*/
		$deleteUser->save();

		/* ASSIGN PERMISSION'S */
		$admin->attachPermission($seeUser);

		$owner->attachPermission($createUser);
		$owner->attachPermission($editUser);
		$owner->attachPermission($seeUser);
		$owner->attachPermission($deleteUser);

		$user = User::find(1);
		$user->attachRole($owner);

		$user = User::find(2);
		$user->attachRole($admin);
    }
}
