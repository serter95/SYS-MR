<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id_tipo'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM tipo_usuario WHERE id_tipo='$id'";
	$valores=pg_query($sql);
	$array=pg_fetch_assoc($valores);

	$tipo=$array['tipo'];
	$priv_horarios=$array['priv_horarios'];
	$priv_proyectos=$array['priv_proyectos'];
	$priv_convenios=$array['priv_convenios'];
	$priv_inventario=$array['priv_inventario'];
	$priv_maquinas=$array['priv_maquinas'];
	$priv_actividades=$array['priv_actividades'];
	$priv_personal=$array['priv_personal'];
	$priv_usuarios=$array['priv_usuarios'];
	$priv_bd=$array['priv_bd'];
	$priv_auditoria=$array['priv_auditoria'];

	$datos = array(
		0 => $id,
		1 => $tipo,
		2 => $priv_horarios,
		3 => $priv_proyectos,
		4 => $priv_convenios,
		5 => $priv_inventario,
		6 => $priv_maquinas,
		7 => $priv_actividades,
		8 => $priv_personal,
		9 => $priv_usuarios,
		10 => $priv_bd,
		11 => $priv_auditoria,
    		 );
	echo json_encode($datos);
?>
	
			