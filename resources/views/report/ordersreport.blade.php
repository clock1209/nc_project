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

	<div class="modal fade" id="pedido">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header header-nuvem">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title">Datos de Pedido</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Fecha creación:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('order_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'order_date']) !!}
						</div>
						<div class="col-md-4 col-sm-4">
							{!! Form::label('Feche entrega:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-8 col-sm-8">
							{!! Form::label('delivery_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'delivery_date']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Cliente:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('client', null, ['class'=>'form-control bg_etiquetas', 'id'=>'client']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Usuario:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('user', null, ['class'=>'form-control bg_etiquetas', 'id'=>'user']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Teléfono:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('phone_number', null, ['class'=>'form-control bg_etiquetas', 'id'=>'phone_number']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Correo:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('email', null, ['class'=>'form-control bg_etiquetas', 'id'=>'email']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Presupuesto:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('budget', null, ['class'=>'form-control bg_etiquetas', 'id'=>'budget']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Anticipo:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('retainer', null, ['class'=>'form-control bg_etiquetas', 'id'=>'retainer']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Prioridad:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('priority', null, ['class'=>'form-control bg_etiquetas', 'id'=>'priority2']) !!}
						</div>
						<div class="col-md-3 col-sm-4">
							{!! Form::label('Estatus:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-9 col-sm-8">
							{!! Form::label('status', null, ['class'=>'form-control bg_etiquetas', 'id'=>'status2']) !!}
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Domicilio:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-12 col-sm-12" style="margin-bottom: 5px; margin-top: 0px">
							{{-- {!! Form::textarea('address', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'address', 'rows' => '2']) !!} --}}
							<div class="form-control bg_etiquetas" id="address"></div>
						</div>
						<div class="col-md-12 col-sm-12">
							{!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
							</div>
							<div class="col-md-12 col-sm-12"  style="margin-top: 0px">
							{{-- {!! Form::textarea('description', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'description', 'rows' => '4']) !!} --}}
							<div class="form-control bg_etiquetas" id="description"></div>
						</div>


					</div>

				</div>{{-- modal-body --}}
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

		$('body').delegate('.get-order','click',function(){
                    odr_id = $(this).attr('odr_id');
                    $.ajax({
                        url : '{{ URL::to("/order") }}' + '/' + odr_id ,
                        type : 'GET',
                        dataType: 'json',
                        data : {id: odr_id}
                    }).done(function(data){
                    	console.log(data);
                    	$("#order_date").html(data.created_at );
                    	$("#client").html(data.client );
                    	$("#user").html(data.user );
                    	$("#phone_number").html(data.phone_number);
                    	$("#email").html(data.email );
                    	$("#address").html(data.address );
                    	$("#description").html(data.description );
                    	$("#budget").html(data.budget );
                    	$("#priority2").html(data.priority );
                    	$("#status2").html(data.status );
                    	$("#retainer").html(data.retainer );
                    	$("#delivery_date").html(data.delivery_date );
                    });

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