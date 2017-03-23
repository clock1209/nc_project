@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.addproduct') }}
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
    
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            @include('alerts.unauthorized')
            <div class="panel panel-default">
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.addproduct') }}</div>
                <div class="panel-body bgn">
                 {!!Form::open(['route'=>'product.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.name') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.details') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('details',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">Precio de Venta:</label>
                        <div class="col-sm-8">
                            {!!Form::text('sale_price',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">Categoria:</label>
                        <div class="col-sm-8">
                            {!! Form::select('category', null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.category') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::select('category',$categories,null['class'=>'form-control'])!!}
                            {!! Form::select('category', null, null,['class'=>'form-control']) !!}
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">Costo de Producción:</label>
                        <div class="col-sm-8">
                            {!!Form::text('production_cost',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.description') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('description',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.quantity') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('quantity',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('product.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection

