@extends('adminlte::layouts.app')

@section('htmlheader_title')
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
                <div class="panel-heading"  style="background: #1792a4; color: white;"><i class="info-box-text"><b>{{ trans('adminlte_lang::message.addmotive') }}</b></i></div>
                <div class="panel-body">
                {!!Form::open(['route'=>'motive.store', 'method'=>'POST'])!!}
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="description_lbl" class="col-sm-4 control-label">Descripción de Motivo:</label>
                            <div class="col-sm-7">
                                {!!Form::text('description',null,['class'=>'form-control'])!!}
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                                <a class="btn btn-danger btn-close" href="{{ route('motive.index') }}"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection