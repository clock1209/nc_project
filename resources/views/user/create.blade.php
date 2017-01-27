@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registeruser') }}
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
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.registeruser') }}</i></div>
                <div class="panel-body">
                 {!!Form::open(['route'=>'user.store', 'method'=>'POST'])!!}
                 <div class="form-group">
                    <div class="form-group has-feedback">
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Full name'])!!}
                        {{-- <span class="glyphicon glyphicon-user form-control-feedback"></span> --}}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('lastNameFather',null,['class'=>'form-control', 'placeholder'=>'Apellido Paterno'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('lastNameMother',null,['class'=>'form-control', 'placeholder'=>'Apellido Materno'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Nombre de usuario'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Correo'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Password'])!!}
                    </div>
                    <div  class="form-group has-feedback">
                        {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Password Confirmation'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {{-- <strong>Role:</strong> --}}
                        {!! Form::select('roles[]', $roles, null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('homePhone',null,['class'=>'form-control', 'placeholder'=>'Teléfono'])!!}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('cellPhone',null,['class'=>'form-control', 'placeholder'=>'Celular'])!!}
                    </div>
                    {!!Form::submit('Guardar', ['class'=>'btn btn-primary',
                                                'style' => 'float:right'])!!}
                </div>
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['user.index'], 'method'=>'GET'])!!}
                {!!Form::submit('Cancelar', ['class'=>'btn btn-danger',
                'style'=>'float:right; margin-right: 5px'])!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection

