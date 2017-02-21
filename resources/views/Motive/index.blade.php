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
	{{ trans('adminlte_lang::message.motiveslist') }}
@endsection

@section('contentheader_title') 
@permission('create_motive')
<a class="btn btn-success btn-close addNew" href="{{ route('motive.create') }}"><i class="glyphicon glyphicon-plus"></i><t class="hidden-xs"> Agregar Nuevo</t></a>
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
		{!! Build::alert_ajax('Motivo Eliminado Exitosamente') !!}
			<div class="panel panel-default">
				<div class="panel-heading"  style="background: #1792a4; color: white;"><b><i class="info-box-text">{{ trans('adminlte_lang::message.motiveslist') }}</i></b></div>

				<div class="panel-body table-responsive">
					<table class="table table-hover" id="motives">
						<thead>
							<tr>
								<th>ID</th>
								<th>Descripción</th>
								<th style="width: 28%">Action</th>
							</tr>
						</thead>
					</table>
				</div>
		</div>
	</div>

	<div class="modal" id="motive">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background: #1792a4; color: white;">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Detalles de Motivo</h4>
				</div>
				<div class="modal-body">
					<div class="form-group has-feedback">
						{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'description', 'rows'=>'1']) !!}
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
				</div>
			</div>
		</div>
	</div>
</div>
		
		<script>

			$(document).ready(function(){
				var table = $('#motives').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/motives",
					"columns":[
					{data: 'id', visible: false},
					{data: 'description'},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});

				$('body').delegate('.get-motive','click',function(){
                    mtv_id = $(this).attr('mtv_id');
                    $.ajax({
                        url : '{{ URL::to("/motive") }}' + '/' + mtv_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: mtv_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#description").html(data.description );
                    });

                   });

				$('body').delegate('#btnActionDelete','click',function(){
					mtv_id = $(this).attr('mtv_id');
					var token = $("#token").val();
					$.ajax({
						url: '{{ route("motive.destroy") }}'+'/'+mtv_id,
						headers: {'X-CSRF-TOKEN': token},
						type: 'GET',
						dataType: 'json',
						data: {id: mtv_id},
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