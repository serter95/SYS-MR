<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["codigo"])&&trim($_REQUEST["existencia"])&&trim($_REQUEST["minimo"])&&trim($_REQUEST["buenas"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if (empty($recibiendo)){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="insumos.php";
	</script>-->
	<?php
header("Location:insumos.php");
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

		$code=$_REQUEST["codigo"];
		$codigo=ucwords($code);
		$nombre=ucwords($_REQUEST["nombre"]);
		$pre=$_REQUEST["pre_nb"];
		$nb=$_REQUEST["pre_nb"].$_REQUEST["n_b"];
		$tipo_medida=$_REQUEST["tipo_medida"];
		$medida2=$_REQUEST["medida2"];
		$medida1=$_REQUEST["medida1"];

		if(!empty($medida2)){
			$medida=$_REQUEST["medida1"]."/".$_REQUEST["medida2"];
		}
		else if(!empty($medida1)){
			$medida=$_REQUEST["medida1"];
		}
		else{
			$medida=$_REQUEST["medida"];
		}

		if ($medida=="")
		{
			$medida=0;
		}
		//$precio=$_REQUEST["precio"];
		$responsable=$_REQUEST["responsable"];
		$existencia=$_REQUEST["existencia"];
		$precio=$_REQUEST["precio"].' '.$_REQUEST["moneda"];
		$buenas=$_REQUEST["buenas"];
		$danadas=$_REQUEST["danadas"];
		$max=$_REQUEST["maximo"];
		$min=$_REQUEST["minimo"];

		$importe=$_REQUEST["importe"].' '.$_REQUEST["moneda"];
		$ubicacion=$_REQUEST["ubicacion"];
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
		$sqlm="INSERT INTO insumos(codigo_insumo,nombre,n_b,tipo_medida,medida,precio_unitario,existencia,buenas,danadas,min_stock,importe,ubicacion,max_stock,taller)
		VALUES('".$codigo."','".$nombre."','".$id_nb."','".$tipo_medida."','".$medida."','".$precio."','".$existencia."','".$buenas."','".$danadas."','".$min."','".$importe."','".$ubicacion."','".$max."','2')";
		pg_query($sqlm);

		date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Registro','Insumos','".$_SESSION['nom_usuario']."')");

		header("Location:insumos.php?registrado_maq=si");		
		}
		else if ($c_nb==$nb){
			?>
	<script language="javascript">
		alert("Ya existe el codigo del bien");
		location.href="insumos.php?form_error=1";
	</script>
	<?php

		}
		/*else if($existencia>$max){
?>
<script type="text/javascript">
    alert("la existencia no puede ser mayor al maximo");
        window.location.href="insumos.php";
</script>

<?php
		}*/
		else{

//----------------End validacion existe nb php------------

		$sqlnb="INSERT INTO numero_bien(nb)VALUES('".$nb."')";
		pg_query($sqlnb);

		$selectnb="SELECT * FROM numero_bien WHERE nb='".$nb."'";

		$querynb=pg_query($selectnb);
	    //$contar=pg_num_rows($query);
	    $array=pg_fetch_assoc($querynb);

	    $id_nb=$array["id_nb"];

		$sqlm="INSERT INTO insumos(codigo_insumo,nombre,n_b,tipo_medida,medida,precio_unitario,existencia,buenas,danadas,min_stock,importe,ubicacion,max_stock,taller)
		VALUES('".$codigo."','".$nombre."','".$id_nb."','".$tipo_medida."','".$medida."','".$precio."','".$existencia."','".$buenas."','".$danadas."','".$min."','".$importe."','".$ubicacion."','".$max."','2')";
		pg_query($sqlm);

		date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Registro','Insumos','".$_SESSION['nom_usuario']."')");

		header("Location:insumos.php?registrado_maq=si");
		

	}
	}
	

//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

