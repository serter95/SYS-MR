<?php
	require 'conexion.php';
	require 'seguridad.php';

	$id=$_POST['id'];
	$pnf=$_POST['pnf'];
	$sede=$_POST['sede'];
	$anio=trim($_POST['anio']);
	$trayecto=$_POST['trayecto'];
	$seccion=trim($_POST['seccion']);

	$query=pg_query("SELECT * FROM secciones WHERE pnf='$pnf' AND sede='$sede' AND anio='$anio'
		AND trayecto='$trayecto' AND seccion='$seccion' AND taller=2 AND estatus=1");
	$num=pg_num_rows($query);

	if ($id==0)
	{
		if ($num>0)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}
	else
	{
		if ($num>0)
		{
			$array=pg_fetch_assoc($query);
			if ($id==$array['id_seccion'])
			{
				echo 2;
			}
			else
			{
				echo 1;
			}
		}
		else
		{
			echo 2;
		}
	}
	
	
?>