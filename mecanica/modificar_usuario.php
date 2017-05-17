<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id_usu'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM tipo_usuario INNER JOIN (usuario INNER JOIN personal ON usuario.id_personal = personal.id
		AND id_usu='$id') ON tipo_usuario.id_tipo = usuario.id_tipo_usuario";
	$valores=pg_query($sql);
	$array=pg_fetch_assoc($valores);

	$ci_usu=$array['ci'];

	$nc=explode('-', $ci_usu);

	$nac_usu=$nc[0].'-';
	$ci_usuario=$nc[1];

	$nombres=$array['nombres'];
	$apellidos=$array['apellidos'];
	$nom_usuario=$array['nom_usuario'];
	$tipo=$array['tipo'];

	$datos = array(
		0 => $id,
		1 => $nac_usu,
		2 => $ci_usuario,
		3 => $nombres,
		4 => $apellidos,
		5 => $nom_usuario,
		6 => $tipo,
		7 => $array['pregunta'],
		8 => $array['respuesta'],
    		 );
	echo json_encode($datos);
?>
	
			