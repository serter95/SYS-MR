<?php
require ('seguridad.php');
require ('conexion.php');

	$mat=$_REQUEST['mat'];

	$sql="SELECT * FROM materia WHERE codigo='$mat' AND taller=2 AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos = array(
			0 => $array['nombre'],
			1 => $array['hora'],
		);
			
	echo json_encode($datos);
?>