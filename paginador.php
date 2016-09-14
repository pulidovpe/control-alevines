<?php if(@session_start() == false){session_destroy();session_start();};
if(!isset($_SESSION['usuario'])) { 
	header("Location: cerrarsesion.php");
	exit;
}

include_once("conexion.php");
$conecta=conectarse();

$RegistrosAMostrar=5;
//estos valores los recibo por GET
if(isset($_GET['pag'])){
	$RegistrosAEmpezar=($_GET['pag']-1)*$RegistrosAMostrar;
	$PagAct=$_GET['pag'];
//caso contrario los iniciamos
}else{
	$RegistrosAEmpezar=0;
	$PagAct=1;
}
/* ******* */
$query = "select * from productor order by cedula asc limit $RegistrosAEmpezar, $RegistrosAMostrar";
$Resultado=mysql_query($query,$conecta);

?>

<div id="datos-productor" align="center">
  <br />
  <table weigth="830" height="87" border="1" align="left" id="table_results">
		<thead>
			<tr>
				<th colspan="5" ><em>Accion</em></th>
				<th width="50"  ><em> Cedula </em></th>
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
while($MostrarFila=mysql_fetch_array($Resultado)) {
	printf("
	<tr><td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('modificarproductor.php?cedula=%s','div-productor','paginador','0')\" style='cursor:pointer' ><img src='img/b_edit.png' alt='Modificar' width='16' height='16' border='0' class='icon' title='Editar' /></a></td>
	<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('eliminarproductor.php?cedula=%s','div-productor','paginador','3')\" style='cursor:pointer' ><img src='img/b_drop.png' alt='Borrar' width='16' height='16' border='0' class='icon' title='Borrar' /></a></td>
	<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('incluirfactura.php?cedula=%s','contenedor','centro','0')\" style='cursor:pointer' ><img src='img/register.png' alt='Agregar Factura' width='16' height='16' border='0' class='icon' title='Agregar factura' /></a></td>
	<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('incluirdonacion.php?cedula=%s','contenedor','centro','0')\" style='cursor:pointer' ><img src='img/b_selboard.png' alt='Agregar Donacion' width='16' height='16' border='0' class='icon' title='Agregar Donacion' /></a></td>
	<td width='24' align='center'><a onclick=\"javascript:llamarasincronoget('incluirreposicion.php?cedula=%s','contenedor','centro','0')\" style='cursor:pointer' ><img src='img/b_selboard.png' alt='Agregar Reposicion' width='16' height='16' border='0' class='icon' title='Agregar Reposicion' /></a></td>
	</a></td>",$MostrarFila['cedula'],$MostrarFila['cedula'],$MostrarFila['cedula'],$MostrarFila['cedula'],$MostrarFila['cedula']);
	echo "<td width='50'>".$MostrarFila['cedula']."</td>";
	echo "<td width='100'>".$MostrarFila['nombres']."</td>";
	echo "<td width='100'>".$MostrarFila['apellidos']."</td>";
	echo "<td width='100'>".$MostrarFila['telefono']."</td>";
	echo "<td width='200'>".$MostrarFila['direccion']."</td>";
	echo "<td width='100'>".$MostrarFila['estados']."</td>";
	echo "<td width='150'>".$MostrarFila['municipios']."</td></tr>";	
}      
echo "</tbody></table>";
//******--------determinar las páginas---------******//
$NroRegistros=mysql_num_rows(mysql_query("select * from productor",$conecta));

$PagAnt=$PagAct-1;
$PagSig=$PagAct+1;
$PagUlt=$NroRegistros/$RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
$Res=$NroRegistros%$RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
if($Res>0) $PagUlt=floor($PagUlt)+1;

//desplazamiento
$pag_prod = '1';
if($PagAct>1) {
	echo "<a onclick=\"Pagina('1','$pag_prod')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>Primero-</a> ";	
	echo "<a onclick=\"Pagina('$PagAnt','$pag_prod')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>Anterior-</a> ";
} else {
	echo "Primero-";	
	echo "Anterior-";
}	
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt) { 
	echo " <a onclick=\"Pagina('$PagSig','$pag_prod')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>-Siguiente</a> ";
	echo "<a onclick=\"Pagina('$PagUlt','$pag_prod')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>-Ultimo</a>";
} else {
	echo "-Siguiente";	
	echo "-Ultimo";
}
?>
</div>