<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id'];
	$ci=trim($_POST['nac_usuC']).trim($_POST['ci_usuC']);
	$nombres=trim($_POST['nombres_usuC']);
	$apellidos=trim($_POST['apellidos_usuC']);
	$correo=trim($_POST['correoC']);
	$tlf=trim($_POST['cod_tlfC']).trim($_POST['num_contC']);
	$fecha=trim($_POST['fecha_nacC']);

	$fe=explode('/', $fecha);
	$fecha_nac=$fe[2].'-'.$fe[1].'-'.$fe[0];

	$query=pg_query("SELECT * FROM personal WHERE estatus=1 AND area='Mecanica'");

	while($array=pg_fetch_assoc($query))
	{
		if ($array['ci']==$ci AND $array['id']!=$id)
		{
			$igual="si";
		}
	}

	if ($igual!='si')
	{
		pg_query("UPDATE personal SET ci='$ci', nombres='$nombres', apellidos='$apellidos', correo='$correo'
		,numero_contacto='$tlf', fecha_nacimiento='$fecha_nac' WHERE id='$id'");

		header('Location:configuracion.php?datos=si');
	}
	else
	{
		header('Location:configuracion.php?datos=no');
	}
	
?>
	
			