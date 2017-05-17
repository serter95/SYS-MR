<?php
require ('seguridad.php');
require ('conexion.php');

	$codigo=$_REQUEST['codigo'];
	$code=ucwords($codigo);
	$tipo=$_REQUEST['tipo'];

	if($tipo=='insumo'){


	
	$sql="SELECT * FROM insumos i, numero_bien n WHERE i.codigo_insumo='".$code."' AND i.estatus='1' AND i.n_b=n.id_nb AND taller=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos = array(
			0 => $array['id_insumos'],
			1 => $array['codigo_insumo'],
			2 => $array['nb'],
			3 => $array['nombre'],
			4 => $array['existencia'],
			5 => $array['buenas'],
			6 => $array['danadas'],
			7 => $array['min_stock'],
			8 => $array['max_stock'],
		);
			
	echo json_encode($datos);

	}

	else if($tipo=='herramienta'){
		$sql="SELECT * FROM herramientas h, numero_bien n WHERE h.codigo_herramienta='".$code."' AND h.estatus='1' AND h.n_b=n.id_nb AND taller=1";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos2 = array(
			0 => $array['id_herramienta'],
			1 => $array['codigo_herramienta'],
			2 => $array['nombre'],
			3 => $array['nb'],
			//3 => $array['nombre'],
			//4 => $array['existencia'],
			//5 => $array['buenas'],
			//6 => $array['danadas'],
		);
			
	echo json_encode($datos2);
	}


?>