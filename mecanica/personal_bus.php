<?php

require ('seguridad.php');
require('conexion.php');

$datos=array();

$ci=trim($_REQUEST['term']);
$disp=$_REQUEST['disponibilidad'];

if ($disp=='profesor')
{
	$sql="SELECT * FROM personal WHERE area='Mecanica' AND estatus=1 AND cargo='Profesor' AND ci LIKE '%$ci%'";
	$query=pg_query($sql);

	while ($array=pg_fetch_assoc($query))
	{	
		$ci=explode("-", $array['ci']);

		$datos[]=array("value" => $ci[1]);
	}

	echo json_encode($datos);
}
else
{
	$sql="SELECT * FROM personal WHERE area='Mecanica' AND estatus=1 AND ci LIKE '%$ci%'";
	$query=pg_query($sql);

	while ($array=pg_fetch_assoc($query))
	{	
		$ci=explode("-", $array['ci']);

		$datos[]=array("value" => $ci[1]);
	}

	echo json_encode($datos);
}
?>