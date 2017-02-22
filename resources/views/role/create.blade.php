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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.addrole') }}</div>
                <div class="panel-body bgn">
                 {!!Form::open(['route'=>'role.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}

                    <div class="form-group">
                        <label for="rolName_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.rolname') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="displayName_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.displayname') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('display_name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="displayName_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.description') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::textarea('description',null,['class'=>'form-control', 'rows'=>'3'])!!}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('role.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
	
@endsection


{{-- style="color: #777789" --}}