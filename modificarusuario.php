<?php session_start();
if(!isset($_SESSION['usuario']) && ($_SESSION['tipo'] != 1)) { 
	header("Location: cerrarsesion.php");
	exit;
}
include_once("conexion.php");
$conecta = conectarse();
$usu=$_GET["usu"];
$busqueda="SELECT * from usuarios where usuario='$usu'";
$rbusqueda=mysql_query($busqueda);
$fila=mysql_fetch_array($rbusqueda);
?>
<center>
	<br />
	<br />
	<br />
	<br />
	<br />
	<center><h2>Modificar Usuario</h2></center>
	<br />
	<div id="usuarios">
		<!--form action="registrar.php" method="post" class="Estilo1"-->
		<form name="planilla1" id="planilla1" method="post" onsubmit="llamarasincronopost('validarmodificarusuario.php','usuarios','mensaje','9',
		'usuario='+document.getElementById('usuario').value
		+'&amp;clave='+document.getElementById('clave').value
		+'&amp;cclave='+document.getElementById('cclave').value
		+'&amp;nombre='+document.getElementById('nombre').value
		+'&amp;tele='+document.getElementById('tele').value); return false" action="#">
			<div align="center">
				<table width="291" border="0">
					<tr>
						<td width="151">
							<div align="right">Usuario:
								<br />
								<br />
							</div>
						</td>
						<td width="151"><input name="usuario" type="text" id="usuario" disabled="disabled" value="<?php echo $fila['usuario']; ?>" /></td>
					</tr>
					<tr>
						<td><div align="right">Password:</div></td>
						<td width="151"><input type="password" name="clave" id="clave" value="" /></td>
					</tr>
					<tr>
						<td>
							<div align="right">Confirmar Password:</div>
						</td>
						<td width="151"><input type="password" name="cclave" id="cclave" value="" /></td>
					</tr>
					<tr>
						<td width="151">
							<div align="right">Nombres:
								<br />
								<br />
							</div>
						</td>
						<td width="151"><input  type="text" name="nombre" id="nombre" value="<?php echo $fila['nombre']; ?>" /></td>
					</tr>
					<tr>
						<td width="151">
							<div align="right">Teléfono:
								<br />
								<br />
							</div>
						</td>
						<td width="151"><input name="tele" type="text" id="tele" value="<?php echo $fila['telefono']; ?>" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" value="Aceptar" />
							<input type="reset" value="Borrar" />
							<input type="button" value="Cancelar" onclick="llamarasincronoget('usuarios.php','contenedor','centro','0')" />
						</td>
					</tr>
				</table>
			</div>
		</form>	 
		<div id="mensaje" style='visibility:hidden'></div>
	</div>
</center>