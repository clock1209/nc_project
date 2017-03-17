<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;
use DB;
use App\Products;
use Response;
use Datatables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Entrust::can('see_product')){
            return view('product.index')->with('product' , Products::all());
        }else{
            return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
    }

    public function recover()
    {
        // if(Entrust::can('recover_product')){
            return view('product.recover')->with('products' , Products::all());
        // }else{
            return redirect('/home')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        // }
    }

    public function getBtnDatatable()
    {
        $products = Products::select(['id','name', 'details', 'category','sale_price', 'production_cost', 'description', 'quantity']);

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                
                return $this->botones($product);
            })
            ->editColumn('sale_price', '$ {{$sale_price}}')
            ->editColumn('quantity', '<i>cant:</i> {{$quantity}}')
            ->make(true);
    }

     function botones($product)
    {
        $see_product = "";
        $edit_product = "";
        $delete_product = "";
        if(Entrust::can('see_product')){
            $see_product =
            '<a data-toggle="modal" pdt_id="'. $product->id .'" data-target="#producto" class="btn btn-info get-product"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('edit_product')) {
            $edit_product = 
            '<a href="product/'.$product->id.'/edit" class="btn btn-primary" id="btnAction"><i class="glyphicon glyphicon-edit"></i> <t class="hidden-xs">Editar</t></a>';
        }if (Entrust::can('delete_product')) {
            $delete_product = 
            '<a pdt_id="'. $product->id .'" class="btn btn-danger" id="btnActionDelete"
            data-toggle="confirmation"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Borrar</t></a>';
        }

        return $see_product ." ". $edit_product ." ". $delete_product;
    }

    public function btnRecoverProducts()
    {
        $products = Products::select(['id','name', 'details', 'category','sale_price', 'production_cost', 'description', 'quantity'])->onlyTrashed()->get();

        return Datatables::of($products)
            ->addColumn('action', function ($product) {
                
                return $this->recoveryBtn($product);
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    function recoveryBtn($product)
    {
        $see_product = "";
        // $edit_product = "";
        $recover_product = "";
        if(Entrust::can('see_product')){
            $see_product =
            '<a data-toggle="modal" pdt_id="'. $product->id .'" data-target="#producto" class="btn btn-info get-product"><i class="glyphicon glyphicon-info-sign"></i> <t class="hidden-xs">Mostrar</t></a>';
        }if (Entrust::can('recover_product')) {
            $recover_product = 
            '<a pdt_id="'. $product->id .'" class="btn btn-primary" id="btnActionRecover"
            data-toggle="confirmation"><i class="glyphicon glyphicon-floppy-open"></i> <t class="hidden-xs">Recuperar</t></a>';
        }

        return $see_product ." ". $recover_product;
    }

    public function recovery($id)
    {
        if(Entrust::can('recover_product')){
            $product = Products::onlyTrashed()->where('id', $id)->restore();
            // dd($product);

            return response()->json(["message"=>"authorized"]);
        }else{
            return redirect('product.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Products::create([
            'name' => $request['name'],
            'details' => $request['details'],
            'category' => $request['category'],
            'sale_price' => $request['sale_price'],
            'production_cost' => $request['production_cost'],
            'description' => $request['description'],
            'quantity' => $request['quantity'],
        ]);

        return redirect('product')->with('message','Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Entrust::can('see_product')){
            $product = Products::find($id);

            return Response::json($product);
        }else{
            return redirect('product.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
        }
    }

    public function showTrashed($id)
    {
        // echo "trashed";
        if(Entrust::can('see_product')){
            $product = Products::onlyTrashed()->where('id', $id)->get();

            return Response::json($product);
        }else{
            return redirect('product.index')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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
        if(Entrust::can('edit_product')){
            $product = Products::find($id);

            return view('product.edit', ['product'=>$product]);
        }else{
            return redirect('/product')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
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

        $product = Products::find($id);
        $product->update($input);

        Session::flash('message', 'Producto Actualizado exitosamente');
        return Redirect::to('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Entrust::can('delete_product')){
            Products::whereId($id)->delete();

            return response()->json(["message"=>"authorized"]);
         }else{
            return redirect('/product')->with('unauthorized', "No tiene los permisos necesarios para realizar esa acción.");
         }
    }
}
