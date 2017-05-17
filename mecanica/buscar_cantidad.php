<?php
require ('seguridad.php');
require ('conexion.php');

	$id=$_REQUEST['id'];
	$tipo=$_REQUEST['tipo'];
	if($tipo=='preventivo'){
	
	$sql="SELECT * FROM repuestos WHERE id_repuesto='".$id."' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
	//$array["id_maquina"];
	
	$cantidad=$array["salida1"];
	
 				
	echo ($cantidad);
	
	//echo ($encontrado);

	
	}

	if($tipo=='correctivo'){
	
	$sql="SELECT * FROM repuestos WHERE id_repuesto='".$id."' AND estatus=1";
	$query=pg_query($sql);
	
	$array=pg_fetch_assoc($query);
	//$array["id_maquina"];
	
	$cantidad=$array["salida1"];
	
 	
			
	echo ($cantidad);

	
	}


?>

