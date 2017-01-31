@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.rolelist') }}
	<STYLE type="text/css">
		.right {
			margin-bottom: 20px
		}
	</STYLE>
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
                				{!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'fecha'])!!}
                			</div>
                			<label for="inputEmail3" class="col-sm-2 control-label pull-right">Fecha:</label>
                		</div>
                		<div class="form-group">
                		<label for="inputEmail3" class="col-sm-2 control-label">Usuario:</label>
                			<div class="col-sm-10">
                				{!! Form::select('nombres', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                		<label for="inputEmail3" class="col-sm-2 control-label">Nombre del Cliente:</label>
                			<div class="col-sm-10">
                				{!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Nombre del Cliente'])!!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="inputPassword3" class="col-sm-2 control-label">Dominio:</label>
                			<div class="col-sm-10">
                				{!! Form::select('nombres', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="inputPassword3" class="col-sm-2 control-label">Motivo:</label>
                			<div class="col-sm-10">
                				{!! Form::select('nombres', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="inputPassword3" class="col-sm-2 control-label">Descripción:</label>
                			<div class="col-sm-10">
                				<textarea class="form-control" rows="3" placeholder="Detalle de la llamada..."></textarea>
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="inputPassword3" class="col-sm-2 control-label">Estatus:</label>
                			<div class="col-sm-10">
                			<label class="checkbox-inline"><input type="checkbox" value="">En espera del cliente</label>
                				<label class="checkbox-inline"><input type="checkbox" value="">Resuelto</label>
                				<label class="checkbox-inline"><input type="checkbox" value="">Cancelado</label>
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="inputPassword3" class="col-sm-2 control-label">Tiempo de atención:</label>
                			<div class="col-sm-3">
                				{!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Nombre del Cliente'])!!}
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

{{-- <div class="form-group has-feedback">
                        <div class="col-md-9 col-md-push-3">
	                 		{!! Form::select('nombres', array('L' => '-- Seleccionar --', 'S' => 'Small'), null, ['class'=>'form-control']) !!}
	                 	</div>
                 		<div class="col-md-3 col-md-pull-9">
                 			<label class="col-sm-2 control-label">Motivo:</label>
                 		</div>
                 	</div> --}}