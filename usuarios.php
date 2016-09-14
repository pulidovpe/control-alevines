<?php session_start();
if(!isset($_SESSION['usuario']) && ($_SESSION['tipo'] != 1)) { 
  header("Location: cerrarsesion.php");
  exit;
} else {
	//sino, calculamos el tiempo transcurrido
	$fechaGuardada = $_SESSION["ultimoAcceso"];
	$ahora = date("Y-n-j H:i:s");
	$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

	//comparamos el tiempo transcurrido 
	if($tiempo_transcurrido >= 600) {  //si pasaron 10 minutos o más
		session_destroy(); // destruyo la sesión
		header("Location: index.php"); //envío al usuario a la pag. de autenticación
		//sino, actualizo la fecha de la sesión
	} else {
		$_SESSION["ultimoAcceso"] = $ahora;
	} 
} 
?>
<div id="div-usuarios">
	<center>
		<br />
		<br />
		<br />
		<br />
		<H3 align="center">LISTADO DE USUARIOS</H3>
		<nav>
			<table width="400" height="41">
				<td width="133"><div align="center"><a href="javascript:llamarasincronoget('registrarse.php','contenedor','centro','0');">Agregar Usuario</a></div></td>
			</table>	
		</nav>
		<div id="paginador">
			<?php include('paginador6.php') ?>
		</div>
	</center>
</div>