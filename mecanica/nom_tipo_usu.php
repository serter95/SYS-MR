<?php
	require('seguridad.php');
	require('conexion.php');

	$nombre=ucfirst(trim($_POST['nom']));

	$sql="SELECT * FROM tipo_usuario WHERE area In ('Doble', 'Mecanica') AND estatus=1 AND tipo='$nombre'";
	$query=pg_query($sql);
	$num=pg_num_rows($query);

	if ($num>0)
	{
		echo $dato=1;
	}
	else
	{
		echo $dato=0;
	}
?>