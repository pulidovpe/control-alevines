<?php session_start();
//if(!isset($_SESSION['usuario']) && 
if($_SESSION['tipo'] > 1) { 
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
include_once("conexion.php");
$conecta = conectarse();
//$ced=$_GET["cedula"];
$busqueda="SELECT * from almacen";
$rbusqueda=mysql_query($busqueda);
?>
<center>
	<br />
	<br />
	<br />
	<br /><!-- ?php echo "Usuario: ".$_SESSION['usuario']." Tipo: ".$_SESSION['tipo']; ?-->
	<center><h2>Actualizar Almacen</h2></center>
	<br />
	<div id="almacen">
		<!-- form method="post" name='planilla' id='planilla' action="validarincluirproductor.php" -->
		<form name="planilla1" id="planilla1" method="post" onsubmit="llamarasincronopost('validarmodificaralmacen.php','almacen','mensaje','7',
		'existencia1='+document.getElementById('existencia1').value
		+'&amp;precio1='+document.getElementById('precio1').value
		+'&amp;existencia2='+document.getElementById('existencia2').value
		+'&amp;precio2='+document.getElementById('precio2').value
		+'&amp;existencia3='+document.getElementById('existencia3').value
		+'&amp;precio3='+document.getElementById('precio3').value
		+'&amp;existencia4='+document.getElementById('existencia4').value
		+'&amp;precio4='+document.getElementById('precio4').value
		+'&amp;existencia5='+document.getElementById('existencia5').value
		+'&amp;precio5='+document.getElementById('precio5').value
		+'&amp;existencia6='+document.getElementById('existencia6').value
		+'&amp;precio6='+document.getElementById('precio6').value
		+'&amp;existencia7='+document.getElementById('existencia7').value
		+'&amp;precio7='+document.getElementById('precio7').value); return false" action="#">
			<table width="42%" border="1" align="center">
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Alevines:</label></th>
					<td>
						<input type="text" name="existencia1" id="existencia1" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio1" id="precio1" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Alevines 2:</label></th>
					<td>
						<input type="text" name="existencia2" id="existencia2" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio2" id="precio2" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Juveniles:</label></th>
					<td>
						<input type="text" name="existencia3" id="existencia3" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio3" id="precio3" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Empaques:</label></th>
					<td>
						<input type="text" name="existencia4" id="existencia4" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio4" id="precio4" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Transporte (Empaques):</label></th>
					<td>
						<input type="text" name="existencia5" id="existencia5" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio5" id="precio5" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Transporte (Tanque):</label></th>
					<td>
						<input type="text" name="existencia6" id="existencia6" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio6" id="precio6" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<?php $fila=mysql_fetch_array($rbusqueda); ?>
				<tr>
					<th width="24%" height="28"><label>Transporte (Cisterna):</label></th>
					<td>
						<input type="text" name="existencia7" id="existencia7" size="10" maxlength="12" value="<?php echo $fila['existencia']; ?>" />
					</td>
					<td>
						<input type="text" name="precio7" id="precio7" size="5" maxlength="10" value="<?php echo $fila['precio']; ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="submit" name="Aceptar" value="Actualizar" />
						<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:llamarasincronoget('productores.php','contenedor','centro','0');" />
					</td>
				</tr>
			</table>  
		</form>
		<div id="mensaje" style='visibility:hidden'></div>
	</div>
</center> 