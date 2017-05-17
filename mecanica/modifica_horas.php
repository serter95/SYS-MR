<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM horas WHERE id_horas=".$id." LIMIT 1";
	$valores=pg_query($sql);
	$valores2=pg_fetch_assoc($valores);

	$h=explode(' ', $valores2['entrada']);
	$hora1=$h[0];
	$horario1=$h[1];

	$ho=explode(' ', $valores2['salida']);
	$hora2=$ho[0];
	$horario2=$ho[1];

	$datos = array(
		0 => $valores2['numero_bloque'],
		1 => $hora1,
		2 => $horario1,
		3 => $hora2,
		4 => $horario2,
    		 );
	echo json_encode($datos);
?>