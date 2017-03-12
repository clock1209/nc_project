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
	{{ trans('adminlte_lang::message.productslist') }}
@endsection

@section('contentheader_title') 
@permission('create_product')
<a class="btn btn-success btn-md addNew" href="{{ route('product.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
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
			{!! Build::alert_ajax('Producto Recuperado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.recoverproduct') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="products">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Código</th>
								<th>Nombre</th>
								<th>Detalles</th>
								<th>Categoria</th>
								<th>Precio</th>
								<th>Costo</th>
								<th>Descripción</th>
								<th>Existencia</th>
								<th style="width: 28%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="producto">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Cliente</h4>
				</div>
				<div class="modal-body">
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Code:</div>
						{!! Form::label('code', null, ['class'=>'form-control', 'id'=>'code']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Nombre de Producto:</div>
						{!! Form::label('name', null, ['class'=>'form-control', 'id'=>'name']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Detalles de Producto:</div>
						{!! Form::label('details', null, ['class'=>'form-control', 'id'=>'details']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Categoria:</div>
						{!! Form::label('category', null, ['class'=>'form-control', 'id'=>'category']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Precio de Venta:</div>
						{!! Form::label('sale_price', null, ['class'=>'form-control', 'id'=>'sale_price']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Costo de producción:</div>
						{!! Form::label('production_cost', null, ['class'=>'form-control', 'id'=>'production_cost']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Descripción:</div>
						{!! Form::label('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Existencias:</div>
						{!! Form::label('quantity', null, ['class'=>'form-control', 'id'=>'quantity']) !!}
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
				var table = $('#products').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/pdt_recover",
					"language": {
						url: "{{ asset('/plugins/datatables/spanish.json') }}"
					},
					"columns":[
					{data: 'id', visible: false},
					{data: 'code'},
					{data: 'name'},
					{data: 'details'},
					{data: 'category'},
					{data: 'sale_price'}, 
					{data: 'production_cost', visible: false},
					{data: 'description', visible: false},
					{data: 'quantity'},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-product','click',function(){
                    pdt_id = $(this).attr('pdt_id');
                    $.ajax({
                        url : '{{ route("product.showTrashed") }}'+'/'+pdt_id,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: pdt_id}
                    }).done(function(data){
                    	console.log(data[0]);
                    	$("#name").html(data[0].name );
                    	$("#details").html(data[0].details );
                    	$("#code").html(data[0].code );
                    	$("#category").html(data[0].category );
                    	$("#sale_price").html('$ ' + data[0].sale_price);
                    	$("#production_cost").html('$ ' + data[0].production_cost );
                    	$("#description").html(data[0].description );
                    	$("#quantity").html(data[0].quantity );
                    });

                   });

				$('body').delegate('#btnActionRecover','mouseenter',function(){
					pdt_id = $(this).attr('pdt_id');
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
					  		url: '{{ route("product.recovery") }}'+'/'+pdt_id,
					  		headers: {'X-CSRF-TOKEN': token},
					  		type: 'GET',
					  		dataType: 'json',
					  		data: {id: pdt_id},
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