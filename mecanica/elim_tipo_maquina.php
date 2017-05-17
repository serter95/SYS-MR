<?php
	require("seguridad.php");
	require("conexion.php");

	$id=$_REQUEST['id_maq'];

 #   echo $id;

	# Eliminamos logicamente el usuario

	pg_query("UPDATE tipo_maquina SET estatus='0' WHERE id_tipom='".$id."'");
    //pg_query("DELETE FROM maquinas WHERE id_maquina='".$id."'");
#	Actualizamos los rerigistros y los obtenemos

	$sql="SELECT * FROM tipo_maquina WHERE estatus='1' ";
    $query=pg_query($sql);

    date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Máquinas','".$_SESSION['nom_usuario']."',1)");

    header("Location:maquinas.php?elim_maq=si");

	# Creamos nuestra vista y la devolvemos al ajax
?>
