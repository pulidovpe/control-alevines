<html lang="es">
	<head>
		<title>Registro General de Productores</title>
		<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
</html>
<?php
include("conexion.php");
$conecta = conectarse();

$sql = "SELECT * FROM productor";
$consulta = mysql_query($sql,$conecta);
echo "<h1><center>Registro de Productores</a></center></h1>";
echo "<center><table border='1'><TR><TD><B>Nombres</B></TD><TD><B>Apellidos</B></TD><TD><B>Razón Social</B></TD><TD><B>Cedula</B></TD><TD><B>Dirección</B></TD><TD><B>Telefono</B></TD><TD><B>Estado</B></TD><TD><B>Municipio</B></TD></TR>"; 
while($registros = mysql_fetch_array($consulta)) {     
	printf("<TR><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD></TR>",$registros['nombres'],$registros['apellidos'],$registros['razons'],$registros['cedula'],$registros['direccion'],$registros['telefono'],$registros['estado'],$registros['municipio']);
}
echo "</table>";
echo "<center><a href='incluirproductor.php'>Volver al Menu</a></center>";
mysql_free_result($consulta);
mysql_close($conecta); 
?>
<!doctype html>


