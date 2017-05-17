<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM registro_diario INNER JOIN personal
	ON registro_diario.id_personal = personal.id AND registro_diario.estatus=1 AND personal.estatus=1
	AND registro_diario.id_reg='$id' AND area='Mecanica'";

	$valores=pg_query($sql);
	$array=pg_fetch_assoc($valores);

	$datos = array(
		0 => $array['id_personal'],
		1 => $array['observaciones'],
    		 );
	echo json_encode($datos);
?>