@extends('adminlte::layouts.app')

<?php $message=Session::get('message')?>

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.rolelist') }}
    	<style>
            .user{
                margin-top: 60px;
            }
        </style>
@endsection

@section('contentheader_title') 
@permission('create_role')
{!!Form::open(['route'=> ['role.create'], 'method'=>'GET'])!!}
{!!Form::submit('Agregar Rol', ['class'=>'btn btn-success',
    'style'=>'float:right; margin-right: 5px; margin-right: 100px'])!!}
{!!Form::close()!!}
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
		<div class="panel panel-default">
			<div class="panel-heading" style="background: #1792a4; color: white;"><i class="info-box-text"><b>{{ trans('adminlte_lang::message.rolelist') }}</b></i></div>

			<div class="panel-body">
				<table class="table" id="roles">
					<thead>
						<tr>
							<th>ID</th>
							<th>Role</th>
							<th style="width: 360px">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal" id="mostrar_rol">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Datos de Usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Nombre de Rol:</div>
                        {!! Form::label('name', null, ['class'=>'form-control', 'id'=>'name']) !!}
                    </div>
                    <div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Nombre a Mostrar:</div>
                        {!! Form::label('display_name', null, ['class'=>'form-control', 'id'=>'display_name']) !!}
                    </div>
                    <div class="form-group has-feedback input-group mb-2 mr-sm-2 mb-sm-0">
                        <div class="input-group-addon">Descripción:</div>
                        {!! Form::label('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal" id="permisos">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Gestionar permisos</h4>
        </div>
        <div class="modal-body">
          <select id="select-permisos" multiple="multiple">
                @if(isset($permisos))
                    @foreach($permisos as $permiso)
                        <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
        </div>
      </div>
    </div>
</div>

<script>

	$(document).ready(function(){
		$('#roles').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "/api/roles",
			"columns":[
			{data: 'id'},
			{data: 'display_name'},
			{data: 'action', name: 'action', orderable: false, serchable: false,  bSearchable: false},
			],
		});

        $('body').delegate('.get-rol-datos','click',function(){
            id_rol = $(this).attr('id_rol');
            $.ajax({
                url : '{{ URL::to("/role") }}' + '/' + id_rol ,
                type : 'GET',
                dataType: 'json',
                data : {id: id_rol}
            }).done(function(data){
                console.log(data);
                $("#name").html(data.name );
                $("#display_name").html(data.display_name);
                $("#description").html(data.description);
            });

        });

			 	rol_id = null;
               $('#select-permisos').multiSelect({
                    selectableHeader: "<div class='custom-header'>Permisos no asignados</div>",
                    selectionHeader: "<div class='custom-header'>Permisos asignados</div>",
                   afterSelect:function(value){//enviamos al servidor el id del permiso seleccionado
                        $.ajax({
                        url : '{{ URL::to("/permisos/asignar") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {permission_id: value[0], role_id: rol_id}
                    }).done(function(data){
                        console.log(data);
                    });
                   },
                   afterDeselect:function(value){//enviamos al servidor el id del permiso seleccionado
                        $.ajax({
                        url : '{{ URL::to("/permisos/desasignar") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {permission_id: value[0], role_id: rol_id}
                    }).done(function(data){
                        console.log(data);
                    });
                   }
               });

                $('body').delegate('.get-permisos','click',function(){
                    rol_id = $(this).attr('rol_id');
                    $('#select-permisos option').prop('selected', false);
                    $.ajax({
                        url : '{{ URL::to("/permisos") }}',
                        type : 'GET',
                        dataType: 'json',
                        data : {id: rol_id}
                    }).done(function(data){
                        $.each(data.permisosAsignados ,function(index, value){
                        	console.log(value);
                            $('#select-permisos option[value="'+value.id+'"]').prop('selected', true);
                        });
                        $('#select-permisos').multiSelect('refresh');
                    });
                } );
	});
</script>
</div>

@endsection