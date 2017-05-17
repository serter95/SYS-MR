<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_REQUEST['id_tec'];
	$estado=$_REQUEST['estado'];
	$lugar=$_REQUEST['comunitario'];

	pg_query("UPDATE proyectos SET estado_proyecto='$estado' WHERE id_proyecto='$id'");

	if ($lugar=="comunitario")
	{
		header('Location:comunitario.php?estado=exito');		
	}
	else
	{
		header('Location:tecnologico.php?estado=exito');
	}
?>