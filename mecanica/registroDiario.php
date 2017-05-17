<?php
	require('seguridad.php');
	require('conexion.php');

	$observaciones=trim($_POST['observaciones']);
	
	date_default_timezone_set('America/Caracas');
	$hoy=date('d/m/Y');
	$hora=getdate();

	if ($hora['seconds']<10)
	{
		$segundos='0'.$hora['seconds'];
	}
	else
	{
		$segundos=$hora['seconds'];
	}

	if ($hora['minutes']<10)
	{
		$minutos='0'.$hora['minutes'];
	}
	else
	{
		$minutos=$hora['minutes'];
	}

	$horaComp=$hora['hours'].':'.$minutos.':'.$segundos;

	$s="SELECT * FROM registro_diario";
	$c=pg_query($s);
	while ($a=pg_fetch_assoc($c))
	{
		$date=explode(' ', $a['fecha']);

		if($observaciones==$a['observaciones'] AND $hoy==$date[0])
		{
			$actividad="existe";
		}
	}

	if ($actividad!='existe')
	{
		$query=pg_query("SELECT * FROM personal INNER JOIN usuario ON personal.id=usuario.id_personal AND personal.estatus=1 AND usuario.estatus=1 AND usuario.nom_usuario='".$_SESSION['nom_usuario']."' AND usuario.taller=1");
		$array=pg_fetch_assoc($query);

		$id_personal=$array['id'];
		$fecha=$hoy.' '.$horaComp;

		$query2=pg_query("INSERT INTO registro_diario (observaciones, id_personal, fecha) VALUES ('$observaciones'
			, '$id_personal','$fecha')");

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			VALUES('$hoy','Registro','Registro Diario','".$_SESSION['nom_usuario']."',1)");

		header('Location:registro_diario.php?registro=exito');
	}
	else
	{
		header('Location:registro_diario.php?error=siR');
	}
?>