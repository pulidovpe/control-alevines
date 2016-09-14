<?php
include_once("conexion.php");
$conecta = conectarse();
$fpago1 = $_POST['fpago1'];
$numero1 = $_POST['numero1'];
$fecha1 = $_POST['fecha1'];
$monto1 = $_POST['monto1'];
$fpago2 = $_POST['fpago2'];
$numero2 = $_POST['numero2'];
$fecha2 = $_POST['fecha2'];
$monto2 = $_POST['monto2'];
$fpago3 = $_POST['fpago3'];
$numero3 = $_POST['numero3'];
$fecha3 = $_POST['fecha3'];
$monto3 = $_POST['monto3'];
$idfact = $_POST['id_factura'];

if(empty($fpago1) || empty($fecha1) || empty($monto1) || empty($idfact) || ($monto2>0 && empty($fpago2)) || ($monto3>0 && empty($fpago3))) { 
	echo "02";
	// No Deje Campos Vacios
} else {
	$sql1="INSERT INTO depositos (cod_dep,forma_pago,num_cheqdep,fecha,monto,factura) 
	VALUES (NULL,'$fpago1','$numero1','$fecha1','$monto1','$idfact')";
	$res1=mysql_query($sql1,$conecta);
	if($res1==false) {
		echo "07";
		// Error al tratar de incluir deposito!
	} else {
		if(!empty($monto2)) {
			$sql2="INSERT INTO depositos (cod_dep,forma_pago,num_cheqdep,fecha,monto,factura) 
			VALUES (NULL,'$fpago2','$numero2','$fecha2','$monto2','$idfact')";
			$res2=mysql_query($sql2,$conecta);
			if($res2==false) {
				echo "07";
				// Error al tratar de incluir deposito!
			} else {
				if(!empty($monto3)) {
					$sql3="INSERT INTO depositos (cod_dep,forma_pago,num_cheqdep,fecha,monto,factura) 
					VALUES (NULL,'$fpago3','$numero3','$fecha3','$monto3','$idfact')";
					$res3=mysql_query($sql3,$conecta);
					if($res3==false) {
						echo "07";
						// Error al tratar de incluir deposito!
					} else {
						echo "08";
						// Grabacion exitosa en los depositos!
					}
				} else {
					echo "08";
					// Grabacion exitosa en los depositos!
				}
			}
		} else {
			echo "08";
			// Grabacion exitosa en los depositos!
		}
	}	
}
?>