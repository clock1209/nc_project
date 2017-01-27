@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.edituser') }}
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
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.edituser') }}</i></div>

                <div class="panel-body">
                   {!!Form::model($user, ['route'=> ['user.update',$user->id], 'method'=>'PUT'])!!}
                   <div class="form-group">
                    <div class="form-group has-feedback">
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Full name'])!!}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('lastNameFather',null,['class'=>'form-control', 'placeholder'=>'Apellido Paterno'])!!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('lastNameMother',null,['class'=>'form-control', 'placeholder'=>'Apellido Materno'])!!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('username',null,['class'=>'form-control', 'placeholder'=>'Nombre de Usuario'])!!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Email'])!!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Password'])!!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div  class="form-group has-feedback">
                        {!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Password Confirmation'])!!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div  class="form-group has-feedback">
                        {!!Form::text('homePhone',null,['class'=>'form-control', 'placeholder'=>'Teléfono'])!!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div  class="form-group has-feedback">
                        {!!Form::text('cellPhone',null,['class'=>'form-control', 'placeholder'=>'cellPhone'])!!}
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <strong>Role:</strong>
                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                    </div>
                    {!!Form::submit('Actualizar', ['class'=>'btn btn-primary',
                    'style'=>'float:right'])!!}

                </div>
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['user.destroy',$user->id], 'method'=>'DELETE'])!!}
                {!!Form::submit('Borrar', ['class'=>'btn btn-danger',
                'style'=>'float:right; margin-right: 5px'])!!}
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
