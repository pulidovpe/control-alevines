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
	<title>Consultar Registro de Factura</title>
</head>
<body bgcolor=grey>
	<center>
		<h1>Realizar Consulta</h1>
		<form method="post" action="validarconsultarfactura.php">
			<table border="1">
			<input type="submit" value="Consultar" />
			</table>
		</form>
		<a href='incluirfactura.php'>Volver al menú</a>
	</center> 
</body>
</html>