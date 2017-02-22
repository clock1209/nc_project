@extends('adminlte::layouts.app')

@section('styles')
<style type="text/css">
        #loader{
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
      }

      @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
      }

      .popover{
        width: 500px;
      }
    </style>
@endsection

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.rolelist') }}
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            @include('alerts.unauthorized')
            {!! Build::alert_ajax('mensaje') !!}
            <div class="panel panel-default">
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.addwebsupport') }}</div>
                <div class="panel-body bgn">
                	{!!Form::open(['route'=>'websupport.store', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                		<div class="form-group mb-200">
                			<div class="col-sm-4 pull-right">
                				{!!Form::date('date',$date,['class'=>'form-control datepicker'])!!}
                			</div>
                			<label for="date_lbl" class="col-sm-2 control-label pull-right">Fecha:</label>
                		</div>
                		<div class="form-group">
                		<label for="user_lbl" class="col-sm-3 control-label">Usuario:</label>
                			<div class="col-sm-9">
                				{!! Form::select('users[]', $users, null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                		<label for="client_lbl" class="col-sm-3 control-label">Nombre del Cliente:</label>
                			<div class="col-sm-9">
                				{!!Form::text('client',null,['class'=>'form-control'])!!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="domain_lbl" class="col-sm-3 control-label">Dominio:</label>
                			<div class="col-sm-9">
                				{{-- {!! Form::select('domains[]', $domains, null, ['class'=>'form-control']) !!} --}}
                                <div class="input-group ">
                                    {!! Form::text('domains', "", ['list'=> 'domains','class'=>'form-control']) !!}
                                  <datalist size='5' id="domains">
                                      @foreach ($domains as $element)
                                          <option value="{{ $element }}" >
                                      @endforeach
                                  </datalist>
                                  <a id="btnRefresh" idtest="test" class="btn btn-default input-group-addon" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="glyphicon glyphicon-refresh" id="refresh"></i></a>
                                </div>
                                
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="motive_lbl" class="col-sm-3 control-label">Motivo:</label>
                			<div class="col-sm-9">
                				{!! Form::select('motives[]', $motives, null, ['class'=>'form-control']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="description_lbl" class="col-sm-3 control-label">Descripción:</label>
                			<div class="col-sm-9">
                                {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'Detalle de la llamada...', 'rows'=>'3']) !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="status_lbl" class="col-sm-3 control-label">Estatus:</label>
                			<div class="col-sm-9 text-center">
                                 {!! Build::radios() !!}
                			</div>
                		</div>
                		<div class="form-group">
                			<label for="time_lbl" class="col-sm-3 control-label">Tiempo de atención:</label>
                			<div class="col-sm-4">
                                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                    {!!Form::text('attentiontime',null,['class'=>'form-control'])!!}
                                    <a class="btn btn-default input-group-addon " data-toggle="popover" title="Registre el tiempo estimado de atención:" data-trigger="hover" data-content="w=week d=day h=hour m=minute (Por ejemplo, 3w 4d 12h)"><i class="glyphicon glyphicon-question-sign" id=""></i></a>
                                </div>
                				
                			</div>
                		</div>
                		<div class="text-center">
                			<div class="form-group">
                				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Guardar</t></button>
                				<a class="btn btn-danger btn-close" href="{{ route('websupport.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                			</div>
                		</div>
                	{!! Form::close() !!}
            </div>
        </div>
    </div>

</div>

<script>
    

    $(document).ready(function(){
        $('body').delegate('#btnRefresh','click', function(){
            spt_id = $(this).attr('spt_id');
            var token = $("#token").val();
            $('#refresh').attr('id', 'loader');
            $.ajax({
                url: '{{ route("websupport.refresh") }}',
                headers: {'X-CSRF-TOKEN': token},
                type: 'GET',
                dataType: 'json',
                data: {id: spt_id},
            }).done(function(data){
                $('#domains').empty();
                $.each(data.domains, function (key, value){
                    $('#domains').append("<option value='" + value + "'></option>");
                });
                $('#loader').attr('id', 'refresh');
                
                $("#msj-authorized").fadeOut(function (){
                    $(".msg-text").empty().html(data.message);
                }).fadeIn();
            }).fail(function (){
                $('#loader').attr('id', 'refresh');
                $("#msj-authorized").fadeOut(function (){
                    $(".msg-text").empty().html(data.message);
                }).fadeIn();
            });
            $('body').delegate('#msj-authorized','click', function(){
                $(this).hide();
            });
        });

        $('[data-toggle="popover"]').popover(); 

    });
</script>

@endsection
