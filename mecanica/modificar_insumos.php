<?php
    require("seguridad.php");
    require("conexion.php");

$id=$_REQUEST["id"];
//$encargado=$_REQUEST["rev_maquina"];
$fecha=$_REQUEST["fecha_falla"];
//$code=$_REQUEST["codigo"];
//$codigo=ucwords($code);
$nombre=$_REQUEST["nombre"];
$nb=$_REQUEST["pre_nb"].$_REQUEST["n_b"];
$tipo=$_REQUEST["tipo_medida"];
$medida=$_REQUEST["medida"];
$precio=$_REQUEST["precio"]." ".$_REQUEST["moneda"];
$existencia=$_REQUEST["existencia"];
$buenas=$_REQUEST["buenas"];
$danadas=$_REQUEST["danadas"];
$minimo=$_REQUEST["minimo"];
$maximo=$_REQUEST["maximo"];
$importe=$_REQUEST["importe"]." ".$_REQUEST["moneda"];
$ubicacion=$_REQUEST["ubicacion"];
$idnb=$_POST["id_nb"];
$estante=$_REQUEST["estante"];
/*if($existencia>$maximo){
?>
<script type="text/javascript">
    alert("la existencia no puede ser mayor al maximo");
        window.location.href="insumos.php";
</script>

<?php
}
else{*/
    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
    //$query=pg_query($sql);
    //$num=pg_num_rows($query);

    //$array=pg_fetch_assoc($query);
            $sql_id_nb="UPDATE numero_bien SET nb='".$nb."' WHERE id_nb='".$idnb."'";
            pg_query($sql_id_nb);



            $sql2="UPDATE insumos SET n_b='".$idnb."',
            nombre='".$nombre."', tipo_medida='".$tipo."', medida='".$medida."',
            precio_unitario='".$precio."',existencia='".$existencia."', buenas='".$buenas."',
             danadas='".$danadas."', min_stock='".$minimo."', max_stock='".$maximo."',
             importe='".$importe."', ubicacion='".$ubicacion."', estante='".$estante."' WHERE id_insumos='".$id."'";

            pg_query($sql2);

            date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Insumos','".$_SESSION['nom_usuario']."',1)");

            header("Location:insumos.php?editado_maq=si");
            
        /*  $valor="exito";
            $datos = array(
                0 => $valor,
            );
            echo json_encode($datos);
*/
  //   }   
?>