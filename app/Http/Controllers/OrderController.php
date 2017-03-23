<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderCreateRequest;
use Carbon\Carbon;
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

    public function getBtnDatatable()
    {
        $orders = Order::select(['id', 'client', 'user', 'quote_date', 'phone_number', 'email', 'address', 'description', 'budget', 'retainer', 'delivery_date', 'priority', 'status']);

        return Datatables::of($orders)
            ->addColumn('action', function ($order) {
                
                return $this->botones($order);
            })
            ->editColumn('budget', '$ {{$budget}}')
            ->make(true);
    }

    function botones($order)
    {
        $see_order = "";
        $edit_order = "";
        $delete_order = "";
        if(Entrust::can('see_order')){
            $see_order =
            '<a data-toggle="modal" odr_id="'. $order->id .'" data-target="#pedido" class="btn btn-info get-order"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_order')) {
            $edit_order = 
            '<a href="order/'.$order->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_order')) {
            $delete_order = 
            '<a odr_id="'. $order->id .'" class="btn btn-danger" id="btnActionDelete" data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_order ." ". $edit_order ." ". $delete_order;
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
        $delivery_date = Carbon::now()->addDays(3);       

        return view('order.create')->with(compact('status', 'delivery_date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCreateRequest $request)
    {

        // dd($request['date']);
        $order = Order::create([
            'client' => $request['client'],
            'user' => $request['user'],
            'quote_date' => $request['date'],
            'phone_number' => $request['phonenumber'],
            'address' => $request['address'],
            'email' => $request['email'],
            'description' => $request['description'],
            'budget' => $request['budget'],
            'retainer' => $request['retainer'],
            'delivery_date' => $request['deliver_date'],
            'priority' => $request['priority'],
            'status' => $request['status'],
        ]);

        return redirect('order')->with('message','Pedido registrada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $order = Order::find($id);
        return Response::json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Entrust::can('edit_order')){
            $order = Order::find($id);
            $sta_sel = $order['status'];
            $prio_sel = $order['priority'];
            $status = $this->statusList();
            $priority = $this->priorityList();
            // dd($prio_sel);
            return view('order.edit', ['order'=>$order])->with(compact('status', 'priority', 'sta_sel', 'prio_sel'));
        }else{
            return redirect('/order')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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
        $input = $request->all();

        $order = Order::find($id);
        $order->update($input);

        Session::flash('message', 'Pedido Actualizado exitosamente');
        return Redirect::to('/order');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('delete_order')){
            Order::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/order')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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
