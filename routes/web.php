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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
	Route::resource('user', 'UserController');
	Route::get('user/edit', 'UserController@Edit');

	Route::get('user/create',['as'=>'user.create','uses'=>'UserController@create','middleware'=> ['permission:create_user']]);
	Route::post('user/create',['as'=>'user.store','uses'=>'UserController@store','middleware'=> ['permission:create_user']]);
	Route::get('user/{id}/edit',['as'=>'user.edit','uses'=>'UserController@edit','middleware'=> ['permission:edit_user']]);

	Route::get('api/users', 'UserController@getBtnDatatable');
});



// Entrust::routeNeedsRole('user/create', 'admin', Redirect::to('/home'));

// Route::filter('create_user', function()
// {
//     // check the current user
//     if (!Entrust::can('create_user')) {
//         return Redirect::to('/home');
//     }
// });

// // only users with roles that have the 'manage_posts' permission will be able to access any admin/post route
// Route::when('user/create', 'create_user');