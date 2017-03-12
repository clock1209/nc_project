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
        $normalUser = new App\Role();
    	$normalUser->name         = 'user';
		$normalUser->display_name = 'Usuario'; // optional
		$normalUser->description  = 'Usuario sin privilegios'; // optional
		$normalUser->save();

		$admin = new App\Role();
		$admin->name         = 'admin';
		$admin->display_name = 'Admin'; // optional
		$admin->description  = 'Usuario con todos los privilegios'; // optional
		$admin->save();




		/* CREATE NEW USER'S PERMISSION'S */
		$createUser = new App\Permission();
		$createUser->name 			= 'create_user';
		$createUser->display_name 	= 'Crear Usuario'; /*OPTIONAL*/
		$createUser->description 	= 'Permite crear un nuevo usuario'; /*OPTIONAL*/
		$createUser->save();

		$editUser = new App\Permission();
		$editUser->name 			= 'edit_user';
		$editUser->display_name 	= 'Editar Usuario'; /*OPTIONAL*/
		$editUser->description 	= 'permite editar un usuario existente'; /*OPTIONAL*/
		$editUser->save();

		$seeUser = new App\Permission();
		$seeUser->name 			= 'see_user';
		$seeUser->display_name 	= 'Ver Lista de Usuarios'; /*OPTIONAL*/
		$seeUser->description 	= 'Permite ver la lista de usuarios'; /*OPTIONAL*/
		$seeUser->save();

		$deleteUser = new App\Permission();
		$deleteUser->name 			= 'delete_user';
		$deleteUser->display_name 	= 'Borrar Usuario'; /*OPTIONAL*/
		$deleteUser->description 	= 'Permite borrar un usuario existente'; /*OPTIONAL*/
		$deleteUser->save();

		$recoverUser = new App\Permission();
		$recoverUser->name 			= 'recover_user';
		$recoverUser->display_name 	= 'Recuperar Usuario'; /*OPTIONAL*/
		$recoverUser->description 	= 'Permite recuperar un usuario eliminado'; /*OPTIONAL*/
		$recoverUser->save();

		/* CREATE NEW CLIENT'S PERMISSION'S */
		$createClient = new App\Permission();
		$createClient->name 			= 'create_client';
		$createClient->display_name 	= 'Crear Cliente'; /*OPTIONAL*/
		$createClient->description 	= 'Permite crear un nuevo cliente'; /*OPTIONAL*/
		$createClient->save();

		$editClient = new App\Permission();
		$editClient->name 			= 'edit_client';
		$editClient->display_name 	= 'Editar Cliente'; /*OPTIONAL*/
		$editClient->description 	= 'permite editar un cliente existente'; /*OPTIONAL*/
		$editClient->save();

		$seeClient = new App\Permission();
		$seeClient->name 			= 'see_client';
		$seeClient->display_name 	= 'Ver Lista de Clientes'; /*OPTIONAL*/
		$seeClient->description 	= 'Permite ver la lista de clientes'; /*OPTIONAL*/
		$seeClient->save();

		$deleteClient = new App\Permission();
		$deleteClient->name 			= 'delete_client';
		$deleteClient->display_name 	= 'Borrar Cliente'; /*OPTIONAL*/
		$deleteClient->description 	= 'Permite borrar un cliente existente'; /*OPTIONAL*/
		$deleteClient->save();

		$recoverClient = new App\Permission();
		$recoverClient->name 			= 'recover_client';
		$recoverClient->display_name 	= 'Recuperar Cliente'; /*OPTIONAL*/
		$recoverClient->description 	= 'Permite recuperar un cliente eliminado'; /*OPTIONAL*/
		$recoverClient->save();

		/* CREATE NEW ROLE'S PERMISSION'S */
		$createRole = new App\Permission();
		$createRole->name 			= 'create_role';
		$createRole->display_name 	= 'Crear Rol'; /*OPTIONAL*/
		$createRole->description 	= 'Permite crear un nuevo rol'; /*OPTIONAL*/
		$createRole->save();

		$editRole = new App\Permission();
		$editRole->name 			= 'edit_role';
		$editRole->display_name 	= 'Editar Rol'; /*OPTIONAL*/
		$editRole->description 	= 'Permite editar un rol existente'; /*OPTIONAL*/
		$editRole->save();

		$seeRole = new App\Permission();
		$seeRole->name 			= 'see_role';
		$seeRole->display_name 	= 'Ver lista de roles'; /*OPTIONAL*/
		$seeRole->description 	= 'Permite ver la lista de usuarios'; /*OPTIONAL*/
		$seeRole->save();

		$deleteRole = new App\Permission();
		$deleteRole->name 			= 'delete_role';
		$deleteRole->display_name 	= 'Borrar Rol'; /*OPTIONAL*/
		$deleteRole->description 	= 'Permite borrar un rol existente'; /*OPTIONAL*/
		$deleteRole->save();

		$assignPermission = new App\Permission();
		$assignPermission->name 			= 'assign_permission';
		$assignPermission->display_name 	= 'Asignar Permiso'; /*OPTIONAL*/
		$assignPermission->description 	= 'Permite asignar permisos a un rol'; /*OPTIONAL*/
		$assignPermission->save();

		/* CREATE NEW PRODUCTS'S PERMISSION'S */
		$createProduct = new App\Permission();
		$createProduct->name 			= 'create_product';
		$createProduct->display_name 	= 'Crear Producto'; /*OPTIONAL*/
		$createProduct->description 	= 'Permite crear un nuevo producto'; /*OPTIONAL*/
		$createProduct->save();

		$editProduct = new App\Permission();
		$editProduct->name 			= 'edit_product';
		$editProduct->display_name 	= 'Editar Producto'; /*OPTIONAL*/
		$editProduct->description 	= 'permite editar un producto existente'; /*OPTIONAL*/
		$editProduct->save();

		$seeProduct = new App\Permission();
		$seeProduct->name 			= 'see_product';
		$seeProduct->display_name 	= 'Ver Lista de Productos'; /*OPTIONAL*/
		$seeProduct->description 	= 'Permite ver la lista de productos'; /*OPTIONAL*/
		$seeProduct->save();

		$deleteProduct = new App\Permission();
		$deleteProduct->name 			= 'delete_product';
		$deleteProduct->display_name 	= 'Borrar Producto'; /*OPTIONAL*/
		$deleteProduct->description 	= 'Permite borrar un producto existente'; /*OPTIONAL*/
		$deleteProduct->save();

		$recoverProduct = new App\Permission();
		$recoverProduct->name 			= 'recover_product';
		$recoverProduct->display_name 	= 'Recuperar Producto'; /*OPTIONAL*/
		$recoverProduct->description 	= 'Permite recuperar un producto eliminado'; /*OPTIONAL*/
		$recoverProduct->save();

		/* CREATE NEW MOTIVE'S PERMISSION'S */
		// $createMotive = new App\Permission();
		// $createMotive->name 			= 'create_motive';
		// $createMotive->display_name 	= 'Create Motive'; /*OPTIONAL*/
		// $createMotive->description 	= 'Create a new motive'; /*OPTIONAL*/
		// $createMotive->save();

		// $editMotive = new App\Permission();
		// $editMotive->name 			= 'edit_motive';
		// $editMotive->display_name 	= 'Edit Motive'; /*OPTIONAL*/
		// $editMotive->description 	= 'Edit a motive'; /*OPTIONAL*/
		// $editMotive->save();

		// $seeMotive = new App\Permission();
		// $seeMotive->name 			= 'see_motive';
		// $seeMotive->display_name 	= 'See Motives List'; /*OPTIONAL*/
		// $seeMotive->description 	= 'See Motives list'; /*OPTIONAL*/
		// $seeMotive->save();

		// $deleteMotive = new App\Permission();
		// $deleteMotive->name 			= 'delete_motive';
		// $deleteMotive->display_name 	= 'Delete Motive'; /*OPTIONAL*/
		// $deleteMotive->description 	= 'Delete a motive'; /*OPTIONAL*/
		// $deleteMotive->save();

		/* CREATE NEW webSUPPORT'S PERMISSION'S */
		// $createWebSupport = new App\Permission();
		// $createWebSupport->name 			= 'create_websupport';
		// $createWebSupport->display_name 	= 'Create Web Support'; /*OPTIONAL*/
		// $createWebSupport->description 	= 'Create a new web support'; /*OPTIONAL*/
		// $createWebSupport->save();

		// $editWebSupport = new App\Permission();
		// $editWebSupport->name 			= 'edit_websupport';
		// $editWebSupport->display_name 	= 'Edit Web Support'; /*OPTIONAL*/
		// $editWebSupport->description 	= 'Edit a web support'; /*OPTIONAL*/
		// $editWebSupport->save();

		// $seeWebSupport = new App\Permission();
		// $seeWebSupport->name 			= 'see_websupport';
		// $seeWebSupport->display_name 	= 'See Web Support List'; /*OPTIONAL*/
		// $seeWebSupport->description 	= 'See Web Support list'; /*OPTIONAL*/
		// $seeWebSupport->save();

		// $deleteWebSupport = new App\Permission();
		// $deleteWebSupport->name 			= 'delete_websupport';
		// $deleteWebSupport->display_name 	= 'Delete Web Support'; /*OPTIONAL*/
		// $deleteWebSupport->description 	= 'Delete a web support'; /*OPTIONAL*/
		// $deleteWebSupport->save();

		/* 
			ASSIGN PERMISSION'S 
		*/
			//TO ADMIN
		$normalUser->attachPermission($seeUser);
		$normalUser->attachPermission($seeRole);
		// $normalUser->attachPermission($seeMotive);

		$admin->attachPermission($createUser);
		$admin->attachPermission($editUser);
		$admin->attachPermission($seeUser);
		$admin->attachPermission($deleteUser);
		$admin->attachPermission($recoverUser);

		$admin->attachPermission($createRole);
		$admin->attachPermission($editRole);
		$admin->attachPermission($seeRole);
		$admin->attachPermission($deleteRole);
		$admin->attachPermission($assignPermission);

		$admin->attachPermission($createClient);
		$admin->attachPermission($editClient);
		$admin->attachPermission($seeClient);
		$admin->attachPermission($deleteClient);
		$admin->attachPermission($recoverClient);

		$admin->attachPermission($createProduct);
		$admin->attachPermission($editProduct);
		$admin->attachPermission($seeProduct);
		$admin->attachPermission($deleteProduct);
		$admin->attachPermission($recoverProduct);
		// $admin->attachPermission($createMotive);
		// $admin->attachPermission($editMotive);
		// $admin->attachPermission($seeMotive);
		// $admin->attachPermission($deleteMotive);
		// $admin->attachPermission($createWebSupport);
		// $admin->attachPermission($editWebSupport);
		// $admin->attachPermission($seeWebSupport);
		// $admin->attachPermission($deleteWebSupport);

		$user = User::find(1);
		$user->attachRole($admin);

		$user = User::find(2);
		$user->attachRole($normalUser);

		$user = User::find(3);
		$user->attachRole($normalUser);

		$user = User::find(4);
		$user->attachRole($admin);

		$user = User::find(5);
		$user->attachRole($admin);

		$user = User::find(6);
		$user->attachRole($normalUser);
    }
}
