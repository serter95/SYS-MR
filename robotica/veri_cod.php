<?php
	require('seguridad.php');
	require('conexion.php');



	$codigo=trim(strtoupper($_POST['cod']));
	
	if(!empty($codigo)) {
		comprobar($codigo);
	}
	
	function comprobar($codigo)
	{
		$id=trim($_POST['id']);

		if (empty($id))
		{
			$sql="SELECT * FROM proyectos WHERE codigo='$codigo' AND ambito='tecnologico' AND taller=2 AND estatus=1";
			$query=pg_query($sql);
			$num=pg_num_rows($query);

			echo $num;
		}
		else
		{
			$sql="SELECT * FROM proyectos WHERE codigo='$codigo' AND ambito='tecnologico' AND taller=2 AND estatus=1";
			$query=pg_query($sql);
			$array=pg_fetch_assoc($query);
			$num=pg_num_rows($query);

			if ($num>0)
			{
				if ($array['id_proyecto']==$id)
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