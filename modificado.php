<?php
include("conexion.php");
$conecta = conectarse();

$nom = $_POST['nombre'];
$apll = $_POST['apellido'];
$razons = $_POST['razons'];
$ced = $_POST['cedula'];
$tel = $_POST['telefono'];
$dir = $_POST['direccion'];
$est = $_POST['estado'];
$mun = $_POST['municipio'];

if($ced=='' || $nom=='') {
	echo "<center><h3>Campos no pueden ir vacios</h3><br />";
	echo "<a href='modificarprodcutor.php'>Volver a Modificar</a></center>";
} else {
	//$sql = "SELECT cedula FROM productor WHERE cedula = '$ced' ";
	$sql = "UPDATE productor SET ";
	$sql.= "nombre='".$nom."', apellido='".$apll."', razons='".$razons."', telefono='".$tel."', direccion='".$dir."', estado='".$est."', municipio='".$mun."' ";
	$sql.= "WHERE cedula=".$ced;
	$resultado = mysql_query($sql,$conecta);

	if($resultado==false) {
		echo "<center><h3>Error al tratar de modificar</h3><br />";
		echo "<a href='modificarproductor.php'>Volver a Modificar</a></center>";
	} else {
		echo "<center><h3>Modificación exitosa</h3><br />";
		echo "<a href='menu.php'>Volver al menú</a></center>";
	}
}
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
	</head>
		<link rel="stylesheet" type="text/css" href="css/estilosvs.css" />
	
</html>