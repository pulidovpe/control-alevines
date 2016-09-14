<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
} 
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<title>Menú Principal</title>
</head>
<body>
	<center>
	  <p align="right">&nbsp;</p>
	  <p align="center"><img src="imagenes/titulo.png" width="800" height="50"></p>
	  <p align="center" class="fade Estilo2">CONTROL DE PRODUCTORES Y VENTA DE ALEVINES </p>
	  <h1 align="center" class="Estilo5">MENÚ PRINCIPAL</h1>
	  <br />
		<nav>
			<table width="768" height="61">
				<td width="109"><div align="center"><a href="productores.php">Productores</a></div></td>
				<td width="109"><div align="center"><a href="incluirfactura.php">Factura de Venta</a></div></td>
				<td width="109"><div align="center"><a href="donaciones.php">Donaciones</a></div></td>
				<td width="109"><div align="center"><a href="facturaproforma.php">Factura Proforma</a></div></td>
				<td width="109"><div align="center"><a href="actaentrega.php">Acta de Entrega</a></div></td>
				<td width="109"><div align="center"><a href="ayuda.php">Ayuda</a></div></td>
				<td width="109"><div align="center"><a href="cerrarsesion.php">Salir</a></div>
		  	</table>	
			<p><img src="imagenes/dsc03017.jpg" width="503" height="370"></p>
		    <p>&nbsp;</p>
		</nav>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</center> 
</body>
</html>
