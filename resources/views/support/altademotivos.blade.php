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
                    <form class="form-horizontal">
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Descripción de Motivo:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" placeholder="Descripción..."></textarea>
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