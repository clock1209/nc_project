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
	{{ trans('adminlte_lang::message.userslist') }}
@endsection

@section('contentheader_title') 
@permission('create_user')
<a class="btn btn-success btn-md addNew" href="{{ route('user.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
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
			{!! Build::alert_ajax('Usuario Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.userslist') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="users">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombre de Usuario</th>
								<th>Correo</th>
								<th>Domicilio</th>
								<th>Telefono</th>
								<th>Celular</th>
								<th style="width: 28%">Opciones</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="usuario">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Usuario</h4>
				</div>
				<div class="modal-body">
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Nombre:</div>
						{!! Form::label('name', null, ['class'=>'form-control', 'id'=>'name']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Apellido Paterno:</div>
						{!! Form::label('lastNameFather', null, ['class'=>'form-control', 'id'=>'lastNameFather']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Apellido Materno:</div>
						{!! Form::label('lastNameMother', null, ['class'=>'form-control', 'id'=>'lastNameMother']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Nombre de usuario:</div>
						{!! Form::label('username', null, ['class'=>'form-control', 'id'=>'username']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Correo:</div>
						{!! Form::label('email', null, ['class'=>'form-control', 'id'=>'email']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Rol:</div>
						{!! Form::label('role', null, ['class'=>'form-control', 'id'=>'role']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Domicilio:</div>
						{!! Form::label('address', null, ['class'=>'form-control', 'id'=>'address']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Teléfono:</div>
						{!! Form::label('homePhone', null, ['class'=>'form-control', 'id'=>'homePhone']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Celular:</div>
						{!! Form::label('cellPhone', null, ['class'=>'form-control', 'id'=>'cellPhone']) !!}
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
				var table = $('#users').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/users",
					"columns":[
					{data: 'id', visible: false},
					{data: 'name'},
					{data: 'lastNameFather'},
					{data: 'lastNameMother', visible: false},
					{data: 'username'},
					{data: 'email', visible: false}, 
					{data: 'address', visible: false},
					{data: 'homePhone', visible: false},
					{data: 'cellPhone', visible: false},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-user','click',function(){
                    usr_id = $(this).attr('usr_id');
                    $.ajax({
                        url : '{{ URL::to("/user") }}' + '/' + usr_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: usr_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#name").html(data[0].name );
                    	$("#lastNameFather").html(data[0].lastNameFather );
                    	$("#lastNameMother").html(data[0].lastNameMother );
                    	$("#email").html(data[0].email);
                    	$("#username").html(data[0].username );
                    	$("#homePhone").html(data[0].homePhone );
                    	$("#cellPhone").html(data[0].cellPhone );
                    	$("#address").html(data[0].address );
                    	$("#role").html(data[1]);
                    });

                   });

				$('body').delegate('#btnActionDelete','click',function(){
					usr_id = $(this).attr('usr_id');
					var token = $("#token").val();
					$.ajax({
						url: '{{ route("user.destroy") }}'+'/'+usr_id,
						headers: {'X-CSRF-TOKEN': token},
						type: 'GET',
						dataType: 'json',
						data: {id: usr_id},
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