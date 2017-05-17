<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM secciones WHERE id_seccion=".$id." LIMIT 1";
	$valores=pg_query($sql);
	$valores2=pg_fetch_assoc($valores);

	$datos = array(
		0 => $valores2['anio'],
		1 => $valores2['trayecto'],
		2 => $valores2['seccion'],
		3 => $valores2['sede'],
		4 => $valores2['pnf'],
    		 );
	echo json_encode($datos);
?>