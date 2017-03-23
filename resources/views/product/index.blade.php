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
	{{ trans('adminlte_lang::message.productlist') }}
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
			{!! Build::alert_ajax('producto Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.productlist') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="products">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
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
					<h4 class="modal-title">Datos del producto</h4>
				</div>
				<div class="modal-body">

				<div class="row">
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Producto:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('name', null, ['class'=>'form-control bg_etiquetas', 'id'=>'name']) !!}
					</div>
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Detalles:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('details', null, ['class'=>'form-control bg_etiquetas', 'id'=>'details']) !!}
					</div>
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Precio Venta:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('sale_price', null, ['class'=>'form-control bg_etiquetas', 'id'=>'sale_price']) !!}
					</div>
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Categoría:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('category', null, ['class'=>'form-control bg_etiquetas', 'id'=>'category']) !!}
					</div>
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('description', null, ['class'=>'form-control bg_etiquetas', 'id'=>'description']) !!}
					</div>
					<div class="col-md-3 col-sm-4">
						{!! Form::label('Cantidad:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-9 col-sm-8">
						{!! Form::label('quantity', null, ['class'=>'form-control bg_etiquetas', 'id'=>'quantity']) !!}
					</div>
					<div class="col-md-4 col-sm-4">
						{!! Form::label('Costo Producción:', null, ['class'=>'form-control etiquetas']) !!}
						</div>
						<div class="col-md-8 col-sm-8">
						{!! Form::label('production_cost', null, ['class'=>'form-control bg_etiquetas', 'id'=>'production_cost']) !!}
					</div>
				</div>
				</div>{{-- modal --}}
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
				var table = $('#products').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/product",
					"language": {
						url: "{{ asset('/plugins/datatables/spanish.json') }}"
					},
					"columns":[
					{data: 'id', visible: false},
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
                        url : '{{ URL::to("/product") }}' + '/' + pdt_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: pdt_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#name").html(data.name );
                    	$("#details").html(data.details );
                    	$("#category").html(data.category );
                    	$("#sale_price").html('$ ' + data.sale_price);
                    	$("#production_cost").html('$ ' + data.production_cost );
                    	$("#description").html(data.description );
                    	$("#quantity").html(data.quantity );
                    });

                   });

				$('body').delegate('#btnActionDelete','mouseenter',function(){
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
					  		url: '{{ route("product.destroy") }}'+'/'+pdt_id,
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