<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Motive;
use App\webSupport;
use App\Domain;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\WebSupportRequest;
use Datatables;
use Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;
use Carbon\Carbon;

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
                
                return $this->botones($support);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    function botones($support)
    {
        $see_websupport = "";
        $edit_websupport = "";
        $delete_websupport = "";
        if(Entrust::can('see_websupport')){
            $see_websupport =
            '<a data-toggle="modal" spt_id="'. $support->id .'" data-target="#support" class="btn btn-info get-support"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_websupport')) {
            $edit_websupport = 
            '<a href="websupport/'.$support->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_websupport')) {
            $delete_websupport = 
            '<a spt_id="'. $support->id .'" class="btn btn-danger" id="btnActionDelete"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_websupport ." ". $edit_websupport ." ". $delete_websupport;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->refreshDomains();
        $users = User::pluck('username', 'username');
        $motives = Motive::pluck('description', 'description');
        $date = Carbon::now();
        $domains = Domain::pluck('domain','domain');

        return view('support.websupport')->with(compact('users', 'motives', 'date', 'domains'));
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
      $domain = Input::get('domains');

      $support = webSupport::create([
          'date' => $request['date'],
          'user' => $user,
          'client' => $request['client'],
          'domain' => $domain,
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
        $domains = Domain::pluck('domain', 'domain');
        $selDomain = $support->domain;

        return view('support.edit', ['support'=>$support])->with(compact('users', 'selUser', 'motives', 'selMotive', 'selRadio', 'domains', 'selDomain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, WebSupportRequest $request)
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
        if(Entrust::can('delete_websupport')){
            webSupport::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/websupport')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         }
    }

    

    public function refreshDomains()
    {   
        $cpanel = new \Gufy\CpanelPhp\Cpanel([
            'host'        =>  env('CP_IP'), // ip or domain complete with its protocol and port
            'username'    =>  env('CP_USERNAME'), // username of your server, it usually root.
            'auth_type'   =>  'password', // set 'hash' or 'password'
            'password'    =>  env('CP_PASSWORD'), // long hash or your user's password 
        ]);

        $data = json_decode($cpanel->listAccounts());

        if($data){
            Domain::truncate();

            foreach ($data->acct as $key => $value) {
                    Domain::create([
                        'domain' => $value->domain,
                    ]);
                }

            $domains = Domain::pluck('domain', 'domain');

            return response()->json(["message"=>"Se han actualizado los dominios correctamente", "domains"=>$domains]);
        }elseif (is_null($data)) {
            return response()->json(["message"=>"Surgió un error al intentar actualizar los dominios"]);
        }
    }


}
