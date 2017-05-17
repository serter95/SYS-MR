<?php
	require 'conexion.php';
	require 'seguridad.php';

	$id=$_POST['id'];
	$bloque=$_POST['bloque'];

	$query=pg_query("SELECT * FROM horas WHERE numero_bloque='$bloque' AND taller=2 AND estatus=1");
	$num=pg_num_rows($query);

	if ($id==0)
	{
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
		if ($num>0)
		{
			$array=pg_fetch_assoc($query);
			
			if ($id==$array['id_horas'])
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