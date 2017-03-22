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
				<div class="panel-heading header-nuvem">reporte de ventas/usuario</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="reports">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Fecha</th>
								<th>ID Cliente</th>
								<th>ID Usuario</th>
								<th>Folio</th>
								<th>Cliente</th>
								<th>Usuario</th>
								<th>Total</th>
								<th style="width: 28%">Action</th>
							</tr>
						</thead>
					</table>
					<input type="hidden" id="date1" value="{{ $date1 }}">
					<input type="hidden" id="date2" value="{{ $date2 }}">
					<input type="hidden" id="username" value="{{ $username }}">
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="venta">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Detalles de venta</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<table class="table table-hover" id="sale-details">
							<thead class="thead-default">
								<tr>
									<th>Cant</th>
									<th>Producto</th>
									<th>Precio Unitario</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody id="tbody">
								
							</tbody>
						</table>
					</div>{{-- row --}}
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
		date1 = $("#date1").val();
		date2 = $("#date2").val();
		username = $("#username").val();
		var table = $('#reports').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "/api/reports"+"/"+date1+"/"+username+date2,
			"language": {
				url: "{{ asset('/plugins/datatables/spanish.json') }}"
			},
			"columns":[
			{data: 'id', visible: false},
			{data: 'date'},
			{data: 'id_client', visible: false},
			{data: 'id_user', visible: false},
			{data: 'folio', visible: false},
			{data: 'client'}, 
			{data: 'user'},
			{data: 'total'},
			{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
			],
		});

		$('body').delegate('.get-venta_total','click',function(){
			folio = $(this).attr('folio');
			$.ajax({
				url : '{{ URL::to("report/folio") }}' + '/' + folio ,
				type : 'GET',
				dataType: 'json',
				data : {id: folio}
			}).done(function(data){
				console.log(data);
				$('#tbody').empty();
                $.each(data, function (key, value){
                	$('#tbody').append("<tr name='fila'><td>"+value.quantity+"</td><td name='name'>"+value.product+"</td><td name='sale_price'>$"+value.unitary_price+"</td><td name='td'>$"+value.subtotal+"</td></tr>");
                });
			});

		});
	});
</script>

@endsection