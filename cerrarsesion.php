<?php session_start();
	session_destroy();
	echo "<script language='javascript'> ";
	echo "window.open('index.php','_top');";
	//echo "alert('Sesi\u00f3n expir\u00f3!');";
	echo "</script>";
?>