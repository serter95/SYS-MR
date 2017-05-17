<?php
	require('seguridad.php');
	require ('conexion.php');

	$ci_prof=$_POST['ci_profesor'];

	$query2=pg_query("SELECT * FROM personal WHERE ci='$ci_prof' AND area='Robotica'");
	$array2=pg_fetch_assoc($query2);
	
$datos = array( 0 => $array2['dedicacion'], );

echo json_encode($datos);	

?>