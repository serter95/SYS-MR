<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];

	$query=pg_query("SELECT * FROM planificacion_semanal WHERE id_planif='$id'");
	$array=pg_fetch_assoc($query);

	$dato = array(
		0 => $array['estado'],
		);

	echo json_encode($dato);
?>