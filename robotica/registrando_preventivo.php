<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim(isset($_REQUEST["nac_usu"]))&&trim(isset($_REQUEST["ci_usu"]))&&trim(isset($_REQUEST["n_b"]))&&trim(isset($_REQUEST["codigo"]))&&trim(isset($_REQUEST["nombres_usu"]))&&trim(isset($_REQUEST["apellidos_usu"]));
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error

	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
header("Location:mant_preventivo.php");
	
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{
	$service=$_REQUEST["tipo_servicio"];
	if($service=='interno'){
		$id_per=$_REQUEST["id_per"];

		$id_maq=$_REQUEST["id_maq"];
		

		
	/*	$fecha=$_REQUEST["fecha"];
		$fecha=explode("/", $fecha);
  		$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];*/
		$responsable=$_REQUEST["responsable"];
	

		$sqlm="INSERT INTO mant_preventivo(fecha,maquina_id,responsable,id_personal,tipo_servicio)
		VALUES('now()','".$id_maq."','".$responsable."','".$id_per."','".$service."')";
		pg_query($sqlm);
		header("Location:mant_preventivo.php?registrado_maq=si");

	}
	else if ($service=='externo'){
		$id_maq=$_REQUEST["id_maq"];
		$id_per=$_REQUEST["id_per"];

		
		
		//if ($repuestoE1!=""){	

/*		$fecha=$_REQUEST["fecha"];
		$fecha=explode("/", $fecha);
  		$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];*/
		$proveedor=$_REQUEST["provedor"];
		$responsable=$_REQUEST["responsable"];
		echo $sqlm2="INSERT INTO mant_preventivo(fecha,maquina_id,proveedor,responsable,id_personal,tipo_servicio)
		VALUES('now()','".$id_maq."','".$proveedor."','".$responsable."','".$id_per."','".$service."')";
		pg_query($sqlm2);



			
		header("Location:mant_preventivo.php?registrado_maq=si");
		//echo $sqlm2;
		?>

		<!--<script language="javascript">
		alert("manteniminto preventivo");
		window.location.href="maquinas.php";
	</script>	-->
	<?php
	
}

//---------------------------------------Hasta aqui funciona todo calidad------------------------
}
              //no existe usuario
	



         //  mysql_close($db_db);


?>

