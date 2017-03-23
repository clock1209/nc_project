<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Products;
use App\Client;
use App\Sale;
use App\VentaTotal;
use Response;
use Entrust;
use PDF;
use DB;
use Auth;
use Datatables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index sales');
    }

    public function saleDone()
    {

        // $venta_total = VentaTotal::all()->where('folio', $request->folio);
        $sale = Sale::all()->where('folio', 207);
        // foreach ($sale as $key => $value) {
        // dd($value->unitary_price);
        //     # code...
        // }

        $pdf = PDF::loadView('pdf.pdfVentas', ['sale'=>$sale]);

        return $pdf->download('archivo.pdf');
        return view('sale.done');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $pdf = PDF::loadView('pdfVentas');

        // return $pdf->download('archivo.pdf');

        $cli = Client::all();
        foreach ($cli as $key => $value) {
            $clients[$key] =  $value->name . " ". $value->lastNameFather . " " . $value->lastNameMother;
        }

        $date = Carbon::now();

        return view('sale.create')->with('product' , Products::all())->with(compact('clients', 'date'));
    }

    public function getBtnDatatable()
    {
        $products = Products::select(['id','name', 'details', 'category','sale_price', 'production_cost', 'description', 'quantity'])
                ->where('quantity', '!=', '=>0');

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                
                return '<a data-toggle="modal" pdt_id="'. $product->id .'" data-target="#producto" class="btn btn-info get-product"><i class="glyphicon glyphicon-info-sign"></i></a>
                    <a pdt_id="'. $product->id .'" class="btn btn-success" id="btnAdd"
                    data-toggle="confirmation"><i class="glyphicon glyphicon-plus"></i></a>';
            })
            ->make(true);
    }

    public function getBtnDatatableClt()
    {
        $clients = Client::select(['id', 'name','lastNameFather','lastNameMother','email', 'address', 'homePhone', 'cellPhone']);

        return Datatables::of($clients)
            ->addColumn('action', function ($client) {
                
                return '<a data-toggle="modal" clt_id="'. $client->id .'" data-target="#cliente" class="btn btn-info get-client"><i class="glyphicon glyphicon-info-sign"></i></a>
                    <a clt_id="'. $client->id .'" class="btn btn-success" id="ClienteAdd"
                    data-toggle="confirmation"><i class="glyphicon glyphicon-plus"></i></a>';
            })
            ->make(true);
    }

    //  function botones($product)
    // {
    //     $see_product = "";
    //     $edit_product = "";
    //     $delete_product = "";
    //     if(Entrust::can('see_product')){
    //         $see_product =
    //         '<a data-toggle="modal" pdt_id="'. $product->id .'" data-target="#producto" class="btn btn-info get-product"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
    //     }if (Entrust::can('edit_product')) {
    //         $edit_product = 
    //         '<a href="product/'.$product->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
    //     }if (Entrust::can('delete_product')) {
    //         $delete_product = 
    //         '<a pdt_id="'. $product->id .'" class="btn btn-danger" id="btnActionDelete"
    //         data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
    //     }

    //     return $see_product ." ". $edit_product ." ". $delete_product;
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function addProduct($id)
    {
        // dd($id);
        $product = Products::find($id);

        return Response::json($product);
    }

    public function addClient($id)
    {
        // dd($id);
        $client = Client::find($id);

        return Response::json($client);
    }

    public function getFolio()
    {
        // dd('quieriendo obterner folio');
        $folio = Sale::all('folio');
        // dd($folio);
        foreach($folio as $fol){
            $res = $fol->folio;
        }
        // dd($res);
        // dd();
        $resfolio = $res + 1;
        return Response::json($resfolio);
    }


    // static $folio = 120;
    public function makeSale($cant, $cmax, $name, $detail, $unip, $subt, $folio)
    {
        $unip = str_replace('$', '', $unip);
        $subt = str_replace('$', '', $subt);
        $res = $cmax - $cant;

        $producto = Products::where('name', $name)
                            ->where('details', $detail)
                            ->update(['quantity' => $res]);

                            

        $sale = Sale::create([
            'folio' => $folio,
            'product' => $name,
            'quantity' => $cant,
            'unitary_price' => $unip,
            'subtotal' => $subt,
        ]);
        

        
    }

    public function saleDetails(Request $request)
    {
        // dd($request->final_total);
        $client_name = null;
        $id_client = 666;
        if ($request->sel_client == null) {
            $client_name = 'Venta de Mostrador';
        }else{
            list($nm, $ln1, $ln2) = explode(' ', $request->sel_client);

            $client = Client::select('id')
                        ->where('name', $nm)
                        ->where('lastNameFather', $ln1)
                        ->where('lastNameMother', $ln2)
                        ->first();

            $client_name = $request->sel_client;
        }

        $folio = Sale::all('folio');
        foreach($folio as $fol){
            $resfolio = $fol->folio;
        }
        $resfolio += 1;

        $vt = VentaTotal::create([
            'date'      => $request->date,
            'id_client' => $id_client,
            'id_user' => Auth::user()->id,
            'folio' => $resfolio,
            'client' => $client_name,
            'user' => Auth::user()->username,
            'total' => $request->final_total,
        ]);       

        // $this->generaPdf();
        // $pdf = PDF::loadView('pdfVentas');
        // $sale = Sale::all()->where('folio', $resfolio);

        // dd($sale);

        // return $pdf->download('archivo.pdf');
        // try{
        //     if($client->email != null){
        //         Mail::send('emails.registered', $request->all(), function($msj) use ($client){
        //             $msj->subject('Gracias por comprar en NC Mueblería');
        //             $msj->to($client->email);
        //         });
        //     }
            

            
        // }catch(Exception $e){
        //     alert()->error('No se pudo enviar el correo electrónico a '.$user->email.' correctamente', 'Correo NO Enviado!')->persistent("Cerrar");;
        // }
        // 
        alert()->success('La venta se realizó correctamente', 'Venta Realizada!')->persistent("Cerrar");

        // $pdf = PDF::loadView('pdfVentas');

        // return $pdf->download('archivo.pdf');
        // 
        return redirect()->action('SaleController@generaPdf', ['folio' => $resfolio]);

        // return redirect('sale/done');
    }

    public function generaPdf(Request $request)
    {

        sleep(3);
        $venta_total = VentaTotal::all()->where('folio', $request->folio);
        $sale = Sale::all()->where('folio', $request->folio);
        // foreach ($venta_total as $key => $value) {
        // // dd($key);
        //     $res[$key] = $value;
        // }
        // dd($res);

        $pdf = PDF::loadView('pdf.pdfVentas', ['sale'=>$sale, 'venta_total'=>$venta_total]);

        return $pdf->download('archivo.pdf');
    }
}
