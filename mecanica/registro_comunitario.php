<?php
	require("seguridad.php");
	require("conexion.php");

	$codigo=trim(strtoupper($_POST['codigo']));
	$regimen=trim($_POST['regimen']);
	$estado=trim(ucwords($_POST['estado']));
	$municipio=trim(ucwords($_POST['municipio']));
	$parroquia=trim(ucwords($_POST['parroquia']));
	$sector=trim(ucwords($_POST['sector']));
	$pnf=trim(ucwords($_POST['pnf']));
	$trayecto=trim($_POST['trayecto']);
	$seccion=trim($_POST['seccion']);
	$periodo=trim($_POST['periodo']);
	$titulo=trim($_POST['titulo']);

	$nac1=$_POST['nacEst'];
	$ced1=trim($_POST['ciEst']);
	$nomEst1=trim(ucwords(strtolower($_POST['nomEst'])));
	$apeEst1=trim(ucwords(strtolower($_POST['apeEst'])));
	$cod1=$_POST['codTlf'];
	$tlf1=trim($_POST['tlfEst']);
	$correoEst1=trim(strtolower($_POST['correoEst']));
	$especialidad1=trim(ucwords(strtolower($_POST['especialidad'])));

	$ci1=$nac1.$ced1;
	$tlfEst1=$cod1.$tlf1;

	$nac2=$_POST['nacEst2'];
	$ced2=trim($_POST['ciEst2']);
	$nomEst2=trim(ucwords(strtolower($_POST['nomEst2'])));
	$apeEst2=trim(ucwords(strtolower($_POST['apeEst2'])));
	$cod2=$_POST['codTlf2'];
	$tlf2=trim($_POST['tlfEst2']);
	$correoEst2=trim(strtolower($_POST['correoEst2']));
	$especialidad2=trim(ucwords(strtolower($_POST['especialidad2'])));

	$ci2=$nac2.$ced2;
	$tlfEst2=$cod2.$tlf2;

	$nac3=$_POST['nacEst3'];
	$ced3=trim($_POST['ciEst3']);
	$nomEst3=trim(ucwords($_POST['nomEst3']));
	$apeEst3=trim(ucwords($_POST['apeEst3']));
	$cod3=$_POST['codTlf3'];
	$tlf3=trim($_POST['tlfEst3']);
	$correoEst3=trim(strtolower($_POST['correoEst3']));
	$especialidad3=trim(ucwords(strtolower($_POST['especialidad3'])));

	$ci3=$nac3.$ced3;
	$tlfEst3=$cod3.$tlf3;

	$descripcion=trim(ucfirst(strtolower($_POST['descripcion'])));
	$aportes=trim(ucfirst(strtolower($_POST['aportes'])));
	$integracion=trim(ucfirst(strtolower($_POST['integracion'])));
	$planNacional=trim(ucfirst(strtolower($_POST['planNacional'])));

	$query=pg_query("SELECT * FROM proyectos WHERE estado_proyecto In ('Concluido','En proceso') AND taller=1 AND estatus=1");
		
	while ($array=pg_fetch_assoc($query))
	{
		if ($codigo==$array['codigo'] AND $array['estado_proyecto']!='Abandonado')
		{
			$existe='si';
		}
	}

	if ($existe=='si')
	{
		header('Location:comunitario.php?error=si');
	}
	else
	{
		if (empty($nac2) || empty($ced2) || empty($nomEst2) || empty($apeEst2) || empty($cod2) || empty($tlf2) || empty($correoEst2) || empty($especialidad2))
		{
				pg_query("INSERT INTO proyectos (codigo,regimen,estado,municipio,parroquia,sector,pnf,trayecto,seccion
					,periodo,titulo,descripcion,aportes,integracion,plan_nacional,ambito,estado_proyecto) VALUES
					('$codigo','$regimen','$estado','$municipio','$parroquia','$sector','$pnf','$trayecto','$seccion'
					,'$periodo','$titulo','$descripcion','$aportes','$integracion','$planNacional','comunitario','En proceso')");

				$query=pg_query("SELECT * FROM proyectos WHERE taller=1 AND estatus=1 ORDER BY id_proyecto DESC");
				$array=pg_fetch_assoc($query);
				$id=$array['id_proyecto'];

				pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
					('$ci1','$nomEst1','$apeEst1','$tlfEst1','$correoEst1','$especialidad1','$id')");

				#echo "exito";
				date_default_timezone_set('America/Caracas');

		          $hoy=date('Y-m-d h:i:s');

		          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
		              VALUES('$hoy','Registro','Comunitario','".$_SESSION['nom_usuario']."',1)");

				header("Location:comunitario.php?registro=exito");
		}

		if ((empty(!$nac2) && empty(!$ced2) && empty(!$nomEst2) && empty(!$apeEst2) && empty(!$cod2) && empty(!$tlf2) && empty(!$correoEst2) && empty(!$especialidad2)) AND (empty($nac3) || empty($ced3) || empty($nomEst3) || empty($apeEst3) || empty($cod3) || empty($tlf3) || empty($correoEst3) || empty($especialidad3)))
		{
					pg_query("INSERT INTO proyectos (codigo,regimen,estado,municipio,parroquia,sector,pnf,trayecto,seccion
						,periodo,titulo,descripcion,aportes,integracion,plan_nacional,ambito,estado_proyecto)
						VALUES ('$codigo','$regimen','$estado','$municipio','$parroquia','$sector','$pnf','$trayecto'
							,'$seccion','$periodo','$titulo','$descripcion','$aportes','$integracion','$planNacional'
							,'comunitario','En proceso')");

					$query=pg_query("SELECT * FROM proyectos WHERE taller=1 AND estatus=1 ORDER BY id_proyecto DESC");
					$array=pg_fetch_assoc($query);
					$id=$array['id_proyecto'];

					pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
						('$ci1','$nomEst1','$apeEst1','$tlfEst1','$correoEst1','$especialidad1','$id')");

					pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
						('$ci2','$nomEst2','$apeEst2','$tlfEst2','$correoEst2','$especialidad2','$id')");

					date_default_timezone_set('America/Caracas');

		          $hoy=date('Y-m-d h:i:s');

		          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
		              VALUES('$hoy','Registro','Comunitario','".$_SESSION['nom_usuario']."',1)");

					header("Location:comunitario.php?registro=exito");
		}

		if (empty(!$nac2) && empty(!$ced2) && empty(!$nomEst2) && empty(!$apeEst2) && empty(!$cod2) && empty(!$tlf2) && empty(!$correoEst2) && empty(!$especialidad2) && empty(!$nac3) && empty(!$ced3) && empty(!$nomEst3) && empty(!$apeEst3) && empty(!$cod3) && empty(!$tlf3) && empty(!$correoEst3) && empty(!$especialidad3))
		{
						pg_query("INSERT INTO proyectos (codigo,regimen,estado,municipio,parroquia,sector,pnf,trayecto,seccion
							,periodo,titulo,descripcion,aportes,integracion,plan_nacional,ambito,estado_proyecto)
							VALUES ('$codigo','$regimen','$estado','$municipio','$parroquia','$sector','$pnf','$trayecto'
								,'$seccion','$periodo','$titulo','$descripcion','$aportes','$integracion','$planNacional'
								,'comunitario','En proceso')");
						
						$query="SELECT * FROM proyectos WHERE taller=1 AND estatus=1 ORDER BY id_proyecto DESC";
						$array=pg_fetch_assoc(pg_query($query));
						$id=$array['id_proyecto'];

						pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
							('$ci1','$nomEst1','$apeEst1','$tlfEst1','$correoEst1','$especialidad1','$id')");

						pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
							('$ci2','$nomEst2','$apeEst2','$tlfEst2','$correoEst2','$especialidad2','$id')");

						pg_query("INSERT INTO estudiantes (ci, nombres, apellidos, telefono, correo, especialidad, codpro) VALUES
							('$ci3','$nomEst3','$apeEst3','$tlfEst3','$correoEst3','$especialidad3','$id')");

						date_default_timezone_set('America/Caracas');

		          $hoy=date('Y-m-d h:i:s');

		          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
		              VALUES('$hoy','Registro','Comunitario','".$_SESSION['nom_usuario']."',1)");

						header("Location:comunitario.php?registro=exito");
		}
	}
?>