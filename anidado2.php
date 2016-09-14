<?php  // primer bloque php
if (isset($_POST['CadEstado']))
	$id=$_POST['CadEstado'];
else
	$id=0;
?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<script language="JavaScript">
function A() 
{ 
	parent.document.getElementById('var_ciudad').value=document.getElementById('CadMunicipio').value; 
	parent.document.getElementById('estado1').value=document.getElementById('CadEstado').options[document.getElementById('CadEstado').selectedIndex].text;
	parent.document.getElementById('municipio1').value=document.getElementById('CadMunicipio').options[document.getElementById('CadMunicipio').selectedIndex].text;
}
</script>  
</head>

<body >
<form name="f1" action="anidado2.php" method="post">
<!--b>Estados :      Ciudades</b><br-->
<select name="CadEstado" id="CadEstado" onchange="javascript:f1.submit();">
	<option value='-1'>Seleccione</option>
<?php  // segundo bloque php
/* Conectamos a los datos */
include_once("conexion.php");
$conecta = conectarse();
mysql_query("SET NAMES 'utf8'");
$sql="SELECT * FROM lista_estados";
$rs=mysql_query($sql);
while ($reg=mysql_fetch_assoc($rs)) {  // estados
	$ce=$reg['id'];	// código estado
	$de=$reg['opcion'];	// descripción estado
	if ($id==$ce)
		echo "<option value=$ce selected>$de</option>";
	else
		echo "<option value=$ce>$de</option>";
}
?>
</select>
<select name="CadMunicipio" id="CadMunicipio" onChange="A();">
<?php  // tercer bloque php
if ($id==0) {
	echo "<option value=".$id.">Seleccione</option>";
} else {
	$sql="SELECT * FROM lista_municipios WHERE relacion=$id";
	$rs=mysql_query($sql);
	echo "<option value=0>Seleccione</option>";
	while ($reg=mysql_fetch_assoc($rs)) {  // ciudades
		$cc=$reg['id'];	// código ciudad
		$dc=$reg['opcion'];	// descripción ciudad
		echo "<option value=".$cc.">".$dc."</option>";
	}
}
echo "<script language='JavaScript'>";
echo "A();";
echo "</script>";
?>
</select>
</form>
</body>
</html>
