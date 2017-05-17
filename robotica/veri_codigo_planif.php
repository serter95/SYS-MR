<?php
	require 'conexion.php';
	require 'seguridad.php';

	$codigo=strtoupper($_POST['codigo']);
	$id=$_POST['id'];

	if ($id==0)
	{
		$query=pg_query("SELECT * FROM materia WHERE codigo='$codigo' AND taller=2 AND estatus=1");
		$num=pg_num_rows($query);

		if ($num>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	else
	{
		$query=pg_query("SELECT * FROM materia WHERE codigo='$codigo' AND taller=2 AND estatus=1");
		$num=pg_num_rows($query);
		$array=pg_fetch_assoc($query);

		if ($num>0)
		{
			if ($id==$array['id_materia'])
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
			echo 0;
		}
	}
	
?>