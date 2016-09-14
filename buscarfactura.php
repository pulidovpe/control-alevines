<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
} 
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Buscar Registro de Factura</title>
</head>
<body bgcolor=grey>
	<center>
		<h1>Buscar</h1>
		<br />
		<form method="post" action="validarbuscarfactura.php">
			<table border="1">
				<tr>
					<td>
						<label>Número de Factura:</label>						
					</td>
					<td>
						<input type="text" name="id_factura" id="id_factura" size="7" maxlength="8" />	
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Aceptar" />
						<input type="reset" value="Cancelar" />
					</td>
				</tr>
			</table>
		</form>	
		<a href='incluirfactura.php'>Volver al menú</a>
	</center> 
</body>
</html>