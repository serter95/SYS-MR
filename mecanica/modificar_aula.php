<?php

	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	$query=pg_query("SELECT * FROM aulas WHERE id_aulas='$id'");
	$array=pg_fetch_assoc($query);

	$datos = array(
		0 => $array['nombre'],
		);

	echo json_encode($datos);
?>