<?php
require ('seguridad.php');
require ('conexion.php');

	$nb=$_REQUEST['nb'];
	
	$sql="SELECT * FROM maquinas WHERE n_b='".$nb."'";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos = array(
			0 => $array['id_maquina'],
			1 => $array['codigo'],
		);
			
	echo json_encode($datos);
?>