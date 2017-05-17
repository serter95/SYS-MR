<?php
    require("seguridad.php");
    require("conexion.php");

$id=$_REQUEST["id"];
//$encargado=$_REQUEST["rev_maquina"];
$fecha=$_REQUEST["fecha_falla"];


//$code=$_REQUEST["codigo"];
//$codigo=ucwords($code);
$nombre=$_REQUEST["nombre"];
$nbv=$_REQUEST["n_bv"];
$nb=$_REQUEST["pre_nb"].$_REQUEST["n_b"];
$tipo=$_REQUEST["tipo_medida"];
$medida=$_REQUEST["medida"];
$estado=$_REQUEST["estado"];
$precio=$_REQUEST["precio"]." ".$_REQUEST["moneda"];
$existencia=$_REQUEST["existencia"];
$pres=$_REQUEST["pre_serial"];
        if($pres=="S/Serial"){
            $serial="S/Serial";
        }else{
            $serial=$_REQUEST["serial"];

        }$marca=$_REQUEST["marca"];
$minimo=$_REQUEST["minimo"];
$recambio=$_REQUEST["recambio"];
$importe=$_REQUEST["importe"]." ".$_REQUEST["moneda"];
$ubicacion=$_REQUEST["ubicacion"];
$estante=$_REQUEST["estante"];

$idnb=$_POST["id_nb"];

$inputimagen=$_REQUEST["inputimagen"];

    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
    //$query=pg_query($sql);
    //$num=pg_num_rows($query);

    //$array=pg_fetch_assoc($query);

$sql_id_nb="UPDATE numero_bien SET nb='".$nb."' WHERE id_nb='".$idnb."'";
            pg_query($sql_id_nb);




            /*$sql2="UPDATE herramientas SET codigo_herramienta='".$codigo."', n_bv='".$nbv."', n_b='".$idnb."',
            nombre='".$nombre."', serial='".$serial."', marca='".$marca."', estado='".$estado."',
            precio_unitario='".$precio."',existencia='".$existencia."', 
              min_stock='".$minimo."', recambio='".$recambio."', 
              ubicacion='".$ubicacion."' WHERE id_herramienta='".$id."'";
*/  

              $sql2="UPDATE herramientas SET n_b='".$idnb."', 
              tipo_medida='".$tipo."', medida='".$medida."', cantidad='".$existencia."',
            nombre='".$nombre."', serial='".$serial."', marca='".$marca."', estado='".$estado."',         
              ubicacion='".$ubicacion."', estante='".$estante."' WHERE id_herramienta='".$id."'";
            pg_query($sql2);
       
          date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Modificación','Herramientas','".$_SESSION['nom_usuario']."',1)");
  
            $picture = $_FILES['imagen']['name'];

$formatos = array('.jpg', '.png','.jpeg', '.JPEG', '.JPG');
    $nombreOrigArchivo = $_FILES['imagen']['name'];
        $nombreTmpArchivo = $_FILES['imagen']['tmp_name'];
$ext = substr($nombreOrigArchivo, strrpos($nombreOrigArchivo, '.'));
if($picture==""){
if ($inputimagen==""){
 $sql = "UPDATE herramientas SET imagen ='imagenes/herramientas/Sin_Imagen.JPG' WHERE id_herramienta = '$id'";

                $resultado = pg_query($sql);
header("Location:herramientas.php?editado_maq=si");  }
else {
     $sql = "UPDATE herramientas SET imagen ='$inputimagen' WHERE id_herramienta = '$id'";

                $resultado = pg_query($sql);
header("Location:herramientas.php?editado_maq=si");  
}
}
else{
//------------------------------------Sobre pasando los limites---------------------------

if(in_array($ext, $formatos)){


            $slq_img = "SELECT * FROM herramientas WHERE id_herramienta='$id'";

            $resultado_img = pg_query($slq_img);

                        //if($rows_img > 0){

                while ($datos = pg_fetch_array($resultado_img)) {

                    $id_usu = $datos['id_herramienta'];

                }

                /*$nomImagen_explode = explode( "/" , $nomImagen);
                
                $con_cadena = count($nomImagen_explode);*/

                $nombreArchivo = ($id_usu).$ext;

            //}

            /*else {

                $nombreArchivo = 1;

            }*/

        }
        else{

            $nombreArchivo = 'noimagen';


        }
        if($nombreArchivo != 'noimagen'){
            
            if(move_uploaded_file($nombreTmpArchivo, "imagenes/herramientas/$nombreArchivo")){

                $sql = "UPDATE herramientas SET imagen ='imagenes/herramientas/$nombreArchivo' WHERE id_herramienta = '$id'";

                $resultado = pg_query($sql);
?>
                <!--<script type="text/javascript"> alert('Se ha configurado su cuenta2');</script>-->
<?php
 //header("Location:maquinas.php?registrado_maq=si"); 
header("Location:herramientas.php?editado_maq=si");
            }

            else{
?>
                <script type="text/javascript"> alert('No se puedo subir el archivo');</script>
<?php
 header("Location:herramientas.php?editado_maq=si"); 
            }


        }

        else{

            $sql = "UPDATE herramientas SET imagen = '$nombreArchivo' WHERE id_herramienta = '$id'";
            $resultado = pg_query($sql);

?>

                <!--<script type="text/javascript"> alert('Se ha configurado su cuentax');</script>-->
<?php
header("Location:herramientas.php?editado_maq=si");
 //header("Location:maquinas.php?registrado_maq=si");

        }

    }
    



        /*  $valor="exito";
            $datos = array(
                0 => $valor,
            );
            echo json_encode($datos);
*/
        
?>