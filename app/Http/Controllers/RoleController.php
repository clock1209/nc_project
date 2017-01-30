<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleCreateRequest;
use App\Role;
use App\Permission;
use Datatables; 
use Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index')->with('permisos' , Permission::all());
    }

    public function getBtnDatatable()
    {
        $roles = Role::select(['id', 'display_name']);
        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                return '<a href="role/'.$role->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a data-toggle="modal" rol_id="'. $role->id .'" data-target="#permisos" class="btn btn-primary get-permisos"><i class="glyphicon glyphicon-list"></i> Permissions</a>
                <a data-toggle="modal" id_rol="'. $role->id .'" data-target="#mostrar_rol" class="btn btn-info get-rol-datos"><i class="glyphicon glyphicon-info-sign"></i> Mostrar</a>
                <a href="role/delete/'.$role->id.'" class="btn btn-danger" id="btnActionDelete"><i class="glyphicon glyphicon-remove"></i> Borrar</a>
                ';
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
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        Role::create([
            'name' => $request['name'],
            'display_name' => $request['display_name'],
            'description' => $request['description'],
        ]);

        return redirect('role')->with('message','Rol registrado correctante');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return Response::json($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        return view('role.edit', ['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->fill($request->all());
        $role->save();
        

        Session::flash('message', 'Rol Actualizado satisfactoriamente');
        return Redirect::to('/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::whereId($id)->delete();

        Session::flash('message', 'Rol eliminado satisfactoriamente');
        return Redirect::to('/role');
    }
}
