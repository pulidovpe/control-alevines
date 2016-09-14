<?php
	function conectarse()
	{
		$BaseDeDatos = "piscicola";
		$Servidor = "localhost";
		$Usuario = "pulidovpe";
		$Clave = "123456";
		$Conexion = mysql_connect($Servidor,$Usuario,$Clave)or die("Error! Fallo la conexion!<br>" . mysql_error() );
		$dbresult=mysql_select_db($BaseDeDatos, $Conexion)or die("Error seleccionando database <br>" . mysql_error() );
		return $Conexion;
	}
	function desconectar($Conexion)
	{
		mysql_close($Conexion);
	}
?>
