@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editwebsupport') }}
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
                <div class="panel-heading" style="background: #1792a4; color: white;"><i class="info-box-text"><b>{{ trans('adminlte_lang::message.editwebsupport') }}</b></i></div>

                <div class="panel-body">
                   {!!Form::model($support, ['route'=> ['websupport.update',$support->id], 'method'=>'PUT', 'class'=>'form-horizontal'])!!}

                    <div class="form-group mb-200">
                            <div class="col-sm-4 pull-right">
                                {!!Form::date('date',null,['class'=>'form-control datepicker'])!!}
                            </div>
                            <label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                        </div>
                        <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">Usuario:</label>
                            <div class="col-sm-9">
                                {!! Form::select('user', $users, $selUser, ['class'=>'form-control']) !!}
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
                                {!! Form::select('motive', $motives, $selMotive, ['class'=>'form-control']) !!}
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
                                {!! Build::radioGroup($selRadio) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="time_lbl" class="col-sm-3 control-label">Tiempo de atención:</label>
                            <div class="col-sm-3">
                                {!!Form::text('attentiontime',null,['class'=>'form-control'])!!}
                            </div>
                        </div>
                        <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Actualizar</button>
                            <a class="btn btn-danger btn-close" href="{{ route('websupport.destroy').'/'.$support->id }}" ><i class="glyphicon glyphicon-floppy-remove"></i> Borrar</a>
                            <a class="btn btn-danger btn-close" href="{{ route('websupport.index') }}"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
                        </div>
                    </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection
