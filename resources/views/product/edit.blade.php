@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.editproduct') }}
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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.editproduct') }}</div>

                <div class="panel-body bgn">
                   {!!Form::model($product, ['route'=> ['product.update',$product->id], 'method'=>'PUT', 'class'=>'form-horizontal'])!!}

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
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.details') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('details',null,['class'=>'form-control'])!!}
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
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.production_cost') }}:</label>
                        <div class="col-sm-8" style="margin-top: 10px;">
                            {!!Form::text('production_cost',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="product_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.description') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::textarea('description',3 < 4,['class'=>'form-control'])!!}
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
                            <button type="submit" class="btn btn-primary" id="update" data-toggle="confirmation"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Actualizar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('product.destroy').'/'.$product->id }}" ><i class="glyphicon glyphicon-floppy-remove"></i> <t class="hidden-xs">Borrar</t></a>
                            <a class="btn btn-danger btn-close" href="{{ route('product.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>

                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>

<script>

    $(document).ready(function(){
        $('body').delegate('#update','mouseenter',function(){
            $('[data-toggle=confirmation]').confirmation({
              rootSelector: '[data-toggle=confirmation]',
              title: "¿Está seguro?",
              singleton: true,
              popout: true,
              btnOkLabel: 'Sí',
              btnCancelLabel: 'No',
              placement: 'top',
              onConfirm: function() {
                    $('submit').click();
                },
                onCancel: function() {
                },
            });
        });
    });
    
</script>
    
@endsection
