<?php if(@session_start() == false){session_destroy();session_start();}
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
}

include_once("conexion.php");
$conecta = conectarse();
// Para que MySQL reconozca la ñ y demas caracteres latinos
mysql_query("SET NAMES 'utf8'");
//header("Content-Type: text/html;charset=utf-8");
	
		
	$sql=" select * from productor"; //código MySQL
$datos=mysql_query($sql,$con); //enviar código MySQL
while ($row=mysql_fetch_array($datos)) { //Bucle para ver todos los registros
      $nombre=$row['nombre']; //datos del campo nombre
      $telefono=$row['telefono']; //datos del campo teléfono
      $email=$row['email']; //datos del campo email
      echo "$nombre, $telefono, $email. <br/>"; //visualizar datos
      }
mysql_close($con);//cerrar conexion
?>

