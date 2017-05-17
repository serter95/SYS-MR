<?php
	require("seguridad.php");
	require("conexion.php");

	 $id=$_POST['id'];
	 $codigo=trim(strtoupper($_POST['codigo_M']));
	 $nombre=trim($_POST['nombre_M']);
	 $trayecto=$_POST['trayecto_M'];
	 $horas=trim($_POST['horas_M']);

	$query=pg_query("SELECT * FROM materia WHERE codigo='$codigo' AND taller=1 AND estatus=1");
	$num=pg_num_rows($query);

	if ($num>0)
	{
		while($array=pg_fetch_assoc($query))
		{
			if ($id==$array['id_materia'])
			{
				$modificar="si";
			}
		}

		if ($modificar=="si")
		{
			$query2=pg_query("UPDATE materia SET codigo='$codigo',nombre='$nombre',trayecto='$trayecto',hora='$horas'
			WHERE id_materia='$id'");

			date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Materias','".$_SESSION['nom_usuario']."',1)");

			header('Location:horarios.php?modificar=materia');
			#echo " MODIFICA EXISTENTE";
		}
		else
		{
			#echo "ERROR";
			header('Location:horarios.php?error=codigo_M');
		}
	}
	else
	{
		$query2=pg_query("UPDATE materia SET codigo='$codigo',nombre='$nombre',trayecto='$trayecto',hora='$horas'
		WHERE id_materia='$id'");

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Materias','".$_SESSION['nom_usuario']."',1)");

		header('Location:horarios.php?modificar=materia');

		#echo " MODIFICA NO EXISTENTE";
	}
?>