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
                <div class="panel-heading" style="background: #1792a4; color: white;"><i class="info-box-text"><b>{{ trans('adminlte_lang::message.registeruser') }}</b></i></div>
                <div class="panel-body">
                 {!!Form::open(['route'=>'user.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    
                     <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.yourname') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.lastnamefather') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('lastNameFather',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.lastnamemother') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('lastNameMother',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.username') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('username',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.email') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('email',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.password') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::password('password',['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.retrypepassword') }}:</label>
                        <div class="col-sm-8"  style="padding-top: 9px;">
                            {!!Form::password('password_confirmation',['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.roles') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('roles[]', $roles, null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.homephone') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('homePhone',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.cellphone') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('cellPhone',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a class="btn btn-danger btn-close" href="{{ route('user.index') }}">Cancelar</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection

