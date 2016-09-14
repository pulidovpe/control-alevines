<?
include("conexion.php");
$combo=$_REQUEST["combo"];
echo "EL Delito Seleccionado es: ".$combo;
$consulta="select * from lista_estados where opcion='$combo'";
$result=mysql_query($consulta);?>
<table border=1 align="center">
<tr><td>Id</td><td>Descripcion</td><td>Delito</td><td>Fecha</td><td>Sector</td><td></td></tr>
<?
while($fila=mysql_fetch_array($result)){?>
<tr><td><? echo $fila["id"]?></td><td>
        <? echo $fila["descripcion"]?></td><td>
        <? echo $fila["delito"]?></td><td>
        <? echo $fila["fecha"]?></td><td>
        <? echo $fila["sector"]?></td><td>
<td><a href="modificar.php?id= <? echo $fila['id']?>">Modificar</a></td><tr>


<?}?>
</table>
