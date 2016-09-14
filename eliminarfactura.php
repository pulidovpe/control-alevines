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
	<title>Eliminar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
<body>
	<center>
		<h1 align="center">Eliminar Registro de Factura</h1>
		<br />
		<form method="post" action="validareliminarfactura.php">
			<table width="237" height="96" border="1" align="center">
				<tr>
					<td width="128">
				    <label>Número de Factura </label></td>
					<td width="64">
						<input type="text" name="id_factura" id="id_factura" size="7" maxlength="8" />	
				    </td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<div align="center">
						  <input type="submit" value="Aceptar" />
						  <input type="reset" value="Cancelar" />
				        </div></td>
				</tr>
		  </table>	
   	        <div align="center"></div>
   	        <div align="center"></div>
		</form>
   	    <div align="center"><a href='incluirfactura.php'>Volver al menú</a>
        </div>
</html>
		
		
