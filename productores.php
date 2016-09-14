<?php session_start();
if(!isset($_SESSION['usuario'])) { 
	header("Location: cerrarsesion.php");
	exit;
}  else {
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
<div id="div-productor">
	<center>
		<br />
		<br />
		<br />
		<br />
		<H3 align="center">LISTADO DE PRODUCTORES</H3>
		<nav>
			<table width="768" height="41">
				<td width="133"><div align="center"><a href="javascript:llamarasincronoget('incluirproductor.php','contenedor','centro','0');">Agregar</a></div></td>
				<td width="135"><div align="center"><a href="javascript:llamarasincronoget('buscarproductor.php','contenedor','centro','0');">Buscar</a></div></td>
				<!-- td width="135"><div align="center"><a href="javascript:popupCentrado('imprimirlistadopro.php','PRODUCTORES','800','600','0');">Listado de Productores</a></div></td -->
				<td width="135"><div align="center"><a href="javascript:llamarasincronoget('imprimirproductor.php','contenedor','centro','0');">Listado de Productores</a></div></td>
				<!--td width="135"><div align="center"><a href="index.php" target="_self">Volver al Menú</a></div></td-->
			</table>	
		</nav>
		<div id="paginador">
			<?php include('paginador.php') ?>
		</div>
	</center>
</div>