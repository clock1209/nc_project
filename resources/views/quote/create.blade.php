@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.addquote') }}
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
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.registerquote') }}</div>
                <div class="panel-body bgn">
                 {!!Form::open(['route'=>'quote.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                    <div class="form-group mb-200" style="margin-bottom: 50px">
                        <div class="col-sm-4 pull-right">
                            {!!Form::date('date',$date,['class'=>'form-control datepicker'])!!}
                        </div>
                        <label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                        <div class="col-sm-3 pull-right">
                            {!!Form::text('username',Auth::user()->username,['readonly', 'class' => 'form-control'])!!}
                        </div>
                        <label for="user_lbl" class="col-sm-2 control-label pull-right">Usuario:</label>
                    </div>

                    <div class="form-group">
                        <label for="client_lbl" class="col-sm-3 control-label">Cliente:</label>
                        <div class="col-sm-9">
                            {!! Form::text('client', "", ['list'=> 'clients','class'=>'form-control']) !!}
                            <datalist size='5' id="clients">
                                @foreach ($clients as $client)
                                    <option value="{{ $client }}" >
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number_lbl" class="col-sm-3 control-label">Teléfono:</label>
                        <div class="col-sm-3">
                            {!! Form::text('phone_number', null, ['class'=>'form-control']) !!}
                        </div>
                        <label for="email_lbl" class="col-sm-2 control-label">Correo:</label>
                        <div class="col-sm-4">
                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'correo@ejemplo.com']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address_lbl" class="col-sm-3 control-label">Domicilio:</label>
                        <div class="col-sm-9">
                        {!! Form::textarea('address', null, ['class'=>'form-control', 'placeholder'=>'Detalles de domicilio...', 'rows'=>'1']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description_lbl" class="col-sm-3 control-label">Descripción:</label>
                        <div class="col-sm-9">
                        {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Detalle de cotización...', 'rows'=>'3']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="radio_lbl" class="col-sm-3 control-label">Tipo:</label>
                        <div class="col-sm-9">
                            {!! Build::quoteCreateRadios() !!}
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 50px;">
                        <label for="expiration_date_lbl" class="col-sm-3 control-label">Expiración:</label>
                        <div class="col-sm-4">
                            {!!Form::date('expiration_date',null,['class'=>'form-control datepicker'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-6 pull-right" style="margin-right: 15px">
                            <span class="input-group-addon">$</span>
                            {!! Form::text('budget', null, ['class'=>'form-control']) !!}
                            {{-- <input type="text" class="form-control"> --}}
                            <span class="input-group-addon">.00</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group col-md-2 pull-right">
                            <small class=" bg-info">servicio de flete </small>
                            {{ Form::checkbox('agree', 'aceptado', null,['class'=>'bg-info']) }}
                        </div>
                    </div>
                    <input type="checkbox">
                    <label>Checkbox 1</label>

                    <input type="checkbox" checked>
                    <label>Checkbox 2</label>

                    <input type="radio" name="iCheck">
                    <label>Radio button 1</label>

                    <input type="radio" name="iCheck" checked>
                    <label>Radio button 2</label>

                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                            <a class="btn btn-danger btn-close" href="{{ route('quote.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("[name='phone_number']").inputmask("(99)-9999-9999");  //static mask

        $('input').each(function(){
           var self = $(this),
             label = self.next(),
             label_text = label.text();

           label.remove();
           self.iCheck({
             checkboxClass: 'icheckbox_line',
             radioClass: 'iradio_line',
             insert: '<div class="icheck_line-icon"></div>' + label_text
           });
         });
    });   
</script>
	
@endsection

