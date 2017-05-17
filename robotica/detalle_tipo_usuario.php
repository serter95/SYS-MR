<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id_usu'];

	$sql="SELECT * FROM tipo_usuario WHERE id_tipo='$id'";
	$query=pg_query($sql);
    $array=pg_fetch_assoc($query);

    $dato = array(
            0 => $array['tipo'],
            1 => $array['priv_horarios'],
            2 => $array['priv_proyectos'],
            3 => $array['priv_convenios'],
            4 => $array['priv_inventario'],
            5 => $array['priv_maquinas'],
            6 => $array['priv_actividades'],
            7 => $array['priv_personal'],
            8 => $array['priv_usuarios'],
            9 => $array['priv_bd'],
            10 => $array['priv_auditoria'],
        );

    echo json_encode($dato);

?>