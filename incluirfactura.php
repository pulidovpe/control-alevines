<?php session_start();
if(!isset($_SESSION['usuario'])) { 
  header("Location: cerrarsesion.php");
  exit;
} 
include_once("conexion.php");
$conecta = conectarse();
$idProd = trim($_GET["cedula"]);

$resultado1 = mysql_query("SELECT `id_fact` FROM `proforma` ORDER BY `id_fact` DESC LIMIT 1",$conecta);
$registros1 = mysql_fetch_array($resultado1);
$ultimopro = $registros1['id_fact'] + 1;
$resultado = mysql_query("SELECT `id_fact` FROM `factura` ORDER BY `id_fact` DESC LIMIT 1",$conecta);
$registros = mysql_fetch_array($resultado);
$ultimo = $registros['id_fact'] + 1;

$res = mysql_query("SELECT * FROM almacen ",$conecta);

$ahora= time();
$fecha = date("Y",$ahora)."-";
$fecha .= date("m",$ahora)."-";
$fecha .= date("d",$ahora);

?>
<div id="factura">
	<center>
		<h1>Factura de Venta</h1>
	</center>
	<!-- form method="post" action="validarincluirfactura.php" -->
	<form name="planilla1" id="planilla1" method="post" onsubmit="llamarasincronopost('validarincluirfactura.php','factura','mensaje','4',
		'fecha='+document.getElementById('fecha').value
		+'&amp;cedula='+document.getElementById('cedula').value
		+'&amp;cant1='+document.getElementById('cant1').value
		+'&amp;cant2='+document.getElementById('cant2').value
		+'&amp;cant3='+document.getElementById('cant3').value
		+'&amp;cant4='+document.getElementById('cant4').value
		+'&amp;p1='+document.getElementById('p1').value
		+'&amp;p2='+document.getElementById('p2').value
		+'&amp;p3='+document.getElementById('p3').value
		+'&amp;p4='+document.getElementById('p4').value
		+'&amp;trans='+document.getElementById('transporte').value
		+'&amp;total='+document.getElementById('total').value
		+'&amp;id_factura='+document.getElementById('id_factura').value); return false;" action="#">
		<fieldset>
  			<legend>Factura</legend>
			<div align="left">
				<th>Numero de Factura:</th>					
				<input type="text" name="id_factura" id="id_factura" size="5" maxlength="10" disabled="disabled" value="<?php echo $ultimo; ?>" />
				<input type="hidden" name="id_proforma" id="id_proforma" size="5" maxlength="10" disabled="disabled" value="<?php echo $ultimopro; ?>" />				
				<th>Fecha de Factura:</th>
			  	<input type="date" name="fecha" id="fecha" size="10" maxlength="10" value="<?php echo $fecha; ?>" />
	   	</div>
		</fieldset>
		<fieldset>
  			<legend>Datos del Productor</legend>
  			<th>Cédula:</th>				
			<input type="text" name="cedula" id="cedula" size="7" maxlength="8" value="<?php echo $idProd; ?>" />			
			<input type="button" value="Buscar" onclick="javascript:buscarDato('1','dat-prod'); return false;" />
			<div id="dat-prod" align="center"></div>
		</fieldset>
		<fieldset>
  			<legend>Cantidades a comprar</legend>
  			<table border="1">
  				<tr>
  					<th>Alevines 1:</th>
					<td><input type="text" name="cant1" id="cant1" size="3" maxlength="4" onkeyUp="return ValNumero(this);" /></td>
					<th>Precio:</th>
					<?php $reg = mysql_fetch_array($res); ?>
					<td><input type="text" name="precio1" id="precio1" size="4" maxlength="4" disabled="disabled" value="<?php echo $reg['precio']; ?>" /></td>
					<th>Alevines 2:</th>
					<td><input type="text" name="cant2" id="cant2" size="3" maxlength="4" onkeyUp="return ValNumero(this);" /></td>
					<th>Precio:</th>
					<?php $reg = mysql_fetch_array($res); ?>
					<td><input type="text" name="precio2" id="precio2" size="4" maxlength="4" disabled="disabled" value="<?php echo $reg['precio']; ?>" /></td>
					<th>Juveniles:</th>
					<td><input type="text" name="cant3" id="cant3" size="3" maxlength="4" /></td>
					<th>Precio:</th>
					<?php $reg = mysql_fetch_array($res); ?>
					<td><input type="text" name="precio3" id="precio3" size="4" maxlength="4" disabled="disabled" value="<?php echo $reg['precio']; ?>" /></td>					
				</tr>
				<tr>
					<th>Empaques:</th>
					<td><input type="text" name="cant4" id="cant4" size="3" maxlength="4" onkeyUp="return ValNumero(this);" disabled="disabled" /></td>
					<th>Precio:</th>
					<?php $reg = mysql_fetch_array($res); ?>
					<td><input type="text" name="precio4" id="precio4" size="4" maxlength="4" disabled="disabled" value="<?php echo $reg['precio']; ?>" /></td>
					<th>Transporte:</th>
					<td colspan="4">
						<input type="hidden" name="p1" id="p1" />
						<input type="hidden" name="p2" id="p2" />
						<input type="hidden" name="p3" id="p3" />
						<input type="hidden" name="p4" id="p4" />
						<select name="transporte1" id="transporte1" size="1" maxlength="5" onchange="document.getElementById('transporte').value = this.options[this.selectedIndex].value;">
							<option value="0" disabled="disabled" selected></option>
							<option value="0">Del Productor (en empaques)</option>
							<option value="0">Del Productor (en tanque)</option>
							<option value="0">Del Productor (cisterna)</option>
							<?php
								// Nos conectamos a la base de datos
								$link=conectarse();
								mysql_query("SET NAMES 'utf8'");			
								$res = mysql_query("SELECT * FROM almacen WHERE id > 4",$link);
								$cant =  mysql_num_rows($res);
								if($cant>0){						
									while($rs = mysql_fetch_array($res)){
										$texto = $rs['texto'];
										//COMO ESPECIFICAR EL TRANSPORTE EN LA FACTURA???
							?>				
							<option value="<?php echo $rs['precio']; ?>"><?php echo $rs['texto']; ?></option>
							<?php
									}
								}
							?>
						</select>
						<input type="hidden" name="transporte" id="transporte" />
						<td>	
							<input type="button" value="Calcular" onclick="javascript:calcula(); return false" />
						</td>
					</td>
					<th>Total:</th>
					<td><input type="text" name="total" id="total" disabled="disabled" size="8" maxlength="10" /></td>
				</tr>
			</table>			
		 	<div id="dat-prod" align="center">				
			</div>
		</fieldset>
		<fieldset>
  			<legend>Forma de Pago</legend>
  			<table border="0" width="600">
  				<tr>
  					<td>
  						<div id="divoculto1" style="color:red;display:block;">
	  						<input style="display:none" type="button" name="pagar11" id="pagar11" value="-- Pago" onclick="javascript:mostrarocultar('4')" />
							<input style="display:block" type="button" name="pagar1" id="pagar1" value="+ Pago" onclick="javascript:mostrarocultar('1')" />
							<input style="display:none" type="button" name="pagar22" id="pagar22" value="-- Pago" onclick="javascript:mostrarocultar('3')" />
							<input style="display:none" type="button" name="pagar2" id="pagar2" value="+ Pago" onclick="javascript:mostrarocultar('2')" />
	  						<hr />
	  						<select name="fpago1" id="fpago1" size="1" onChange="if(this.options[3].selected) javascript:efectivo('1'); else javascript:efectivo('4');" >
								<option value="" disabled="disabled" selected></option>
								<option value="Deposito">Deposito</option>
								<option value="Cheque">Cheque</option>
								<option value="Efectivo">Efectivo</option>
							</select>
							Numero:<input type="text" name="numero1" id="numero1" size="8" maxlength="10" onkeyUp="return ValNumero(this);" />
							Fecha:<input type="date" name="fecha1" id="fecha1" size="8" maxlength="10" />
							Monto:<input type="text" name="monto1" id="monto1" size="8" maxlength="10" value=0 onkeyUp="return ValNumero(this);" />					
						</div>
						<div id="divoculto2" style="color:blue;display:none;">							
							<hr />
							<select name="fpago2" id="fpago2" size="1" onchange="if(this.options[3].selected) javascript:efectivo('2'); else javascript:efectivo('5');">
								<option value="" disabled="disabled" selected></option>
								<option value="Deposito">Deposito</option>
								<option value="Cheque">Cheque</option>
								<option value="Efectivo">Efectivo</option>
							</select>
							Numero:<input type="text" name="numero2" id="numero2" size="8" maxlength="10" onkeyUp="return ValNumero(this);" />
							Fecha:<input type="date" name="fecha2" id="fecha2" size="8" maxlength="10" />
							Monto:<input type="text" name="monto2" id="monto2" size="8" maxlength="10" value=0 onkeyUp="return ValNumero(this);" />														
						</div>
						<div id="divoculto3" style="color:green;display:none;">
							<hr />
							<select name="fpago3" id="fpago3" size="1" onchange="if(this.options[3].selected) javascript:efectivo('3'); else javascript:efectivo('6');">
								<option value="" disabled="disabled" selected></option>
								<option value="Deposito">Deposito</option>
								<option value="Cheque">Cheque</option>
								<option value="Efectivo">Efectivo</option>
							</select>
							Numero:<input type="text" name="numero3" id="numero3" size="8" maxlength="10" onkeyUp="return ValNumero(this);" />
							Fecha:<input type="date" name="fecha3" id="fecha3" size="8" maxlength="10" />
							Monto:<input type="text" name="monto3" id="monto3" size="8" maxlength="10" value=0 onkeyUp="return ValNumero(this);" />							
						</div>						
  					</td> 
  					<td align="right">
  						<input type="hidden" name="recibido" id="recibido" value='NO' />
  						<input type="button" name="Cobrar" id="Cobrar" value="Cobrar" onclick="llamarasincronopost('validarincluirdeposito.php','factura','mensaje','5',
						'fpago1='+document.getElementById('fpago1').value
						+'&amp;numero1='+document.getElementById('numero1').value
						+'&amp;fecha1='+document.getElementById('fecha1').value
						+'&amp;monto1='+document.getElementById('monto1').value
						+'&amp;fpago2='+document.getElementById('fpago2').value
						+'&amp;numero2='+document.getElementById('numero2').value
						+'&amp;fecha2='+document.getElementById('fecha2').value
						+'&amp;monto2='+document.getElementById('monto2').value
						+'&amp;fpago3='+document.getElementById('fpago3').value
						+'&amp;numero3='+document.getElementById('numero3').value
						+'&amp;fecha3='+document.getElementById('fecha3').value
						+'&amp;monto3='+document.getElementById('monto3').value
						+'&amp;id_factura='+document.getElementById('id_factura').value);" />
  					</td> 					
  				</tr>
  			</table>			
		</fieldset>
		<table>
			<tr>
				<td>
					<input type="submit" name="Facturar" value="Facturar" />
					<input type="button" value="Proforma" onclick="llamarasincronopost('validarincluirproforma.php','factura','mensaje','8',
					'fecha='+document.getElementById('fecha').value
					+'&amp;cedula='+document.getElementById('cedula').value
					+'&amp;cant1='+document.getElementById('cant1').value
					+'&amp;cant2='+document.getElementById('cant2').value
					+'&amp;cant3='+document.getElementById('cant3').value
					+'&amp;cant4='+document.getElementById('cant4').value
					+'&amp;p1='+document.getElementById('p1').value
					+'&amp;p2='+document.getElementById('p2').value
					+'&amp;p3='+document.getElementById('p3').value
					+'&amp;p4='+document.getElementById('p4').value
					+'&amp;total='+document.getElementById('total').value); return false;" />
					<input type="button" value="Cancelar" onclick="llamarasincronoget('productores.php','contenedor','centro','0')" />
				</td>
			</tr>
		</table>
	</form>
	<div id="mensaje" style='visibility:hidden'></div>
</div>