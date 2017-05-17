<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_REQUEST['id_planif'];
	$estado=$_REQUEST['estado'];

	pg_query("UPDATE planificacion_semanal SET estado='$estado' WHERE id_planif='$id'");

	header('Location:planificacion_semanal.php?estado=exito');
?>