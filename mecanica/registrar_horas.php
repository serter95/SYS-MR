<?php
	require("conexion.php");
	require("seguridad.php");

	$periodo=$_REQUEST['periodo'];
	$sec=explode(' ', $_REQUEST['seccion']);
	$id_horas=explode(',', $_REQUEST['id_h']);
	$lunes=explode(',' , $_REQUEST['lunes']);
	$martes=explode(',', $_REQUEST['martes']);
	$miercoles=explode(',', $_REQUEST['miercoles']);
	$jueves=explode(',', $_REQUEST['jueves']);
	$viernes=explode(',', $_REQUEST['viernes']);
	$ciclo=$_REQUEST['ciclo'];
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
		$ciProfLun2[$j]=$lun[5];
		$ciProfLun3[$j]=$lun[6];

		$diaMar[$j]=$mar[0];
		$valueMar[$j]=$mar[1];
		$codMatMar[$j]=$mar[2];
		$aulaMar[$j]=strtoupper(implode(' ',explode('-', $mar[3])));
		$ciProfMar[$j]=$mar[4];
		$ciProfMar2[$j]=$mar[5];
		$ciProfMar3[$j]=$mar[6];

		$diaMie[$j]=$mie[0];
		$valueMie[$j]=$mie[1];
		$codMatMie[$j]=$mie[2];
		$aulaMie[$j]=strtoupper(implode(' ',explode('-', $mie[3])));
		$ciProfMie[$j]=$mie[4];
		$ciProfMie2[$j]=$mie[5];
		$ciProfMie3[$j]=$mie[6];

		$diaJue[$j]=$jue[0];
		$valueJue[$j]=$jue[1];
		$codMatJue[$j]=$jue[2];
		$aulaJue[$j]=strtoupper(implode(' ',explode('-', $jue[3])));
		$ciProfJue[$j]=$jue[4];
		$ciProfJue2[$j]=$jue[5];
		$ciProfJue3[$j]=$jue[6];

		$diaVie[$j]=$vie[0];
		$valueVie[$j]=$vie[1];
		$codMatVie[$j]=$vie[2];
		$aulaVie[$j]=strtoupper(implode(' ',explode('-', $vie[3])));
		$ciProfVie[$j]=$vie[4];
		$ciProfVie2[$j]=$vie[5];
		$ciProfVie3[$j]=$vie[6];
	}
	
	$query2=pg_query("SELECT id_periodo FROM periodo WHERE tipo='$periodo'");
	$array2=pg_fetch_assoc($query2);
	$id_periodo=$array2['id_periodo'];

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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Mecanica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$queryp2=pg_query("SELECT id FROM personal WHERE ci='$ciProfLun2[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp2=pg_fetch_assoc($queryp2);
			$id_personal2=$arrayp2['id'];
			$rows=pg_num_rows($queryp2);

			if ($rows==0)
			{
				$id_personal2=0;
			}

			$queryp3=pg_query("SELECT id FROM personal WHERE ci='$ciProfLun3[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp3=pg_fetch_assoc($queryp3);
			$id_personal3=$arrayp3['id'];
			$rows2=pg_num_rows($queryp3);

			if ($rows2==0)
			{
				$id_personal3=0;
			}

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND d.taller=1 AND h.taller=1
				AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueLunes[$i][]=$dato['lunes'];
				}

			$d=explode('_', $diaLun[$j]);

			$numero=$d[1]-1;

			if ($BloqueLunes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
					dia='$diaLun[$j]' AND id_personal='$id_personal' AND taller=1 AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
						dia='$diaLun[$j]' AND aula='$aulaLun[$j]' AND taller=1 AND estatus=1");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatLun[$j]' AND taller=1 AND estatus=1");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
							seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=1 AND estatus=1");
						$ar=pg_fetch_assoc($qu);
						$id_seccion=$ar['id_seccion'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula, id_personal2, id_personal3)VALUES('$id_seccion','$id_materia','$id_personal','$id_horas[$j]'
							,'$id_periodo','$diaLun[$j]','$aulaLun[$j]','$id_personal2','$id_personal3')";	
						
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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Mecanica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$queryp2=pg_query("SELECT id FROM personal WHERE ci='$ciProfMar2[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp2=pg_fetch_assoc($queryp2);
			$id_personal2=$arrayp2['id'];
			$rows=pg_num_rows($queryp2);

			if ($rows==0)
			{
				$id_personal2=0;
			}

			$queryp3=pg_query("SELECT id FROM personal WHERE ci='$ciProfMar3[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp3=pg_fetch_assoc($queryp3);
			$id_personal3=$arrayp3['id'];
			$rows2=pg_num_rows($queryp3);

			if ($rows2==0)
			{
				$id_personal3=0;
			}

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND d.taller=1 AND h.taller=1 
				AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueMartes[$i][]=$dato['martes'];
				}

			$d=explode('_', $diaMar[$j]);

			$numero=$d[1]-1;

			if ($BloqueMartes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
					dia='$diaMar[$j]' AND id_personal='$id_personal' AND taller=1 AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
						dia='$diaMar[$j]' AND aula='$aulaMar[$j]' AND taller=1 AND estatus=1");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatMar[$j]' AND taller=1 AND estatus=1");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
							seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=1 AND estatus=1");
						$ar=pg_fetch_assoc($qu);
						$id_seccion=$ar['id_seccion'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula, id_personal2, id_personal3)VALUES('$id_seccion','$id_materia','$id_personal','$id_horas[$j]'
							,'$id_periodo','$diaMar[$j]','$aulaMar[$j]','$id_personal2','$id_personal3')";	
						
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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Mecanica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$queryp2=pg_query("SELECT id FROM personal WHERE ci='$ciProfMie2[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp2=pg_fetch_assoc($queryp2);
			$id_personal2=$arrayp2['id'];
			$rows=pg_num_rows($queryp2);

			if ($rows==0)
			{
				$id_personal2=0;
			}

			$queryp3=pg_query("SELECT id FROM personal WHERE ci='$ciProfMie3[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp3=pg_fetch_assoc($queryp3);
			$id_personal3=$arrayp3['id'];
			$rows2=pg_num_rows($queryp3);

			if ($rows2==0)
			{
				$id_personal3=0;
			}

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND d.taller=1 AND h.taller=1
				AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueMiercoles[$i][]=$dato['miercoles'];
				}

			$d=explode('_', $diaMie[$j]);

			$numero=$d[1]-1;

			$BloqueMiercoles[$i];

			if ($BloqueMiercoles[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
					dia='$diaMie[$j]' AND id_personal='$id_personal' AND taller=1 AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
						dia='$diaMie[$j]' AND aula='$aulaMie[$j]' AND taller=1 AND estatus=1");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatMie[$j]' AND taller=1 AND estatus=1");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
							seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=1 AND estatus=1");
						$ar=pg_fetch_assoc($qu);
						$id_seccion=$ar['id_seccion'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula, id_personal2, id_personal3)VALUES('$id_seccion','$id_materia','$id_personal','$id_horas[$j]'
							,'$id_periodo','$diaMie[$j]','$aulaMie[$j]','$id_personal2','$id_personal3')";	
						
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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Mecanica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$queryp2=pg_query("SELECT id FROM personal WHERE ci='$ciProfJue2[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp2=pg_fetch_assoc($queryp2);
			$id_personal2=$arrayp2['id'];
			$rows=pg_num_rows($queryp2);

			if ($rows==0)
			{
				$id_personal2=0;
			}

			$queryp3=pg_query("SELECT id FROM personal WHERE ci='$ciProfJue3[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp3=pg_fetch_assoc($queryp3);
			$id_personal3=$arrayp3['id'];
			$rows2=pg_num_rows($queryp3);

			if ($rows2==0)
			{
				$id_personal3=0;
			}

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND d.taller=1 AND h.taller=1
				AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueJueves[$i][]=$dato['jueves'];
				}

			$d=explode('_', $diaJue[$j]);

			$numero=$d[1]-1;

			if ($BloqueJueves[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
					dia='$diaJue[$j]' AND id_personal='$id_personal' AND taller=1 AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
						dia='$diaJue[$j]' AND aula='$aulaJue[$j]' AND taller=1 AND estatus=1");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatJue[$j]' AND taller=1 AND estatus=1");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
							seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=1 AND estatus=1");
						$ar=pg_fetch_assoc($qu);
						$id_seccion=$ar['id_seccion'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula, id_personal2, id_personal3)VALUES('$id_seccion','$id_materia','$id_personal','$id_horas[$j]'
							,'$id_periodo','$diaJue[$j]','$aulaJue[$j]','$id_personal2','$id_personal3')";	
						
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

			$query=pg_query("SELECT id FROM personal WHERE ci='$ci' AND area='Mecanica' AND estatus=1");
			$array=pg_fetch_assoc($query);
			$id_personal=$array['id'];

			$queryp2=pg_query("SELECT id FROM personal WHERE ci='$ciProfVie2[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp2=pg_fetch_assoc($queryp2);
			$id_personal2=$arrayp2['id'];
			$rows=pg_num_rows($queryp2);

			if ($rows==0)
			{
				$id_personal2=0;
			}

			$queryp3=pg_query("SELECT id FROM personal WHERE ci='$ciProfVie3[$j]' AND area='Mecanica' AND estatus=1");
			$arrayp3=pg_fetch_assoc($queryp3);
			$id_personal3=$arrayp3['id'];
			$rows2=pg_num_rows($queryp3);

			if ($rows2==0)
			{
				$id_personal3=0;
			}

			$con=pg_query("SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND 
				d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND d.taller=1 AND h.taller=1
				AND d.estatus=1 AND h.estatus=1 
				ORDER BY h.numero_bloque ASC");

				while ($dato=pg_fetch_assoc($con))
				{
					$BloqueViernes[$i][]=$dato['viernes'];
				}

			$d=explode('_', $diaVie[$j]);

			$numero=$d[1]-1;

			if ($BloqueViernes[$i][$numero]==1)
			{
				$con2=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
					dia='$diaVie[$j]' AND id_personal='$id_personal' AND taller=1 AND estatus=1");
				$num=pg_num_rows($con2);

				if ($num==0)
				{
					$con3=pg_query("SELECT * FROM horario_clase WHERE id_periodo='$id_periodo' AND
						dia='$diaVie[$j]' AND aula='$aulaVie[$j]' AND taller=1 AND estatus=1");
					$num2=pg_num_rows($con3);

					if ($num2==0)
					{
						$q=pg_query("SELECT * FROM materia WHERE codigo='$codMatVie[$j]' AND taller=1 AND estatus=1");
						$a=pg_fetch_assoc($q);
						$id_materia=$a['id_materia'];

						$qu=pg_query("SELECT * FROM secciones WHERE anio='$anio' AND trayecto='$trayecto' AND
							seccion='$seccion' AND sede='$sede' AND pnf='$pnf' AND taller=1 AND estatus=1");
						$ar=pg_fetch_assoc($qu);
						$id_seccion=$ar['id_seccion'];

						$sql="INSERT INTO horario_clase (id_seccion, id_materia, id_personal, id_horas, id_periodo, dia, aula, id_personal2, id_personal3)VALUES('$id_seccion','$id_materia','$id_personal','$id_horas[$j]'
							,'$id_periodo','$diaVie[$j]','$aulaVie[$j]','$id_personal2','$id_personal3')";	
						
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
		header('Location:horarios_clase.php?error=aula');
	}
	if ($error=='prof')
	{
		#echo "ERROR DE PROF";
		header('Location:horarios_clase.php?error=prof');
	}
	if ($registrar=="exito")
	{
		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Horarios','".$_SESSION['nom_usuario']."',1)");
		#echo "<br><br>REGISTRO!!!";
		header('Location:horarios_clase.php?registro=exito');
	}
?>