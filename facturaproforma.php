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
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Incluir</title>
<style type="text/css">

<!--
body {
	background-color: #CCCC99;
}
.Estilo1 {color: #000000}
-->
</style></head>
<body>
	<center>
		<h1>Factura Proforma</h1>
		<br />
		<form method="post" action="validarproforma.php">
			<table width="76%" border="1" align="center" bordercolor="#000066">
				<tr>
					<td>
						<label><span class="Estilo1">Numero de Factura Proforma:</span></label>

				    </td>
					<td>
						<span class="Estilo1">
							<input type="text" name="id_factura" id="id_factura" size="10" maxlength="10" />
							<label>Fecha de Factura Proforma:</label>
				      	<input type="text" name="fecha_factura" id="fecha_factura" size="10" maxlength="10" />				  
		          		</span>
		          	</td>
		        </tr>
				<tr>	
					<td>
						<label><span class="Estilo1">Cédula/RIF :</span></label>				
					</td>	
					<td>	
						<select name="razons" id="razons">
							<option value="" selected="selected"></option>
							<option value="V">V</option>
							<option value="E">E</option>
							<option value="J">J</option>
							<option value="G">G</option>
						</select>
							<input type="text" name="cedula" id="cedula" size="7" maxlength="8" />					
					</td>
				<tr>
					<td>
					
					  <label><span class="Estilo1">Nombres:</span></label>	
					</td>
					<td>
						<span class="Estilo1">
							<input type="text" name="nombres" id="nombres" size="25" maxlength="50" />
							<label>Apellidos:</label>
							<input type="text" name="apellidos" id="apellidos" size="25" maxlength="50" />					
						</span>
					</td>
				</tr>
				<tr>
				  	<td><span class="Estilo1">
				    	<label>Teléfono:</label>
				    	</span>
				    </td>
					<td>
						<input type="text" name="telefono" id="telefono" size="25" maxlength="50" />			
			        </td>
				</tr>
				<tr>	
					<td>
					  <label>Dirección:</label>
					  </span> 
					</td>
					<td>
						<input type="text" name="direccion" id="direccion" size="50" maxlength="100" />
					    	<span class="Estilo1">
					   			<label>Estado:</label>
									<select name="estado" id="estado">
										<option value="" selected="selected"></option>
										<option value="Anzoátegui">Anzoátegui</option>
										<option value="Apure">Apure</option>
										<option value="Aragua">Aragua</option>
										<option value="Barinas">Barinas</option>
										<option value="Bolívar">Bolívar</option>
										<option value="Carabobo">Carabobo</option>
										<option value="Cojedes">Cojedes</option>
										<option value="Delta Amacuro">Delta Amacuro</option>
										<option value="Distrito Capital">Distrito Capital</option>
										<option value="Falcón">Falcón</option>
										<option value="Guárico">Guárico</option>
										<option value="Lara">Lara</option>
										<option value="Mérida">Mérida</option>
										<option value="Miranda">Miranda</option>
										<option value="Monagas">Monagas</option>
										<option value="Nueva Esparta">Nueva Esparta</option>
										<option value="Sucre">Sucre</option>
										<option value="Tachira">Tachira</option>
										<option value="Vargas">Vargas</option>
										<option value="Yaracuy">Yaracuy</option>
										<option value="Zulia">Zulia</option>
									</select>
								<label>Municipio:</label>
								<input type="text" name="municipio" id="municipio" size="10" maxlength="20" />
					</td>
				<tr>
					<td>
						<label>Concepto:</label>
					</td>
					<td>
						<select name="concepto" id="concepto">
							<option value="" selected="selected"></option>
							<option value="Alevines">Alevines</option>
							<option value="Juveniles">Juveniles</option>
						</select>
					</td>
				<tr>
					<td><span class="Estilo1">
					    <label>Cantidad Alevines:</label>
					    </span> 
					</td>
					<td>
						<span class="Estilo1">
							<input type="text" name="cantidad_alev" id="cantidad_alev" size="10" maxlength="20" />
							<label>Cantidad Juveniles:</label>
							<input type="text" name="cantidad_juv" id="cantidad_juv" size="10" maxlength="20" />
							<label>Precio Unitario:</label>
							<input type="text" name="precio_unit" id="precio_unit" size="10" maxlength="20" />
							<label>Total:</label>
					    	<input type="text" name="total" id="total" size="10" maxlength="20" />					
			        	</span>
			    	</td>
			    <tr>	
					<td>
			  		<span class="Estilo1">
				   			<label>Observaciones:</label>
				    	</span>
                  	</td>
                  	<td>
						<textarea name="observaciones" id="observaciones"rows="2.5" cols="80"></textarea>
					</td>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Aceptar" />
						<input type="reset" value="Borrar" />		
					</td>
				</tr>
		  	</table>
		    <p>&nbsp;</p>
		</form>
		<nav>
			<table width="768" height="41">
				<td width="129"><div align="center"><a href="modificarproforma.php">Modificar</a></div></td>
				<td width="133"><div align="center"><a href="eliminarproforma.php">Eliminar</a></div></td>
				<td width="142"><div align="center"><a href="consultarproforma.php">Consultar</a></div></td>
				<td width="135"><div align="center"><a href="buscarproformafactura.php">Buscar</a></div></td>
				<td width="135"><div align="center"><a href="menu.php">Volver al Menú</a></div></td>
	 		</table>	
			<p>&nbsp;</p>
	        <p>&nbsp;</p>
		</nav>
	</center> 
</body>
</html>