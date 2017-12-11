<?php 	
	$dbopts = parse_url(getenv('DATABASE_URL')); // HEROKU
	//$cadena="host='localhost' port='5432' dbname='SYS-M&R' user='postgres' password='1234'";
	$cadena="host='".$dbopts["host"]."' port='".$dbopts["port"]."' dbname='".ltrim($dbopts["path"],'/')."' user='".$dbopts["user"]."' password='".$dbopts["pass"]."'";
	$con=pg_connect($cadena) or die("Error de conexion. ". pg_last_error());
	pg_set_client_encoding($con, "UTF-8");
?>