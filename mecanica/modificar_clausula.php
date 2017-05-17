<?php
    require("seguridad.php");
    require("conexion.php");

$id=$_REQUEST["id"];
$id2=$_REQUEST["id2"];
$tipo=$_REQUEST["tipo"];

if($tipo=="clausula"){
        
        $clausula=$_REQUEST["clausula"];
    

      echo  $sql = "UPDATE clausulas SET contenido = '$clausula'  WHERE id_clausula= '$id'";
          pg_query($sql); 

          date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Clausulas','".$_SESSION['nom_usuario']."',1)");
      
            header("Location:convenios.php?editado_clau=si&num=$id2");   
  
}
else if($tipo=="seguimiento"){
        $seguimiento=$_REQUEST["seguimiento"];
    

      echo  $sql = "UPDATE clausulas SET seguimiento = '$seguimiento'  WHERE id_clausula= '$id'";
          pg_query($sql); 

date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Clausulas','".$_SESSION['nom_usuario']."',1)");
      
            header("Location:convenios.php?editado_clau=si&num=$id2");   
}

    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
    //$query=pg_query($sql);
    //$num=pg_num_rows($query);

    //$array=pg_fetch_assoc($query);


    
    



        /*  $valor="exito";
            $datos = array(
                0 => $valor,
            );
            echo json_encode($datos);
*/
        
?>