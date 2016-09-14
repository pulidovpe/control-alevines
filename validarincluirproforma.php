<?php
include_once("conexion.php");
$conecta = conectarse();
$fecha = $_POST['fecha'];
$cedula = $_POST['cedula'];
$cant1 = $_POST['cant1'];
$cant2 = $_POST['cant2'];
$cant3 = $_POST['cant3'];
$cant4 = $_POST['cant4'];
$p1 = $_POST['p1'];
$p2 = $_POST['p2'];
$p3 = $_POST['p3'];
$p4 = $_POST['p4'];
$total = $_POST['total'];

if(empty($cedula) || empty($cant4) || empty($p4) || empty($total)){ 
	echo "02"." -Cedula: $cedula - Cant4: $cant4 - P4: $p4 - Total: $total";
	// No Deje Campos Vacios
} else {
	// Registrar una proforma mediante un Procedimiento Almacenado
	$sql = "CALL piscicola.proforma1(NULL,'$fecha','$cedula','$cant1','$cant2','$cant3','$cant4','$p1','$p2','$p3','$p4','$total')";
	//	$sql1="INSERT INTO proforma (id_fact,fecha,ced_prod,compra1,compra2,compra3,compra4,precio1,precio2,precio3,precio4,total) 
	//VALUES (NULL,'$fecha','$cedula','$cant1','$cant2','$cant3','$cant4','$p1','$p2','$p3','$p4','$total')";
	$res0=mysql_query($sql,$conecta);
	if($res0==false) {
		echo "06";
		// Error al incluir proforma!
	} else {
		//imprimir proforma			
		echo "10";
		// Grabacion exitosa!
	}
}	
?>