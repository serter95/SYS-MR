<?php
	require 'seguridad.php';
	require 'conexion.php';

	pg_query("UPDATE aulas SET estatus=0 WHERE id_aulas='".$_REQUEST['id']."'");

	date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Eliminación','Aulas','".$_SESSION['nom_usuario']."',1)");

	header('Location:horarios.php?r=el');
?>