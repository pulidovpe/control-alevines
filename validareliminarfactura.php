<?php
include_once("conexion.php");
$conecta = conectarse();

$id = $_POST['id_factura'];

if($id=='') {
	echo "<center><h2>Campo no puede ir vacio</h2><br />";
	echo "<a href='eliminarfactura.php'>Volver a Eliminar</></center>";
} else {
	$sql = "SELECT id_factura,fecha_factura,razons,cedula,nombres,apellidos,telefono,direccion,estado,municipio,concepto,cantidad_alev,cantidad_juv,precio_unit,total,tipopago,banco,num_deposito,fecha_deposito,tipo_transporte,observaciones FROM factura WHERE id_factura = '$id' ";

	$consulta = mysql_query($sql,$conecta);

	$num = mysql_num_rows($consulta);
	if($num > 0) {

		echo "<center><table border='1'><TR><TD>&nbsp;<B>Número de Factura</B></TD><TD>&nbsp;<B>Borrar</B>&nbsp;</TD></TR>"; 
		while($registros = mysql_fetch_array($consulta)) {   

			printf("<tr><td>&nbsp;%s</td><td><a href=\"borrafactura.php?id=%s\">Borrar</a></td></tr>",$registros['id_factura'],$registros['fecha_factura']);
		}
		echo "</table>";
	}
	echo "<h3>Sinó esta seguro vuelva a ingresar el Número de Factura</h3><br />";
	echo "<a href='eliminarfactura.php'>Volver al Eliminar</a></center>";
   mysql_free_result($consulta);
   mysql_close($conecta); 
}
?>

<!doctype html>
<html lang="es">
	<head>
		<title>Registro de Factura de Venta</title>
		<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
		
	
</html>


