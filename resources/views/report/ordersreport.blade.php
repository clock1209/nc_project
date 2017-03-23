@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('contentheader_title') 
	<a class="btn btn-primary" href="{{ route('reporte.index') }}"><i class="glyphicon glyphicon-chevron-left"></i> <t class="hidden-xs">Regresar</t></a>
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">reporte pedidos</div>
				<div class="panel-body table-responsive bgn">
					<table class="table table-hover" id="reports">
						<thead class="thead-default">
							<tr>
								<th>ID</th>
								<th>Cliente</th>
								<th>Usuario</th>
								<th>Fecha</th>
								<th>Teléfono</th>
								<th>Correo</th>
								<th>Domicilio</th>
								<th>Descripción</th>
								<th>Presupuesto</th>
								<th>Anticipo</th>
								<th>Fecha de Entrega</th>
								<th>Prioridad</th>
								<th>Estatus</th>
								<th>Opción</th>
							</tr>
						</thead>
					</table>
					<input type="hidden" id="date1" value="{{ $date1 }}">
					<input type="hidden" id="date2" value="{{ $date2 }}">
					<input type="hidden" id="username" value="{{ $username }}">
					<input type="hidden" id="status" value="{{ $status }}">
					<input type="hidden" id="priority" value="{{ $priority }}">
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
							<h4 style="margin-left: 25px;">
								<span class="text-muted">#Folio: <b name="folio"></b></span>
							</h4>
							<thead class="thead-default">
								<tr class="bg-faded">
									<th>Cant</th>
									<th>Producto</th>
									<th>Precio Unitario</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody id="tbody">
								
							</tbody>
							<div name="venta_muestra" class="text-center"></div>
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
		status = $("#status").val();
		priority = $("#priority").val();
		var table = $('#reports').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "/api/reportso"+"/"+date1+"/"+username+"/"+status+"/"+priority+date2,
			"language": {
				url: "{{ asset('/plugins/datatables/spanish.json') }}"
			},
			"columns":[
			{data: 'id', visible: false},
			{data: 'client'},
			{data: 'user'},
			{data: 'quote_date', visible: false},
			{data: 'phone_number', visible: false},
			{data: 'email', visible: false}, 
			{data: 'address', visible: false},
			{data: 'description', visible: false},
			{data: 'budget', visible: false},
			{data: 'retainer', visible: false},
			{data: 'delivery_date', visible: false},
			{data: 'priority'},
			{data: 'status'},
			{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
			],
		});

		// $('body').delegate('.get-venta_total','click',function(){
		// 	folio = $(this).attr('folio');
		// 	$.ajax({
		// 		url : '{{ URL::to("report/folio") }}' + '/' + folio ,
		// 		type : 'GET',
		// 		dataType: 'json',
		// 		data : {id: folio}
		// 	}).done(function(data){
		// 		console.log(data);
		// 		$('#tbody').empty();
		// 		$('div[name="venta_muestra"]').empty();

		// 		if (typeof data === 'object' ) {
		// 			$.each(data, function (key, value){
		// 				$('#tbody').append("<tr name='fila'><td>"+value.quantity+"</td><td name='name'>"+value.product+"</td><td name='sale_price'>$"+value.unitary_price+"</td><td name='td'>$"+value.subtotal+"</td></tr>");
		// 				$('b[name="folio"]').html(value.folio);
		// 			});
		// 		}else {
		// 			$('div[name="venta_muestra"]').append("<h3>Venta de Muestra ;)</h3>");
	 //                $('b[name="folio"]').html(data);
		// 		}
		// 	});

		// });
	});
</script>

@endsection