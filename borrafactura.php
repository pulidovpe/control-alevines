<?php
	include_once("conexion.php");
   $conecta=conectarse();

   $id=$_GET['id'];
   $consulta1 = sprintf("DELETE FROM `factura` WHERE `id_factura`='%s' ",mysql_real_escape_string($id));
   mysql_query($consulta1,$conecta);
   
   echo "<center><h2>Borrado exitoso</h2><br />";
	echo "<a href='incluirfactura.php'>Volver al menu</a></center>";
?> 
<!doctype html>
<html lang="es">
	<head>
		<title>Eliminar de Factura de Venta</title>
		<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
		
	
</html>
