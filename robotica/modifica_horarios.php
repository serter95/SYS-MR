<?php
	require("conexion.php");
	require("seguridad.php");

	$idSeccion=$_REQUEST['idSeccion'];
	$idPeriodo=$_REQUEST['idPeriodo'];
	$id_horas=explode(',', $_REQUEST['id_h']);
	$lunes=explode(',' , $_REQUEST['lunes']);
	$martes=explode(',', $_REQUEST['martes']);
	$miercoles=explode(',', $_REQUEST['miercoles']);
	$jueves=explode(',', $_REQUEST['jueves']);
	$viernes=explode(',', $_REQUEST['viernes']);
	$ciclo=$_REQUEST['ciclo'];

	for ($i=1; $i <=$ciclo ; $i++)
	{ 
		$j=$i-1;

		$lun=explode(' ', $lunes[$j]);
		$mar=explode(' ', $martes[$j]);
		$mie=explode(' ', $miercoles[$j]);
		$jue=explode(' ', $jueves[$j]);
		$vie=explode(' ', $viernes[$j]);

		$diaLun[$j]=$lun[0];
		$valueLun[$j]=$lun[1];
		$codMatLun[$j]=$lun[2];
		$aulaLun[$j]=strtoupper(implode(' ',explode('-', $lun[3])));
		$ciProfLun[$j]=$lun[4];

		$diaMar[$j]=$mar[0];
		$valueMar[$j]=$mar[1];
		$codMatMar[$j]=$mar[2];
		$aulaMar[$j]=strtoupper(implode(' ',explode('-', $mar[3])));
		$ciProfMar[$j]=$mar[4];

		$diaMie[$j]=$mie[0];
		$valueMie[$j]=$mie[1];
		$codMatMie[$j]=$mie[2];
		$aulaMie[$j]=strtoupper(implode(' ',explode('-', $mie[3])));
		$ciProfMie[$j]=$mie[4];

		$diaJue[$j]=$jue[0];
		$valueJue[$j]=$jue[1];
		$codMatJue[$j]=$jue[2];
		$aulaJue[$j]=strtoupper(implode(' ',explode('-', $jue[3])));
		$ciProfJue[$j]=$jue[4];

		$diaVie[$j]=$vie[0];
		$valueVie[$j]=$vie[1];
		$codMatVie[$j]=$vie[2];
		$aulaVie[$j]=strtoupper(implode(' ',explode('-', $vie[3])));
		$ciProfVie[$j]=$vie[4];
	}

	pg_query("DELETE FROM horario_clase WHERE id_seccion='$idSeccion' AND id_periodo='$idPeriodo'");

#****************************************************************************************

	for ($i=1; $i <=$ciclo ; $i++)
	{ 
		$j=$i-1;
		
		if ($valueLun[$j]==1)
		{
			$ce=explode('-', $ciProfLun[$j]);

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$idPeriodo' AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");
			
				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueLunes[$i][]=$dato['lunes'];
				}
			
			$d=explode('_', $diaLun[$j]);

			$numero=$d[1]-1;

			if ($BloqueLunes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
					dia='$diaLun[$j]' AND id_personal='$id_personal' AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
						dia='$diaLun[$j]' AND aula='$aulaLun[$j]' AND estatus=1 AND taller=2");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatLun[$j]' AND estatus=1 AND taller=2");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula,taller)VALUES('$idSeccion','$id_materia','$id_personal','$id_horas[$j]','$idPeriodo','$diaLun[$j]','$aulaLun[$j]','2')";	
						
						pg_query($sql);

						$registrar="exito";
					}
					else
					{
						$error='aula';
					}
				}
				else
				{
					$error='prof';
				}
			}
			else
			{
				$error='prof';
			}
		}

		if ($valueMar[$j]==1)
		{
			$ce=explode('-', $ciProfMar[$j]);

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$idPeriodo' AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueMartes[$i][]=$dato['martes'];
				}

			$d=explode('_', $diaMar[$j]);

			$numero=$d[1]-1;

			if ($BloqueMartes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
					dia='$diaMar[$j]' AND id_personal='$id_personal' AND estatus=1 AND taller=2");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
						dia='$diaMar[$j]' AND aula='$aulaMar[$j]' AND estatus=1 AND taller=2");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatMar[$j]' AND estatus=1 AND taller=2");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula,taller)VALUES('$idSeccion','$id_materia','$id_personal','$id_horas[$j]','$idPeriodo','$diaMar[$j]','$aulaMar[$j]','2')";	
						
						pg_query($sql);

						$registrar="exito";
					}
					else
					{
						$error='aula';
					}
				}
				else
				{
					$error='prof';
				}
			}
			else
			{
				$error='prof';
			}
		}

		if ($valueMie[$j]==1)
		{
			$ce=explode('-', $ciProfMie[$j]);

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$idPeriodo' AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueMiercoles[$i][]=$dato['miercoles'];
				}

			$d=explode('_', $diaMie[$j]);

			$numero=$d[1]-1;

			if ($BloqueMiercoles[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
					dia='$diaMie[$j]' AND id_personal='$id_personal' AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
						dia='$diaMie[$j]' AND aula='$aulaMie[$j]' AND estatus=1 AND taller=2");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatMie[$j]' AND estatus=1 AND taller=2");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula,taller)VALUES('$idSeccion','$id_materia','$id_personal','$id_horas[$j]','$idPeriodo','$diaMie[$j]','$aulaMie[$j]','2')";	
						
						pg_query($sql);

						$registrar="exito";
					}
					else
					{
						$error='aula';
					}
				}
				else
				{
					$error='prof';
				}
			}
			else
			{
				$error='prof';
			}
		}

		if ($valueJue[$j]==1)
		{
			$ce=explode('-', $ciProfJue[$j]);

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$idPeriodo' AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueJueves[$i][]=$dato['jueves'];
				}

			$d=explode('_', $diaJue[$j]);

			$numero=$d[1]-1;

			if ($BloqueJueves[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
					dia='$diaJue[$j]' AND id_personal='$id_personal' AND estatus=1 AND taller=2");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
						dia='$diaJue[$j]' AND aula='$aulaJue[$j]' AND estatus=1 AND taller=2");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatJue[$j]' AND estatus=1 AND taller=2");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula,taller)VALUES('$idSeccion','$id_materia','$id_personal','$id_horas[$j]','$idPeriodo','$diaJue[$j]','$aulaJue[$j]','2')";	
						
						pg_query($sql);

						$registrar="exito";
					}
					else
					{
						$error='aula';
					}
				}
				else
				{
					$error='prof';
				}
			}
			else
			{
				$error='prof';
			}
		}

		if ($valueVie[$j]==1)
		{
			$ce=explode('-', $ciProfVie[$j]);

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Robotica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$idPeriodo' AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueViernes[$i][]=$dato['viernes'];
				}

			$d=explode('_', $diaVie[$j]);

			$numero=$d[1]-1;

			if ($BloqueViernes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
					dia='$diaVie[$j]' AND id_personal='$id_personal' AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$idPeriodo' AND
						dia='$diaVie[$j]' AND aula='$aulaVie[$j]' AND estatus=1 AND taller=2");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatVie[$j]' AND estatus=1 AND taller=2");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula,taller)VALUES('$idSeccion','$id_materia','$id_personal','$id_horas[$j]','$idPeriodo','$diaVie[$j]','$aulaVie[$j]','2')";	
						
						pg_query($sql);

						$registrar="exito";
					}
					else
					{
						$error='aula';
					}
				}
				else
				{
					$error='prof';
				}
			}
			else
			{
				$error='prof';
			}
		}
	}

#****************************************************************************************************

	if ($error=='aula')
	{
		#echo "ERROR DE AULA";
		header('Location:horarios_clase.php?error=aula_M');
	}
	if ($error=='prof')
	{
		#echo "ERROR DE PROF";
		header('Location:horarios_clase.php?error=prof_M');
	}
	if ($registrar=="exito")
	{
		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Modificación','Horarios','".$_SESSION['nom_usuario']."')");
		#echo "<br><br>REGISTRO!!!";
		header('Location:horarios_clase.php?registro=exito_M');
	}

?>