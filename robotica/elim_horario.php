<?php
	require 'seguridad.php';
	require 'conexion.php';

	$idSeccion=$_REQUEST['idSeccion'];
	$idPeriodo=$_REQUEST['idPeriodo'];

	pg_query("UPDATE horario_clase SET estatus=0 WHERE id_seccion='$idSeccion' AND id_periodo='$idPeriodo'");

	date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Eliminación','Horarios','".$_SESSION['nom_usuario']."')");

	header('Location:horarios_clase.php?elim=nkh');
?>