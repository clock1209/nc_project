@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registersale') }}
@endsection

@section('contentheader_title')
@endsection

@section('styles')
	<style type="text/css" media="screen">
		.total{
			border-width: 1px;
			border-style: solid;
			border-color: #ccc;
		}

		.et{
			margin-right: 15px;
		}
	</style>
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
	<div class="row">
			{{-- {!! Build::alert_ajax('Cliente Eliminado Exitosamente') !!} --}}
			@include('sweet::alert')
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.clientlist') }}</div>
				<div class="panel-body table-responsive bgn">
				<a data-toggle="collapse" href="#collapse1" class="btn bg-info">Hacer venta a usuario</a>
					<div id="collapse1" class="row panel-collapse collapse">
						<div class="form-horizontal pull-right">
							<div class="form-group row">
								<label for="client_lbl" class="col-sm-3 control-label">Cliente:</label>
								<div class="col-sm-10">
										<div class="form-horizontal">
											{!! Form::text('client', "", ['list'=> 'clients','class'=>'form-control']) !!}
											<datalist size='5' id="clients">
												@foreach ($clients as $client)
													<option value="{{ $client }}" >
												@endforeach
											</datalist>
										</div>
								</div>
							</div>
							
						</div>
					</div>
				{{-- <div id="collapse1" class="row panel-collapse collapse">
					<div class="col-md-5">
						<table class="table table-hover" id="clients">
							<h3 class="text-center">Agregar Cliente</h3>
							<thead class="thead-default">
								<tr>
									<th>ID</th>
									<th>Nombre</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Correo</th>
									<th>Domicilio</th>
									<th>Teléfono</th>
									<th>Celular</th>
									<th>Opciones</th>
								</tr>
							</thead>
						</table>
					</div>{{-- div tabla productos 
					<div class="col-md-7">
						<div class="form-horizontal">
							<input name="id_clt" type="text" id="id_clt">
							<div class="form-group">
								<label for="client_lbl" class="col-sm-3 control-label text-right">{{ trans('adminlte_lang::message.name') }}:</label>
								<div class="col-sm-8">
									{!!Form::text('name',null,['class'=>'form-control'])!!}
								</div>
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="client_lbl" class="col-sm-3 control-label text-right">{{ trans('adminlte_lang::message.lastnamefather') }}:</label>
	                    		<div class="col-sm-8">
	                    		{!!Form::text('lastNameFather',null,['class'=>'form-control'])!!}
	                    		</div>
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="client_lbl" class="col-sm-3 control-label text-right">{{ trans('adminlte_lang::message.lastnamemother') }}:</label>
	                    		<div class="col-sm-8">
	                    		{!!Form::text('lastNameMother',null,['class'=>'form-control'])!!}
	                    		</div>
	                    	</div>
	                    	<div class="form-group">
	                    		<label for="client_lbl" class="col-sm-3 control-label text-right">{{ trans('adminlte_lang::message.email') }}:</label>
	                    		<div class="col-sm-8">
	                    		{!!Form::text('email',null,['class'=>'form-control'])!!}
	                    		</div>
	                    	</div>
	                    </div>
					</div>{{-- div datos cliente 
					{{-- <div class="panel-footer">Panel Footer</div>
				</div> --}}
				<div class="row">
					<div class="col-md-5">
						<table class="table table-hover" id="products">
							<h3 class="text-center">Agregar Productos</h3>
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
					<div class="col-md-7">
						<table class="table table-hover" id="addTable">
						<h3  class="text-center">Venta</h3>
						<thead class="thead-default">
							<tr>
								<th>Cant</th>
								<th>Producto</th>
								<th>Detalle</th>
								<th>Precio Unitario</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody id="tbody">
							
						</tbody>
					</table>
						<div class="form-group form-inline">
							<div class="total">
								{{-- <h4 class="pull-left">cant total: </h4> --}}
								<h1 id="total_label" class="text-danger pull-right et"> 0</h1>
								<h2 class="pull-right">Total: $</h2>
							</div>
							
						</div>
						<div class="form-group">
							<div>
								{!!Form::open(['route'=>'sale.details', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
								{!! Form::hidden('sel_client', null) !!}
								{!! Form::hidden('final_total', null) !!}
								{!! Form::hidden('date', $date) !!}
								<button type="submit" class="btn btn-success" id="btnVenta">Vender</button>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>{{-- row --}}
				{{-- <div class="row" id="display_total">
					<div class="form-inline pull-right">
						<h2>Total: </h2><h1 id="total_label" class="text-danger">0</h1>
					</div>
				</div> --}}
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
						$('table tr').has('a[pdt_id="'+ pdt_id +'"]').remove()
						// var $this = $(this).parent().find('tr');
						// $('td').hide();
						var subtotal = data.sale_price;
						var sum = 0;
						// alert("sum 1: " + sum);
						// table.ajax.reload();
						// alert(data.name);
						$('#tbody').append("<tr name='fila'><td><input type='number' name='cant' min='1' max="+data.quantity+" step='1' value='1'></td><td name='name'>"+data.name+"</td><td name='details'>"+data.details+"</td><td name='sale_price'>$"+data.sale_price+"</td><td name='td'>$"+subtotal+"</td></tr>");
						$('td[name="td"]').each(function(){
							var ff = $(this).html();
							ff = ff.replace('$', '');
							// alert("ff this: " + ff);
							sum = parseInt(sum) + parseInt(ff);
							// alert("sum final: " + sum);
						});
						$('#total_label').empty().append(sum);
					});
				},
				onCancel: function() {
				},
			});
		});


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
			$('body').find('h1#total_label').text("$"+res);

			var sum = 0;
			// alert("suma 1: " + sum)
			$('td[name="td"]').each(function(){
				var ff = $(this).html();
				ff = ff.replace('$', '');
				// alert("ff this: " + ff);
				sum = parseInt(sum) + parseInt(ff);
				// alert("sum final: " + sum);
			});
			$('#total_label').empty().append(sum);
		});

		$('body').delegate('#btnVenta','click',function(){
			pdt_id = $(this).attr('pdt_id');
			var final_total = $('#total_label').html();
			$('input[name="final_total"]').val(final_total);
			var token = $("#token").val();
			var promise = $.ajax({
				url: '/sale/folio',
				headers: {'X-CSRF-TOKEN': token},
				type: 'GET',
				dataType: 'json',
				data: {id: pdt_id},
			}).done(function(data){
				console.log(data);
				$('#tbody tr').each(function(){
				$this = $(this);
				var subt = $this.find('td[name="td"]').html();
				var name = $this.find('td[name="name"]').html();
				var det = $this.find('td[name="details"]').html();
				var unip = $this.find('td[name="sale_price"]').html();
				var cant = $this.find('input[name="cant"]').val();
				var cmax = $this.find('input').attr('max');
				// alert('aqui esta');
				$.ajax({
					url: '/sale/' + cant + '/' + cmax + '/' + name + '/' + det + '/' + unip + '/' + subt + '/' + data,
					headers: {'X-CSRF-TOKEN': token},
					type: 'GET',
					dataType: 'json',
					data: {id: pdt_id},
				}).done(function(data){
					console.log(data);
				});
			});
			});
			// 	var res = $('input[name="folio"]').html();
			// 	alert(res);
			// alert(folio);
			// var total = $('#total_label').html();
			// var cliente = $('input[name="client"]').val();
			// alert(total);
			// 	$.ajax({
			// 		url: '/sale/details/' + total + '/' + cliente,
			// 		headers: {'X-CSRF-TOKEN': token},
			// 		type: 'GET',
			// 		dataType: 'json',
			// 		data: {name: cliente},
			// 	}).done(function(data){
			// 		console.log(data);
					// window.location=data.ToString();
				// window.location.replace("http://ncmuebleria.local/sale/create");
				// });
			
			// $.ajax({
			// 	url: '/sale/details',
			// 	headers: {'X-CSRF-TOKEN': token},
			// 	type: 'GET',
			// 	dataType: 'json',
			// 	data: {id: pdt_id},
			// }).done(function(data){
			// 	// console.log(data);
			// 	// event.PreventDefault();
			// 	alert('antes');
			// 	// similar behavior as an HTTP redirect
			// 	window.location.replace("http://stackoverflow.com");

			// 	alert('num: 2');
			// 	// similar behavior as clicking on a link
			// 	window.location.href = "http://stackoverflow.com";
			// 	// location.href="data";
			// 	alert('num 3');
			// 	return false;
			// 	alert('ultima');
			// });
			// $("form").trigger( "submit" );
		});

		$('body').delegate('input[name="client"]','focusout',function(){
            var client = $(this).val();
            $('input[name="sel_client"]').val(client);
        });

	});
</script>

@endsection