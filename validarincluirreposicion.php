<?php
include_once("conexion.php");
$conecta = conectarse();
$fecha = $_POST['fecha'];
$cedula = $_POST['cedula'];
$cant1 = $_POST['cant1'];
$cant2 = $_POST['cant2'];
$cant3 = $_POST['cant3'];
$cant4 = $_POST['cant4'];
$total = $_POST['total'];

if(empty($cedula)) { 
	echo "02"; //." -Cedula: $cedula - Cant1: $cant1 - Cant2: $cant2 - Cant3: $cant3 ";
	// No Deje Campos Vacios
} else {
	$p1=0;$p2=0;
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
	$sql5 = "UPDATE almacen SET existencia='$tempaques' WHERE id='4'; ";
	$res2 = mysql_query($sql2,$conecta);
	$res3 = mysql_query($sql3,$conecta);
	$res4 = mysql_query($sql4,$conecta);
	$res5 = mysql_query($sql5,$conecta);
	if($res5==false || $res4==false || $res3==false || $res2==false) {
		echo "06";
		// Error al actualizar almacen!
	} else {		
		if($total>0) {
			$p4 = $total;
			// Se facturan los empaques y se procesa la reposicion			
			$sql1="INSERT INTO factura (id_fact,fecha,ced_prod,compra1,compra2,compra3,compra4,precio1,precio2,precio3,precio4,transporte,total) 
			VALUES (NULL,'$fecha','$cedula',0,0,0,'$cant4',0,0,0,'$p4',0,'$total')";
			$res0=mysql_query($sql1,$conecta);
			if($res0==false) {
				echo "06"." Error al facturar los empaques";
				// Error al incluir factura!
			} else {
				if(!empty($cant1) || !empty($cant2) || !empty($cant3)) {
					// Si hay reposicion, se procesan
					$sql2="INSERT INTO reposicion (id_reposicion,fecha_rep,cedula,cant_alev1,cant_alev2,cant_juve) 
					VALUES (NULL,'$fecha','$cedula','$cant1','$cant2','$cant3')";
					$res1=mysql_query($sql2,$conecta);
					if($res1==false) {
						$message  = 'Consulta fallo: ' . mysql_error() . "\n";
				    	$message .= 'Cual consulta: ' . $sql2;
						echo "06".$message;
						//echo "06"." Error al reponer despues de facturar los empaques"." Cant1: ".$cant1." Cant2:".$cant2;
						// Error al incluir reposicion
					} else {
						echo "11"." o este 1";
						// Grabacion exitosa! facturar
					}
				} else {
					echo "09"." o este 2";
					// Grabacion exitosa! facturar
				}
			}
		} else {
			// Solo se procesa la reposicion
			$sql2="INSERT INTO reposicion (id_reposicion,fecha_don,cedula,cant_alev1,cant_alev2,cant_juve) 
				VALUES (NULL,'$fecha','$cedula','$cant1','$cant2','$cant3')";
			$res1=mysql_query($sql2,$conecta);
			if($res1==false) {
				$message  = 'Consulta fallo: ' . mysql_error() . "\n";
		    	$message .= 'Cual consulta: ' . $sql2;
				echo "06".$message;
				//echo "06"." Error al reponer"." Cant1: ".$cant1." Cant2:".$cant2;
				// Error al incluir reposicion
			} else {
				echo "04"." o este 3";
				// Grabacion exitosa!
			}
		}
	}	
}
?>