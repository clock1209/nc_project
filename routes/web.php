<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('list-accounts',function(){
		$list_accounts = CpanelWhm::listaccts();

		return $list_accounts;
	});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
	Route::resource('user', 'UserController');
	Route::get('user/edit', 'UserController@Edit');
	Route::get('user/delete/{id}', 'UserController@destroy');

	// 	---------- PERMISSION MIDDLEWARE FOR USERS
	Route::get('user/create',['as'=>'user.create','uses'=>'UserController@create','middleware'=> ['permission:create_user']]);
	Route::post('user/create',['as'=>'user.store','uses'=>'UserController@store','middleware'=> ['permission:create_user']]);
	Route::get('user/{id}/edit',['as'=>'user.edit','uses'=>'UserController@edit','middleware'=> ['permission:edit_user']]);
	Route::get('/user',['as'=>'user.index','uses'=>'UserController@index','middleware'=> ['permission:see_user']]);
	Route::get('user/show',['as'=>'user.show','uses'=>'UserController@show','middleware'=> ['permission:see_user']]);
	Route::get('user/delete',['as'=>'user.destroy','uses'=>'UserController@destroy','middleware'=> ['permission:delete_user']]);

	Route::resource('role', 'RoleController');
	Route::get('role/edit', 'RoleController@edit');
	Route::get('role/delete/{id}', 'RoleController@destroy');

	// 	---------- PERMISSION MIDDLEWARE FOR ROLES
	Route::get('role/create',['as'=>'role.create','uses'=>'RoleController@create','middleware'=> ['permission:create_role']]);
	Route::post('role/create',['as'=>'role.store','uses'=>'RoleController@store','middleware'=> ['permission:create_role']]);
	Route::get('role/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit','middleware'=> ['permission:edit_role']]);
	Route::get('/role',['as'=>'role.index','uses'=>'RoleController@index','middleware'=> ['permission:see_role']]);
	Route::get('role/show',['as'=>'role.show','uses'=>'RoleController@show','middleware'=> ['permission:see_role']]);
	Route::get('role/delete',['as'=>'role.destroy','uses'=>'RoleController@destroy','middleware'=> ['permission:delete_role']]);

	Route::resource('motive', 'MotiveController');
	Route::get('motive/edit', 'MotiveController@Edit');
	Route::get('motive/delete/{id}', 'MotiveController@destroy');

	Route::get('motive/delete',['as'=>'motive.destroy','uses'=>'MotiveController@destroy','middleware'=> ['permission:delete_motive']]);

	Route::resource('websupport', 'WebSupportController');
	Route::get('websupport/edit', 'WebSupportController@Edit');
	Route::get('websupport/delete/{id}', 'WebSupportController@destroy');

	Route::get('websupport/delete',['as'=>'websupport.destroy','uses'=>'WebSupportController@destroy','middleware'=> ['permission:delete_websupport']]);

	Route::get('api/users', 'UserController@getBtnDatatable');
	Route::get('api/roles', 'RoleController@getBtnDatatable');
	Route::get('api/motives', 'MotiveController@getBtnDatatable');
	Route::get('api/websupport', 'WebSupportController@getBtnDatatable');

	Route::get('/permisos','PermissionController@index');
	Route::get('/permisos/asignar','PermissionController@asignar');
	Route::get('/permisos/desasignar','PermissionController@desasignar');

});