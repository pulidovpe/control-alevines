<?php
include_once("conexion.php");
$conecta=conectarse();
$ced=$_GET['ced'];
$consulta1 = sprintf("DELETE FROM `productor` WHERE `cedula`='%s' ",mysql_real_escape_string($ced));
mysql_query($consulta1,$conecta);
echo "<center><h2>Borrado exitoso</h2><br />";
echo "<a href='incluirproductor.php'>Volver al menu</a></center>";
?> 
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	</head>
		<link rel="stylesheet" type="text/css" href="css/estilosvs.css" />
	
</html>