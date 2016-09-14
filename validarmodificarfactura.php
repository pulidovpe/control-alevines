<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
} 
include_once("conexion.php");
$conecta = conectarse();

$id = $_POST['id_factura'];

if($id=='') {
	echo "<center><h2>Campo no puede ir vacio</h2><br />";
	echo "<a href='modificarfactura.php'>Volver a Modificar</a></center>";
	exit;
} else {
	$sql = "SELECT * FROM factura WHERE id_factura = '$id' ";

	$resultado = mysql_query($sql,$conecta);
	$registros = mysql_fetch_array($resultado);
	$num = mysql_num_rows($resultado);
	$idAux = $registros['id_factura'];
	if($num == 0) {
		echo "<center><h3>No se encontro coincidencia</h3><br />";
		echo "<a href='modificarfactura.php'>Volver a Modificar</a></center>";
	}
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Incluir</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	background-color: #CCCC99;
}
-->
</style></head>
<body>
	<center>
		<h1>Modificar Factura</h1>
		<br />
		<form method="post" action="factura_tmp.php">
			<table border="1">
				<tr>
						<table width="12%" border="1" align="center" bordercolor="#000066">
				<tr>
					<td>
						<label>Numero de Factura:</label>
					</td>
					<td>
						<input type="text" name="id_factura" id="id_factura" size="10" maxlength="10" />
					
						<label>Fecha de Factura:</label>
						<input type="text" name="fecha_factura" id="fecha_factura" size="10" maxlength="10" />
					</td><tr>
					<td>
						<label>Cédula/RIF :</label>
					</td>	
					<td>	
						<select>
							<option value="" selected="selected"></option>
							<option value="V">V</option>
							<option value="E">E</option>
							<option value="J">J</option>
							<option value="G">G</option>
						</select>
							<input type="text" name="cedula" id="cedula" size="12" maxlength="12" />
					</td><tr>
					<td>
						<label>Nombres:</label>
					</td>
					<td>
						<input type="text" name="nombres" id="nombres" size="25" maxlength="50" />
						<label>Apellidos:</label>
						<input type="text" name="apellidos" id="apellidos" size="25" maxlength="50" />
					</td>
				</tr>
				<td>
					<label>Telefono:</label>
				</td>
					<td>
						<input type="text" name="telefono" id="telefono" size="25" maxlength="50" />
					</td>
				<tr>	
					<td>
						<label>Dirección:</label>
					</td>
					<td>
						<input type="text" name="direccion" id="direccion" size="50" maxlength="100" />
					<label>Estado:</label>
						<select name="estado" id="estado">
							<option value="" selected="selected"></option>
							<option value="Anzoátegui">Anzoátegui</option>
							<option value="Apure">Apure</option>
							<option value="Aragua">Aragua</option>
							<option value="Barinas">Barinas</option>
							<option value="Bolívar">Bolívar</option>
							<option value="Carabobo">Carabobo</option>
							<option value="Cojedes">Cojedes</option>
							<option value="Delta Amacuro">Delta Amacuro</option>
							<option value="Distrito Capital">Distrito Capital</option>
							<option value="Falcón">Falcón</option>
							<option value="Guárico">Guárico</option>
							<option value="Lara">Lara</option>
							<option value="Mérida">Mérida</option>
							<option value="Miranda">Miranda</option>
							<option value="Monagas">Monagas</option>
							<option value="Nueva Esparta">Nueva Esparta</option>
							<option value="Sucre">Sucre</option>
							<option value="Tachira">Tachira</option>
							<option value="Vargas">Vargas</option>
							<option value="Yaracuy">Yaracuy</option>
							<option value="Zulia">Zulia</option>
					</select>
					<label>Municipio:</label>
					<input type="text" name="municipio" id="municipio" size="10" maxlength="20" />
					</td><tr>
					<td>
						<label>Concepto:</label>
					</td>
					<td>
						<select name="concepto" id="concepto">
							<option value="" selected="selected"></option>
							<option value="Alevines">Alevines</option>
							<option value="Juveniles">Juveniles</option>
						</select>
					</td>
					<tr>
					<td>	
						<label>Cantidad Alevines:</label>
					</td>
					<td>
						<input type="text" name="cantidad_alev" id="cantidad_alev" size="10" maxlength="20" />
						<label>Cantidad Juveniles:</label>
						<input type="text" name="cantidad_juv" id="cantidad_juv" size="10" maxlength="20" />
						<label>Precio Unitario:</label>
						<input type="text" name="precio_unit" id="precio_unit" size="10" maxlength="20" />
						<label>Total:</label>
						<input type="text" name="total" id="total" size="10" maxlength="20" />
					</td><tr>	
					<td>
						<label>Tipo de Pago:</label>
					<td>
							<select name="tipopago" id="tipopago">
								<option value="" selected="selected"></option>
								<option value="Efectivo">Efectivo</option>
								<option value="Deposito">Deposito</option>
								<option value="Transferencia">Transferencia</option>
							</select>
						<label>Banco:</label>
						<select name="banco" id="banco">
							<option value="" selected="selected"></option>
							<option value="Del Tesoro">Del Tesoro</option>
							<option value="Banesco">Banesco</option>
						</select>
						<label>Numero de Deposito:</label>
							<input type="text" name="num_dep" id="num_dep" size="10" maxlength="10" />
						<label>Fecha de Deposito:</label>
							<input type="text" name="fecha_deposito" id="fecha_deposito" size="10" maxlength="10" />
					</td>
					<tr>
					<td>
						<label>Transporte:</label>
					</td>
					<td>
							<select name="tipo_transp" id="tipo_transp">
							<option value=""selected="selected"></option>
							<option value="Propio en Empaque">Propio en Empaque</option>
							<option value="Propio en Tanque">Propio en Tanque</option>
							<option value="Camión Cisterna">Camión Cisterna</option>
						</select>
					</td><tr>
				<td>
					<label>Observaciones:</label>
				<td>
						<textarea name="observaciones" id="observaciones"rows="2.5" cols="80"></textarea>
				</td>
				<tr>	
					
				</tr>
				<tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Aceptar" />
						<input type="reset" value="Borrar" />
					</td>
				</tr>
					
			</table>
		</form>
		<a href='menu.php'>Volver al menú</a>
	</center> 
</body>
</html>