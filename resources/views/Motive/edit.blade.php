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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.editmotive') }}</div>
                <div class="panel-body bgn">
                {!!Form::model($motive, ['route'=> ['motive.update',$motive->id], 'method'=>'PUT'])!!}
                    <div class="form-horizontal">
                        <div class="form-group">
                        <label for="inputEmail3" class="col-sm-4 control-label">Descripción de Motivo:</label>
                            <div class="col-sm-7">
                                {!!Form::text('description',null,['class'=>'form-control'])!!}
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="form-group">
                                <button  type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Actualizar</t></button>
                                <a class="btn btn-danger btn-close" href="{{ route('motive.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
