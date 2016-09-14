<?php
include_once("conexion.php");
$conecta = conectarse();
$razons = $_POST['razons'];
$ced = $_POST['cedula'];
$nom = strtoupper($_POST['nombres']);
$apll = strtoupper($_POST['apellidos']);
$tel = $_POST['telefono'];
$dir = strtoupper($_POST['direccion']);
$est1 = strtoupper($_POST['estado1']);
$mun1 = strtoupper($_POST['municipio1']);

if(empty($ced) || empty($razons) || empty($nom) || empty($apll) || empty($dir) || empty($est1) || empty($mun1) || $est1=='Seleccione' || $mun1=='Seleccione'){ 
	echo "02"; //." estados1: $est1 - municipios1: $mun1";
	// No Deje Campos Vacios
} else {
	/*******************/
	// Registro un productor mediante un Procedimiento Almacenado
	$sql = "CALL piscicola.productor1('$ced','$nom','$apll','$razons','$tel','$dir','$est1','$mun1')";
	//$sql="INSERT INTO productor (cedula,nombres,apellidos,razons,telefono,direccion,estados,municipios) VALUES ('$ced','$nom','$apll','$razons','$tel','$dir','$est1','$mun1')";
	$res=mysql_query($sql,$conecta);
	if($res==false){
		echo "03";
		// Productor ya existe!
	} else {
		echo "04";
		// Grabacion exitosa!
	}
}
?>