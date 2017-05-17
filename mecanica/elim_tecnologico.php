<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id'];
	$lugar=$_REQUEST['comunitario'];

	pg_query("UPDATE proyectos SET estatus='0' WHERE id_proyecto='$id'");

	if ($lugar=="comunitario")
	{

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Comunitario','".$_SESSION['nom_usuario']."',1)");

		header("Location:comunitario.php?elim=si");
	}
	else
	{
		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Tecnológico','".$_SESSION['nom_usuario']."',1)");

		header("Location:tecnologico.php?elim=si");
	}
?>
