<?php
	include_once("conexion.php");
	$conecta = conectarse();
	// Preguntaremos si se han enviado ya las variables necesarias
	$usuario = $_POST["usuario"];
	$clave   = $_POST["clave"];
	$cclave  = $_POST["cclave"];
	$nombre  = strtoupper($_POST["nombre"]);
	$tele    = $_POST["tele"];
	$tipo    = 2;  // Tipo de usuario

	if(!empty($usuario) || !empty($clave) || !empty($cclave) || !empty($nombre) || !empty($tele)) {		
		// CIFRADO DE CLAVE MD5
		//$cclave = md5($clave); 
		/*******************/
		// Registro un usuario mediante un Procedimiento Almacenado
		$sql = "CALL piscicola.registrarse('$usuario', '$clave', $tipo, '$nombre', '$tele')";
		//$sql = "INSERT INTO usuarios (usuario, clave, nombre, telefono) VALUES('$usuario','$cclave','$nombre','$tele')";
		$res=mysql_query($sql,$conecta);
		if($res==false){
			echo "14"." El usuario ya existe!";
		} else {
			echo "12" . " GRABACION EXITOSA";
		}		
	} else {
		echo "13"." CAMPOS NO PUEDEN IR VACIOS";
	}
?>