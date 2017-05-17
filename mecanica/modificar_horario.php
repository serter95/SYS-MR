<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id_seccion=$_POST['id_seccion'];
	$id_periodo=$_POST['id_periodo'];

	$query3=pg_query("SELECT * FROM secciones WHERE id_seccion='$id_seccion'");
	$array3=pg_fetch_assoc($query3);
	$seccion= "Año: ".$array3['anio']." Trayecto: ".$array3['trayecto']." Sección: ".$array3['seccion']." Sede: ".$array3['sede']." PNF: ".$array3['pnf'];

	$query4=pg_query("SELECT * FROM periodo WHERE id_periodo='$id_periodo'");
	$array4=pg_fetch_assoc($query4);
	$periodo=$array4['tipo'];

	$valores=pg_query("SELECT * FROM horario_clase hc, horas h WHERE hc.id_horas=h.id_horas AND
		hc.id_periodo='$id_periodo' AND hc.id_seccion='$id_seccion' AND hc.estatus=1 AND h.estatus=1 ORDER BY
		h.numero_bloque ASC");
	$num=pg_num_rows($valores);

	while($valores2=pg_fetch_assoc($valores))
	{
		$id_horario_clase[]=$valores2['id_horario_clase'];
		$dia[]=$valores2['dia'];
		$aula[]=$valores2['aula'];
		$id_personal[]=$valores2['id_personal'];
		$id_materia[]=$valores2['id_materia'];
		$id_personal2[]=$valores2['id_personal2'];
		$id_personal3[]=$valores2['id_personal3'];
	}

	for ($i=0; $i < $num; $i++)
	{ 
		$query=pg_query("SELECT * FROM personal WHERE id='$id_personal[$i]'");
		$array=pg_fetch_assoc($query);

		$nom=explode(' ', $array['nombres']);
		$ape=explode(' ', $array['apellidos']);

		$nomApe[$i]=$nom[0]." ".$ape[0]." ".$array['ci'];

		if ($id_personal2[$i]!=0)
		{
			$queryp2=pg_query("SELECT * FROM personal WHERE id='$id_personal2[$i]'");
			$arrayp2=pg_fetch_assoc($queryp2);
			$nump2=pg_num_rows($queryp2);

			$nomp2=explode(' ', $arrayp2['nombres']);
			$apep2=explode(' ', $arrayp2['apellidos']);

			$nomApe2[$i]=$nomp2[0]." ".$apep2[0]." ".$arrayp2['ci'];
		}
		else
		{
			$nomApe2[$i]=0;
		}

		if ($id_personal3[$i]!=0)
		{

			$queryp3=pg_query("SELECT * FROM personal WHERE id='$id_personal3[$i]'");
			$arrayp3=pg_fetch_assoc($queryp3);
			$nump3=pg_num_rows($queryp3);

			$nomp3=explode(' ', $arrayp3['nombres']);
			$apep3=explode(' ', $arrayp3['apellidos']);

			$nomApe3[$i]=$nomp3[0]." ".$apep3[0]." ".$arrayp3['ci'];
		}
		else
		{
			$nomApe3[$i]=0;
		}

		$query2=pg_query("SELECT * FROM materia WHERE id_materia='$id_materia[$i]'");
		$array2=pg_fetch_assoc($query2);

		$codigoMateria[$i]=$array2['codigo'];
	}

	$datos = array(
		0 => $num,
		1 => $seccion,
		2 => $periodo,
		3 => $dia,
		4 => $aula,
		5 => $nomApe,
		6 => $codigoMateria,
		7 => $id_horario_clase,
		8 => $nomApe2,
		9 => $nomApe3,
    		 );
	echo json_encode($datos);
?>