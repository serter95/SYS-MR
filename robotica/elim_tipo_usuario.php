<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id_tipo'];

	# Eliminamos logicamente el usuario
	$sql="UPDATE tipo_usuario SET estatus=0 WHERE id_tipo='$id'";
	pg_query($sql);

	#echo $sql;

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Eliminación','Tipo de Usuarios','".$_SESSION['nom_usuario']."')");

    header("Location:tipo_usuario.php?eliminar=si");
?>