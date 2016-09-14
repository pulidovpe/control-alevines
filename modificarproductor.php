<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
} 
include_once("conexion.php");
$conecta = conectarse();
$ced=$_GET["cedula"];
$busqueda="SELECT * from productor where cedula='$ced'";
$rbusqueda=mysql_query($busqueda);
$fila=mysql_fetch_array($rbusqueda);
?>
<center>
	<center><h2>Modificar Productor</h2></center>
	<br />
	<div id="productor">
		<!-- form method="post" name='planilla' id='planilla' action="validarincluirproductor.php" -->
		<form name="planilla1" id="planilla1" method="post" onsubmit="llamarasincronopost('validarmodificarproductor.php','productor','mensaje','2',
		'cedula='+document.getElementById('cedula').value
		+'&amp;razons='+document.getElementById('razons').value
		+'&amp;nombres='+document.getElementById('nombres').value
		+'&amp;apellidos='+document.getElementById('apellidos').value
		+'&amp;telefono='+document.getElementById('telefono').value
		+'&amp;direccion='+document.getElementById('direccion').value
		+'&amp;estado1='+document.getElementById('estado1').value
		+'&amp;municipio1='+document.getElementById('municipio1').value); return false" action="#">
			<table width="42%" height="237" border="1" align="center" bordercolor="#F0F0F0">
			<tr>
				<td width="24%" height="28"><label>Cédula/RIF:</label></td>
				<td width="76%">
					<input type="text" name="razons" id="razons" size="1" disabled="disabled" value="<?php echo $fila['razons']; ?>" />
					<input type="text" name="cedula" id="cedula" size="10" maxlength="12" disabled="disabled" value="<?php echo $fila['cedula']; ?>" />
				</td>
				</tr>
				<tr>
					<td height="27"><label>Nombres:</label></td>
					<td>
						<input type="text" name="nombres" id="nombres" size="25" maxlength="50" value="<?php echo $fila['nombres']; ?>" />
					</td>
				</tr>
				<tr>    
					<td height="28"><label>Apellidos:</label></td>
					<td>
						<input type="text" name="apellidos" id="apellidos" size="25" maxlength="50" value="<?php echo $fila['apellidos']; ?>" />
					</td>
				</tr>
				<tr>
					<td height="26"><label>Telefono:</label></td>
					<td>
						<input type="text" name="telefono" id="telefono" size="15" maxlength="10" value="<?php echo $fila['telefono']; ?>" />
					</td>
				</tr>   
				<tr>    
					<td height="26"><label>Dirección:</label></td>
					<td>
						<input type="text" name="direccion" id="direccion" size="50" maxlength="50" value="<?php echo $fila['direccion']; ?>" />  
					</td>
				</tr>   
				<tr>
					<td height="26"><label>Estado y Municipio:</label></td>
					<td>
						<div id='anidado'><iframe src="anidado2.php" width="400" height="30" name="anidado" scrolling="no" frameborder="0"></iframe></div>
						<input type='hidden' name='var_ciudad' id='var_ciudad' value=0 />
						<input type='hidden' name='estado1' id='estado1' /> 
						<input type='hidden' name='municipio1' id='municipio1' />
						&nbsp&nbsp<input type='text' name='est' id='est' size="13" disabled="disabled" value="<?php echo $fila['estados']; ?>" /> 
						&nbsp<input type='text' name='mun' id='mun' disabled="disabled" value="<?php echo $fila['municipios']; ?>" />             
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" name="Aceptar" value="Aceptar" />
						<input type="reset" name="Borrar" value="Borrar" />
						<input type="button" name="Cancelar" value="Cancelar" onclick="javascript:llamarasincronoget('productores.php','contenedor','centro','0');" />
					</td>
				</tr>
			</table>  
		</form>
		<div id="mensaje" style='visibility:hidden'></div>
	</div>
</center> 