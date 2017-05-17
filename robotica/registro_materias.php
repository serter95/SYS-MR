<?php
	require("conexion.php");
	require("seguridad.php");

	$codigo=trim(strtoupper($_POST['codigo']));
	$nombre=trim($_POST['nombre']);
	$trayecto=$_POST['trayecto'];
	$horas=trim($_POST['horas']);

	$query=pg_query("SELECT * FROM materia WHERE codigo='$codigo' AND taller=2 AND estatus=1");
	$num=pg_num_rows($query);

	if ($num>0)
	{
		header('Location:horarios.php?error=codigo');
	}
	else
	{
		$query2=pg_query("INSERT INTO materia (codigo,nombre,trayecto,hora,taller)VALUES('$codigo','$nombre','$trayecto','$horas','2')");

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Registro','Materias','".$_SESSION['nom_usuario']."')");

		header('Location:horarios.php?registro=materia');
	}
?>
