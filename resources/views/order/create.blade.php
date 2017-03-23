@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registerorder') }}
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
                <div class="panel-heading header-nuvem">registro de pedido</div>
                <div class="panel-body bgn">
                 {!!Form::open(['route'=>'order.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    
                    {!! Form::hidden('client', $client) !!}
                    {!! Form::hidden('user', Auth::user()->username) !!}
                    {!! Form::hidden('address', $address) !!}
                    {!! Form::hidden('budget', $budget) !!}
                    {!! Form::hidden('description', $description) !!}
                    {!! Form::hidden('quote_date', $date) !!}
                    {!! Form::hidden('date', $date) !!}
                    {!! Form::hidden('phonenumber', $phonenumber) !!}
                    {!! Form::hidden('email', $email) !!}
                    {!! Form::hidden('exp_date', $client) !!}
                    {!! Form::hidden('status', 'En progreso') !!}

                    <div class="form-group">
                        <div class="col-sm-8 col-md-offset-3">
                            <div class="text-right">
                                {!!Form::label('client',$client,['class' => 'form-control-static', 'style'=>'margin-right: 10px;'])!!}
                                <a data-toggle="modal" data-target="#cliente" class="btn btn-info" id="VerCliente"><i class="glyphicon glyphicon-eye-open"></i> <t class="hidden-xs"> Ver Cotización</t></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="retainer_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.retainer') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('retainer',null,['class'=>'form-control', 'placeholder'=>'na'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.delivery_date') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::date('deliver_date',$delivery_date,['class'=>'form-control datepicker'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.priority') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('priority', $priority, null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label for="status_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.status') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('status', $status, null,['class'=>'form-control']) !!}
                        </div>
                    </div> --}}
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('order.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>
                </div>{{-- panel-body --}}
            </div>{{-- panel panel-default --}}
        </div>
    </div>{{-- row --}}

    <div class="modal fade" id="cliente">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-nuvem">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Datos de Cotización</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Fecha:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('quote_date', $date, ['class'=>'form-control bg_etiquetas', 'id'=>'quote_date']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Cliente:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('client', $client, ['class'=>'form-control bg_etiquetas', 'id'=>'client']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Atendió:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('user', Auth::user()->username, ['class'=>'form-control bg_etiquetas', 'id'=>'user']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Teléfono:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('phone_number', $phonenumber, ['class'=>'form-control bg_etiquetas', 'id'=>'phone_number']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Correo:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('email', $email, ['class'=>'form-control bg_etiquetas', 'id'=>'email']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Presupuesto:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('budget', $budget, ['class'=>'form-control bg_etiquetas', 'id'=>'budget']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Expiración:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('expiration_date', $exp_date, ['class'=>'form-control bg_etiquetas', 'id'=>'expiration_date']) !!}
                        </div>
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('Domicilio:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-12 col-sm-12" style="margin-bottom: 5px; margin-top: 0px">
                            {{-- {!! Form::textarea('address', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'address', 'rows' => '2']) !!} --}}
                            <div class="form-control bg_etiquetas" id="address">{{ $address }}</div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-12 col-sm-12"  style="margin-top: 0px">
                            {{-- {!! Form::textarea('description', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'description', 'rows' => '4']) !!} --}}
                            <div class="form-control bg_etiquetas" id="description">{{ $description }}</div>
                        </div>


                    </div>
                </div>{{-- modal-body --}}
                <div class="modal-footer background-nuvem">
                    <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
                </div>
            </div>
        </div>
    </div>{{-- modal --}}

</div>{{-- container --}}


<script>
    $(document).ready(function(){
      $("[name='homePhone']").inputmask("9999-9999");  //static mask
        $("[name='cellPhone']").inputmask("(99)-9999-9999");  //static mask

        var retain = $("input[name='budget']").val();
        retain = retain * .20; 
        $("input[name='retainer']").attr('placeholder', "$"+retain + " (recomendado)");
    });
</script>
	
@endsection

