<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;
use DB;
use App\Client;
use Response;
use Datatables;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Entrust::can('see_client')){
            return view('client.index')->with('client' , Client::all());
        }else{
            return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
    }

    public function getBtnDatatable()
    {
        $clients = Client::select(['id', 'name','lastNameFather','lastNameMother','email', 'address', 'homePhone', 'cellPhone']);

        return Datatables::of($clients)
            ->addColumn('action', function ($client) {
                
                return $this->botones($client);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

     function botones($client)
    {
        $see_client = "";
        $edit_client = "";
        $delete_client = "";
        if(Entrust::can('see_client')){
            $see_client =
            '<a data-toggle="modal" clt_id="'. $client->id .'" data-target="#cliente" class="btn btn-info get-client"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_client')) {
            $edit_client = 
            '<a href="client/'.$client->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_client')) {
            $delete_client = 
            '<a clt_id="'. $client->id .'" class="btn btn-danger" id="btnActionDelete"
            data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_client ." ". $edit_client ." ". $delete_client;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::pluck('display_name', 'id');

        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientCreateRequest $request)
    {
        $client = Client::create([
            'name' => $request['name'],
            'lastNameFather' => $request['lastNameFather'],
            'lastNameMother' => $request['lastNameMother'],
            'email' => $request['email'],
            'address' => $request['address'],
            'homePhone' => $request['homePhone'],
            'cellPhone' => $request['cellPhone'],
        ]);

        // Mail::send('emails.registered', $request->all(), function($msj) use ($client){
        //     $msj->subject('Bienvenido al portal de NC Mueblería');
        //     $msj->to($client->email);
        // });

        // foreach ($request->input('roles') as $key => $value) {
        //     $client->attachRole($value);
        // }

        return redirect('client')->with('message','Cliente registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(Entrust::can('see_client')){
            $client = Client::find($id);
            // dd($client);

            return Response::json($client);
        // }else{
            // return redirect('client.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(Entrust::can('edit_user')){
            $client = Client::find($id);

            return view('client.edit', ['client'=>$client]);
        // }else{
            // return redirect('/user')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, ClientUpdateRequest $request)
    {
        $input = $request->all();
        // if(!empty($input['password'])){
        //     $input['password'] = Hash::make($input['password']);
        // }else{
        //     $input = array_except($input, array('password'));
        // }

        $client = Client::find($id);
        $client->update($input);

        // foreach ($request->input('roles') as $key => $value) {
        //     $client->attachRole($value);
        // }
        // $client->fill($request->all());
        // $client->save();
        

        Session::flash('message', 'Cliente Actualizado exitosamente');
        return Redirect::to('/client');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(Entrust::can('delete_user')){
            Client::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         // }else{
            // return redirect('/user')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         // }
    }
}
