<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuoteCreateRequest;
use Carbon\Carbon;
use App\Client;
use App\Quote;
use Illuminate\Support\Facades\Input;
use Datatables;
use Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quote.index');
    }

    public function recover()
    {
         if(Entrust::can('recover_quote')){
            return view('quote.recover')->with('quotes' , Quote::all());
        }else{
            return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
    }

    public function getBtnDatatable()
    {
        $quotes = Quote::select(['id', 'client', 'user', 'quote_date', 'phone_number', 'email', 'address', 'description', 'budget', 'expiration_date','type', 'status']);

        return Datatables::of($quotes)
            ->addColumn('action', function ($quote) {
                
                return $this->botones($quote);
            })
            ->editColumn('budget', '$ {{$budget}}')
            ->make(true);
    }

    function botones($quote)
    {
        $see_quote = "";
        $edit_quote = "";
        $delete_quote = "";
        if(Entrust::can('see_quote')){
            $see_quote =
            '<a data-toggle="modal" qt_id="'. $quote->id .'" data-target="#cotizacion" class="btn btn-info get-quote"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_quote')) {
            $edit_quote = 
            '<a href="quote/'.$quote->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_quote')) {
            $delete_quote = 
            '<a qt_id="'. $quote->id .'" class="btn btn-danger" id="btnActionDelete" data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_quote ." ". $edit_quote ." ". $delete_quote;
    }

    public function btnRecoverQuote()
    {
        $quotes = Quote::select(['id', 'client', 'user', 'quote_date', 'phone_number', 'email', 'address', 'description', 'budget', 'expiration_date','type', 'status'])->onlyTrashed()->get();

        return Datatables::of($quotes)
            ->addColumn('action', function ($quote) {
                
                return $this->recoveryBtn($quote);
            })
            ->editColumn('budget', '$ {{$budget}}')
            ->make(true);
    }

    function recoveryBtn($quote)
    {
        // dd($quote->id);
        $see_quote = "";
        // $edit_quote = "";
        $recover_quote = "";
        if(Entrust::can('see_quote')){
            $see_quote =
            '<a data-toggle="modal" qt_id="'. $quote->id .'" data-target="#cotizacion" class="btn btn-info get-quote"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('recover_quote')) {
            $recover_quote = 
            '<a qt_id="'. $quote->id .'" class="btn btn-primary" id="btnActionRecover"
            data-toggle="confirmation"><i class="glyphicon glyphicon-floppy-open"></i> <t class="hidden-xs">Recuperar</t></a>';
        }

        return $see_quote ." ". $recover_quote;
    }

    public function recovery($id)
    {
        if(Entrust::can('recover_quote')){
            $quote = Quote::onlyTrashed()->where('id', $id)->restore();
            // dd($quote);

            return response()->json(["message"=>"authorized"]);
        }else{
            return redirect('quote.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cli = Client::all();
        // $client = Client::pluck('name', 'lastNameFather', 'lastNameMother');
        foreach ($cli as $key => $value) {
            $clients[$key] =  $value->name . " ". $value->lastNameFather . " " . $value->lastNameMother;
        }

        $date = Carbon::now();
        $exp_date = Carbon::now()->addDays(5);

        return view('quote.create')->with(compact('date', 'exp_date', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuoteCreateRequest $request)
    {
      if(Input::get('order') == 'on'){
          $type = Input::get('radio');
          $user = Input::get('username');
          $date = Input::get('date');
          $exp_date = Input::get('expiration_date');
          // dd($exp_date);
          $client = Input::get('client');
          $budget = Input::get('budget');
          $phonenumber = Input::get('phone_number');
          $address = Input::get('address');
          $description = Input::get('description');
          $email = Input::get('email');
          $status = $this->statusList();
          $priority = $this->priorityList();

          if ($client == null) {
            $client = 'Cliente Mostrador';
            $phonenumber = 'NA';
            $address = 'NA';
            $email = 'NA';
          }

          $delivery_date = Carbon::now()->addDays(3); 

          return view('order.create')->with(compact('date', 'exp_date', 'client', 'budget', 'status', 'priority', 'phonenumber', 'email', 'address', 'description','delivery_date'));
      }else{
        $type = Input::get('radio');
        $user = Input::get('username');
                // dd($request);

        $quote = Quote::create([
          'client' => $request['client'],
          'user' => $user,
          'quote_date' => $request['date'],
          'phone_number' => $request['phone_number'],
          'email' => $request['email'],
          'address' => $request['address'],
          'description' => $request['description'],
          'budget' => $request['budget'],
          'type' => $type,
          'expiration_date' => $request['expiration_date'],
          ]);

                // dd($request);
        return redirect('quote')->with('message','La información se ha guardado.');
      }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::find($id);
        return Response::json($quote);
    }

    public function showTrashed($id)
    {
        if(Entrust::can('see_quote')){
            $quote = Quote::onlyTrashed()->where('id', $id)->get();

            return Response::json($quote);
        }else{
            return redirect('quote.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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
        if(Entrust::can('edit_quote')){
            $quote = Quote::find($id);
            // dd($quote);
            return view('quote.edit', ['quote'=>$quote]);
        }else{
            return redirect('/quote')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
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

      if(Input::get('order') == 'on'){
          $type = Input::get('radio');
          $user = Input::get('username');
          $date = Input::get('quote_date');
          $exp_date = Input::get('expiration_date');
          // dd($exp_date);
          $client = Input::get('client');
          $budget = Input::get('budget');
          $phonenumber = Input::get('phone_number');
          $address = Input::get('address');
          $description = Input::get('description');
          $email = Input::get('email');
          $status = $this->statusList();
          $priority = $this->priorityList();

          if ($client == null) {
            $client = 'Cliente Mostrador';
            $phonenumber = 'NA';
            $address = 'NA';
            $email = 'NA';
          }

           Quote::whereId($id)->delete();

          $delivery_date = Carbon::now()->addDays(3); 

          return view('order.create')->with(compact('date', 'exp_date', 'client', 'budget', 'status', 'priority', 'phonenumber', 'email', 'address', 'description','delivery_date'));
      }else{
        // $type = Input::get('radio');
        // $user = Input::get('username');
        //         // dd($request);

        // $quote = Quote::create([
        //   'client' => $request['client'],
        //   'user' => $user,
        //   'quote_date' => $request['date'],
        //   'phone_number' => $request['phone_number'],
        //   'email' => $request['email'],
        //   'address' => $request['address'],
        //   'description' => $request['description'],
        //   'budget' => $request['budget'],
        //   'type' => $type,
        //   'expiration_date' => $request['expiration_date'],
        //   ]);

        //         // dd($request);
        // return redirect('quote')->with('message','La información se ha guardado.');
        $input = $request->all();

        $quote = Quote::find($id);
        $quote->update($input);

        Session::flash('message', 'Cotización Actualizada exitosamente');
        return Redirect::to('/quote');
      }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('delete_quote')){
            Quote::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/quote')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         }
    }

    private function statusList()
    {
        $array = [
            'En progreso' => 'En progreso',
            'Detenido' => 'Detenido',
            'Listo' => 'Listo',
            'Entregado' => 'Entregado'
        ];

        return $array;
    }

    private function priorityList()
    {
        $array = [
            'Normal' => 'Normal',
            'Baja' => 'Baja',
            'Alta' => 'Alta',
        ];

        return $array;
    }


}
