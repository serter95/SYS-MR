<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM personal WHERE id=".$id." LIMIT 1";
	$valores=pg_query($sql);
	$valores2=pg_fetch_assoc($valores);

	$nc=explode('-', $valores2['ci']);

	$nac=$nc[0]."-";
	$ci=$nc[1];

	$tlf=explode('-', $valores2['numero_contacto']);

	$cod_tlf=$tlf[0]."-";
	$num_tlf=$tlf[1];

	$fecha=explode('-', $valores2['fecha_nacimiento']);

	$fecha_nac=$fecha[2]."/".$fecha[1]."/".$fecha[0];

#	$fecha=explode('-', $valores2['fecha_nacimiento']);
#	$fecha_nac=$fecha[2]."/".$fecha[1]."/".$fecha_nac[0];

	$datos = array(
		0 => $nac,
		1 => $ci,
		2 => $valores2['nombres'],
		3 => $valores2['apellidos'],
		4 => $valores2['sexo'],
		5 => $valores2['grado_instruccion'],
		6 => $valores2['especialidad'],
		7 => $valores2['cargo'],
		8 => $valores2['correo'],
		9 => $cod_tlf,
		10 => $num_tlf,
		11 => $fecha_nac,
		12 => $valores2['dedicacion'],
    		 );
	echo json_encode($datos);
?>