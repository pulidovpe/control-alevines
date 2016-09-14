<?php session_start();
if(!isset($_SESSION['usuario'])) { 
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
<div id="div-donacion">
	<center>
		<br />
		<br />
		<br />
		<H3 align="center">LISTADO DE REPOSICIONES</H3>
		<div id="paginador">
			<?php include('paginador5.php') ?>
		</div>
	</center>
</div>		