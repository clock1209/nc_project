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
	{{ trans('adminlte_lang::message.orderlist') }}
@endsection

@section('contentheader_title') 
{{-- @permission('create_order')
<a class="btn btn-success btn-md addNew" href="{{ route('order.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
@endpermission --}}
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
			{!! Build::alert_ajax('Pedido Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.orderlist') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="orders">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Cliente</th>
								<th>Telefono</th>
								<th>Correo</th>
								<th>Domicilio</th>
								<th>Descripción</th>
								<th>Presupuesto</th>
								<th>Fecha de Entrega</th>
								<th>Prioridad</th>
								<th>Estatus</th>
								<th style="width: 28%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="pedido">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Pedido</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						{{-- <div class="col-md-4 col-sm-4">
							{!! Form::label('Fecha creación:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('order_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'order_date']) !!}
						</div> --}}
						{{-- <div class="col-md-4 col-sm-4">
							{!! Form::label('Feche entrega:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('delivery_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'delivery_date']) !!}
						</div> --}}
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Cliente:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('client', null, ['class'=>'form-control bg_etiquetas', 'id'=>'client']) !!}
						</div>
						{{-- <div class="col-md-3 col-sm-4">
							{!! Form::label('Usuario:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('user', null, ['class'=>'form-control bg_etiquetas', 'id'=>'user']) !!}
						</div> --}}
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Teléfono:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('phone_number', null, ['class'=>'form-control bg_etiquetas', 'id'=>'phone_number']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Correo:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('email', null, ['class'=>'form-control bg_etiquetas', 'id'=>'email']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Presupuesto:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('budget', null, ['class'=>'form-control bg_etiquetas', 'id'=>'budget']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Anticipo:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('retainer', null, ['class'=>'form-control bg_etiquetas', 'id'=>'retainer']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Prioridad:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('priority', null, ['class'=>'form-control bg_etiquetas', 'id'=>'priority']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Estatus:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('status', null, ['class'=>'form-control bg_etiquetas', 'id'=>'status']) !!}
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Domicilio:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-12 col-sm-12" style="margin-bottom: 5px; margin-top: 0px">
							{{-- {!! Form::textarea('address', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'address', 'rows' => '2']) !!} --}}
							<div class="form-control bg_etiquetas" id="address"></div>
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-12 col-sm-12"  style="margin-top: 0px">
							{{-- {!! Form::textarea('description', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'description', 'rows' => '4']) !!} --}}
							<div class="form-control bg_etiquetas" id="description"></div>
						</div>


					</div>

				</div>{{-- modal-body --}}
				<div class="modal-footer background-nuvem">
					<a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
		<script>

		paceOptions = {
		  // Disable the 'elements' source
		  elements: false,

		  // Only show the progress on regular and ajax-y page navigation,
		  // not every request
		  restartOnRequestAfter: false
		}


			$(document).ready(function(){
				var table = $('#orders').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/orders",
					"language": {
						url: "{{ asset('/plugins/datatables/spanish.json') }}"
					},
					"columns":[
					{data: 'id', visible: false},
					{data: 'order_date', visible: false},
					{data: 'user', visible: false},
					{data: 'client'},
					{data: 'phone_number', visible: false}, 
					{data: 'email', visible: false},
					{data: 'address', visible: false},
					{data: 'description', visible: false},
					{data: 'budget'},
					{data: 'delivery_date', visible: false},
					{data: 'priority'},
					{data: 'status'},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-order','click',function(){
                    odr_id = $(this).attr('odr_id');
                    $.ajax({
                        url : '{{ URL::to("/order") }}' + '/' + odr_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: odr_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#order_date").html(data.created_at );
                    	$("#client").html(data.client );
                    	$("#user").html(data.user );
                    	$("#phone_number").html(data.phone_number);
                    	$("#email").html(data.email );
                    	$("#address").html(data.address );
                    	$("#description").html(data.description );
                    	$("#budget").html("$"+data.budget );
                    	$("#retainer").html("$"+data.retainer );
                    	$("#delivery_date").html(data.delivery_date );
                    	$("#priority").html(data.priority );
                    	$("#status").html(data.status );
                    });

                   });

				$('body').delegate('#btnActionDelete','mouseenter',function(){
					odr_id = $(this).attr('odr_id');
					var token = $("#token").val();
					$('[data-toggle=confirmation]').confirmation({
					  rootSelector: '[data-toggle=confirmation]',
					  title: "¿Está seguro?",
					  singleton: true,
					  popout: true,
					  btnOkLabel: 'Sí',
					  btnCancelLabel: 'No',
					  placement: 'left',
					  onConfirm: function() {
					  	$.ajax({
					  		url: '{{ route("order.destroy") }}'+'/'+odr_id,
					  		headers: {'X-CSRF-TOKEN': token},
					  		type: 'GET',
					  		dataType: 'json',
					  		data: {id: odr_id},
					  	}).done(function(data){
					  		console.log(data);
					  		table.ajax.reload();
					  		$("#msj-"+data.message).fadeOut().fadeIn();
					  	});
					    },
					    onCancel: function() {
					    },
					});
				});

				$('body').delegate('#msj-authorized','click', function(){
					$(this).hide();
				});

			});
		</script>
	</div>
	
    
@endsection