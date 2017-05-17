<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id'];

	pg_query("UPDATE planificacion_semanal SET estatus='0' WHERE id_planif='$id'");

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Eliminación','Planificación Semanal','".$_SESSION['nom_usuario']."')");

    header("Location:planificacion_semanal.php?elim_planif=si");
?>
