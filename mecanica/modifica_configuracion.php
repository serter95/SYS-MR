<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del usuario

	$valores=pg_query("SELECT * FROM usuario WHERE estatus=1 AND id_usu='$id'");
	$valores2=pg_fetch_assoc($valores);

	$datos = array(
		0 => $valores2['nom_usuario'],
		1 => $valores2['pregunta'],
		2 => $valores2['respuesta'],
    		 );
	echo json_encode($datos);
?>