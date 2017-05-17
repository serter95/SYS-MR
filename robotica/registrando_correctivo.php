<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim(isset($_REQUEST["nac_usu"]))&&trim(isset($_REQUEST["ci_usu"]))&&trim(isset($_REQUEST["n_b"]))&&trim(isset($_REQUEST["codigo"]));
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
header("Location:mant_correctivo.php");
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{
$service=$_REQUEST["tipo_servicio"];
	if($service=='interno'){
	$id_maq=$_REQUEST["id_maq"];
	$id_per=$_REQUEST["id_per"];
	

	/*$fecha=$_REQUEST["fecha"];
	$fecha=explode("/", $fecha);
  	$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];*/	

	$responsable=$_REQUEST["responsable"];
	$sqlm="INSERT INTO mant_correctivo(fecha,id_maquina,id_personal,tipo_servicio,responsable)
	VALUES('now()','".$id_maq."','".$id_per."','".$service."','".$responsable."')";
	pg_query($sqlm);
	header("Location:mant_correctivo.php?registrado_maq=si");

	?>

		<!--<script language="javascript">
		alert("manteniminto preventivo");
		window.location.href="maquinas.php";
	</script>	-->
	<?php
	
}

else if ($service=='externo'){

	$id_maq=$_REQUEST["id_maq"];
	$id_per=$_REQUEST["id_per"];
	

	/*$fecha=$_REQUEST["fecha"];
	$fecha=explode("/", $fecha);
  	$fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
	*/
	$proveedor=$_REQUEST["provedor"];
	$responsable=$_REQUEST["responsable"];
	$sqlm2="INSERT INTO mant_correctivo(fecha,id_maquina,id_personal,tipo_servicio,proveedor,responsable)
	VALUES('now()','".$id_maq."','".$id_per."','".$service."','".$proveedor."','".$responsable."')";
	pg_query($sqlm2);
	header("Location:mant_correctivo.php?registrado_maq=si");

	?>

		<!--<script language="javascript">
		alert("manteniminto preventivo");
		window.location.href="maquinas.php";
	</script>	-->
	<?php
	

}

}
//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

