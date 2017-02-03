@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registerrole') }}
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
    
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            <div class="panel panel-default">
                <div class="panel-heading" style="background: #1792a4; color: white;"><i class="info-box-text"><b>{{ trans('adminlte_lang::message.addrole') }}</b></i></div>
                <div class="panel-body">
                 {!!Form::open(['route'=>'role.store', 'method'=>'POST'])!!}
                 <div class="form-group">
                    <div class="form-group has-feedback">
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre del Rol'])!!}
                        {{-- <span class="glyphicon glyphicon-user form-control-feedback"></span> --}}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('display_name',null,['class'=>'form-control', 'placeholder'=>'Nombre a Mostrar'])!!}
                        {{-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> --}}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('description',null,['class'=>'form-control', 'placeholder'=>'Descripción'])!!}
                        {{-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
                    </div>
                    {!!Form::submit('Guardar', ['class'=>'btn btn-primary',
                                                'style' =>'float: right;'])!!}
                </div>
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['role.index'], 'method'=>'GET'])!!}
                {!!Form::submit('Cancelar', ['class'=>'btn btn-danger',
                'style'=>'float:right; margin-right: 5px'])!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
	
@endsection


{{-- style="color: #777789" --}}