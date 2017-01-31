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
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.addmotive') }}</i></div>
                <div class="panel-body">
                {!!Form::open(['route'=>'motive.store', 'method'=>'POST'])!!}
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="description_lbl" class="col-sm-2 control-label">Descripción de Motivo:</label>
                            <div class="col-sm-10">
                                {!!Form::textarea('description',null,['class'=>'form-control', 'rows'=>'5'])!!}
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="btn-group">
                                <button  type="submit" class="btn btn-primary">Guardar</button>
                                <a class="btn btn-danger btn-close" href="{{ route('motive.index') }}">Cancelar</a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection