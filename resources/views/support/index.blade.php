@extends('adminlte::layouts.app')

@section('styles')
	<style type="text/css">
		.addNew{
			float: right;
		}
	</style>
@endsection

<?php $message=Session::get('message')?>

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.supportlist') }}
@endsection

@section('contentheader_title') 
@permission('create_websupport')
<a class="btn btn-success btn-md addNew" href="{{ route('websupport.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
@endpermission
@endsection

@section('main-content')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    {{ Session::get('message') }}    
</div>
@endif

@include('alerts.unauthorized')

<div class="container-fluid spark-screen">
	<div class="row">
		{!! Build::alert_ajax('Soporte Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.supportlist') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="supports">
						<thead>
							<tr>
								<th>ID</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Cliente</th>
								<th>Dominio</th>
								<th>Motivo</th>
								<th>Descripción</th>
								<th>Estatus</th>
								<th>Tiempo</th>
								<th style="width: 28%">Action</th>
							</tr>
						</thead>
					</table>
				</div>{{-- //panel-body --}}
			</div>{{-- //panel panel-default --}}
	</div>{{-- //row --}}

	<div class="modal fade" id="support">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Detalles de Soporte</h4>
				</div>
				<div class="modal-body">
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Fecha:</span>
							{!! Form::label('date', null, ['class'=>'form-control', 'id'=>'date']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Usuario:</span>
							{!! Form::label('user', null, ['class'=>'form-control', 'id'=>'user']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Cliente:</span>
							{!! Form::label('client', null, ['class'=>'form-control', 'id'=>'client']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Dominio:</span>
							{!! Form::label('domain', null, ['class'=>'form-control', 'id'=>'domain']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Motivo:</span>
							{!! Form::label('motive', null, ['class'=>'form-control', 'id'=>'motive']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Descripción:</span>
							{!! Form::label('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Estatus:</span>
							{!! Form::label('status', null, ['class'=>'form-control', 'id'=>'status']) !!}
						</div>
						<div class="input-group form-group">
							<span class="input-group-addon" id="basic-addon2">Tiempo:</span>
							{!! Form::label('attentiontime', null, ['class'=>'form-control', 'id'=>'attentiontime']) !!}
						</div>
                </div>
				<div class="modal-footer background-nuvem">
					<a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
				</div>
			</div>{{-- //modal-content --}}
		</div>{{-- //modal-dialog --}}
	</div>{{-- //modal --}}

</div>{{-- //container-fluid spark-screen --}}
	
		
		<script>

			$(document).ready(function(){
				var table = $('#supports').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/websupport",
					"columns":[
					{data: 'id', visible: false},
					{data: 'date', visible: false}, 
					{data: 'user'},
					{data: 'client'},
					{data: 'domain', visible: false},
					{data: 'motive'},
					{data: 'description', visible: false},
					{data: 'status', visible: false}, 
					{data: 'attentiontime', visible: false}, 
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-support','click',function(){
                    spt_id = $(this).attr('spt_id');
                    $.ajax({
                        url : '{{ URL::to("/websupport") }}' + '/' + spt_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: spt_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#date").html(data.date );
                    	$("#user").html(data.user );
                    	$("#client").html(data.client );
                    	$("#domain").html(data.domain );
                    	$("#motive").html(data.motive );
                    	$("#description").html(data.description );
                    	$("#status").html(data.status );
                    	$("#attentiontime").html(data.attentiontime );
                    });

                   });

				$('body').delegate('#btnActionDelete','click',function(){
					spt_id = $(this).attr('spt_id');
					var token = $("#token").val();
					$.ajax({
						url: '{{ route("websupport.destroy") }}'+'/'+spt_id,
						headers: {'X-CSRF-TOKEN': token},
						type: 'GET',
						dataType: 'json',
						data: {id: spt_id},
					}).done(function(data){
							console.log(data);
							table.ajax.reload();
							$("#msj-"+data.message).fadeOut().fadeIn();
					});
				});

				$('body').delegate('#msj-authorized','click', function(){
					$(this).hide();
				});
				
			});
		</script>
	</div>
	
    
@endsection