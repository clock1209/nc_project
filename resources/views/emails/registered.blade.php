<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Demystifying Email Design</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


	<style type="text/css">
		.fondo-contenido{
			background: #EAF2F8;
		}
		.radius-top{
			border-top-left-radius: 50px;
			border-top-right-radius: 50px;
		}
		.radius-bottom{
			border-bottom-left-radius: 50px;
			border-bottom-right-radius: 50px;
		}
		.fondo-titulo{
			background: #1792a4;
			color: #F8F9F9;
		}
		.pad-text{
			padding: 5px;
		}
		.btn{
			border-radius: 50px;
			background: e47c5d;
		}

		td #contenido{
			color: 142b3b;
		}
	</style>
</head>
<body style="margin: 0; padding: 0; font-family: Calibri;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td>
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" height="220" style="border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9">
							<img src="{{ asset('/img/nuvem_cabecera.png') }}" alt="header image" width="600" height="220" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td align="center" class="radius-top fondo-titulo">
										<h2>Notificación de contraseña</h2>
									</td>
								</tr>
								<tr>
									<td align="center" id="contenido" class="fondo-contenido">
										<p>Bienvenido al portal <strong>{!! $name !!} {!! $lastNameFather !!}</strong></p>
										<p>Se ha creado exitosamente tu usuario, tus datos de acceso son los siguientes:</p><br>
										<label>Tu Usuario:</label>
										<label>{!! $username !!}</label><br>
										<label>Tu Contraseña</label>
										<label>{!! $password !!}</label><br>
										<a href="http://nuvem.local/login" class="btn btn-default" role="button">Ir a Página</a>
										<img src="{{ asset('/img/nuvem_png.png') }}" alt="nuvem image" style="display: block; padding: 15px 0 10px 0;" />
									</td>
								</tr>
								<tr>
									<td align="center" class="radius-bottom fondo-titulo pad-text">Nuvem Tecnología viva - Todos los derechos reservados.</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>