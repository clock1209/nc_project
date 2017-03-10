<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Role;
use DB;
use Mail;
use Response;
use Illuminate\Support\Facades\Hash;
use Datatables; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;

class UserController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Entrust::can('see_user')){
            return view('user.index')->with('users' , User::all());
        }else{
            return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
    }

    public function getBtnDatatable()
    {
        $users = User::select(['id', 'name','lastNameFather','lastNameMother','username', 'email', 'address', 'homePhone', 'cellPhone']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                
                return $this->botones($user);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

     function botones($user)
    {
        $see_user = "";
        $edit_user = "";
        $delete_user = "";
        if(Entrust::can('see_user')){
            $see_user =
            '<a data-toggle="modal" usr_id="'. $user->id .'" data-target="#usuario" class="btn btn-info get-user"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_user')) {
            $edit_user = 
            '<a href="user/'.$user->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_user')) {
            $delete_user = 
            '<a usr_id="'. $user->id .'" class="btn btn-danger" id="btnActionDelete"
            data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_user ." ". $edit_user ." ". $delete_user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');

        return view('user.create')->with(compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'lastNameFather' => $request['lastNameFather'],
            'lastNameMother' => $request['lastNameMother'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'homePhone' => $request['homePhone'],
            'cellPhone' => $request['cellPhone'],
        ]);

        Mail::send('emails.registered', $request->all(), function($msj) use ($user){
            $msj->subject('Bienvenido al portal de NC Mueblería');
            $msj->to($user->email);
        });

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect('user')->with('message','Usuario registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Entrust::can('see_user')){
            $user = User::find($id);
            $roles = Role::pluck('display_name', 'id');
            $userRole = $user->roles->pluck('display_name','id')->toArray();

            if (empty($userRole)) {
                $userRole = ["NA"];
            }

            return Response::json([$user, implode($userRole)]);
        }else{
            return redirect('user.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
        
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
            return redirect('/user')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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
        

        Session::flash('message', 'Usuario Actualizado exitosamente');
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
         if(Entrust::can('delete_user')){
            User::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/user')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         }
        
    }
}
