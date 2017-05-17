<?php
	require 'conexion.php';
	require 'seguridad.php';

	$IdPeriodo=$_POST['id_periodo'];
	$IdPersonal=$_POST['id_personal'];
	$periodo=$_POST['periodo'];
	$ci=trim($_POST['ci']);

	$ced=explode('-', $ci);

	$lon=strlen($ced[1]);

	if ($lon==7)
	{
		$cedi="0".$ced[1];
	}
	else
	{
		$cedi=$ced[1];
	}

	$ci=$ced[0]."-".$cedi;

	$query=pg_query("SELECT * FROM periodo WHERE tipo='$periodo'");
	$array=pg_fetch_assoc($query);
	$id_periodo=$array['id_periodo'];

	if ($id_periodo==0)
	{
		#periodo no existe
		echo 3;
	}

	$query2=pg_query("SELECT * FROM personal WHERE ci='$ci' AND estatus=1 AND area='Mecanica'");
	$array2=pg_fetch_assoc($query2);
	$id_personal=$array2['id'];

	$num=pg_num_rows($query2);

	if ($num>0)
	{
		$query3=pg_query("SELECT * FROM disponibilidad_persona WHERE id_periodo='$id_periodo'
			AND id_personal='$id_personal' AND taller=1 AND estatus=1");
		$num2=pg_num_rows($query3);

		if ($num2>0)
		{
			if ($id_periodo==$IdPeriodo && $id_personal==$IdPersonal)
			{
				#valido
				echo 0;
			}
			else
			{
				#ya existe esta disponibilidad
				echo 2;
			}
		}
		else
		{
			#valido
			echo 0;
		}

	}
	else
	{
		#La persona no existe
		echo 1;
	}

?>