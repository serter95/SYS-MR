<?php
	require('seguridad.php');
	require('conexion.php');

	$actividad=ucfirst(trim($_POST['nom_act']));
	
	$fecha=explode('/', trim($_POST['fecha_act']));
	$fecha_planif=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];

	$cedula=$_POST['nacionalidad_planif'].trim($_POST['ci_planif']);

	$sql="SELECT * FROM personal WHERE ci='$cedula' AND area='Mecanica' AND estatus=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);
	$id_personal=$array['id'];

	$s="SELECT * FROM planificacion_semanal INNER JOIN personal ON planificacion_semanal.estatus=1 
	AND personal.estatus=1 AND area='Mecanica'";
	$c=pg_query($s);
	while ($a=pg_fetch_assoc($c))
	{
		if($actividad==$a['actividad'] AND $fecha_planif==$a['fecha'] AND $id_personal==$a['id_personal'])
		{
			$actividad="existe";
		}
	}

	if ($actividad!='existe')
	{

		$sql2="INSERT INTO planificacion_semanal (actividad, fecha, id_personal, estado)
		VALUES ('$actividad','$fecha_planif', '$id_personal', 'En proceso')";

		$query2=pg_query($sql2);

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			VALUES('$hoy','Registro','Planificación Semanal','".$_SESSION['nom_usuario']."',1)");

		header('Location:planificacion_semanal.php?registro=exito');
	}
	else
	{
		header('Location:planificacion_semanal.php?error=si');
	}

	

?>