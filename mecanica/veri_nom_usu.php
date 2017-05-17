<?php
	require('seguridad.php');
	require('conexion.php');

	$nom = $_POST['nom'];
	
	if(!empty($nom))
	{
		comprobar($nom);
	}
	
	function comprobar($nombre)
	{
			
			$sql2="SELECT * FROM usuario u, personal p WHERE u.id_personal=p.id AND u.nom_usuario='$nombre'
			AND p.area='Mecanica' AND u.estatus=1 AND p.estatus=1";
			$query2=pg_query($sql2);
			$num2=pg_num_rows($query2);

			echo $num2;
	}	
?>