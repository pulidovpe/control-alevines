<?php
include("conexion.php");
$conecta = conectarse();

$id = $_POST['id_acta'];
$fechaf = $_POST['fecha_entreg'];
$razons = $_POST['razons'];
$ced = $_POST['cedula'];
$nom = strtoupper($_POST['nombres']);
$apll = strtoupper($_POST['apellidos']);
$observa = strtoupper($_POST['observaciones']);

if($id=='' || $fechaf=='') {
	echo "<center><h2>Campos no pueden ir vacios</h2><br />";
	echo "<a href='actaentrega.php'>Volver a Incluir</></center>";
} else	{
	$sql = "SELECT id_aca FROM acta WHERE id_acta = '$id' ";
	$resultado1 = mysql_query($sql,$conecta);

	{  	$sql="INSERT INTO `acta` (`id_acta`,`fecha_entreg`,`razons`,`cedula`,`nombres`,`apellidos`,`observaciones`) 
		VALUES ('$id','$fechaf','$razons','$ced','$nom','$apll','$observa')";
		
		$resultado2 = mysql_query($sql,$conecta);

		if($resultado2==false) {
			echo "<center><h2>Error al tratar de ingresar</h2><br />";
			echo "<a href='actaentrega.php'>Volver a Incluir</a></center>";
		}else {
			echo "<center><h2>Grabación exitosa</h2><br />";
			echo "<a href='menu.php'>Volver al menú</a></center>";
		}
	}
}	
?>