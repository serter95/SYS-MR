<?php
	require("seguridad.php");
	require("conexion.php");

$id=$_POST['id'];
$observaciones=trim($_POST['observaciones_M']);

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

	$fecha=$hoy.' '.$horaComp;
	
		$sql="UPDATE registro_diario SET observaciones='$observaciones', fecha='$fecha'	WHERE id_reg='$id'";
	
		pg_query($sql);

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Modificación','Registro Diario','".$_SESSION['nom_usuario']."')");

		header("Location:registro_diario.php?modificar=exito");
	
?>