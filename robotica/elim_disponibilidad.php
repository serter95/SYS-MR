<?php
	require("seguridad.php");
	require("conexion.php");

	$id_personal=$_REQUEST['id_personal'];
	$id_periodo=$_REQUEST['id_periodo'];

	# Eliminamos logicamente el usuario

	/*$query=pg_query("SELECT * FROM disponibilidad_persona WHERE id_personal='$id_personal' 
	AND id_periodo='$id_periodo' AND estatus=1 ORDER BY id_horas ASC");

	while($array=pg_fetch_assoc($query))
	{
		#echo $array['id_periodo'].' '.$array['id_personal'].' ---> '.$array['estatus'].' '.$array['lunes'].' '.$array['martes'].' '.$array['miercoles'].' '.$array['jueves'].' '.$array['viernes'].' '.$array['id_horas'];
		#echo "<br>";
	}*/

	pg_query("UPDATE disponibilidad_persona SET estatus=0 WHERE id_personal='$id_personal'
		AND id_periodo='$id_periodo'");

	date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Eliminación','Disponibilidad','".$_SESSION['nom_usuario']."')");

    header("Location:horarios.php?elim_mat=disponibilidad");
?>