<?php
require ('seguridad.php');
require ('conexion.php');

	$code=$_REQUEST['code'];
	$code=ucwords($code);
	
	$sql="SELECT * FROM maquinas m, numero_bien n WHERE m.codigo='".$code."' AND m.n_b=n.id_nb";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos = array(
			0 => $array['id_maquina'],
			1 => $array['nb'],
		);
			
	echo json_encode($datos);
?>