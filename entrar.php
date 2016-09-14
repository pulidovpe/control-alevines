<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
<!--
a {text-decoration: none; color: #CCCC33;}
a:hover {text-decoration: underline; color: #ff0000;}
// -->
</style>
<style type="text/css">
#container
{
width:400px;
height:210px;
margin-left:auto;
margin-right:auto;
border:#FFFFFF 1px solid;
}
.Estilo1 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.Estilo3 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; font-weight: bold; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Roberto Rodriguez C. roberto_rc13@hotmail.com</title>
</head>

<body bgcolor="#000000">
<div id="container"><p></p>
  <p align="center" class="Estilo3">Acceso a tu Cuenta<br />
    <br /><br /><br />
<?php
// Configura los datos de tu cuenta
$dbhost='localhost';
$dbusername='username';
$dbuserpass='password';
$dbname='database';

// Conectar a la base de datos
mysql_connect("localhost", "root") or die(mysql_error());
mysql_select_db("database") or die(mysql_error());

if ($_POST['username']) {
//Comprobacion del envio del nombre de usuario y password
$username=$_POST['username'];
$password=$_POST['password'];
if ($password==NULL) {
echo "El password en incorrecto";
}else{
$query = mysql_query("SELECT username,password FROM users WHERE username = '$username'") or die(mysql_error());
$data = mysql_fetch_array($query);
if($data['password'] != $password) {
echo "Login incorrecto";
}else{
$query = mysql_query("SELECT username,password FROM users WHERE username = '$username'") or die(mysql_error());
$row = mysql_fetch_array($query);
$_SESSION["s_username"] = $row['username'];
echo "<html><head></head><body>Bienvenido ".$_SESSION['s_username']." a tu cuenta<br><br><br>Aquí estan tus datos<br><br><br></body></html>";
// Make a MySQL Connection
mysql_connect("localhost", "root") or die(mysql_error());
mysql_select_db("database") or die(mysql_error());

// Retrieve all the data from the "example" table
$result = mysql_query("SELECT username,password,email FROM users WHERE username = '$username'")
or die(mysql_error());  

// store the record of the "example" table into $row
$row = mysql_fetch_array( $result );
// Print out the contents of the entry -
echo "<font face='verdana' color='#ffffff' size='2'>Username: ".$row['username'];
echo "<br><font face='verdana' color='#ffffff' size='2'>Password:</font>".$row['password'];
echo "<br><font face='verdana' color='#ffffff' size='2'>Email:</font>".$row['email'];
}
}
}
?> 
</div>
</body>
</html>
