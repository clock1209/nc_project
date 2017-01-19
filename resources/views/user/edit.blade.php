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
                        {!!Form::text('email',null,['class'=>'form-control', 'placeholder'=>'Email'])!!}
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    {!!Form::submit('Update', ['class'=>'btn btn-primary',
                    'style'=>'float:right'])!!}

                </div>
                {!!Form::close()!!}
                {!!Form::open(['route'=> ['user.destroy',$user->id], 'method'=>'DELETE'])!!}
                {!!Form::submit('Delete', ['class'=>'btn btn-danger',
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