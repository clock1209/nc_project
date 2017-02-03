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
                <div class="panel-heading" style="background: #1792a4; color: white;"><b><i class="info-box-text">{{ trans('adminlte_lang::message.websupport') }}</i></b></div>
                <div class="panel-body">
                	{!!Form::open(['route'=>'websupport.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                		<div class="form-group mb-200">
                			<div class="col-sm-4 pull-right">
                				{!!Form::date('date',null,['class'=>'form-control datepicker'])!!}
                			</div>
                			<label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                		</div>
                		<div class="form-group">
                		<label for="user_lbl" class="col-sm-3 control-label">Usuario:</label>
                			<div class="col-sm-9">
                				{!! Form::select('users[]', $users, null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                		<label for="client_lbl" class="col-sm-3 control-label">Nombre del Cliente:</label>
                			<div class="col-sm-9">
                				{!!Form::text('client',null,['class'=>'form-control'])!!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="domain_lbl" class="col-sm-3 control-label">Dominio:</label>
                			<div class="col-sm-9">
                				{!! Form::select('domain', array('L' => '-- Seleccionar --'), null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="motive_lbl" class="col-sm-3 control-label">Motivo:</label>
                			<div class="col-sm-9">
                				{!! Form::select('motives[]', $motives, null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="description_lbl" class="col-sm-3 control-label">Descripción:</label>
                			<div class="col-sm-9">
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Detalle de la llamada...', 'rows'=>'3']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="status_lbl" class="col-sm-3 control-label">Estatus:</label>
                			<div class="col-sm-9 text-center">
                                 <label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="En espera del cliente" checked="true"> En espera del cliente</label>
                                 <label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="Resuelto"> Resuelto</label>
                                 <label class="checkbox-inline btn btn-default"><input type="radio" name="radio" value="Cancelado"> Cancelado</label>
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="time_lbl" class="col-sm-3 control-label">Tiempo de atención:</label>
                			<div class="col-sm-3">
                				{!!Form::text('attentiontime',null,['class'=>'form-control'])!!}
                			</div>
                		</div>
                		<div class="text-center">
                			<div class="btn-group">
                				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                				<a class="btn btn-danger btn-close" href="{{ route('user.index') }}"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
                			</div>
                		</div>
                	{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $('.datepicker').datepicker({
    language: "es",
    autoclose: true,
    todayHighlight: true
});
</script>
@endsection
