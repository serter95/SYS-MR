<?php
	require 'seguridad.php';
	require 'conexion.php';

	$nombre=strtoupper($_REQUEST['nombreM']);
	$id=$_REQUEST['id_aula'];

	$query=pg_query("SELECT * FROM aulas WHERE nombre='$nombre' AND taller=1 AND estatus=1");
	$num=pg_num_rows($query);
	$array=pg_fetch_assoc($query);

	if ($num>0)
	{
		if ($array['nombre']==$nombre && $id==$array['id_aulas'])
		{
			pg_query("UPDATE aulas SET nombre='$nombre' WHERE id_aulas='$id'");

			date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Aulas','".$_SESSION['nom_usuario']."',1)");

			header('Location:horarios.php?m=e');
		}
		else
		{
			header('Location:horarios.php?m=n');
		}
	}
	else
	{
		pg_query("UPDATE aulas SET nombre='$nombre' WHERE id_aulas='$id'");

		date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Aulas','".$_SESSION['nom_usuario']."',1)");
      
		header('Location:horarios.php?m=e');
	}
?>