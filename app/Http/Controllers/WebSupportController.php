<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Motive;
use App\webSupport;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WebSupportRequest;
use Datatables;
use Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class WebSupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('support.index');
    }

    public function getBtnDatatable()
    {
        $supports = webSupport::select(['id', 'date', 'user', 'client', 'domain', 'motive', 'description', 'status', 'attentiontime']);

        return Datatables::of($supports)
            ->addColumn('action', function ($support) {
                
                return '<a data-toggle="modal" spt_id="'. $support->id .'" data-target="#support" class="btn btn-info get-support"><i class="glyphicon glyphicon-info-sign"></i> Mostrar</a>
                <a href="websupport/'.$support->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <a href="websupport/delete/'.$support->id.'" class="btn btn-danger" id="btnActionDelete"><i class="glyphicon glyphicon-remove"></i> Borrar</a>';
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
        $users = User::pluck('username', 'username');
        $motives = Motive::pluck('description', 'description');

        return view('support.websupport')->with(compact('users', 'motives'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebSupportRequest $request)
    {
      $status = Input::get('radio');
      $user = implode(Input::get('users'));
      $motive = implode(Input::get('motives'));

      $support = webSupport::create([
          'date' => $request['date'],
          'user' => $user,
          'client' => $request['client'],
          'domain' => $request['domain'],
          'motive' => $motive,
          'description' => $request['description'],
          'status' => $status,
          'attentiontime' => $request['attentiontime'],
      ]);

      return redirect('websupport')->with('message','La información se ha guardado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $support = webSupport::find($id);
        return Response::json($support);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $support = webSupport::find($id);
        $users = User::pluck('username', 'username');
        $selUser = $support->user;
        $motives = Motive::pluck('description', 'description');
        $selMotive = $support->motive;
        $selRadio = $support->status;

        return view('support.edit', ['support'=>$support])->with(compact('users', 'selUser', 'motives', 'selMotive', 'selRadio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $support = webSupport::find($id);
        $support->update($request->all());

        Session::flash('message', 'Soporte Actualizado satisfactoriamente');
        return Redirect::to('websupport');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        webSupport::whereId($id)->delete();

        Session::flash('message', 'Soporte Borrado Exitosamente');
        return Redirect::to('websupport');
    }
}
