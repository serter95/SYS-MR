<?php
require ('seguridad.php');
require ('conexion.php');

	$fecha=$_REQUEST['fecha'];
	$id=$_REQUEST['id'];

	$sql="SELECT * FROM mant_preventivo WHERE fecha='$fecha' AND estatus=1";
	$query=pg_query($sql);
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	if ($num>0)
	{
		if($id!=$array['id'])
		{
			echo $datos=1;
		}
		else
		{
			echo $datos = 0;
		}
	}
	else
	{
		echo $datos = 0;
	}			
?>