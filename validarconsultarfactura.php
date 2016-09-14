<?php
include("conexion.php");
$conecta = conectarse();

$sql = "SELECT * FROM factura";
$consulta = mysql_query($sql,$conecta);
echo "<h1><center>Consulta de Facturas Emitidas</a></center></h1>";
echo "<center><table border='1'><TR><TD><B>Número de Factura</B></TD><TD><B>Fecha de Factura</B></TD><TD><B>Razón Social</B></TD><TD><B>Cedula/RIF</B></TD><TD><B>Nombres</B></TD><TD><B>Apellidos</B></TD><TD><B>Teléfono</B></TD><TD><B>Dirección</B></TD><TD><B>Estado</B></TD><TD><B>Municipio</B></TD><TD><B>Concepto</B></TD><TD><B>Cantidad de Alevines</B></TD><TD><B>Cantidad de Juveniles</B></TD><TD><B>Precio Unitario</B></TD><TD><B>Total</B></TD><TD><B>Tipo de Pago</B></TD><TD><B>Banco</B></TD><TD><B>Número de Deposito</B></TD><TD><B>Fecha de Deposito</B></TD><TD><B>Transporte</B></TD><TD><B>Observaciones</B></TD></TR>"; 
while($registros = mysql_fetch_array($consulta)) {   

	printf("<TR><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD></TR>",$registros['id_factura'],$registros['fecha_factura'],$registros['razons'],$registros['cedula'],$registros['nombres'],$registros['apellidos'],$registros['telefono'],$registros['direccion'],$registros['estado'],$registros['municipio'],$registros['concepto'],$registros['cantidad_alev'],$registros['cantidad_juv'],$registros['precio_unit'],$registros['total'],$registros['tipopago'],$registros['banco'],$registros['num_deposito'],$registros['fecha_deposito'],$registros['tipo_transporte'],$registros['observaciones']);
}
echo "</table>";
echo "<center><a href='incluirfactura.php'>Volver al Menu</a></center>";
mysql_free_result($consulta);
mysql_close($conecta); 
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

