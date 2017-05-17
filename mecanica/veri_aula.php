<?php
	require 'seguridad.php';
	require 'conexion.php';

	$nombre=trim(strtoupper($_POST['nombre']));
	$id=trim($_POST['id']);


	$query=pg_query("SELECT * FROM aulas WHERE nombre='$nombre' AND taller=1 AND estatus=1");
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	if ($id==0)
	{
		echo $num;
	}
	else
	{
		if ($num>0)
		{
			if ($id==$array['id_aulas'])
			{
				echo 0;
			}
			else
			{
				echo 1;
			}
		}
		else
		{
			echo $num;
		}
	}
?>