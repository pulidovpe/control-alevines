<?php
include("conexion.php");
$conecta = conectarse();

$idacta = $_POST['id_acta'];
$fechae = $_POST['fecha_entreg'];
$razons = $_POST['razons'];
$cedula = $_POST['cedula'];
$nombres = strtoupper($_POST['nombres']);
$apellidos = strtoupper($_POST['apellidos']);
$observ = strtoupper($_POST['observaciones']);

	$sql = "SELECT id_acta FROM acta WHERE id_acta = '$idacta' ";
	$resultado1 = mysql_query($sql,$conecta);
	
	{		$sql="INSERT INTO `acta` (`id_acta`,`fecha_entreg`,`razons`,`cedula`,`nombres`,`apellidos`,`observaciones`)
	VALUES ('$idacta','$fechae','$razons','$cedula','$nombres','$apellidos','$observ')";

		$resultado2 = mysql_query($sql,$conecta);
		if($resultado2==false) {
			echo "<center><h2>Error al tratar de ingresar</h2><br />";
			echo "<a href='modificar.php'>Volver a Incluir</a></center>";
		} else {
			echo "<center><h2>Grabación exitosa</h2><br />";
			echo "<a href='menu.php'>Volver al menú</a></center>";
		}
	}

?>

