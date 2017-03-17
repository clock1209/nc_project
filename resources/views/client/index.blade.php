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
	{{ trans('adminlte_lang::message.clientlist') }}
@endsection

@section('contentheader_title') 
@permission('create_client')
<a class="btn btn-success btn-md addNew" href="{{ route('client.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
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
			{!! Build::alert_ajax('Cliente Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.clientlist') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="clients">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Correo</th>
								<th>Domicilio</th>
								<th>Teléfono</th>
								<th>Celular</th>
								<th style="width: 28%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="cliente">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Cliente</h4>
				</div>
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Nombre:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('name', null, ['class'=>'form-control text-danger', 'id'=>'name']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Apellido Paterno:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('lastNameFather', null, ['class'=>'form-control text-danger', 'id'=>'lastNameFather']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Apellido Materno:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('lastNameMother', null, ['class'=>'form-control text-danger', 'id'=>'lastNameMother']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Correo:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('email', null, ['class'=>'form-control text-danger', 'id'=>'email']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Domicilio:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('address', null, ['class'=>'form-control text-danger', 'id'=>'address']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Teléfono:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('homePhone', null, ['class'=>'form-control text-danger', 'id'=>'homePhone']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Celular:', null, ['class'=>'form-control bg-olive']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('cellPhone', null, ['class'=>'form-control text-danger', 'id'=>'cellPhone']) !!}
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

		paceOptions = {
		  // Disable the 'elements' source
		  elements: false,

		  // Only show the progress on regular and ajax-y page navigation,
		  // not every request
		  restartOnRequestAfter: false
		}


			$(document).ready(function(){
				var table = $('#clients').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/clients",
					"language": {
						url: "{{ asset('/plugins/datatables/spanish.json') }}"
					},
					"columns":[
					{data: 'id', visible: false},
					{data: 'name'},
					{data: 'lastNameFather'},
					{data: 'lastNameMother'},
					{data: 'email'}, 
					{data: 'address', visible: false},
					{data: 'homePhone', visible: false},
					{data: 'cellPhone', visible: false},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-client','click',function(){
                    clt_id = $(this).attr('clt_id');
                    $.ajax({
                        url : '{{ URL::to("/client") }}' + '/' + clt_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: clt_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#name").html(data.name );
                    	$("#lastNameFather").html(data.lastNameFather );
                    	$("#lastNameMother").html(data.lastNameMother );
                    	$("#email").html(data.email);
                    	$("#homePhone").html(data.homePhone );
                    	$("#cellPhone").html(data.cellPhone );
                    	$("#address").html(data.address );
                    });

                   });

				$('body').delegate('#btnActionDelete','mouseenter',function(){
					clt_id = $(this).attr('clt_id');
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
					  		url: '{{ route("client.destroy") }}'+'/'+clt_id,
					  		headers: {'X-CSRF-TOKEN': token},
					  		type: 'GET',
					  		dataType: 'json',
					  		data: {id: clt_id},
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