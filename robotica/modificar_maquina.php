<?php
	require("seguridad.php");
	require("conexion.php");

$id=$_POST["id_maquinas"];
$idnb=$_POST["id_nb"];
$maquina=$_REQUEST["maquina"];
$pre_codigo=$_REQUEST["pre_codigo"];
$codigos=$_REQUEST["codigo"];
$marca=$_REQUEST["marca"];
$modelo=$_REQUEST["modelo"];
$nb=$_REQUEST["pre_nb"].$_REQUEST["n_b"];
$estado=$_REQUEST["estado"];
$preventivo=$_REQUEST["mantenimiento_p"];
$codigo="$pre_codigo"."$codigos";

$inputimagen=$_REQUEST["inputimagen"];

    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
	//$query=pg_query($sql);
	//$num=pg_num_rows($query);

	//$array=pg_fetch_assoc($query);

			$sql_id_nb="UPDATE numero_bien SET nb='".$nb."' WHERE id_nb='".$idnb."'";
			pg_query($sql_id_nb);


			$sql="UPDATE maquinas SET codigo='".$codigo."', n_b='".$idnb."', marca='".$marca."', 
			modelo='".$modelo."', estado='".$estado."',  maquina='".$maquina."',modificado=now(), estatus=1 WHERE id_maquina='".$id."'";

#echo $sql;

#echo "exito";

			pg_query($sql);
		
	//	header("Location:maquinas.php?editado_maq=si");
			
		/*	$valor="exito";
			$datos = array(
				0 => $valor,
		    );
			echo json_encode($datos);
*/


  
            $picture = $_FILES['imagen']['name'];

$formatos = array('.jpg', '.png','.jpeg', '.JPEG', '.JPG');
    $nombreOrigArchivo = $_FILES['imagen']['name'];
        $nombreTmpArchivo = $_FILES['imagen']['tmp_name'];
$ext = substr($nombreOrigArchivo, strrpos($nombreOrigArchivo, '.'));
if($picture==""){
if ($inputimagen==""){
 $sqli = "UPDATE maquinas SET imagen ='imagenes/Sin_Imagen.JPG' WHERE id_maquina = '$id'";

                $resultado = pg_query($sqli);
header("Location:maquinas.php?editado_maq=si");  }
else {
     $sqli = "UPDATE maquinas SET imagen ='$inputimagen' WHERE id_maquina = '$id'";

                $resultado = pg_query($sqli);
header("Location:maquinas.php?editado_maq=si");  
}
}
else{
//------------------------------------Sobre pasando los limites---------------------------

if(in_array($ext, $formatos)){


            $slq_img = "SELECT * FROM maquinas WHERE id_maquina='$id'";

            $resultado_img = pg_query($slq_img);

                        //if($rows_img > 0){

                while ($datos = pg_fetch_array($resultado_img)) {

                    $id_usu = $datos['id_maquina'];

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
            
            if(move_uploaded_file($nombreTmpArchivo, "imagenes/$nombreArchivo")){

                $sqli = "UPDATE maquinas SET imagen ='imagenes/$nombreArchivo' WHERE id_maquina = '$id'";

                $resultado = pg_query($sqli);
?>
                <!--<script type="text/javascript"> alert('Se ha configurado su cuenta2');</script>-->
<?php
 //header("Location:maquinas.php?registrado_maq=si"); 
header("Location:maquinas.php?editado_maq=si");
            }

            else{
?>
                <script type="text/javascript"> alert('No se puedo subir el archivo');</script>
<?php
 header("Location:maquinas.php?editado_maq=si"); 
            }


        }

        else{

            $sqli = "UPDATE maquinas SET imagen = '$nombreArchivo' WHERE id_maquina = '$id'";
            $resultado = pg_query($sqli);

?>

                <!--<script type="text/javascript"> alert('Se ha configurado su cuentax');</script>-->
<?php
header("Location:maquinas.php?editado_maq=si");
 //header("Location:maquinas.php?registrado_maq=si");

        }

    }
		
?>