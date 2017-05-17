<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id_pla'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM planificacion_semanal INNER JOIN personal
	ON planificacion_semanal.id_personal = personal.id AND planificacion_semanal.estatus=1 AND personal.estatus=1
	AND planificacion_semanal.id_planif='$id' AND area='Robotica'";

	$valores=pg_query($sql);
	$array=pg_fetch_assoc($valores);

	$fecha=explode('-', $array['fecha']);

	$fecha_planif=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];

	$nc=explode('-', $array['ci']);

	$nac=$nc[0].'-';
	$ci=$nc[1];

	$datos = array(
		0 => $nac,
		1 => $ci,
		2 => $array['nombres'],
		3 => $array['apellidos'],
		4 => $array['actividad'],
		5 => $fecha_planif,
		6 => $array['id'],

    		 );
	echo json_encode($datos);
?>