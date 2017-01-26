<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Role;
use DB;
use Illuminate\Support\Facades\Hash;
use Datatables; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->beforeFilter('create_user', array('only' => 'create'));
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function getBtnDatatable()
    {
        $users = User::select(['id', 'name', 'email']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a href="user/'.$user->id.'/edit" class="btn btn-xs btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('user')->with('message','User registered successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Entrust::can('edit_user')){
            $user = User::find($id);
            $roles = Role::pluck('display_name', 'id');
            $userRole = $user->roles->pluck('id','id')->toArray();

            return view('user.edit', ['user'=>$user])->with(compact('roles', 'userRole'));
        }else{
            return redirect('/user')->with('unauthorized', "Acceso no autorizado");
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserUpdateRequest $request)
    {
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        // $user->fill($request->all());
        // $user->save();
        

        Session::flash('message', 'User Updated Successfully');
        return Redirect::to('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

         if(Entrust::can('edit_user')){
            User::destroy($id);

            Session::flash('message', 'User Deleted Successfully');
            return Redirect::to('user');
         }else{
            return redirect('user/edit')->with('unauthorized', "Acceso no autorizado");
         }
        
    }
}
