@extends('adminlte::layouts.app')

<?php $message=Session::get('message')?>

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.rolelist') }}
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
			});
		</script>
	</div>
	
    
@endsection