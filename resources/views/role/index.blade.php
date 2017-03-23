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
	{{ trans('adminlte_lang::message.rolelist') }}
@endsection

@section('contentheader_title') 
@permission('create_role')
<a class="btn btn-success btn-md addNew" href="{{ route('role.create') }}"><i class="glyphicon glyphicon-plus"></i> <t class="hidden-xs">Agregar Nuevo</t></a>
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
        {!! Build::alert_ajax('Rol Eliminado Exitosamente') !!}
		<div class="panel panel-default">
			<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.rolelist') }}</div>

			<div class="panel-body table-responsive bgn">
				<table class="table table-hover" id="roles">
					<thead>
						<tr>
							<th>ID</th>
							<th>Role</th>
							<th style="width: 38%">Action</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mostrar_rol">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-nuvem"  style="background: #1792a4; color: white;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Datos de Rol</h4>
                </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        {!! Form::label('Nombre de Rol:', null, ['class'=>'form-control etiquetas']) !!}
                        </div>
                        <div class="col-md-8 col-sm-8">
                        {!! Form::label('name', null, ['class'=>'form-control bg_etiquetas', 'id'=>'name']) !!}
                    </div>
                    <div class="col-md-4 col-sm-4">
                        {!! Form::label('Nombre a Mostrar:', null, ['class'=>'form-control etiquetas']) !!}
                        </div>
                        <div class="col-md-8 col-sm-8">
                        {!! Form::label('display_name', null, ['class'=>'form-control bg_etiquetas', 'id'=>'display_name']) !!}
                    </div>
                    <div class="col-md-4 col-sm-4">
                        {!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
                        </div>
                        <div class="col-md-8 col-sm-8">
                        {!! Form::label('description', null, ['class'=>'form-control bg_etiquetas', 'id'=>'description']) !!}
                    </div>

                </div>


                </div>
                <div class="modal-footer background-nuvem">
                    <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="permisos">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header header-nuvem">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title">Gestionar permisos</h4>
        </div>
        <div class="modal-body">
        <div class="row">
        <select id="select-permisos" multiple="multiple">
                @if(isset($permisos))
                    @foreach($permisos as $permiso)
                    {{-- <option value="{{ $permiso->id }}">{{ $permiso->display_name }}</option> --}}
                        @if (preg_match('/Usuario[s]?$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-user" style="width: 100%"> {{ $permiso->display_name }}</option>
                        @elseif (preg_match('/Rol(es)?$|Permiso$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-knight" style="width: 100%"> {{ $permiso->display_name }}</option>
                        @elseif (preg_match('/Cliente[s]?$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="fa fa-users" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @elseif (preg_match('/Pedido[s]?$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-paperclip" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @elseif (preg_match('/Producto[s]?$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-bed" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @elseif (preg_match('/Cotización?$|Cotizaciones$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-briefcase" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @elseif (preg_match('/Venta$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-usd" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @elseif (preg_match('/Reportes$/', $permiso->display_name))
                            <option value="{{ $permiso->id }}" class="glyphicon glyphicon-list-alt" style="width: 100%"> {{ $permiso->display_name }}</option><span class="fa fa-home"></span>
                        @endif
                    @endforeach
                @endif
            </select>
        </div>
          
        </div>
        <div class="modal-footer background-nuvem">
          <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
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
		var table = $('#roles').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "/api/roles",
            "language": {
                url: "{{ asset('/plugins/datatables/spanish.json') }}"
            },
			"columns":[
			{data: 'id', visible: false},
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
                    selectableHeader: "<h4 class='text-center'><b>Permisos <span class='text-danger'>NO</span> asignados</h4></b>",
                    selectionHeader: "<h4  class='text-center'><b>Permisos asignados</h4></b>",
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

                $('body').delegate('#btnActionDelete','mouseenter',function(){
                    rol_id = $(this).attr('rol_id');
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
                            url: '{{ route("role.destroy") }}'+'/'+rol_id,
                            headers: {'X-CSRF-TOKEN': token},
                            type: 'GET',
                            dataType: 'json',
                            data: {id: rol_id},
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