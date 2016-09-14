<?
include("conexion.php");
$conecta = conectarse();
$ced=$_REQUEST["cedula"];
$consulta="select * from detalle_fact order by id_fact DESC limit 1";
$result=mysql_query($consulta);
$fila=mysql_fetch_array($result);
$id_fact=$fila["id_fact"];
$ct=$id_fact+1;
$consulta="SELECT * FROM tmp_detalle_fact";
$result=mysql_query($consulta);
$fecha=date('Y/m/d');
$total=0;
while($fila=mysql_fetch_array($result)){
$id=$fila["id"];
$descripcion=$fila["descripcion"];
$precio=$fila["precio"];
$cantidad=$fila["cantidad"];
$subtotal=$fila["subtotal"];
$total=$total+$subtotal;
$actualizar="UPDATE alevines SET existencia=existencia-'$cantidad' WHERE id='$id'";
$res_actualizar=mysql_query($actualizar);
$insertar="INSERT INTO detalle_fact VALUES ('$ct','$id','$descripcion','$cantidad','$precio','$subtotal','$fecha')";
$res_insertar=mysql_query($insertar);   
}
$insertar2="INSERT INTO factura VALUES ('$ct','$fecha','$ced','$total')";
$res_insertar2=mysql_query($insertar2);
//limpiar la tabla temporal
$limpiar="DELETE FROM tmp_detalle_fact";
$result=mysql_query($limpiar);
?>
<script>
alert("Compra Exitosa");
this.document.location.href="incluirproductor.php";
</script>
