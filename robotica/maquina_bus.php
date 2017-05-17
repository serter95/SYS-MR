<?php

require ('seguridad.php');
require('conexion.php');

$datos=array();

$ci=$_REQUEST['term'];
$code=explode("-", $ci);
$ci=ucwords($code[0]."-");

$sql="SELECT * FROM maquinas WHERE codigo LIKE '%$ci%' AND estatus=1";
$query=pg_query($sql);

while ($array=pg_fetch_assoc($query))
{	
	
	$datos[]=array("value" => $array['codigo']);
}

echo json_encode($datos);

?>