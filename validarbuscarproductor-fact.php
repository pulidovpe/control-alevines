<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
}
include("conexion.php");
$conecta = conectarse();
$ced=$_POST['cedula'];

if (!empty($ced)) { // Si escribio cedula
	$sql = "SELECT * FROM productor WHERE cedula LIKE '%$ced%' LIMIT 1";
}
?>
<div id="datos" align="center">
  <table weigth="830" border="1" align="left" id="table_results">
		<thead>
			<tr>
				<th width="100" ><em> Nombres </em></th>
				<th width="100" ><em> Apellidos </em></th>
				<th width="100" ><em> Teléfono </em></th>
				<th width="200" ><em> Dirección </em></th>
			</tr>
		</thead>
		<tbody> 
<?php
$Resultado=mysql_query($sql, $conecta);
while($MostrarFila=mysql_fetch_array($Resultado)) {
	echo "<td width='100'>".$MostrarFila['nombres']."</td>";
	echo "<td width='100'>".$MostrarFila['apellidos']."</td>";
	echo "<td width='100'>".$MostrarFila['telefono']."</td>";
	echo "<td width='200'>".$MostrarFila['direccion']."</td></tr>";	
}      
echo "</tbody></table>";
echo "</div>";
//$total = mysql_num_rows($Resultado);
//if ($total == 0) {
//	echo "<input type='text' name='ced1' id='ced1' value='".$MostrarFila['cedula']."' >";
//}
?>