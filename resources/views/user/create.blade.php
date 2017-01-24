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
            <div class="panel panel-default">
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.registeruser') }}</i></div>
                <div class="panel-body">
                 {!!Form::open(['route'=>'user.store', 'method'=>'POST'])!!}
                 <div class="form-group">
                    <div class="form-group has-feedback">
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Full name'])!!}
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
                    {!!Form::submit('Register', ['class'=>'btn btn-primary'])!!}
                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection


{{-- style="color: #777789" --}}