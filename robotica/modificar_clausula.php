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

      
            header("Location:convenios.php?editado_clau=si&num=$id2");   
  
}
else if($tipo=="seguimiento"){
        $seguimiento=$_REQUEST["seguimiento"];
    

      echo  $sql = "UPDATE clausulas SET seguimiento = '$seguimiento'  WHERE id_clausula= '$id'";
          pg_query($sql); 

      
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