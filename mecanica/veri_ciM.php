<?php
	require('seguridad.php');
	require('conexion.php');

	$ci = $_POST['ci'];
	$id = $_POST['id'];
	
	
	if(!empty($ci) || !empty($id))
	{
		comprobar($ci,$id);
	}
	
	function comprobar($cedula,$id)
	{
		$ex=explode('-', $cedula);

		$ced=strlen($ex[1]);

		if ($ced==7)
		{
			$cedu=$ex[0]."-0".$ex[1];
		}
		else
		{
			$cedu=$ex[0]."-".$ex[1];
		}
		
		$sql="SELECT * FROM personal WHERE ci='$cedu' AND estatus=1 AND area='Mecanica'";
		$query=pg_query($sql);
		$num=pg_num_rows($query);
		$array=pg_fetch_assoc($query);

		if($num>0)
		{	
			if($array['id']!=$id)
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
	}	
?>