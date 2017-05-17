<?php
	require('seguridad.php');
	require('conexion.php');

	$Email=$_POST['correo'];
	
	#echo $Email;
	if(!empty($Email))
	{
		comprobar($Email);
	}
	
	function comprobar($correo)
	{
		
		$sql="SELECT * FROM personal WHERE correo='$correo' AND estatus=1 AND area='Robotica'";
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