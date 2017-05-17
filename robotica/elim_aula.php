<?php
	require 'seguridad.php';
	require 'conexion.php';

	pg_query("UPDATE aulas SET estatus=0 WHERE id_aulas='".$_REQUEST['id']."'");

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Eliminación','Aulas','".$_SESSION['nom_usuario']."')");

	header('Location:horarios.php?r=el');
?>