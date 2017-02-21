<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Motive;
use Datatables; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;

class MotiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('motive.index');
    }

    public function altademotivos()
    {
        return view('support.altademotivos');
    }

    public function getBtnDatatable()
    {
        $motives = Motive::select(['id', 'description']);

        return Datatables::of($motives)
            ->addColumn('action', function ($motive) {
                
                return $this->botones($motive);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    function botones($motive)
    {
        $see_motive = "";
        $edit_motive = "";
        $delete_motive = "";
        if(Entrust::can('see_motive')){
            $see_motive =
            '<a data-toggle="modal" mtv_id="'. $motive->id .'" data-target="#motive" class="btn btn-info  get-motive"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if(Entrust::can('edit_motive')){
            $edit_motive =
            '<a href="motive/'.$motive->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_motive')) {
            $delete_motive = 
            '<a mtv_id="'. $motive->id .'" class="btn btn-danger" id="btnActionDelete"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_motive ." ". $edit_motive ." ". $delete_motive;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('motive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Motive::create([
            'description' => $request['description'],
        ]);

        return redirect('motive')->with('message','Motivo registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motive = Motive::find($id);
        return Response::json($motive);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motive = Motive::find($id);
            
        return view('motive.edit', ['motive'=>$motive]);
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
        $motive = Motive::find($id);
        $motive->fill($request->all());
        $motive->save();
        

        Session::flash('message', 'Motivo Actualizado satisfactoriamente');
        return Redirect::to('/motive');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('delete_motive')){
            Motive::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/motive')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         }
    }
}
