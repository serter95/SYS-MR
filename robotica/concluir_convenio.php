<?php
    require("seguridad.php");
    require("conexion.php");

    $id=$_REQUEST['id']; //prestamo

 #   echo $id;

    # Eliminamos logicamente el usuario

    pg_query("UPDATE convenios SET estado='no concluido' WHERE id_convenio='".$id."'");
    //pg_query("DELETE FROM maquinas WHERE id_maquina='".$id."'");
#   Actualizamos los rerigistros y los obtenemos

    $sql="SELECT * FROM convenios WHERE estatus='1'";
    $query=pg_query($sql);

    header("Location:convenios.php?concluido=no");

    # Creamos nuestra vista y la devolvemos al ajax
?>
