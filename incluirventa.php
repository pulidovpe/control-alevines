<? session_start();
  if(!empty($_SESSION["usuario"])){
	include("conexion.php");	
  $conecta = conectarse();
	$ced=$_REQUEST["cedula"];	  
?>
<body>
<?
$buscar="SELECT * from productor where cedula='$ced'";
$rbuscar=mysql_query($buscar);
$campo=mysql_fetch_array($rbuscar);
?>
<tr>
  <td colspan="2" >
  <table  border="1" align="center" bgcolor="#666666">
    <tr>
      <td width="300" bgcolor="#999999">Agregar Venta Para el Productor: </td>
      <td width="425" bgcolor="#999999"><? echo $campo["cedula"];?></td>
    </tr>
  </table>
  <form method="get" action="factura_tmp.php" name="form1" id="form1">
    <table align="center">
      <tr>
        <td width="250" ><span class="Estilo30">CODIGO</span></td>
        <td width="262" ><span class="Estilo30">DESCRIPCION</span></td>
        <td width="76" ><span class="Estilo30">PRECIO</span></td>
        <td width="135" ><span class="Estilo30">CANTIDAD</span></td>
      </tr>
      <tr bgcolor="#cccccc">
        <td bgcolor="#FFFFFF"><span class="Estilo31">
          <input name="txtid" type="text" size="7" />
				  <input name="cedula" type="hidden" size="7" value="<? echo $campo["cedula"];?>"/>
          <input name="submit" type="submit" value="buscar" />
          </span>
        </td>
          <td bgcolor="#FFFFFF"><span class="Estilo31"></span></td>
          <td bgcolor="#FFFFFF"><span class="Estilo31"></span></td>
          <td bgcolor="#FFFFFF"><div align="right"><span class="Estilo31">
          <input type="text" name="txtcant" size="3" />
          <input name="button" type="button" onclick="agregar()" value="+" />
          </span></div>
        </td>
      </tr>
    </table>
  </form>
</tr>
<div align="center"></div>
</body></html>
<? }else {?>
<script>
       alert("Acceso Denegado");
       this.document.location.href="menu.html";
       </script>

<? } ?>