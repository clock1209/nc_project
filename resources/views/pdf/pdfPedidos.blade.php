

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Venta</title>
  <style>
  div.izq{
  	width: 45%;
  }
  div.der{
  	float: right;
  }
  div.total{
  	text-align: right;
  	position: relative;
  	bottom: 200px;
  }
  	table{
  		border-collapse: collapse;
  	}
  	table, th, td {
  		width: 100%;
  		border-bottom: 1px solid #ddd;
  		font-family: "Calibri", Times, serif;
  	}
  	th{
  		height: 35px;
  	}
  	td{
  		padding: 5px;
  	}
  	h2, h4{
  		text-align: center;
  	}
  	.centro{
  		text-align: center;
  	}
  </style>
</head>
<body>

<div>
  <div>
  	<h2>NC Mueblería</h2>
  </div>
  <div>
  	<h4>Detalles de Venta</h4>
  </div>
  <div class="izq">
	  @foreach ($venta_total as $element)
		  	<b>Folio: </b> 00{{ $element->folio }} <br>
		  	<b>Atendió: </b> {{ $element->user }} <br>
		  	<b>Cliente: </b> {{ $element->client }} <br>
		  	<b>Fecha: </b> {{ $element->date }} <br>
	  @endforeach
  </div>
 {{--  <div class="der">
	  @foreach ($venta_total as $element)
		  	<b>Atendió: </b> {{ $element->user }} <br>
		  	<b>Cliente: </b> {{ $element->client }} <br>
		  	<b>Folio: </b> 00{{ $element->folio }} <br>
	  @endforeach
  </div> --}}
  <table>
  	<thead>
  		<tr>
  			<th>Cant</th>
  			<th>Producto</th>
  			<th>precio unitario</th>
  			<th>subtotal</th>
  		</tr>
  	</thead>
  	<tbody>
  		@foreach ($sale as $key => $value)
  		<tr>
  			<td>{{ $value->quantity }}</td>
  			<td>{{ $value->product }}</td>
  			<td>{{ $value->unitary_price }}</td>
  			<td>{{ $value->subtotal }}</td>
  		</tr>
  		@endforeach
  	</tbody>
  </table>
</div>
<div class="total">
	@foreach ($venta_total as $element)
		<h1><b>Total: </b>${{ $element->total }}</h1>
	@endforeach
</div>

<div class="centro">
	<small>NC Mueblería - Todos los derechos reservados</small>
</div>

</body>
</html>
