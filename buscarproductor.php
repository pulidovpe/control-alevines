<?php if(@session_start() == false){session_destroy();session_start();}
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
<center>
	<div id="busca-productor">
		<br />
		<h2>Buscar productor</h2><br />
		<form name="frmbusqueda" action="" onsubmit="javascript:buscarDato('0','resultado1'); return false">	
		<table width="42%" border="1" align="center" bordercolor="#F0F0F0">
			<tr>
				<td width="24%" height="28"><label>Cédula:</label></td>
				<td width="76%">
					<input type="text" name="cedula" id="cedula" size="7" maxlength="8" />
				</td>
			</tr>
			<tr>
				<td><label>Estado y Municipio:</label></td>
				<td>
					<div id='anidado'><iframe src="anidado2.php" width="400" height="30" name="anidado" scrolling="no" frameborder="0"></iframe></div>
					<input type='hidden' name='var_ciudad' id='var_ciudad' value=0>
					<input type='hidden' name='estado1' id='estado1' />	
					<input type='hidden' name='municipio1' id='municipio1' />		      
				</td>
			</tr>	
			<tr>
				<td colspan="2" align="center">
					<input type="submit" value="Buscar" />
					<input type="button" value="Borrar" onclick="javascript:llamarasincronoget('buscarproductor.php','contenedor','centro','0');" />
					<input type="button" value="Cancelar" onclick="llamarasincronoget('productores.php','contenedor','centro','0')" />
				</td>
			</tr>
		</table>
		</form>
		<fieldset><legend>Resultado de la Busqueda</legend>
		<div id="resultado1"></div>
	</div>
</center>