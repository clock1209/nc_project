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
	{{ trans('adminlte_lang::message.quoteslist') }}
@endsection

@section('contentheader_title') 
@permission('create_quote')
<a class="btn btn-success btn-md addNew" href="{{ route('quote.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
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
			{!! Build::alert_ajax('Cliente Recuperado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.recoverquote') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="quotes">
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
								<th>Expiración</th>
								<th style="width: 28%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="cotizacion">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Cliente</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Fecha:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('quote_date', null, ['class'=>'form-control text-danger', 'id'=>'quote_date']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Cliente:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('client', null, ['class'=>'form-control text-danger', 'id'=>'client']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Usuario:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('user', null, ['class'=>'form-control text-danger', 'id'=>'user']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Teléfono:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('phone_number', null, ['class'=>'form-control text-danger', 'id'=>'phone_number']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Correo:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('email', null, ['class'=>'form-control text-danger', 'id'=>'email']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Presupuesto:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('budget', null, ['class'=>'form-control text-danger', 'id'=>'budget']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Expiración:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
							{!! Form::label('expiration_date', null, ['class'=>'form-control text-danger', 'id'=>'expiration_date']) !!}
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Domicilio:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-12 col-sm-12" style="margin-bottom: 5px; margin-top: 0px">
							{{-- {!! Form::textarea('address', null, ['readonly', 'class'=>'form-control text-danger', 'id'=>'address', 'rows' => '2']) !!} --}}
							<div class="form-control" id="address"></div>
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Descripción:', null, ['class'=>'form-control bg-olive']) !!}
						</div>
						<div class="col-md-12 col-sm-12"  style="margin-top: 0px">
							{{-- {!! Form::textarea('description', null, ['readonly', 'class'=>'form-control text-danger', 'id'=>'description', 'rows' => '4']) !!} --}}
							<div class="form-control" id="description"></div>
						</div>
					</div>

				</div>
				<div class="modal-footer background-nuvem">
					<a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
		<script>

			$(document).ready(function(){
				var table = $('#quotes').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/qt_recover",
					"language": {
						url: "{{ asset('/plugins/datatables/spanish.json') }}"
					},
					"columns":[
					{data: 'id', visible: false},
					{data: 'quote_date'},
					{data: 'user'},
					{data: 'client'},
					{data: 'phone_number', visible: false}, 
					{data: 'email'},
					{data: 'address', visible: false},
					{data: 'description', visible: false},
					{data: 'budget'},
					{data: 'expiration_date', visible: false},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-quote','click',function(){
                    qt_id = $(this).attr('qt_id');
                    $.ajax({
                        url : '{{ route("quote.showTrashed") }}'+'/'+qt_id,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: qt_id}
                    }).done(function(data){
                    	console.log(data[0]);
                    	$("#quote_date").html(data[0].quote_date );
                    	$("#client").html(data[0].client );
                    	$("#user").html(data[0].user );
                    	$("#phone_number").html(data[0].phone_number);
                    	$("#email").html(data[0].email );
                    	$("#address").html(data[0].address );
                    	$("#description").html(data[0].description );
                    	$("#budget").html(data[0].budget );
                    	$("#expiration_date").html(data[0].expiration_date );
                    });

                   });

				$('body').delegate('#btnActionRecover','mouseenter',function(){
					qt_id = $(this).attr('qt_id');
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
					  		url: '{{ route("quote.recovery") }}'+'/'+qt_id,
					  		headers: {'X-CSRF-TOKEN': token},
					  		type: 'GET',
					  		dataType: 'json',
					  		data: {id: qt_id},
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