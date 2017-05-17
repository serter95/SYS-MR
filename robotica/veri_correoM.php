<?php
	require('seguridad.php');
	require('conexion.php');

	$Email=$_POST['correo'];
	$id=$_POST['id'];
	
	if(!empty($Email) || !empty($id))
	{
		comprobar($Email,$id);
	}
	
	function comprobar($correo,$id)
	{
		
		$sql="SELECT * FROM personal WHERE correo='$correo' AND estatus=1 AND area='Robotica'";
		$query=pg_query($sql);
		
		$num=pg_num_rows($query);		
		
		while($array=pg_fetch_assoc($query))
		{
			if($array['correo']!=$correo)
			{
				echo $dato=0;
			}
			else
			{	
				if ($id==$array['id'])
				{
					echo $dato=0;
				}
				else
				{
					echo $dato=1;
				}
			}
		}
	}	
?>