@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('contentheader_title') 
	<a class="btn btn-primary" href="{{ route('report.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> <t class="hidden-xs">Regresar</t></a>
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.report') }}</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="reports">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Fecha</th>
								<th>Usuario</th>
								<th>Cliente</th>
								<th>Dominio</th>
								<th>Motivo</th>
								<th>Descripción</th>
								<th>Estatus</th>
								<th>Tiempo</th>
								<th style="width: 28%">Action</th>
							</tr>
						</thead>
					</table>
					<input type="hidden" id="date1" value="{{ $date1 }}">
					<input type="hidden" id="date2" value="{{ $date2 }}">
					<input type="hidden" id="username" value="{{ $username }}">
					<input type="hidden" id="status" value="{{ $status }}">
				</div>
			</div>
		</div>
	</div>

</div>
<script>

	$(document).ready(function(){ 
		date1 = $("#date1").val();
		date2 = $("#date2").val();
		username = $("#username").val();
		status = $("#status").val();
		var table = $('#reports').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "/api/reports"+"/"+date1+"/"+username+"/"+status+date2,
			"columns":[
			{data: 'id', visible: false},
			{data: 'date'},
			{data: 'user'},
			{data: 'client'},
			{data: 'domain', visible: false},
			{data: 'motive', visible: false}, 
			{data: 'description', visible: false},
			{data: 'status', visible: false},
			{data: 'attentiontime'},
			{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
			],
		});
	});
</script>

@endsection