<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Sale;
use Response;
use Entrust;
use DB;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('ventas');
        // return view('client.index')->with('client' , Client::all());
        return view('sale.create')->with('product' , Products::all());
    }

    public function getBtnDatatable()
    {
        $products = Products::select(['id','name', 'details', 'category','sale_price', 'production_cost', 'description', 'quantity']);

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                
                return '<a data-toggle="modal" pdt_id="'. $product->id .'" data-target="#producto" class="btn btn-info get-product"><i class="glyphicon glyphicon-info-sign"></i></a>
                    <a pdt_id="'. $product->id .'" class="btn btn-success" id="btnAdd"
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

    public function getFolio()
    {
        // dd('quieriendo obterner folio');
        $folio = Sale::all('folio');

        foreach($folio as $fol){
            $res = $fol->folio;
        }
        // dd($res);
        // dd();
        $resfolio = $res + 1;
        return Response::json($resfolio);
    }


    static $folio = 120;
    public function makeSale($cant, $cmax, $name, $detail, $unip, $subt, $folio)
    {
        $unip = str_replace('$', '', $unip);
        $subt = str_replace('$', '', $subt);
        // echo "unip" . $unip;
        // echo "subt" . $subt;
        // var_dump($cant);
        // var_dump($name);
        // var_dump($detail);
        // dd($name);
        $res = $cmax - $cant;

        // echo "jjijo";
        // dd($subt);

        // $producto = Products::where('name', $name)
        //                     ->where('details', $detail)
        //                     ->update(['quantity' => $res]);

        //                     

        $sale = Sale::create([
            'folio' => $folio,
            'product' => $name,
            'quantity' => $cant,
            'unitary_price' => $unip,
            'subtotal' => $subt,
        ]);
        

        // var_dump($producto);
    }

    public function saleDetails()
    {

        // var_dump('entro f');
        // $folio = Sale::all('folio');

        // foreach($folio as $fol){
        //     $res = $fol->folio;
        // }
        // dd($res);
        // dd();
        // $resfolio = $folio + 1;
        return redirect('sale/create');
    }
}
