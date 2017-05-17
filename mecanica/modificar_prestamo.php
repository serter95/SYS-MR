<?php
    require("seguridad.php");
    require("conexion.php");

 $id=$_REQUEST["id"];
 $id_herra=$_REQUEST["id_herra"];
//$encargado=$_REQUEST["rev_maquina"];

 $tipo=$_REQUEST["tipo"];
 $estado=$_REQUEST["estado"];

/*$d=explode('/', $_REQUEST["devolucion"]);
$devolucion=$d[2].'-'.$d[1].'-'.$d[0];
*/
$devolucion=date('Y-m-d');

if($estado=="Activo")
{
header("Location:herramientas.php");

}
else{
    if($devolucion==""){
        header("Location:herramientas.php");

    }

    else{

         $sql="UPDATE prestamo SET estado_prestamo='$estado', devolucion='$devolucion' WHERE id_prestamo='$id'";
        pg_query($sql); 

        date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Prestamo','".$_SESSION['nom_usuario']."',1)");

          $buscar="SELECT * FROM herramientas WHERE id_herramienta='$id_herra'";
          $busq=pg_query($buscar);

          $array=pg_fetch_assoc($busq);

          echo $num=(int)$array['cantidad_p'];
       echo   $cantidad=$num-1;
       $cantidad=(int)$cantidad;

       if($cantidad<0){
        $cantidad="0";
       }
       else{
        $cantidad=(int)$cantidad;
       }

      echo $sqlx = "UPDATE herramientas SET cantidad_p = $cantidad WHERE id_herramienta='$id_herra'";
       
        pg_query($sqlx);   

        date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Herramientas','".$_SESSION['nom_usuario']."',1)");

            if($tipo=="externo"){
               header("Location:herramientas.php?devolucion_herra=si");   
            }
            elseif ($tipo=="interno") {
            header("Location:herramientas.php?devolucion_herra=si");   

            }
    }

}
        
?>