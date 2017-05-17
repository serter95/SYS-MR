<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_POST['id_seccion'];
	$anio=trim($_POST['anio_M']);
	$trayecto=$_POST['trayecto_s_M'];
	$seccion=trim($_POST['seccion_M']);
	$sede=$_POST['sede_M'];
	$pnf=$_POST['pnf_M'];

	$query=pg_query("SELECT * FROM secciones WHERE sede='$sede' AND pnf='$pnf' AND anio='$anio' AND trayecto='$trayecto'
		AND seccion='$seccion' AND taller=2 AND estatus=1");
	$array=pg_fetch_assoc($query);
	$num=pg_num_rows($query);

	if ($num>0)
	{
		if ($array['id_seccion']==$id)
		{
			pg_query("UPDATE secciones SET anio='$anio',trayecto='$trayecto',seccion='$seccion', sede='$sede'
				,pnf='$pnf'	WHERE id_seccion='$id'");
			#echo "EXITO";
			date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Modificación','Secciones','".$_SESSION['nom_usuario']."')");

			header('Location:horarios.php?modificar=seccion');
		}
		else
		{
			#echo "ERROR";
			header('Location:horarios.php?error=seccion_M');
		}
	}
	else
	{
		pg_query("UPDATE secciones SET anio='$anio',trayecto='$trayecto',seccion='$seccion', sede='$sede'
		,pnf='$pnf'	WHERE id_seccion='$id'");
		#echo "EXITO";

		date_default_timezone_set('America/Caracas');

		$hoy=date('Y-m-d h:i:s');

		pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
	    VALUES('$hoy','Modificación','Secciones','".$_SESSION['nom_usuario']."')");

		header('Location:horarios.php?modificar=seccion');
	}
?>