<?php
	require ('seguridad.php');
	require ('conexion.php');

	$id=$_POST['id'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM estudiantes WHERE codpro='$id' AND estatus=1";

	$valores=pg_query($sql);
	$num=pg_num_rows($valores);

	while($array=pg_fetch_assoc($valores))
	{
		$id_estudiante[]=$array['id_estudiantes'];
		$ci[]=$array['ci'];
		$nom[]=$array['nombres'];
		$ape[]=$array['apellidos'];
		$tlf[]=$array['telefono'];
		$correo[]=$array['correo'];
		$especialidad[]=$array['especialidad'];
	}

	$c1=explode('-', $ci[0]);
	$nac1=$c1[0]."-";
	$ced1=$c1[1];

	$c2=explode('-', $ci[1]);
	$nac2=$c2[0]."-";
	$ced2=$c2[1];

	$c3=explode('-', $ci[2]);
	$nac3=$c3[0]."-";
	$ced3=$c3[1];

	$t1=explode('-', $tlf[0]);
	$cod1=$t1[0]."-";
	$telefono1=$t1[1];

	$t2=explode('-', $tlf[1]);
	$cod2=$t2[0]."-";
	$telefono2=$t2[1];

	$t3=explode('-', $tlf[2]);
	$cod3=$t3[0]."-";
	$telefono3=$t3[1];

	$query2=pg_query("SELECT * FROM proyectos WHERE id_proyecto='$id'");
	$array2=pg_fetch_assoc($query2);

	$query3=pg_query("SELECT * FROM estados e, municipios m WHERE e.id_estado=m.id_estado AND e.nombre='".$array2['estado']."'
		ORDER BY m.nombre_municipio ASC");

	while ($array3=pg_fetch_assoc($query3))
	{
		$municipio[]="<option value='".$array3['nombre_municipio']."'>".$array3['nombre_municipio']."</option>";
	}

	$datos= array(
			0 => $array2['titulo'],
			1 => $array2['codigo'],
			2 => $array2['regimen'],
			3 => $array2['estado'],
			4 => $array2['municipio'],
			5 => $array2['parroquia'],
			6 => $array2['sector'],
			7 => $array2['pnf'],
			8 => $array2['trayecto'],
			9 => $array2['seccion'],
			10 => $array2['periodo'],
			11 => $nac1,
			12 => $ced1,
			13 => $nom[0],
			14 => $ape[0],
			15 => $cod1,
			16 => $telefono1,
			17 => $correo[0],
			18 => $especialidad[0],
			19 => $nac2,
			20 => $ced2,
			21 => $nom[1],
			22 => $ape[1],
			23 => $cod2,
			24 => $telefono2,
			25 => $correo[1],
			26 => $especialidad[1],
			27 => $nac3,
			28 => $ced3,
			29 => $nom[2],
			30 => $ape[2],
			31 => $cod3,
			32 => $telefono3,
			33 => $correo[2],
			34 => $especialidad[2],
			35 => $array2['descripcion'],
			36 => $array2['aportes'],
			37 => $array2['integracion'],
			38 => $array2['plan_nacional'],
			39 => $id_estudiante[0],
			40 => $id_estudiante[1],
			41 => $id_estudiante[2],
			42 => $municipio,
		);
	echo json_encode($datos);
?>