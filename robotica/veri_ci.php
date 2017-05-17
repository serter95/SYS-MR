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
		
		$sql="SELECT * FROM personal WHERE ci='$cedu' AND estatus=1 AND area='Robotica'";
		$query=pg_query($sql);
		$num=pg_num_rows($query);

		if($num>0)
		{	
			echo 1;
		}
		else
		{	
			echo 0;
		}
	}	
?>