<?php
    require("seguridad.php");
    require("conexion.php");

    $id=$_REQUEST['id']; //prestamo

 #   echo $id;

    # Eliminamos logicamente el usuario

    pg_query("UPDATE clausulas SET estatus='0' WHERE id_clausula='".$id."'");
    //pg_query("DELETE FROM maquinas WHERE id_maquina='".$id."'");
#   Actualizamos los rerigistros y los obtenemos
     $sql1="SELECT * FROM clausulas  WHERE id_clausula='".$id."'";
      $query1=pg_query($sql1);
      $buscaid=pg_fetch_assoc($query1);
      $id2=$buscaid['id_convenio'];

    $sql="SELECT * FROM clausulas WHERE estatus='1'";
    $query=pg_query($sql);

    header("Location:convenios.php?elim_clau=si&num=$id2");

    # Creamos nuestra vista y la devolvemos al ajax
?>
