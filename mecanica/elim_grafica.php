<?php
    require("seguridad.php");
    require("conexion.php");

    $id=$_REQUEST['id']; //prestamo

 #   echo $id;
    $sql2="SELECT * FROM graficas WHERE id_grafica='$id'";
    $query2=pg_query($sql2);
    $datos=pg_fetch_assoc($query2);

    $borrar=$datos["ubicacion"];
    unlink($borrar);

    # Eliminamos logicamente el usuario

    pg_query("DELETE FROM graficas WHERE id_grafica='".$id."'");
#   Actualizamos los rerigistros y los obtenemos

    $sql="SELECT * FROM graficas";
    $query=pg_query($sql);

    date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Gráficas','".$_SESSION['nom_usuario']."',1)");

    header("Location:graficas.php?elim_maq=si");

    # Creamos nuestra vista y la devolvemos al ajax
?>

