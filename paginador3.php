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
$query = "select id_donativo,fecha_don,cedula,cant_alev1,cant_alev2,cant_juve from donaciones order by id_donativo asc limit $RegistrosAEmpezar, $RegistrosAMostrar";
$Resultado=mysql_query($query,$conecta);

?>

<div id="datos-donacion" align="center">
  <br />
  <table weigth="520" height="87" border="1" align="left" id="table_results">
		<thead>
			<tr>
				<th width="70" ><em> Accion </em></th>
				<th width="50" ><em> Id Donativo </em></th>
				<th width="100" ><em> Fecha </em></th>
				<th width="100" ><em> Productor </em></th>
				<th width="75" ><em> Alevines 1</em></th>
				<th width="75" ><em> Alevines 2</em></th>
				<th width="75" ><em> Juveniles </em></th>
			</tr>
		</thead>
		<tbody>
<?php
while($MostrarFila=mysql_fetch_array($Resultado)) {	
	printf("
	<tr><td width='50' align='center'><a onclick=\"javascript:popupCentrado('imprimirdonativo.php?donativo=%s','DONAR','800','600','0')\" style='cursor:pointer' ><img src='img/b_print.png' alt='Imprimir' width='16' height='16' border='0' class='icon' title='Imprimir' /></a></td>
	</a></td>",$MostrarFila['id_donativo']);
	echo "<td width='70' align='center'>".$MostrarFila['id_donativo']."</td>";
	echo "<td width='100' align='center'>".$MostrarFila['fecha_don']."</td>";
	echo "<td width='100'align='center'>".$MostrarFila['cedula']."</td>";
	echo "<td width='75'align='center'>".$MostrarFila['cant_alev1']."</td>";
	echo "<td width='75'align='center'>".$MostrarFila['cant_alev2']."</td>";
	echo "<td width='75'align='center'>".$MostrarFila['cant_juve']."</td></tr>";	
}      
echo "</tbody></table>";
//******--------determinar las páginas---------******//
$NroRegistros=mysql_num_rows(mysql_query("select id_donativo,fecha_don,cedula,cant_alev1,cant_alev2,cant_juve from donaciones",$conecta));

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
$pag_dona = '3';
if($PagAct>1) {
	echo "<a onclick=\"Pagina('1','$pag_dona')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>Primero-</a> ";	
	echo "<a onclick=\"Pagina('$PagAnt','$pag_dona')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>Anterior-</a> ";
} else {
	echo "Primero-";	
	echo "Anterior-";
}	
echo "<strong>Pagina ".$PagAct."/".$PagUlt."</strong>";
if($PagAct<$PagUlt) { 
	echo " <a onclick=\"Pagina('$PagSig','$pag_dona')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>-Siguiente</a> ";
	echo "<a onclick=\"Pagina('$PagUlt','$pag_dona')\" style='cursor:pointer; text-decoration:underline; color:#00008B'>-Ultimo</a>";
} else {
	echo "-Siguiente";	
	echo "-Ultimo";
}
?>
</div>