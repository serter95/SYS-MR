<?php

include("conexion.php");
include("seguridad.php");
?>
<?php
$recibiendo=trim($_REQUEST["maquina"])&&trim($_REQUEST["n_b"])&&trim($_REQUEST["codigo"])&&trim($_REQUEST["estado"])&&trim($_REQUEST["marca"])&&trim($_REQUEST["modelo"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
?>
	<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>
<?php
header("Location:maquinas.php");
}


$pre_nb=$_REQUEST["pre_nb"];
$n_b=$_REQUEST["n_b"];
$maquina=$_REQUEST["maquina"];
//$pre_codigo=$_REQUEST["pre_codigo"];
//$codigos=$_REQUEST["codigo"];
$marca=$_REQUEST["marca"];
$modelo=$_REQUEST["modelo"];
$nb="$pre_nb"."$n_b";
$estado=$_REQUEST["estado"];
$picture = $_FILES['imagen']['name'];
if (!eregi("^[A-Za-z0-9-]{4,10}$",$nb)){
?>
	<script language="javascript">
		alert("Se coloco una expresion diferente a un numero en el campo de N/B");
		window.location.href="maquinas.php";
	</script>	
<?php
header("Location:maquinas.php?form_error=2");
}

else if (!eregi("^[ /A-Za-záéíóúñÁÉÍÓÚÑ0-9.-]{3,20}$",$marca)){
?>
	<script language="javascript">
		alert("Error en el campo de marca");
		window.location.href="maquinas.php";
	</script>	
<?php
header("Location:maquinas.php?form_error=3");
}

else if (!eregi("^[ /A-Za-záéíóúñÁÉÍÓÚÑ0-9.-]{4,20}$",$modelo)){
?>
	<script language="javascript">
		alert("Error en el campo de modelo");
		window.location.href="maquinas.php";
	</script>	
<?php
header("Location:maquinas.php?form_error=4");
}

else{
if ($maquina!=""){

$busca="SELECT * FROM tipo_maquina WHERE nombre='$maquina' AND estatus=1";
$query=pg_query($busca);
$array2=pg_fetch_assoc($query);

$code=$array2['codigo'];

	$sqf = "SELECT * FROM maquinas WHERE codigo LIKE '$code%'  ORDER BY id_maquina ASC";
				$resul = pg_query($sqf);
				while ($row = pg_fetch_assoc($resul)) {
					$m = $row['codigo'];
				}
				if(empty($m)) {
						$codigo = $code.'1';
					}
				else {
						$f = explode($code, $m);
						$x = $f[1];
						$codigo = $code . ($x + 1);
					}

}

		else {
				echo "maquina no existe";
			}
						
//--------------Pequeña validacion existe nb php-----------
		$buscanb="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";
		$arrayc=pg_fetch_assoc(pg_query($buscanb));
		$c_nb=$arrayc["nb"];
		if ($c_nb==$nb){
			?>
	<script language="javascript">
		alert("Ya existe el codigo del bien");
		location.href="maquinas.php?form_error=1";
	</script>
	<?php

		}
		else{

//----------------End validacion existe nb php------------

		echo $sqlnb="INSERT INTO numero_bien(nb)VALUES('".$nb."')";
		pg_query($sqlnb);

		$selectnb="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";

		$querynb=pg_query($selectnb);
	    //$contar=pg_num_rows($query);
	    $array=pg_fetch_assoc($querynb);

	    $id_nb=$array["id_nb"];

	$sqlx="INSERT INTO maquinas(maquina,codigo,n_b,estado,marca,modelo,modificado)
 VALUES('".$maquina."','".$codigo."','".$id_nb."','".$estado."','".$marca."','".$modelo."','now()')";
 pg_query($sqlx);
 //echo "<br><br>".$sqlx;

 date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Máquinas','".$_SESSION['nom_usuario']."',1)");
			 if($picture==""){

				header("Location:maquinas.php?registrado_maq=si");	

			} 
}    
          
           
}
         //  mysql_close($db_db);



$codigos=$_REQUEST["codigo"];
$formatos = array('.jpg', '.png','.jpeg', '.JPEG', '.JPG','.PNG');
	$nombreOrigArchivo = $_FILES['imagen']['name'];
		$nombreTmpArchivo = $_FILES['imagen']['tmp_name'];
$ext = substr($nombreOrigArchivo, strrpos($nombreOrigArchivo, '.'));
if($picture==""){

//header("Location:maquinas.php?registrado_maq=si");	

}
else{
//------------------------------------Sobre pasando los limites---------------------------

if(in_array($ext, $formatos)){


			$slq_img = "SELECT * FROM maquinas";

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
			header("Location:maquinas.php?registrado_maq=si");	

		}
		if($nombreArchivo != 'noimagen'){
			
			if(move_uploaded_file($nombreTmpArchivo, "imagenes/$nombreArchivo")){

				$sql = "UPDATE maquinas SET imagen ='imagenes/$nombreArchivo' WHERE codigo = '$codigos'";

				$resultado = pg_query($sql);
?>
				<!--<script type="text/javascript"> alert('Se ha configurado su cuenta2');</script>-->
<?php
 //header("Location:maquinas.php?registrado_maq=si"); 
header("Location:maquinas.php?registrado_maq=si");
			}

			else{
?>
				<script type="text/javascript"> alert('No se puedo subir el archivo');</script>
<?php
// header("Location:maquinas.php?registrado_maq=si"); 
			}


		}

		else{

			$sql = "UPDATE maquinas SET imagen = '$nombreArchivo' WHERE codigo = '$codigos'";
			$resultado = pg_query($sql);

?>

				<!--<script type="text/javascript"> alert('Se ha configurado su cuentax');</script>-->
<?php
header("Location:maquinas.php?registrado_maq=si");
 //header("Location:maquinas.php?registrado_maq=si");

		}

}
//else
//{
//	header('Location:maquinas.php');
//}

//}



?>

