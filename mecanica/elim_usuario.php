<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id_usu'];

	# Eliminamos logicamente el usuario

	pg_query("UPDATE usuario SET estatus='0' WHERE id_usu='".$id."'");

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
		VALUES('$hoy','Eliminación','Usuarios','".$_SESSION['nom_usuario']."',1)");

    header("Location:usuarios.php?elim_usu=si");
?>