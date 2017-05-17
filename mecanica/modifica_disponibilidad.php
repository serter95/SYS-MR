<?php
	require('seguridad.php');
	require('conexion.php');

	$id_personal1=$_REQUEST['id_personal'];
	$id_periodo1=$_REQUEST['id_periodo'];

	$periodo=$_REQUEST['periodo'];
	$nac=$_REQUEST['nacionalidad'];
	$ci=$_REQUEST['ci_disp'];
	$ciclo=$_REQUEST['ciclo'];
	$lunes=$_REQUEST['lunes'];
	$martes=$_REQUEST['martes'];
	$miercoles=$_REQUEST['miercoles'];
	$jueves=$_REQUEST['jueves'];
	$viernes=$_REQUEST['viernes'];
	$id_horas=$_REQUEST['id_h'];
	$id_disponibilidad=$_REQUEST['id_disponibilidad'];

	$query=pg_query("SELECT * FROM periodo WHERE tipo='$periodo' LIMIT 1");
	$array=pg_fetch_assoc($query);
	$id_periodo=$array['id_periodo'];

	$ci_per=$nac.$ci;

	$query2=pg_query("SELECT * FROM personal WHERE ci='$ci_per' AND area='Mecanica' AND estatus=1");
	$array2=pg_fetch_assoc($query2);
	$id_persona=$array2['id'];

	$con=pg_query("SELECT * FROM disponibilidad_persona WHERE id_personal='$id_persona'
	AND id_periodo='$id_periodo' AND taller=1 AND estatus=1");
	$num=pg_num_rows($con);

	if ($num>0)
	{
		while ($conx=pg_fetch_assoc($con))
		{
			if ($id_personal1==$conx['id_personal'] && $id_periodo1==$conx['id_periodo'])
			{
				$modifica="si";
			}
		}

		if ($modifica=="si")
		{
			// MODIFICA EL HORARIO
			$lun=explode(",", $lunes);
			$mar=explode(",", $martes);
			$mie=explode(",", $miercoles);
			$jue=explode(",", $jueves);
			$vie=explode(",", $viernes);
			$id_h=explode(",", $id_horas);
			$id_disp=explode(",", $id_disponibilidad);

			for ($i=1; $i <=$ciclo ; $i++)
			{
				$j=$i-1;

				$sql="UPDATE disponibilidad_persona SET id_periodo='$id_periodo',id_personal='$id_persona'
				,lunes='$lun[$j]',martes='$mar[$j]',miercoles='$mie[$j]',jueves='$jue[$j]',viernes='$vie[$j]'
				,id_horas='$id_h[$j]' WHERE id_disponibilidad='$id_disp[$j]'";
				
				pg_query($sql);
			} 

		date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Disponibilidad','".$_SESSION['nom_usuario']."',1)");

			header('Location:horarios.php?modificar=disponibilidad');
		}
		else
		{
			// MANDA ERROR
			header('Location:horarios.php?error=disp_M');
		}
	}
	else
	{

		// MODIFICA EL HORARIO
		$lun=explode(",", $lunes);
		$mar=explode(",", $martes);
		$mie=explode(",", $miercoles);
		$jue=explode(",", $jueves);
		$vie=explode(",", $viernes);
		$id_h=explode(",", $id_horas);
		$id_disp=explode(",", $id_disponibilidad);

		for ($i=1; $i <=$ciclo ; $i++)
		{
			$j=$i-1;

			$sql="UPDATE disponibilidad_persona SET id_periodo='$id_periodo',id_personal='$id_persona'
			,lunes='$lun[$j]',martes='$mar[$j]',miercoles='$mie[$j]',jueves='$jue[$j]',viernes='$vie[$j]'
			,id_horas='$id_h[$j]' WHERE id_disponibilidad='$id_disp[$j]'";
			
			pg_query($sql);
		} 

		date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Disponibilidad','".$_SESSION['nom_usuario']."',1)");

		header('Location:horarios.php?modificar=disponibilidad');
	}
?>