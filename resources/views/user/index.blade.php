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

<div class="container-fluid spark-screen">
	<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('adminlte_lang::message.userslist') }}</div>

				<div class="panel-body">
					<table class="table" id="users">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
		</div>
	</div>
</div>

	{{-- <div class="container-fluid spark-screen">
		<div class="row">
            <table class="table" id="users">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
		</div> --}}
		
		<script>

			$(document).ready(function(){
				$('#users').DataTable({
					"processing": true,
					"serverSide": true,
					"ajax": "/api/users",
					"columns":[
					{data: 'id'},
					{data: 'name'},
					{data: 'email'},
					{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
					],
				});
			});
		</script>
	</div>
	
    
@endsection