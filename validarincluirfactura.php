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
$trans = $_POST['trans'];
$total = $_POST['total'];
$id_fact = $_POST['id_factura'];

if(empty($cedula) || empty($cant4) || empty($p4) || empty($total)){ 
	echo "02"." -Cedula: $cedula - Cant4: $cant4 - P4: $p4 - Total: $total";
	// No Deje Campos Vacios
} else {
	//Saber cuanto hay en almacen	
	$res1 = mysql_query("SELECT existencia FROM almacen",$conecta);
	$reg = mysql_fetch_array($res1);	
	$talevines1 = $reg['existencia'] - $cant1;
	$reg = mysql_fetch_array($res1);	
	$talevines2 = $reg['existencia'] - $cant2;
	$reg = mysql_fetch_array($res1);
	$tjuveniles = $reg['existencia'] - $cant3;
	$reg = mysql_fetch_array($res1);
	$tempaques = $reg['existencia'] - $cant4;
	$sql2 = "UPDATE almacen SET existencia='$talevines1' WHERE id='1'; ";
	$sql3 = "UPDATE almacen SET existencia='$talevines2' WHERE id='2'; ";
	$sql4 = "UPDATE almacen SET existencia='$tjuveniles' WHERE id='3'; ";
	$sql5 = "UPDATE almacen SET existencia='$tempaques'  WHERE id='4'; ";
	//DUDA. DEBO ACTUALIZAR transporte EN EL ALMACEN???

	$res2 = mysql_query($sql2,$conecta);
	$res3 = mysql_query($sql3,$conecta);
	$res4 = mysql_query($sql4,$conecta);
	$res5 = mysql_query($sql5,$conecta);
	if($res5==false || $res4==false || $res3==false || $res2==false) {
		echo "06";
		// Error al actualizar almacen! 
	} else {
		$sql0="INSERT INTO acta (id_acta,fecha_entreg,id_fact,cedula) 
		VALUES (NULL ,'', '$id_fact', '$cedula')";
		$res0=mysql_query($sql0,$conecta);
		$sql1="INSERT INTO factura (id_fact,fecha,ced_prod,compra1,compra2,compra3,compra4,precio1,precio2,precio3,precio4,transporte,total) 
		VALUES (NULL,'$fecha','$cedula','$cant1','$cant2','$cant3','$cant4','$p1','$p2','$p3','$p4','$trans','$total')";
		$res1=mysql_query($sql1,$conecta);
		if($res0==false || $res1==false) {
			echo "06";
			// Error al incluir factura!
		} else {
			//imprimir factura			
			echo "09";
			// Grabacion exitosa!
		}
	}	
}
?>