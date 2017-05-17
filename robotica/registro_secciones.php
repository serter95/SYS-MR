<?php
	require("conexion.php");
	require("seguridad.php");

	$anio=trim($_POST['anio']);
	$trayecto=$_POST['trayecto_s'];
	$seccion=trim($_POST['seccion']);
	$sede=$_POST['sede'];
	$pnf=$_POST['pnf'];

	$query=pg_query("SELECT * FROM secciones WHERE sede='$sede' AND pnf='$pnf' AND anio='$anio' AND trayecto='$trayecto' AND seccion='$seccion' AND taller=2 AND estatus=1");
	$num=pg_num_rows($query);

	if ($num>0)
	{
		#echo "ERROR";
		header('Location:horarios.php?error=seccion');
	}
	else
	{
		$query2=pg_query("INSERT INTO secciones (anio,trayecto,seccion,sede,pnf,taller)VALUES('$anio','$trayecto','$seccion','$sede','$pnf','2')");
		#echo "EXITO";
		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Registro','Secciones','".$_SESSION['nom_usuario']."')");

		header('Location:horarios.php?registro=seccion');
	}
?>
