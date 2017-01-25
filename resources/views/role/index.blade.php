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
@endsection

@section('main-content')

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    {{ Session::get('message') }}    
</div>
@endif


<div class="container-fluid spark-screen">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.rolelist') }}</i></div>

			<div class="panel-body">
				<table class="table" id="roles">
					<thead>
						<tr>
							<th>ID</th>
							<th>Role</th>
							<th>Permissions</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
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
			{data: 'permissions', name: 'action', orderable: false, serchable: false, bSearchable: false},
			{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
			],
		});

		$("#btnPermission").click(function(){
			$("#permisos").modal("toggle");
		});

		{{-- rol_id = null; --}}
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

		{{-- $('.get-permisos').on('click', function(){
			rol_id = $(this).attr('rol_id');
			$.ajax({
				url : '{{ URL::to("/permission") }}',
				type : 'GET',
				dataType: 'json',
				data : {id: rol_id}
			}).done(function(data){

				$.each(data.permisosAsignados ,function(index, value){
					$('#select-permisos option[value="'+value.id+'"]').attr('selected', true);
				});
				$('#select-permisos').multiSelect('refresh');
			});
		}); --}}
	});
</script>
</div>

@endsection