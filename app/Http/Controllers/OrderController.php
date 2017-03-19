<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Client;
use App\Quote;
use Illuminate\Support\Facades\Input;
use Datatables;
use Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Entrust;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Entrust::can('see_client')){
            return view('order.index')->with('order' , Order::all());
        // }else{
            // return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        // } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd($request);
        // $date = $request['quote_date'];
        // $client = $request['client'];
        
        $status = $this->statusList();        

        return view('order.create')->with(compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request);
        $order = Order::create([
            'name' => $request['name'],
            'lastNameFather' => $request['lastNameFather'],
            'lastNameMother' => $request['lastNameMother'],
            'email' => $request['email'],
            'address' => $request['address'],
            'homePhone' => $request['homePhone'],
            'cellPhone' => $request['cellPhone'],
        ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function statusList()
    {
        $array = [
            'En progreso',
            'Detenido',
            'Listo',
            'Entregado'
        ];

        return $array;
    }
}
