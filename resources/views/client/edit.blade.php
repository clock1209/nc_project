@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.editclient') }}
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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.editclient') }}</div>

                <div class="panel-body bgn">
                   {!!Form::model($client, ['route'=> ['client.update',$client->id], 'method'=>'PUT', 'class'=>'form-horizontal'])!!}

                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.name') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('name',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.lastnamefather') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('lastNameFather',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.lastnamemother') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('lastNameMother',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.email') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('email',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.address') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('address',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.homephone') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('homePhone',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.cellphone') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('cellPhone',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="update" data-toggle="confirmation"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Actualizar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('client.destroy').'/'.$client->id }}" ><i class="glyphicon glyphicon-floppy-remove"></i> <t class="hidden-xs">Borrar</t></a>
                            <a class="btn btn-danger btn-close" href="{{ route('client.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>

                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
</div>

<script>

    $(document).ready(function(){
        $('body').delegate('#update','mouseenter',function(){
            $('[data-toggle=confirmation]').confirmation({
              rootSelector: '[data-toggle=confirmation]',
              title: "¿Está seguro?",
              singleton: true,
              popout: true,
              btnOkLabel: 'Sí',
              btnCancelLabel: 'No',
              placement: 'top',
              onConfirm: function() {
                    $('submit').click();
                },
                onCancel: function() {
                },
            });
        });

        $("[name='homePhone']").inputmask("9999-9999");  //static mask
        $("[name='cellPhone']").inputmask("(99)-9999-9999");  //static mask
    });
    
</script>
    
@endsection
