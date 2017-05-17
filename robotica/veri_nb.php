<?php
	require('seguridad.php');
	require('conexion.php');

	$nb = $_POST['n_b'];
	
	if(!empty($nb)) {
		comprobar($nb);
	}
	
	function comprobar($n_b)
	{
		$sql="SELECT * FROM maquinas WHERE n_b='$n_b' AND estatus=1";
		$query=pg_query($sql);
				
		while ($array=pg_fetch_assoc($query))
		{
			if($array['n_b']!=$n_b)
			{
				echo $dato=0;
			}
			else
			{	
				echo $dato=1;
			}
		}
	}	
?>