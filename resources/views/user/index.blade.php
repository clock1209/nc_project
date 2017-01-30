@extends('adminlte::layouts.app')

<?php $message=Session::get('message')?>

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.userslist') }}
@endsection

@section('contentheader_title') 
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
			<div class="panel panel-default">
				<div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.userslist') }}</i></div>

				<div class="panel-body">
					<table class="table" id="users">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombre de Usuario</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
		</div>
	</div>

	<div class="modal" id="usuario">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
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
						<div class="input-group-addon">Teléfono:</div>
						{!! Form::label('homePhone', null, ['class'=>'form-control', 'id'=>'homePhone']) !!}
					</div>
					<div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon">Celular:</div>
						{!! Form::label('cellPhone', null, ['class'=>'form-control', 'id'=>'cellPhone']) !!}
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn">Cerrar</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
		<script>

			$(document).ready(function(){
				$('#users').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/users",
					"columns":[
					{data: 'id'},
					{data: 'name'},
					{data: 'lastNameFather'},
					{data: 'lastNameMother'},
					{data: 'username'},
					{data: 'email', visible: false}, 
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
                    	console.log(data.email);
                    	$("#name").html(data.name );
                    	$("#lastNameFather").html(data.lastNameFather );
                    	$("#lastNameMother").html(data.lastNameMother );
                    	$("#email").html(data.email);
                    	$("#username").html(data.username );
                    	$("#homePhone").html(data.homePhone );
                    	$("#cellPhone").html(data.cellPhone );
                    	$("#role").html(data.role );
                    });

                   });
			});
		</script>
	</div>
	
    
@endsection