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
	<title>Modificar Factura</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
<body>
	<center>
		<h1>Buscar Factura a Modificar</h1>
		<br />
		<form method="post" action="validarmodificarfactura.php">
			<table width="217" height="82" border="1">
				<tr>
					<td width="143">
						<label>Número de Factura:</label>						
				  </td>
					<td width="58">
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