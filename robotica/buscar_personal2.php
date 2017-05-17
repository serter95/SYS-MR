<?php
require ('seguridad.php');
require ('conexion.php');

	$cedi=$_REQUEST['ci'];
	$nac=$_REQUEST['nac'];

	$longitud=strlen($cedi);

	if ($longitud==7)
	{
		$ci="0"."".$cedi;
	}
	else
	{
		$ci=$cedi;
	}

	$ci_usu=$nac."".$ci;

	$sql="SELECT * FROM personal WHERE area='Robotica' AND estatus=1 AND ci='".$ci_usu."'";
	$query=pg_query($sql);
	$array=pg_fetch_assoc($query);

	$datos = array(
			0 => $array['nombres'],
			1 => $array['apellidos'],
			2 => $array['id'],
		);
			
	echo json_encode($datos);
?>