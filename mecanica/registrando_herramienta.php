<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["pre_nb"])&&trim($_REQUEST["marca"])&&trim($_REQUEST["nombre"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
header("Location:herramientas.php");
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{

		//$id_per=$_REQUEST["id_per"];

		//$id_maq=$_REQUEST["id_maq"];
		/*$nombre=$_REQUEST["nombres_usu"];
		$apellido=$_REQUEST["apellidos_usu"];

		$nom=explode(' ', $nombre);
		$pri=$nom[0].' ';
		$seg=$nom[1];

		$ape=explode(' ', $apellido);
		$pria=$ape[0];
		$sega=$ape[1];


		$encargado=$pri.$pria;
*/

		
		$nombre=$_REQUEST["nombre"];
		$pre=$_REQUEST["pre_nb"];
		$nb=$_REQUEST["pre_nb"].$_REQUEST["n_b"];

			$tipo_medida=$_REQUEST["tipo_medida"];
		$medida2=$_REQUEST["medida2"];
		$medida1=$_REQUEST["medida1"];
		$estante=$_REQUEST["estante"];

		if(!empty($medida2)){
			$medida=$_REQUEST["medida1"]."/".$_REQUEST["medida2"];
		}
		else if(!empty($medida1)){
			$medida=$_REQUEST["medida1"];
		}
		else{
			$medida=$_REQUEST["medida"];
		}
		//$nbv=$_REQUEST["n_bv"];
		//$tipo_medida=$_REQUEST["tipo_medida"];
		//$medida=$_REQUEST["medida"];
		#$precio=$_REQUEST["precio"];
		//$responsable=$_REQUEST["responsable"];
		$cantidad=$_REQUEST["existencia"];
		//$precio=$_REQUEST["precio"].' '.$_REQUEST["moneda"];
		#$buenas=$_REQUEST["buenas"];
		#$danadas=$_REQUEST["danadas"];
		//$min=$_REQUEST["minimo"];
		//$recambio=$_REQUEST["recambio"];
		#$importe=$_REQUEST["importe"].' '.$_REQUEST["moneda"];
		$ubicacion=$_REQUEST["ubicacion"];
		$pres=$_REQUEST["pre_serial"];
		if($pres=="S/Serial"){
			$serial="S/Serial";
		}else{
			$serial=$_REQUEST["serial"];

		}
		$marca=$_REQUEST["marca"];
		$estado=$_REQUEST["estado"];
		//--------------Pequeña validacion existe nb php-----------
		$buscanb="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";
		$arrayc=pg_fetch_assoc(pg_query($buscanb));
		$c_nb=$arrayc["nb"];
		if($pre=="S/NB"){
			
		$sqlnb="INSERT INTO numero_bien(nb)VALUES('".$pre."')";
		pg_query($sqlnb);

		$selectnb="SELECT * FROM numero_bien WHERE nb='".$pre."' ORDER BY id_nb DESC";
		$querynb=pg_query($selectnb);
	    //$contar=pg_num_rows($query);
	    $array=pg_fetch_assoc($querynb);

	    $id_nb=$array["id_nb"];		
		 $sqlm="INSERT INTO herramientas(nombre,n_b,serial,marca,estado,tipo_medida,medida,cantidad,ubicacion,taller,estante)
		VALUES('".$nombre."','".$id_nb."','".$serial."','".$marca."','".$estado."','".$tipo_medida."','".$medida."','".$cantidad."','".$ubicacion."','1','".$estante."')";
		pg_query($sqlm);

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Herramientas','".$_SESSION['nom_usuario']."',1)");
		}
		else if ($c_nb==$nb){
			?>
	<script language="javascript">
		alert("Ya existe el numero del bien");
		location.href="herramientas.php?form_error=1";
	</script>
	<?php

		}
		else{
//----------------End validacion existe nb php------------

		$sqlnb="INSERT INTO numero_bien(nb)VALUES('".$nb."')";
		pg_query($sqlnb);

		$selectnb="SELECT * FROM numero_bien WHERE nb='".$nb."' AND estatus=1";
		$querynb=pg_query($selectnb);
	    //$contar=pg_num_rows($query);
	    $array=pg_fetch_assoc($querynb);

	    $id_nb=$array["id_nb"];
	    $sqlm="INSERT INTO herramientas(nombre,n_b,serial,marca,estado,tipo_medida,medida,cantidad,ubicacion,taller,estante)
		VALUES('".$nombre."','".$id_nb."','".$serial."','".$marca."','".$estado."','".$tipo_medida."','".$medida."','".$cantidad."','".$ubicacion."','1','".$estante."')";
		pg_query($sqlm);

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Herramientas','".$_SESSION['nom_usuario']."',1)");
	}

	$picture = $_FILES['imagen']['name'];

$formatos = array('.jpg', '.png','.jpeg', '.JPEG', '.JPG');
	$nombreOrigArchivo = $_FILES['imagen']['name'];
		$nombreTmpArchivo = $_FILES['imagen']['tmp_name'];
$ext = substr($nombreOrigArchivo, strrpos($nombreOrigArchivo, '.'));
if($picture==""){

header("Location:herramientas.php?registrado_maq=si");	

}
else{
//------------------------------------Sobre pasando los limites---------------------------

if(in_array($ext, $formatos)){


			$slq_img = "SELECT * FROM herramientas";

			$resultado_img = pg_query($slq_img);

						//if($rows_img > 0){

				while ($datos = pg_fetch_array($resultado_img)) {

					$id_usu = $datos['id_herramienta'];

				}

				/*$nomImagen_explode = explode( "/" , $nomImagen);
				
				$con_cadena = count($nomImagen_explode);*/

				$nombreArchivo = ($id_usu + 1).$ext;

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

				$sql = "UPDATE herramientas SET imagen ='imagenes/herramientas/$nombreArchivo' WHERE n_b = '$id_nb'";

				$resultado = pg_query($sql);
?>
				<!--<script type="text/javascript"> alert('Se ha configurado su cuenta2');</script>-->
<?php
 //header("Location:maquinas.php?registrado_maq=si"); 
header("Location:herramientas.php?registrado_maq=si");
			}

			else{
?>
				<script type="text/javascript"> alert('No se puedo subir el archivo');</script>
<?php
 header("Location:herramientas.php?registrado_maq=si"); 
			}


		}

		else{

			$sql = "UPDATE herramientas SET imagen = '$nombreArchivo' WHERE n_b = '$id_nb'";
			$resultado = pg_query($sql);

?>

				<!--<script type="text/javascript"> alert('Se ha configurado su cuentax');</script>-->
<?php
header("Location:herramientas.php?registrado_maq=si");
 //header("Location:maquinas.php?registrado_maq=si");

		}

	}
	
}
//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

