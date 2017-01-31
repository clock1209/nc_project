@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.rolelist') }}
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
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.websupport') }}</i></div>
                <div class="panel-body">
                	<form class="form-horizontal">
                		<div class="form-group mb-200">
                			<div class="col-sm-3 pull-right">
                				{!!Form::text('date',null,['class'=>'form-control'])!!}
                			</div>
                			<label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                		</div>
                		<div class="form-group">
                		<label for="user_lbl" class="col-sm-2 control-label">Usuario:</label>
                			<div class="col-sm-10">
                				{!! Form::select('user', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                		<label for="client_lbl" class="col-sm-2 control-label">Nombre del Cliente:</label>
                			<div class="col-sm-10">
                				{!!Form::text('client',null,['class'=>'form-control'])!!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="domn_lbl" class="col-sm-2 control-label">Dominio:</label>
                			<div class="col-sm-10">
                				{!! Form::select('domn', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="motive_lbl" class="col-sm-2 control-label">Motivo:</label>
                			<div class="col-sm-10">
                				{!! Form::select('motive', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="description_lbl" class="col-sm-2 control-label">Descripción:</label>
                			<div class="col-sm-10">
                				<textarea class="form-control" id="description" rows="3" placeholder="Detalle de la llamada..."></textarea>
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="status_lbl" class="col-sm-2 control-label">Estatus:</label>
                			<div class="col-sm-10">
                			<label class="checkbox-inline"><input type="checkbox" value="">En espera del cliente</label>
                				<label class="checkbox-inline"><input type="checkbox" value="">Resuelto</label>
                				<label class="checkbox-inline"><input type="checkbox" value="">Cancelado</label>
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="time_lbl" class="col-sm-2 control-label">Tiempo de atención:</label>
                			<div class="col-sm-3">
                				{!!Form::text('time',null,['class'=>'form-control'])!!}
                			</div>
                		</div>
                		<div class="text-center">
                			<div class="btn-group">
                				<button type="button" class="btn btn-primary">Guardar</button>
                				<button  type="button" class="btn btn-danger">Cancelar</button>
                			</div>
                		</div>
                	</form>
            </div>
        </div>
    </div>
</div>
@endsection