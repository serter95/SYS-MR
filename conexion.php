<?php 

	$cadena="host='localhost' port='5432' dbname='SYS-M&R' user='postgres' password='1234'";
	$con=pg_connect($cadena) or die("Error de conexion. ". pg_last_error());
	pg_set_client_encoding($con, "UTF-8");
		
?>