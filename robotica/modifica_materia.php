<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM materia WHERE id_materia=".$id." LIMIT 1";
	$valores=pg_query($sql);
	$valores2=pg_fetch_assoc($valores);

	$datos = array(
		0 => $valores2['codigo'],
		1 => $valores2['nombre'],
		2 => $valores2['trayecto'],
		3 => $valores2['hora'],
    		 );
	echo json_encode($datos);
?>