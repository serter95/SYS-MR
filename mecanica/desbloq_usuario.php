<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id_usu'];

	# Desbloqueamos al usuario

	pg_query("UPDATE usuario SET bloqueo=0 WHERE id_usu='$id'");

    header("Location:usuarios.php?desbloq_usu=si");
?>