<?php
	require('seguridad.php');
	require('conexion.php');

	$actividad = ucfirst(trim(strtolower($_POST['actividad'])));
	$ci = $_POST['ci'];
	
	if(!empty($actividad) AND !empty($ci))
	{
		comprobar($actividad,$ci);
	}
	
	function comprobar($actividad,$ci)
	{
		$id = $_POST['id'];

		$ex=explode('-', $ci);

		$ced=strlen($ex[1]);

		if ($ced==7)
		{
			$cedu=$ex[0]."-0".$ex[1];
		}
		else
		{
			$cedu=$ex[0]."-".$ex[1];
		}
		
		$sql="SELECT * FROM personal WHERE ci='$cedu' AND estatus=1 AND area='Robotica'";
		$query=pg_query($sql);
		$array=pg_fetch_assoc($query);

		if (empty($id))
		{
			$query2=pg_query("SELECT * FROM planificacion_semanal WHERE actividad='$actividad' AND estado In ('En proceso', '0') AND estatus=1 AND id_personal='".$array['id']."'");
			echo $num=pg_num_rows($query2);	
		}
		else
		{
			$query2=pg_query("SELECT * FROM planificacion_semanal WHERE actividad='$actividad' AND estado In ('En proceso', '0') AND estatus=1 AND id_personal='".$array['id']."'");
			$num=pg_num_rows($query2);
			$array=pg_fetch_assoc($query2);
			
				if ($num>0)
				{
					if ($array['id_planif']==$id)
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
	}	
?>