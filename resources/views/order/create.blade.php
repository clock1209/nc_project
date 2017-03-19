@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registerorder') }}
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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.registerorder') }}</div>
                <div class="panel-body bgn">
                 {!!Form::open(['route'=>'order.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="form-group mb-200" style="margin-bottom: 50px">

                        <div class="col-sm-4">
                            {!!Form::label('client',$client,['class' => 'form-control-static'])!!}
                        </div>
                        <div class="col-sm-4">
                            {{ Form::button('Ver', array('class' => 'btn btn-info')) }}
                        </div>
                        {{-- <div class="col-sm-4 pull-right">
                            {!!Form::label('date',$date,['class' => 'form-control-static'])!!}
                        </div>
                        <label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                        <div class="col-sm-3 pull-right">
                            <label for="username" class="form-control bg-olive">{{ Auth::user()->username }}</label>
                            {!! Form::hidden('username', Auth::user()->username) !!}
                            {!!Form::label('username',Auth::user()->username,['class' => 'form-control-static'])!!}
                        </div>
                        <label for="user_lbl" class="col-sm-2 control-label bg-olive pull-right">Usuario:</label> --}}
                    </div>

                    <div class="form-group">
                        <label for="retainer_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.retainer') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('retainer',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.delivery_date') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('delivery_date',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.priority') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('priority', $priority, null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.status') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('status', $status, null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('order.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function(){
      $("[name='homePhone']").inputmask("9999-9999");  //static mask
        $("[name='cellPhone']").inputmask("(99)-9999-9999");  //static mask
    });
</script>
	
@endsection

