<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del preventivo
    $valores=pg_query("SELECT * FROM clausulas WHERE id_clausula='$id' AND estatus=1");

	//$valores=pg_query("SELECT * FROM mant_correctivo WHERE id_correctivo='".$id."'");
	$valores2=pg_fetch_assoc($valores);

     						
                         

		$datos = array(

		0 => $valores2['id_clausula'],
		1 => $valores2['contenido'],
		2 => $valores2['seguimiento'],

		//1 => $encargado_mant,
		
		);
echo json_encode($datos);


?>