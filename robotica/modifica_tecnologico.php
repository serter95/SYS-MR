<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id'];
	$idEst1=$_POST['idEst1'];
	$idEst2=$_POST['idEst2'];
	$idEst3=$_POST['idEst3'];

	$codigo=trim(strtoupper($_POST['codigoM']));
	$regimen=trim($_POST['regimenM']);
	$estado=trim(ucwords($_POST['estadoM']));
	$municipio=trim(ucwords($_POST['municipioM']));
	$parroquia=trim(ucwords($_POST['parroquiaM']));
	$sector=trim(ucwords($_POST['sectorM']));
	$pnf=trim(ucwords($_POST['pnfM']));
	$trayecto=trim($_POST['trayectoM']);
	$seccion=trim($_POST['seccionM']);
	$periodo=trim($_POST['periodoM']);
	$titulo=trim($_POST['tituloM']);

	$nac1=$_POST['nacEstM'];
	$ced1=trim($_POST['ciEstM']);
	$nomEst1=trim(ucwords(strtolower($_POST['nomEstM'])));
	$apeEst1=trim(ucwords(strtolower($_POST['apeEstM'])));
	$cod1=$_POST['codTlfM'];
	$tlf1=trim($_POST['tlfEstM']);
	$correoEst1=trim(strtolower($_POST['correoEstM']));
	$especialidad1=trim(ucwords(strtolower($_POST['especialidadM'])));

	$ci1=$nac1.$ced1;
	$tlfEst1=$cod1.$tlf1;

	$nac2=$_POST['nacEst2M'];
	$ced2=trim($_POST['ciEst2M']);
	$nomEst2=trim(ucwords(strtolower($_POST['nomEst2M'])));
	$apeEst2=trim(ucwords(strtolower($_POST['apeEst2M'])));
	$cod2=$_POST['codTlf2M'];
	$tlf2=trim($_POST['tlfEst2M']);
	$correoEst2=trim(strtolower($_POST['correoEst2M']));
	$especialidad2=trim(ucwords(strtolower($_POST['especialidad2M'])));

	$ci2=$nac2.$ced2;
	$tlfEst2=$cod2.$tlf2;

	$nac3=$_POST['nacEst3M'];
	$ced3=trim($_POST['ciEst3M']);
	$nomEst3=trim(ucwords(strtolower($_POST['nomEst3M'])));
	$apeEst3=trim(ucwords(strtolower($_POST['apeEst3M'])));
	$cod3=$_POST['codTlf3M'];
	$tlf3=trim($_POST['tlfEst3M']);
	$correoEst3=trim(strtolower($_POST['correoEst3M']));
	$especialidad3=trim(ucwords(strtolower($_POST['especialidad3M'])));

	$ci3=$nac3.$ced3;
	$tlfEst3=$cod3.$tlf3;

	$descripcion=trim(strtolower($_POST['descripcionM']));
	$aportes=trim(strtolower($_POST['aportesM']));
	$integracion=trim(strtolower($_POST['integracionM']));
	$planNacional=trim(strtolower($_POST['planNacionalM']));

	$query=pg_query("SELECT * FROM proyectos WHERE estado_proyecto In ('En proceso') AND taller=2 AND estatus=1");
		
	while ($array=pg_fetch_assoc($query))
	{
		if ($codigo==$array['codigo'] AND $array['id_proyecto']!=$id)
		{
			$existe='si';
		}
	}

	if ($existe=='si')
	{
		header('Location:tecnologico.php?error=siM');
	}
	else
	{	
		if (empty($nac2) || empty($ced2) || empty($nomEst2) || empty($apeEst2) || empty($cod2) || empty($tlf2) || empty($correoEst2) || empty($especialidad2))
		{

				#echo " no esta repetido ";
				pg_query("UPDATE proyectos SET codigo='$codigo',regimen='$regimen',estado='$estado'
					,municipio='$municipio',parroquia='$parroquia',sector='$sector',pnf='$pnf',trayecto='$trayecto'
					,seccion='$seccion',periodo='$periodo',titulo='$titulo',descripcion='$descripcion'
					,aportes='$aportes',integracion='$integracion',plan_nacional='$planNacional'
					,ambito='tecnologico' WHERE id_proyecto='$id'");

					pg_query("UPDATE estudiantes SET ci='$ci1',nombres='$nomEst1',apellidos='$apeEst1'
						,telefono='$tlfEst1',correo='$correoEst1',especialidad='$especialidad1'
						WHERE id_estudiantes='$idEst1'");
					#echo " si existe ";

				pg_query("UPDATE estudiantes SET estatus='0' WHERE id_estudiantes='$idEst2'");

				pg_query("UPDATE estudiantes SET estatus='0' WHERE id_estudiantes='$idEst3'");

				date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
			    VALUES('$hoy','Modificación','Tecnológico','".$_SESSION['nom_usuario']."')");

				header("Location:tecnologico.php?modificar=exito");
				
				#echo " exito 1";
		}
	

		if ((empty(!$nac2) && empty(!$ced2) && empty(!$nomEst2) && empty(!$apeEst2) && empty(!$cod2) && empty(!$tlf2) && empty(!$correoEst2) && empty(!$especialidad2)) AND (empty($nac3) || empty($ced3) || empty($nomEst3) || empty($apeEst3) || empty($cod3) || empty($tlf3) || empty($correoEst3) || empty($especialidad3)))
		{

		  $con=pg_query("SELECT * FROM estudiantes WHERE id_estudiantes='$idEst2' AND codpro='$id' AND estatus=1");

			$num2=pg_num_rows($con);

			pg_query("UPDATE proyectos SET codigo='$codigo',regimen='$regimen',estado='$estado'
			,municipio='$municipio',parroquia='$parroquia',sector='$sector',pnf='$pnf',trayecto='$trayecto'
			,seccion='$seccion',periodo='$periodo',titulo='$titulo',descripcion='$descripcion'
			,aportes='$aportes',integracion='$integracion',plan_nacional='$planNacional'
			,ambito='tecnologico' WHERE id_proyecto='$id'");

			
				pg_query("UPDATE estudiantes SET ci='$ci1', nombres='$nomEst1', apellidos='$apeEst1'
				,telefono='$tlfEst1', correo='$correoEst1', especialidad='$especialidad1'
				WHERE id_estudiantes='$idEst1'");			
					
				if ($num2>0)
				{
					#echo " UPDATE";

					pg_query("UPDATE estudiantes SET ci='$ci2', nombres='$nomEst2', apellidos='$apeEst2'
					,telefono='$tlfEst2', correo='$correoEst2', especialidad='$especialidad2'
					WHERE id_estudiantes='$idEst2'");
				}
				else
				{
					pg_query("INSERT INTO estudiantes (ci,nombres,apellidos,telefono,correo,especialidad
						,codpro) VALUES ('$ci2','$nomEst2','$apeEst2','$tlfEst2','$correoEst2','$especialidad2'
						,'$id')");
					
					#echo " INSERT";
				}					

				pg_query("UPDATE estudiantes SET estatus='0' WHERE id_estudiantes='$idEst3'");

				#echo " exito 2";
				date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
			    VALUES('$hoy','Modificación','Tecnológico','".$_SESSION['nom_usuario']."')");
				
				header("Location:tecnologico.php?modificar=exito");
		}

		if (empty(!$nac2) && empty(!$ced2) && empty(!$nomEst2) && empty(!$apeEst2) && empty(!$cod2) && empty(!$tlf2) && empty(!$correoEst2) && empty(!$especialidad2) && empty(!$nac3) && empty(!$ced3) && empty(!$nomEst3) && empty(!$apeEst3) && empty(!$cod3) && empty(!$tlf3) && empty(!$correoEst3) && empty(!$especialidad3))
		{
			$con=pg_query("SELECT * FROM estudiantes WHERE id_estudiantes='$idEst2' AND codpro='$id' AND estatus=1");

			$num2=pg_num_rows($con);

			$con2=pg_query("SELECT * FROM estudiantes WHERE id_estudiantes='$idEst3' AND codpro='$id' AND estatus=1");

			$num3=pg_num_rows($con2);

			pg_query("UPDATE proyectos SET codigo='$codigo',regimen='$regimen',estado='$estado'
			,municipio='$municipio',parroquia='$parroquia',sector='$sector',pnf='$pnf'
			,trayecto='$trayecto',seccion='$seccion',periodo='$periodo',titulo='$titulo'
			,descripcion='$descripcion',aportes='$aportes',integracion='$integracion'
			,plan_nacional='$planNacional',ambito='tecnologico' WHERE id_proyecto='$id'");

			pg_query("UPDATE estudiantes SET ci='$ci1', nombres='$nomEst1', apellidos='$apeEst1'
			,telefono='$tlfEst1', correo='$correoEst1', especialidad='$especialidad1'
			WHERE id_estudiantes='$idEst1'");

			if ($num2>0)
			{
				pg_query("UPDATE estudiantes SET ci='$ci2', nombres='$nomEst2', apellidos='$apeEst2'
				,telefono='$tlfEst2', correo='$correoEst2', especialidad='$especialidad2'
				WHERE id_estudiantes='$idEst2'");
			}
			else
			{
				pg_query("INSERT INTO estudiantes (ci,nombres,apellidos,telefono,correo,especialidad
				,codpro) VALUES ('$ci2','$nomEst2','$apeEst2','$tlfEst2','$correoEst2','$especialidad2'
				,'$id')");
			}

			if ($num3>0)
			{
				pg_query("UPDATE estudiantes SET ci='$ci3', nombres='$nomEst3', apellidos='$apeEst3'
				,telefono='$tlfEst3', correo='$correoEst3', especialidad='$especialidad3'
				WHERE id_estudiantes='$idEst3'");
			}
			else
			{
				pg_query("INSERT INTO estudiantes (ci,nombres,apellidos,telefono,correo,especialidad
				,codpro) VALUES ('$ci3','$nomEst3','$apeEst3','$tlfEst3','$correoEst3','$especialidad3'
				,'$id')");
			}

			date_default_timezone_set('America/Caracas');

				$hoy=date('Y-m-d h:i:s');

				pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
			    VALUES('$hoy','Modificación','Tecnológico','".$_SESSION['nom_usuario']."')");
				
			header("Location:tecnologico.php?modificar=exito");

			#echo " exito 3";
		}
	}
?>