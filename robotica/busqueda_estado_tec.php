<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];

	$query=pg_query("SELECT * FROM proyectos WHERE id_proyecto='$id'");
	$array=pg_fetch_assoc($query);

	$dato = array(
		0 => $array['estado_proyecto'],
		);

	echo json_encode($dato);
?>