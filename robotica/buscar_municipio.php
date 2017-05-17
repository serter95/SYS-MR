<?php
	require 'seguridad.php';
	require 'conexion.php';

	$estado=trim($_POST['estado']);

	$query=pg_query("SELECT * FROM estados e, municipios m WHERE e.id_estado=m.id_estado AND e.nombre='$estado'
		ORDER BY m.nombre_municipio ASC");
	$num=pg_num_rows($query);
	
	while ($array=pg_fetch_assoc($query))
	{
		$municipio[]="<option value='".$array['nombre_municipio']."'>".$array['nombre_municipio']."</option>";
	}

	$dato = array(
			0 => $municipio,
			1 => $num,
		);

	#echo $num

	echo json_encode($dato);
?>