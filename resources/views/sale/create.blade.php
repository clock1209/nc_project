@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registersale') }}
@endsection

@section('contentheader_title')
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
			{{-- {!! Build::alert_ajax('Cliente Eliminado Exitosamente') !!} --}}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.clientlist') }}</div>
				<div class="panel-body table-responsive bgn">
				<div class="row">
					<div class="col-md-6">
						<table class="table table-hover" id="products">
							<h3 class="text-center">Productos</h3>
							<thead class="thead-default">
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Detalles</th>
									<th>Categoria</th>
									<th>Precio</th>
									<th>Costo</th>
									<th>Descripción</th>
									<th>Existencia</th>
									<th style="width: 28%">Opciones</th>
								</tr>
							</thead>
						</table>
					</div>{{-- div tabla productos --}}
					<div class="col-md-6">
						<table class="table table-hover" id="addTable">
						<h3  class="text-center">Venta</h3>
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
					</div>
					
				</div>{{-- row --}}
				<div class="row" id="display_total">
					<div class="form-inline pull-right">
						<h2>Total: </h2><h1 id="total_label" class="text-danger"> nums</h1>
					</div>
				</div>
					{{-- <table class="table table-hover" id="clients">
						<thead class="thead-default">
							<tr>
								<th>Cant</th>
								<th>Producto</th>
								<th>Precio Unitario</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>2</td>
								<td>Mesa</td>
								<td>$ 350</td>
								<td>$ 700</td>
							</tr>

						</tbody>
					</table> --}}
				</div>{{-- panel body --}}
			</div>{{-- panel default --}}
		</div>
	</div>
</div>{{-- container-fluid --}}

<script type="text/javascript">
	$(document).ready(function(){
		// var addTable = $('#addTable').value();
		// alert(addTable);
		var table = $('#products').DataTable({
			"processing": true,
			"serverSide": true,
			"scrollY": 200,
			"ajax": "/api/prd_sales",
			"language": {
				url: "{{ asset('/plugins/datatables/spanish.json') }}"
			},
			"columns":[
			{data: 'id', visible: false},
			{data: 'name'},
			{data: 'details'},
			{data: 'category', visible: false},
			{data: 'sale_price', visible: false}, 
			{data: 'production_cost', visible: false},
			{data: 'description', visible: false},
			{data: 'quantity'},
			{data: 'action', name: 'action', orderable: false, serchable: false, bSearchable: false},
			],
		});

		$('body').delegate('#btnAdd','mouseenter',function(){
			pdt_id = $(this).attr('pdt_id');
			// alert(pdt_id);
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
						url: '{{ route("sale.addProduct", '') }}' + '/' + pdt_id,
						headers: {'X-CSRF-TOKEN': token},
						type: 'GET',
						dataType: 'json',
						data: {id: pdt_id},
					}).done(function(data){
						console.log(data);
						var subtotal = data.sale_price;
						// table.ajax.reload();
						// alert(data.name);
						$('#tbody').append("<tr><td><input type='number' name='cant' min='1' max="+data.quantity+" step='1' value='1'></td><td>"+data.name+"</td><td name='sale_price'>$"+data.sale_price+"</td><td name='td'>$"+subtotal+"</td></tr>");
						// $("#msj-"+data.message).fadeOut().fadeIn();
						
						// <input type="number" name="points" min="0" max="100" step="10" value="30">
					});
				},
				onCancel: function() {
				},
			});
		});

		// $('body').delegate('input', 'change', function (){
		// 	$('td[name="td"]').on(this).text('gg');
		// });
		// 
		var total = 0;
		var subtotal = 0;
		var cant = 0;
		var res = 0;
		$('body').delegate('#tbody tr', 'change', function (){
			subtotal = $(this).find('td[name="sale_price"]').html();
			subtotal = subtotal.replace('$', '');
			cant = $(this).find('input[name="cant"]').val();
			res = subtotal * cant;

			$(this).find('td[name="td"]').text("$"+res);

			// $('td[name="td"]').each(function(){
			// 	total = parseFloat(total) + parseFloat(subtotal);
			// });
			// alert(total);
			// $('body').find('h1#total_label').text("$"+total);

		});

		$('body').delegate('h1#total_label', 'change', function (){
			// alert('cambio');
			// subtotal = $(this).find('td[name="td"]').val();
			alert('subtotal');
			// subtotal = subtotal.replace('$', '');
			// $(this).find('h1[name="total"]').text("hola");
			// cant = $(this).find('input[name="cant"]').val();
			// res = subtotal * cant;

			// $(this).find('td[name="td"]').text("$"+res);
		});

		// $('body').delegate('h1#total_label', 'mouseenter', function (){
		// 	alert('dd f');
		// 	// subtotal = $(this).find('td[name="td"]').html();
		// 	// alert(subtotal);
		// 	// subtotal = subtotal.replace('$', '');
		// 	// $(this).find('h1[name="total"]').text("hola");
		// 	// cant = $(this).find('input[name="cant"]').val();
		// 	// res = subtotal * cant;

		// 	// $(this).find('td[name="td"]').text("$"+res);
		// });
	});
</script>

@endsection