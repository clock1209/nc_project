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
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.code') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('code',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.name') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.category') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('category',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.sale_price') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('sale_price',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.production_cost') }}:</label>
                        <div class="col-sm-8" style="margin-top: 10px;">
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

