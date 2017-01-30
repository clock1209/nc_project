@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.editrole') }}
@endsection


@section('contentheader_title')
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            <div class="panel panel-default">
                <div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.editrole') }}</i></div>

                <div class="panel-body">
                   {!!Form::model($role, ['route'=> ['role.update',$role->id], 'method'=>'PUT'])!!}
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
                    {!!Form::submit('Update', ['class'=>'btn btn-primary',
                    'style'=>'float:right'])!!}

                </div>
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['role.destroy',$role->id], 'method'=>'DELETE'])!!}
                {!!Form::submit('Delete', ['class'=>'btn btn-danger',
                'style'=>'float:right; margin-right: 5px'])!!}
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['role.index'], 'method'=>'GET'])!!}
                {!!Form::submit('Cancelar', ['class'=>'btn btn-danger',
                'style'=>'float:right; margin-right: 5px'])!!}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>
	
@endsection

{{-- {!!Form::submit('Delete', ['class'=>'btn btn-danger'])!!} --}}
            {{-- {!!Form::submit('<< Return', ['class'=>'btn btn-primary', 
                                       'style'=>'float:right'])!!} --}}