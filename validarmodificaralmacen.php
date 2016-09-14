<?php
include_once("conexion.php");
$conecta = conectarse();
$existencia1 = $_POST['existencia1'];
$precio1 = $_POST['precio1'];
$existencia2 = $_POST['existencia2'];
$precio2 = $_POST['precio2'];
$existencia3 = $_POST['existencia3'];
$precio3 = $_POST['precio3'];
$existencia4 = $_POST['existencia4'];
$precio4 = $_POST['precio4'];
$existencia5 = $_POST['existencia5'];
$precio5 = $_POST['precio5'];
$existencia6 = $_POST['existencia6'];
$precio6 = $_POST['precio6'];
$existencia7 = $_POST['existencia7'];
$precio7 = $_POST['precio7'];

if(empty($existencia1) || empty($precio1) || empty($existencia2) || empty($precio2)
 || empty($existencia3) || empty($precio3) || empty($existencia4) || empty($precio4)
 || empty($existencia5) || empty($precio5) || empty($existencia6) || empty($precio6)
 || empty($existencia7) || empty($precio7)) { 
	echo "02";
	// No Deje Campos Vacios
} else {
	$sql1="UPDATE almacen SET existencia='$existencia1', precio='$precio1' WHERE id='1' ";
	$res1=mysql_query($sql1,$conecta);
	$sql2="UPDATE almacen SET existencia='$existencia2', precio='$precio2' WHERE id='2' ";
	$res2=mysql_query($sql2,$conecta);
	$sql3="UPDATE almacen SET existencia='$existencia3', precio='$precio3' WHERE id='3' ";
	$res3=mysql_query($sql3,$conecta);
	$sql4="UPDATE almacen SET existencia='$existencia4', precio='$precio4' WHERE id='4' ";
	$res4=mysql_query($sql4,$conecta);
	$sql5="UPDATE almacen SET existencia='$existencia5', precio='$precio5' WHERE id='5' ";
	$res5=mysql_query($sql5,$conecta);
	$sql6="UPDATE almacen SET existencia='$existencia6', precio='$precio6' WHERE id='6' ";
	$res6=mysql_query($sql6,$conecta);
	$sql7="UPDATE almacen SET existencia='$existencia7', precio='$precio7' WHERE id='7' ";
	$res7=mysql_query($sql7,$conecta);
	if($res1==false || $res2==false || $res3==false || $res4==false || $res5==false || $res6==false || $res7==false){
		echo "06";
		// No se pudo actualizar
	} else {
		echo "05";
		// Modificacion exitosa!
	}
}
?>