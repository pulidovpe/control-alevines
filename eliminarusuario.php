<?php
include_once("conexion.php");
$conecta = conectarse();
$usu=$_REQUEST["usu"];
$instruccion="DELETE FROM usuarios WHERE usuario='$usu'";
$consulta=mysql_query($instruccion,$conecta);
?>