<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_REQUEST['id_maq'];
	# Obtenemos los datos del usuario

	$valores=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE m.estatus='1' AND id_maquina='".$id."' AND m.n_b=n.id_nb");
	$valores2=pg_fetch_assoc($valores);

	$nbx=explode('-', $valores2['nb']);
                            $nb=$nbx[0];
                            $nbnum=$nbx[1];

	 $imagenx=explode('/', $valores2['imagen']);
	$primero=$imagenx[0];
	$segundo=$imagenx[1];
	 $tercero=$imagenx[2];

	$datos = array(
		0 => $valores2['codigo'],
		1 => $nbnum,
		2 => $valores2['marca'],
		3 => $valores2['modelo'],
		4 => $valores2['maquina'],
		5 => $valores2['estado'],
		6 => $valores2['id_nb'],
		7 => $valores2['imagen'].'?xas='.rand(0,99999),
		8 => $valores2['imagen'],
	
    		 );
	echo json_encode($datos);

?>