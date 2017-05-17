<?php
	require('seguridad.php');
	require('conexion.php');

	$periodo=$_POST['periodo'];
	$sec=explode(' ', $_POST['seccion']);
	$anio=$sec[1];
	$trayecto=$sec[3];
	$seccion=$sec[5];

	$lon=strlen($sec[7]);

	if ($lon==2)
	{
		$sede=$sec[7]." ".$sec[8];
		$pnf=$sec[10];
	}
	else
	{
		$sede=$sec[7];
		$pnf=$sec[9];
	}

	$query=pg_query("SELECT * FROM horario_clase hc, secciones s, periodo p WHERE hc.id_seccion=s.id_seccion AND
		hc.id_periodo=p.id_periodo AND s.anio='$anio' AND s.trayecto='$trayecto' AND s.seccion='$seccion' AND
		s.sede='$sede' AND s.pnf='$pnf' AND p.tipo='$periodo' AND hc.taller=1 AND s.taller=1 AND hc.estatus=1 AND s.estatus=1");
	$num=pg_num_rows($query);

	if ($num>0)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
	
?>