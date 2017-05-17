<?php
	require('seguridad.php');
	require('conexion.php');

	$id = $_POST['id'];
	$nom = $_POST['nom'];
	
	if(!empty($nom))
	{
		comprobar($nom,$id);
	}
	
	function comprobar($nombre,$id)
	{
			
			$sql2="SELECT * FROM usuario u, personal p WHERE u.id_personal=p.id AND u.nom_usuario='$nombre'
			AND p.area='Robotica' AND u.estatus=1 AND p.estatus=1";
			$query2=pg_query($sql2);
			$num2=pg_num_rows($query2);
			$array=pg_fetch_assoc($query2);

			if($num2>0)
			{
				if ($array['id_usu']==$id)
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
				echo 2;
			}
	}	
?>