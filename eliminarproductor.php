<?php
include_once("conexion.php");
$conecta=conectarse();
$ced=$_GET['cedula'];
$consulta1 = sprintf("DELETE FROM `productor` WHERE `cedula`='%s' ",mysql_real_escape_string($ced));
mysql_query($consulta1,$conecta);
?> 
<script>
	llamarasincronoget('productores.php','contenedor','centro','0');
</script>