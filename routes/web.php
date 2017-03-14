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

Route::post('websupport/refresh', ['as'=>'websupport.refresh','uses'=>'WebSupportController@refreshDomains']);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
    // 	****************** USERS ROUTES ******************
	Route::get('user/recover', 'UserController@recover');
	Route::resource('user', 'UserController');
	Route::get('user/edit', 'UserController@Edit');
	Route::get('user/delete/{id}', 'UserController@destroy');
	Route::get('user/recovery/{id}', 'UserController@recovery');
	Route::get('user/showTrashed/{id}', 'UserController@showTrashed');

	// 	---------- PERMISSION MIDDLEWARE FOR USERS
	Route::get('user/create',['as'=>'user.create','uses'=>'UserController@create','middleware'=> ['permission:create_user']]);
	Route::post('user/create',['as'=>'user.store','uses'=>'UserController@store','middleware'=> ['permission:create_user']]);
	Route::get('user/{id}/edit',['as'=>'user.edit','uses'=>'UserController@edit','middleware'=> ['permission:edit_user']]);
	Route::get('/user',['as'=>'user.index','uses'=>'UserController@index','middleware'=> ['permission:see_user']]);
	Route::get('/user/recover',['as'=>'user.recover','uses'=>'UserController@recover','middleware'=> ['permission:see_user']]);
	Route::get('user/show',['as'=>'user.show','uses'=>'UserController@show','middleware'=> ['permission:see_user']]);
	Route::get('user/showTrashed',['as'=>'user.showTrashed','uses'=>'UserController@showTrashed','middleware'=> ['permission:see_user']]);
	Route::get('user/delete',['as'=>'user.destroy','uses'=>'UserController@destroy','middleware'=> ['permission:delete_user']]);
	Route::get('user/recovery',['as'=>'user.recovery','uses'=>'UserController@recovery','middleware'=> ['permission:recover_user']]);

	// 	****************** CLIENTS ROUTES ******************
	Route::get('client/recover', 'ClientController@recover');
	Route::resource('client', 'ClientController');
	Route::get('client/edit', 'ClientController@Edit');
	Route::get('client/delete/{id}', 'ClientController@destroy');
	Route::get('client/recovery/{id}', 'ClientController@recovery');
	Route::get('client/showTrashed/{id}', 'ClientController@showTrashed');

	// 	---------- PERMISSION MIDDLEWARE FOR CLIENTS
	Route::get('client/create',['as'=>'client.create','uses'=>'ClientController@create','middleware'=> ['permission:create_client']]);
	Route::post('client/create',['as'=>'client.store','uses'=>'ClientController@store','middleware'=> ['permission:create_client']]);
	Route::get('client/{id}/edit',['as'=>'client.edit','uses'=>'ClientController@edit','middleware'=> ['permission:edit_client']]);
	Route::get('/client',['as'=>'client.index','uses'=>'ClientController@index','middleware'=> ['permission:see_client']]);
	// Route::get('/client/recover',['as'=>'client.recover','uses'=>'ClientController@recover','middleware'=> ['permission:see_client']]);
	Route::get('client/show',['as'=>'client.show','uses'=>'ClientController@show','middleware'=> ['permission:see_client']]);
	Route::get('client/showTrashed',['as'=>'client.showTrashed','uses'=>'ClientController@showTrashed','middleware'=> ['permission:see_client']]);
	Route::get('client/delete',['as'=>'client.destroy','uses'=>'ClientController@destroy','middleware'=> ['permission:delete_client']]);
	Route::get('client/recovery',['as'=>'client.recovery','uses'=>'ClientController@recovery','middleware'=> ['permission:recover_user']]);

	// 	****************** ROLES ROUTES ******************
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

	// 	****************** PRODUCTS ROUTES ******************
	Route::get('product/recover', 'ProductsController@recover');
	Route::resource('product', 'ProductsController');
	Route::get('product/edit', 'ProductsController@edit');
	Route::get('product/delete/{id}', 'ProductsController@destroy');
	Route::get('product/recovery/{id}', 'ProductsController@recovery');
	Route::get('product/showTrashed/{id}', 'ProductsController@showTrashed');

	// 	---------- PERMISSION MIDDLEWARE FOR PRODUCTS
	Route::get('product/create',['as'=>'product.create','uses'=>'ProductsController@create','middleware'=> ['permission:create_product']]);
	Route::post('product/create',['as'=>'product.store','uses'=>'ProductsController@store','middleware'=> ['permission:create_product']]);
	Route::get('product/{id}/edit',['as'=>'product.edit','uses'=>'ProductsController@edit','middleware'=> ['permission:edit_product']]);
	Route::get('/product',['as'=>'product.index','uses'=>'ProductsController@index','middleware'=> ['permission:see_product']]);
	Route::get('product/show',['as'=>'product.show','uses'=>'ProductsController@show','middleware'=> ['permission:see_product']]);
	Route::get('product/delete',['as'=>'product.destroy','uses'=>'ProductsController@destroy','middleware'=> ['permission:delete_product']]);
	Route::get('/product/recover',['as'=>'product.recover','uses'=>'ProductsController@recover','middleware'=> ['permission:see_product']]);
	Route::get('product/showTrashed',['as'=>'product.showTrashed','uses'=>'ProductsController@showTrashed','middleware'=> ['permission:see_product']]);
	Route::get('product/recovery',['as'=>'product.recovery','uses'=>'ProductsController@recovery','middleware'=> ['permission:recover_product']]);

	// 	****************** QUOTES ROUTES ******************
	Route::get('quote/recover', 'QuoteController@recover');
	Route::resource('quote', 'QuoteController');
	Route::get('quote/edit', 'QuoteController@edit');
	Route::get('quote/delete/{id}', 'QuoteController@destroy');
	Route::get('quote/recovery/{id}', 'QuoteController@recovery');
	Route::get('quote/showTrashed/{id}', 'QuoteController@showTrashed');

	// 	---------- PERMISSION MIDDLEWARE FOR QUOTES
	// Route::get('product/create',['as'=>'product.create','uses'=>'ProductsController@create','middleware'=> ['permission:create_product']]);
	// Route::post('product/create',['as'=>'product.store','uses'=>'ProductsController@store','middleware'=> ['permission:create_product']]);
	// Route::get('product/{id}/edit',['as'=>'product.edit','uses'=>'ProductsController@edit','middleware'=> ['permission:edit_product']]);
	// Route::get('/product',['as'=>'product.index','uses'=>'ProductsController@index','middleware'=> ['permission:see_product']]);
	// Route::get('product/show',['as'=>'product.show','uses'=>'ProductsController@show','middleware'=> ['permission:see_product']]);
	// Route::get('product/delete',['as'=>'product.destroy','uses'=>'ProductsController@destroy','middleware'=> ['permission:delete_product']]);
	// Route::get('/product/recover',['as'=>'product.recover','uses'=>'ProductsController@recover','middleware'=> ['permission:see_product']]);
	// Route::get('product/showTrashed',['as'=>'product.showTrashed','uses'=>'ProductsController@showTrashed','middleware'=> ['permission:see_product']]);
	// Route::get('product/recovery',['as'=>'product.recovery','uses'=>'ProductsController@recovery','middleware'=> ['permission:recover_product']]);


	// 	****************** MOTIVES ROUTES ******************
	// Route::resource('motive', 'MotiveController');
	// Route::get('motive/edit', 'MotiveController@Edit');
	// Route::get('motive/delete/{id}', 'MotiveController@destroy');

	// 	---------- PERMISSION MIDDLEWARE FOR MOTIVES
	// Route::get('motive/create',['as'=>'motive.create','uses'=>'MotiveController@create','middleware'=> ['permission:create_motive']]);
	// Route::post('motive/create',['as'=>'motive.store','uses'=>'MotiveController@store','middleware'=> ['permission:create_motive']]);
	// Route::get('motive/{id}/edit',['as'=>'motive.edit','uses'=>'MotiveController@edit','middleware'=> ['permission:edit_motive']]);
	// Route::get('/motive',['as'=>'motive.index','uses'=>'MotiveController@index','middleware'=> ['permission:see_motive']]);
	// Route::get('motive/show',['as'=>'motive.show','uses'=>'MotiveController@show','middleware'=> ['permission:see_motive']]);
	// Route::get('motive/delete',['as'=>'motive.destroy','uses'=>'MotiveController@destroy','middleware'=> ['permission:delete_motive']]);

	// 	****************** WEBSUPPORT ROUTES ******************
	// Route::get('websupport/refresh', ['as'=>'websupport.refresh','uses'=>'WebSupportController@refreshDomains']);
	// Route::resource('websupport', 'WebSupportController');
	// Route::get('websupport/edit', 'WebSupportController@Edit');
	// Route::get('websupport/delete/{id}', 'WebSupportController@destroy');

	// Route::get('websupport/create',['as'=>'websupport.create','uses'=>'WebSupportController@create','middleware'=> ['permission:create_websupport']]);
	// Route::post('websupport/create',['as'=>'websupport.store','uses'=>'WebSupportController@store','middleware'=> ['permission:create_websupport']]);
	// Route::get('websupport/{id}/edit',['as'=>'websupport.edit','uses'=>'WebSupportController@edit','middleware'=> ['permission:edit_websupport']]);
	// Route::get('/websupport',['as'=>'websupport.index','uses'=>'WebSupportController@index','middleware'=> ['permission:see_websupport']]);
	// Route::get('websupport/show',['as'=>'websupport.show','uses'=>'WebSupportController@show','middleware'=> ['permission:see_websupport']]);
	// Route::get('websupport/delete',['as'=>'websupport.destroy','uses'=>'WebSupportController@destroy','middleware'=> ['permission:delete_websupport']]);

	Route::get('api/users', 'UserController@getBtnDatatable');
	Route::get('api/recover', 'UserController@btnRecoverUser');
	Route::get('api/clients', 'ClientController@getBtnDatatable');
	Route::get('api/c_recover', 'ClientController@btnRecoverClient');
	Route::get('api/product', 'ProductsController@getBtnDatatable');
	Route::get('api/pdt_recover', 'ProductsController@btnRecoverProducts');
	Route::get('api/roles', 'RoleController@getBtnDatatable');
	Route::get('api/motives', 'MotiveController@getBtnDatatable');
	Route::get('api/websupport', 'WebSupportController@getBtnDatatable');
	Route::get('api/reports/{date1}/{username}/{status}/{date2?}', 'ReportController@buildDatatable');
	// 	****************** PERMISSION ROUTES ******************
	Route::get('/permisos','PermissionController@index');
	Route::get('/permisos/asignar','PermissionController@asignar');
	Route::get('/permisos/desasignar','PermissionController@desasignar');

	// 	****************** REPORT ROUTES ******************
	// Route::resource('report', 'ReportController');
	// Route::post('report/result',['as'=>'report.result','uses'=>'ReportController@result']);
	// Route::get('report/searchby/{data}',['as'=>'report.searchby','uses'=>'ReportController@radio']);

	// 	****************** TICKET ROUTES ******************
	// Route::resource('ticket', 'TicketController');

	/* datatable charge */
	// Route::get('api/ticket', 'TicketController@getBtnDatatable');
});