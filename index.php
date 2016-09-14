<?php session_start(); ?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />
	<title>Control de Productores y Venta de Alevines</title>
	<script src="js/carga_div.js" type="text/javascript"></script>
	<script type="text/javascript">
		// Cada 10 segundos verificamos si no ha caducado la sesion, sino, se cerrara autom.
		// LLamamos la funcion con los repectivos parametros del DIV que queremos refrescar.
		window.onload = function refresca() {
			refrescaDiv('cabeza',5,'auto.php');
		}
	</script>
</head>
<html>
<body>
	<div id="contenido">
		<header id="cabeza"></header>
		<nav id="menu">
			<?php if(isset($_SESSION['usuario'])) { ?>    
			<ul>
				<li>
					<a onclick="javascript:llamarasincronoget('productores.php','contenedor','centro','0');" style='cursor:pointer'>Productores</a></li>
				<li>
					<a onclick="javascript:llamarasincronoget('facturas.php','contenedor','centro','0');" style='cursor:pointer'>Facturas</a></li>
				<li>
					<a onclick="javascript:llamarasincronoget('reposiciones.php','contenedor','centro','0');" style='cursor:pointer'>Reposiciones</a></li>
				<li>
					<a onclick="javascript:llamarasincronoget('donaciones.php','contenedor','centro','0');" style='cursor:pointer'>Donaciones</a></li>
				<li>
					<a onclick="javascript:llamarasincronoget('actaentrega.php','contenedor','centro','0');" style='cursor:pointer'>Actas</a></li>
				<?php if($_SESSION['tipo'] == 1) { ?> 
				<li>
					<a onclick="javascript:llamarasincronoget('almacen.php','contenedor','centro','0');" style='cursor:pointer'>Almacen</a></li>
				<li>
					<a onclick="javascript:llamarasincronoget('usuarios.php','contenedor','centro','0');" style='cursor:pointer'>Usuarios</a></li>
				<?php } ?>
				<li>
					<a onclick="javascript:popupCentrado('manual.pdf','AYUDA','800','600','0');" style='cursor:pointer'>Ayuda</a></li>
				<li class="cerrar_sesion">
					<a href="cerrarsesion.php" target='_self' style='cursor:pointer'>Salir</a>
				</li>
			</ul>
			<?php } else {
			  echo "<center>";
			  echo "<h1>Control de Productores y venta de Alevines</h1>";
			  echo "</center>";
			}
			?>
		</nav>
		<section>
			<div id="contenedor">
				<div id="centro">
					<?php if(!isset($_SESSION['usuario'])) { include('iniciar_sesion.php'); } ?>
					<td  align="center"><img  align="center" src="img/dsc03017.jpg" width=817 height=489></td> 
				</div>
			</div>
		</section>
		<footer id="pie"></footer>
	</div>
</body>
</html>