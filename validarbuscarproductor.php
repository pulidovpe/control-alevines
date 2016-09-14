<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
}
include_once("conexion.php");
$conecta = conectarse();
mysql_query("SET NAMES 'utf8'");
$ced=$_POST['cedula'];
$est=$_POST['estado1'];
$mun=$_POST['municipio1'];
$sql='';
if(empty($ced) && empty($est) && empty($mun)) {
	echo "CAMPOS NO DEBEN IR VACIOS";
} else {
	if (!empty($ced)) { // Si escribio cedula
		if ($est<>'Seleccione') { // Si eligio estado
			if (!empty($mun)) { // Si se eligio municipio
				$sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' AND estados='$est' AND municipios='$mun' LIMIT 8";
			} else { // Sino se eligio municipio
				$sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' AND estados='$est' LIMIT 8";
			}
		} else { // Sino se eligio estado
			$sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' LIMIT 8";
		}
	} else { // Sino escribio cedula
		if ($est<>'Seleccione') { // Si eligio estado
			if (empty($mun)) {  // Sino se eligio municipio
				$sql = "SELECT * FROM productor WHERE estados='$est' LIMIT 8";
			} else { // Si se eligio municipio
				$sql = "SELECT * FROM productor WHERE estados='$est' AND municipios='$mun' LIMIT 8";
			}
		} 
	}
}
?>
<div id="datos" align="center">
  <br />
  <table weigth="830" height="87" border="1" align="left" id="table_results">
		<thead>
			<tr>
				<th colspan="3" ><em>Accion</em></th>
				<th width="50" ><em> Cedula </em></th>
				<th width="100" ><em> Nombres </em></th>
				<th width="100" ><em> Apellidos </em></th>
				<th width="100" ><em> Teléfono </em></th>
				<th width="200" ><em> Dirección </em></th>
				<th width="100" ><em> Estado </em></th>
				<th width="150" ><em> Municipio </em></th>
			</tr>
		</thead>
		<tbody> 
<?php
	if($sql != '') {
		$Resultado=mysql_query($sql, $conecta);
		while($MostrarFila=mysql_fetch_array($Resultado)) {
			printf("
			<tr><td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('modificarproductor.php?cedula=%s','contenedor','centro','0')\" style='cursor:pointer' ><img src='img/b_edit.png' alt='Modificar' width='16' height='16' border='0' class='icon' title='Editar' /></a></td>
			<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('eliminarproductor.php?cedula=%s','contenedor','centro','3')\" style='cursor:pointer' ><img src='img/b_drop.png' alt='Borrar' width='16' height='16' border='0' class='icon' title='Borrar' /></a></td>
			<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('incluirfactura.php?cedula=%s','contenedor','centro','0')\" style='cursor:pointer' ><img src='img/b_selboard.png' alt='Agregar Factura' width='16' height='16' border='0' class='icon' title='Agregar factura' /></a></td>
			</a></td>",$MostrarFila['cedula'],$MostrarFila['cedula'],$MostrarFila['cedula']);
			echo "<td width='50'>".$MostrarFila['cedula']."</td>";
			echo "<td width='100'>".$MostrarFila['nombres']."</td>";
			echo "<td width='100'>".$MostrarFila['apellidos']."</td>";
			echo "<td width='100'>".$MostrarFila['telefono']."</td>";
			echo "<td width='200'>".$MostrarFila['direccion']."</td>";
			echo "<td width='100'>".$MostrarFila['estados']."</td>";
			echo "<td width='150'>".$MostrarFila['municipios']."</td></tr>";	
		}
	}      
echo "</tbody></table>";
echo "</div>";
?>