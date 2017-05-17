<?php
	require('seguridad.php');
	require('conexion.php');

	$ci = $_POST['ci'];
	
	if(!empty($ci)) {
		comprobar($ci);
	}
	
	function comprobar($cedula)
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
			$sql2="SELECT * FROM usuario WHERE id_personal='".$array['id']."' AND estatus=1 ";
			$query2=pg_query($sql2);
			$num2=pg_num_rows($query2);

			if($num2>0)
			{
				echo $dato=1;
			}
			else
			{
				echo $dato=2;
			}
		}
		else
		{	
			echo $dato=0;
		}
	}	
?>