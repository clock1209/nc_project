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

Route::get('altademotivos', function () {
    return view('support.altademotivos');
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

	// 	---------- PERMISSION MIDDLEWARE FOR ROLES
	Route::get('role/create',['as'=>'role.create','uses'=>'RoleController@create','middleware'=> ['permission:create_role']]);
	Route::post('role/create',['as'=>'role.store','uses'=>'RoleController@store','middleware'=> ['permission:create_role']]);
	Route::get('role/{id}/edit',['as'=>'role.edit','uses'=>'RoleController@edit','middleware'=> ['permission:edit_role']]);
	Route::get('/role',['as'=>'role.index','uses'=>'RoleController@index','middleware'=> ['permission:see_role']]);
	Route::get('role/show',['as'=>'role.show','uses'=>'RoleController@show','middleware'=> ['permission:see_role']]);
	Route::get('role/delete',['as'=>'role.destroy','uses'=>'RoleController@destroy','middleware'=> ['permission:delete_role']]);

	Route::resource('role', 'RoleController');
	Route::get('role/edit', 'RoleController@edit');
	Route::get('role/delete/{id}', 'RoleController@destroy');

	Route::get('api/users', 'UserController@getBtnDatatable');
	Route::get('api/roles', 'RoleController@getBtnDatatable');

	Route::get('/permisos','PermissionController@index');
	Route::get('/permisos/asignar','PermissionController@asignar');
	Route::get('/permisos/desasignar','PermissionController@desasignar');

	Route::resource('support', 'SupportController');
	Route::get('support/altademotivos', 'SupportController@altademotivos');
});