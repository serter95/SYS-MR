<?php
	require("seguridad.php");
	require("conexion.php");

$id=$_POST['id'];
$id_personal=$_POST['id_per'];
$cedula=$_POST["nacionalidad_planif_M"].trim($_POST['ci_planif_M']);
$actividad=ucfirst(trim($_POST['nom_act_M']));
$fecha=explode('/', trim($_POST['fecha_act_M']));
$fecha_planif=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];

	$s="SELECT * FROM planificacion_semanal INNER JOIN personal ON planificacion_semanal.estatus=1 
	AND personal.estatus=1 AND area='Mecanica'";
	$c=pg_query($s);
	while ($a=pg_fetch_assoc($c))
	{
		if($actividad==$a['actividad'] AND $fecha_planif==$a['fecha'] AND $id_personal==$a['id_personal']
		 AND $id!=$a['id_planif'])
		{
			$actividad="existe";
		}
	}

	if ($actividad!='existe')
	{
		$sqlx="SELECT * FROM personal WHERE ci='$cedula' AND area='Mecanica' AND estatus=1";
		$query=pg_query($sqlx);
		$array=pg_fetch_assoc($query);
		$id_per=$array['id'];

		$sql="UPDATE planificacion_semanal SET actividad='$actividad', fecha='$fecha_planif'
		,id_personal='$id_per' WHERE id_planif='$id'";
	
		pg_query($sql);

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
			VALUES('$hoy','Modificación','Planificación Semanal','".$_SESSION['nom_usuario']."',1)");

		header("Location:planificacion_semanal.php?modificar=exito");
	}
	else
	{
		header('Location:planificacion_semanal.php?error=si');
	}
?>