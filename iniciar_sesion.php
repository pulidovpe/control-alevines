<br />
<br />
<center><h2>Iniciar Sesión</h2></center>
<br />
<div id="sesion" align="center">
	<!-- form action="validarsesion.php" method="post" -->
	<form name="planilla1" id="planilla1" method="post" onsubmit="llamarasincronopost('validarsesion.php','sesion','mensaje','1',
		'usuario='+document.getElementById('usuario').value
		+'&amp;clave='+document.getElementById('clave').value); return false" action="#">
			<table width="259" align="center">
				<tr>
					<td width="70" >Login:  </td>
					<td width="177" ><input type="text" name="usuario" id="usuario" size="15" /></td>
				</tr>
				<tr>
					<td >
						<span class="Estilo12">Password:  
					</td>
					<td><input type="password" name="clave" id="clave" size="15" /></td>
				</tr>
				<tr>
					<td ></td>
					<td>
						<input name="submit" type="submit" value="Entrar" />
						<input name="Restablecer" type="reset" value="Limpiar" />
					</td>
				</tr>
			</table>
		</form>
		<!-- div align="center"><span class="Estilo4"><a href="registrarse.html">Registrarse</a></span></div-->
	<div id="mensaje" style='visibility:hidden'></div>
	
</div>