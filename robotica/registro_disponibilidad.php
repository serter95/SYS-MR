<?php
	require('seguridad.php');
	require('conexion.php');

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

	$query=pg_query("SELECT * FROM periodo WHERE tipo='$periodo' LIMIT 1");
	$array=pg_fetch_assoc($query);
	$id_periodo=$array['id_periodo'];

	$ci_per=$nac.$ci;

	$query2=pg_query("SELECT * FROM personal WHERE ci='$ci_per' AND area='Robotica' AND estatus=1");
	$array2=pg_fetch_assoc($query2);
	$id_persona=$array2['id'];

	$con=pg_query("SELECT * FROM disponibilidad_persona WHERE id_personal='$id_persona'
	AND id_periodo='$id_periodo' AND taller=2 AND estatus=1");
	$num=pg_num_rows($con);

	if ($num>0)
	{
		header('Location:horarios.php?error=disp');
	}
	else
	{

		$lun=explode(",", $lunes);
		$mar=explode(",", $martes);
		$mie=explode(",", $miercoles);
		$jue=explode(",", $jueves);
		$vie=explode(",", $viernes);
		$id_h=explode(",", $id_horas);

		for ($i=1; $i <=$ciclo ; $i++)
		{
			$j=$i-1;

			$sql="INSERT INTO disponibilidad_persona (id_periodo,id_personal,lunes,martes,miercoles,jueves
				,viernes,id_horas,taller)VALUES('$id_periodo','$id_persona','$lun[$j]','$mar[$j]','$mie[$j]','$jue[$j]'
				,'$vie[$j]','$id_h[$j]','2')";
			
			pg_query($sql);
		}

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Registro','Disponibilidad','".$_SESSION['nom_usuario']."')");

		header('Location:horarios.php?registro=disponibilidad');
	}
?>