<?php
include("conexion.php");
$conecta = conectarse();
$usu = $_POST['usuario'];
$cla = $_POST['clave'];
$ccla = md5($cla); // CIFRADO DE CLAVE MD5
$sql = "SELECT usuario,clave,tipo FROM usuarios WHERE usuario = '$usu' and clave='$ccla' ";
$consulta = mysql_query($sql,$conecta);
if($consulta == false) {
	$message  = 'Consulta fallo: ' . mysql_error() . "\n";
	$message .= 'Cual consulta: ' . $result1;
	echo "20".$message; // Error al tratar de grabar los datos
} else {
	$fila=mysql_fetch_array($consulta);
	$num = mysql_num_rows($consulta);
	if($num > 0) {
		session_start();
		$_SESSION['usuario'] = $usu;
		$_SESSION['tipo'] = $fila['tipo'];
		//defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss 
		$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
		echo "01"; // Entrada Exitosa al Sistema
	} else {
		echo "00"; // Usuario o clave inválido
	}
}
?>