<?php
    require("seguridad.php");
    require("conexion.php");

$id=$_REQUEST["id"];

//$encargado=$_REQUEST["rev_maquina"];


$titulo=$_REQUEST["titulo"];
        $titulo=ucwords($titulo);
        $ente1=$_REQUEST["ente1"];
        $ente2=$_REQUEST["ente2"];

        $fechai=$_REQUEST["fechai"];
        $fechaf=$_REQUEST["fechaf"];

        $contratante=$_REQUEST["contratante"];
        $contratado=$_REQUEST["contratado"];
        
        //$clausulas=$_REQUEST["clausulas"];
    

        $sql = "UPDATE convenios SET titulo = '$titulo', ente1='$ente1', ente2='$ente2', contratante='$contratante', contratado='$contratado', fecha_inicio='$fechai', fecha_final='$fechaf' WHERE id_convenio= '$id'";
            pg_query($sql); 

        date_default_timezone_set('America/Caracas');

    $hoy=date('Y-m-d h:i:s');

    pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Modificación','Convenios','".$_SESSION['nom_usuario']."')");

            header("Location:convenios.php?editado_maq=si");   
  


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