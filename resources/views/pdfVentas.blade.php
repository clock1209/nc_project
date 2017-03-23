
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
		@foreach ($sale as $value)
			<tr>
				<th>{{ $value->quantity }}</th>
				<th>{{ $value->product }}</th>
				<th>{{ $value->unitary_price }}</th>
				<th>{{ $value->subtotal }}</th>
			</tr>
		@endforeach
	</tbody>
</table>


{{-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalles de Venta</title>
</head>
<body>
	<h3>Detalles de Venta</h3>
	<table>
		<thead>
			<tr>
				<th>Cant</th>
				<th>Producto</th>
				<th>Precio Unitario</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($sale as $sl)
				<tr>
					<th>{{ $sl->quantity }}</th>
					<th>{{ $sl->product }}</th>
					<th>{{ $sl->unitary_price }}</th>
					<th>{{ $sl->subtotal }}</th>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html> --}}