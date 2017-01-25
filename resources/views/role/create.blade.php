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
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.registerrole') }}</i></div>
                <div class="panel-body">
                 {!!Form::open(['route'=>'role.store', 'method'=>'POST'])!!}
                 <div class="form-group">
                    <div class="form-group has-feedback">
                        {!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Rol Name'])!!}
                        {{-- <span class="glyphicon glyphicon-user form-control-feedback"></span> --}}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('display_name',null,['class'=>'form-control', 'placeholder'=>'Display Name'])!!}
                        {{-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> --}}
                    </div>
                    <div class="form-group has-feedback">
                        {!!Form::text('description',null,['class'=>'form-control', 'placeholder'=>'Description'])!!}
                        {{-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> --}}
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