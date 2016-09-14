<?php
include("conexion.php");
$ced=$_REQUEST["cedula"];
$instruccion="DELETE FROM productor WHERE cedula='$ced'";
$consulta=mysql_query($instruccion);
?>
<script>
alert('Borrado Exitoso!');
this.document.location.href="incluirproductor.php";
</script>";
	
