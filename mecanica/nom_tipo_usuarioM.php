<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];
	$nombre_tipo=ucfirst(trim($_POST['nom']));

	$sql="SELECT * FROM tipo_usuario WHERE area In ('Doble', 'Mecanica') AND estatus=1 AND tipo='$nombre_tipo'";
	$query=pg_query($sql);
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	if ($num>0)
	{
		if ($array['id_tipo']!=$id)
		{
			echo $dato=1;	
		}
		else
		{
			echo $dato=0;	
		}
	}
	else
	{
		echo $dato=0;
	}
?>