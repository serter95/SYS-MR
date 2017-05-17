<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id'];

	# Eliminamos logicamente el usuario

	pg_query("UPDATE personal SET estatus='0' WHERE id='".$id."'");

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Eliminación','Personal','".$_SESSION['nom_usuario']."')");

    header("Location:personal.php?elim_per=si");

?>