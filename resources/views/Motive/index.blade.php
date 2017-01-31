@extends('adminlte::layouts.app')

<?php $message=Session::get('message')?>

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.motiveslist') }}
@endsection

@section('contentheader_title') 
@permission('create_user')
<a class="btn btn-success btn-close" href="{{ route('motive.create') }}" style="float:right; margin-right: 5px; margin-right: 100px">Agregar Motivo</a>
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
				<div class="panel-heading"><i class="info-box-text">{{ trans('adminlte_lang::message.userslist') }}</i></div>

				<div class="panel-body">
					<table class="table" id="motives">
						<thead>
							<tr>
								<th>ID</th>
								<th class="col-md-8">Descripción</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
		</div>
	</div>

	<div class="modal" id="motive">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Detalles de Motivo</h4>
				</div>
				<div class="modal-body">
					<div class="form-group has-feedback">
						{!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'description', 'rows'=>'5']) !!}
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
				$('#motives').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/motives",
					"columns":[
					{data: 'id'},
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
			});
		</script>
	</div>
	
    
@endsection