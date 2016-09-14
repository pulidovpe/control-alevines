<?php
	include_once("conexion.php");
	$conecta = conectarse();
	// Preguntaremos si se han enviado ya las variables necesarias
	$usu   = $_POST["usuario"];
	$cla   = $_POST["clave"];
	$ccla  = $_POST["cclave"];
	$nom   = strtoupper($_POST["nombre"]);
	$tele  = $_POST["tele"];
	if(empty($usu) || empty($cla) || empty($ccla) || empty($nom) || empty($tele)) {		
		echo "02"." usuario: $usu";
		// No Deje Campos Vacios
	} else {
		$sql="UPDATE usuarios SET clave='$cla', nombre='$nom', telefono='$tele' WHERE usuario='$usu' ";
		$res=mysql_query($sql,$conecta);
		if($res==false){
			echo "14";
			// Usuario ya existe!
		} else {
			echo "15";
			// Modificacion exitosa!
		}
	}
?>