<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id'];

	# Eliminamos logicamente el usuario

	pg_query("UPDATE secciones SET estatus='0' WHERE id_seccion='".$id."'");

	date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Secciones','".$_SESSION['nom_usuario']."',1)");

    header("Location:horarios.php?elim_mat=seccion");

?>