<?php
include("conexion.php");
$conecta = conectarse();
$razons = $_POST['razons'];
$ced = $_POST['cedula'];
$nom = strtoupper($_POST['nombres']);
$apll = strtoupper($_POST['apellidos']);
$tel = $_POST['telefono'];
$dir = strtoupper($_POST['direccion']);
$est1 = strtoupper($_POST['estado1']);
$mun1 = strtoupper($_POST['municipio1']);

if( empty($ced) || empty($razons) || empty($nom) || empty($apll) || empty($dir) || empty($est1) || empty($mun1) ) { 
	echo "02"." estados1: $est1 - municipios1: $mun1";
	// No Deje Campos Vacios
} else {
	// No se cambio el estado ni el municipio
	if(($est1=='Seleccione') || ($mun1=='Seleccione')) {
		$sql="UPDATE productor SET nombres='$nom', apellidos='$apll', direccion='$dir', telefono='$tel' WHERE cedula='$ced' ";
		$res=mysql_query($sql,$conecta);
		if($res==false){
			echo "03";
			// Productor ya existe!
		} else {
			echo "05";
			// Modificacion exitosa!
		}
	} else {
		$sql="UPDATE productor SET nombres='$nom', apellidos='$apll', direccion='$dir', telefono='$tel', estados='$est1', municipios='$mun1' WHERE cedula='$ced' ";
		$res=mysql_query($sql,$conecta);
		if($res==false){
			echo "03";
			// Productor ya existe!
		} else {
			echo "05";
			// Modificacion exitosa!
		}
	}
}
?>