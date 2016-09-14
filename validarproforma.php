<?php
include("conexion.php");
$conecta = conectarse();

$id = $_POST['id_factura'];
$fechaf = $_POST['fecha_factura'];
$razons = $_POST['razons'];
$ced = $_POST['cedula'];
$nom = strtoupper($_POST['nombres']);
$apll = strtoupper($_POST['apellidos']);
$tel = $_POST['telefono'];
$dir = strtoupper($_POST['direccion']);
$est = strtoupper($_POST['estado']);
$mun = strtoupper($_POST['municipio']);
$concep = strtoupper($_POST['concepto']);
$cantidad_alev = $_POST['cantidad_alev'];
$cantidad_juv = $_POST['cantidad_juv'];
$precio_unit = $_POST['precio_unit'];
$total = $_POST['total'];
$observa = strtoupper($_POST['observaciones']);

if($id=='' || $fechaf=='') {
	echo "<center><h2>Campos no pueden ir vacios</h2><br />";
	echo "<a href='facturaproforma.php'>Volver a Incluir</></center>";
} else	{
	$sql = "SELECT id_factura FROM factura WHERE id_factura = '$id' ";
	$resultado1 = mysql_query($sql,$conecta);

	{  	$sql="INSERT INTO `facturapro` (`id_factura`,`fecha_factura`,`razons`,`cedula`,`nombres`,`apellidos`,`telefono`,`direccion`,`estado`,`municipio`,`concepto`,`cantidad_alev`,`cantidad_juv`,`precio_unit`,`total`,`observaciones`) 
		VALUES ('$id','$fechaf','$razons','$ced','$nom','$apll','$tel','$dir','$est','$mun','$concep','$cantidad_alev','$cantidad_juv','$precio_unit','$total','$observa')";
		
		$resultado2 = mysql_query($sql,$conecta);

		if($resultado2==false) {
			echo "<center><h2>Error al tratar de ingresar</h2><br />";
			echo "<a href='facturaproforma.php'>Volver a Incluir</a></center>";
		}else {
			echo "<center><h2>Grabación exitosa</h2><br />";
			echo "<a href='menu.php'>Volver al menú</a></center>";
		}
	}
}	
?>