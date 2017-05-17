<?php
	require 'seguridad.php';
	require 'conexion.php';

	$nombre=trim(strtoupper($_POST['nombre']));

	$query=pg_query("SELECT * FROM aulas WHERE nombre='$nombre' AND taller=1 AND estatus=1");
	$array=pg_fetch_assoc($query);

	if ($array['nombre']==$nombre)
	{
		header("Location:horarios.php?r=n");
	}
	else
	{
		pg_query("INSERT INTO aulas (nombre) VALUES ('$nombre')");

		date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Registro','Aulas','".$_SESSION['nom_usuario']."',1)");

		header('Location:horarios.php?r=e');
	}
?>