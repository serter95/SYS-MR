<?php
	require("conexion.php");
	require("seguridad.php");

	$ce=explode('-', $_POST['ci']);

	$longitud=strlen($ce[1]);

	if ($longitud==7)
	{
		$ced="0".$ce[1];
	}
	else
	{
		$ced=$ce[1];
	}

	$ci=$ce[0]."-".$ced;

	$aula=strtoupper($_POST['aula']);
	$periodo=$_POST['periodo'];
	$materia=$_POST['materia'];
	$sec=explode(' ', $_POST['seccion']);

	$anio=$sec[1];
	$trayecto=$sec[3];
	$seccion=$sec[5];

	$lon=strlen($sec[7]);

	if ($lon==2)
	{
		$sede=$sec[7]." ".$sec[8];
		$pnf=$sec[10];
	}
	else
	{
		$sede=$sec[7];
		$pnf=$sec[9];
	}

	$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
	seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=2 AND estatus=1");
	$ar=pg_fetch_assoc($qu);
	$id_seccion=$ar['id_seccion'];

	$div=explode('_', $_POST['div']);
	$dia=$div[0];
	$numero=$div[1]-1;

	$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1 ");
	$array=pg_fetch_assoc($query);
	$id=$array['id'];

	$query2=pg_query("SELECT id_periodo FROM periodo WHERE tipo='$periodo'");
	$array2=pg_fetch_assoc($query2);
	$id_periodo=$array2['id_periodo'];

	$queryx=pg_query("SELECT id_materia FROM materia WHERE codigo='$materia' AND taller=2 AND estatus=1");
	$arrayx=pg_fetch_assoc($queryx);
	$id_materia=$arrayx['id_materia'];

	$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
		d.id_personal='$id' AND d.id_periodo='$id_periodo' AND d.estatus=1 AND h.estatus=1 
		ORDER BY h.numero_bloque ASC");

	while ($dato=pg_fetch_assoc($con))
	{
		$lunes[]=$dato['lunes'];
		$martes[]=$dato['martes'];
		$miercoles[]=$dato['miercoles'];
		$jueves[]=$dato['jueves'];
		$viernes[]=$dato['viernes'];
	}

	if ($dia=='lunes')
	{
		if ($lunes[$numero]==1)
		{
			$diaSelecciondo="disponible";	
		}
	}
	if ($dia=='martes')
	{
		if ($martes[$numero]==1)
		{
			$diaSelecciondo="disponible";	
		}
	}
	if ($dia=='miercoles')
	{
		if ($miercoles[$numero]==1)
		{
			$diaSelecciondo="disponible";	
		}
	}
	if ($dia=='jueves')
	{
		if ($jueves[$numero]==1)
		{
			$diaSelecciondo="disponible";	
		}
	}
	if ($dia=='viernes')
	{
		if ($viernes[$numero]==1)
		{
			$diaSelecciondo="disponible";	
		}
	}


	if ($diaSelecciondo=="disponible")
	{
		$con2=pg_query("SELECT * FROM horario_clase WHERE dia='".$_POST['div']."' AND id_periodo='$id_periodo'
		 AND id_personal='$id' AND taller=2 AND estatus=1");
		$num=pg_num_rows($con2);

		if ($num==0)
		{
			$con3=pg_query("SELECT * FROM horario_clase WHERE dia='".$_POST['div']."' 
			AND id_periodo='$id_periodo' AND aula='$aula' AND taller=2 AND estatus=1");
			$num2=pg_num_rows($con3);

			if ($num2==0)
			{
				$con4="SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND id_seccion='$id_seccion' AND id_personal='$id' AND estatus=1";
				$q4=pg_query($con4);
				$num3=pg_num_rows($q4);

				if ($num3==0)
				{
					echo 1;
				}
				else
				{
					while ($array4=pg_fetch_assoc($q4))
					{
						if ($id_materia!=$array4['id_materia'])
						{
							$permitir='no';
						}
					}

					if ($permitir=='no')
					{
						echo 3;
					}
					else
					{
						echo 1;
					}
				}
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 2;
		}
	}
	else
	{
		echo 2;
	}



//*********************************************************************************************************	

?>