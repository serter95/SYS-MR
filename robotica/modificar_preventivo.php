<?php
	require("seguridad.php");
	require("conexion.php");

$id=$_POST["id"];
$encargado=$_POST["rev_maquina"];
//$fecha=$_POST["fecha"];

if($_POST["niv_aceite"]==""){
$aceite="No";
}
else{
	$aceite=$_POST["niv_aceite"];
}

$observaciones=$_POST["observaciones"];

$luces=$_REQUEST["luces_mod"];
	$parada=$_REQUEST["parada_mod"];
	$pulsadores=$_REQUEST["pulsadores_mod"];
	$responsable=$_POST["responsable"];
	$hora_hombre=$_REQUEST["hora_hombre"];
	$proveedor=$_REQUEST["proveedor"];
	$servicio=$_REQUEST["tipo_servicio"];
	$costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
    # comparamos nombre de usuario
	$imprevisto=$_REQUEST["imprevisto"];
	
	#if ($_POST["imprevisto"]=="No")
	#{
	#	$fechai="agua";
	#	$detallei="agua2";
	#}
	#else{
		$fechai=$_REQUEST["fechai"];
		$detallei=$_REQUEST["detallei"];
	#}
	
    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
	//$query=pg_query($sql);
	//$num=pg_num_rows($query);

	//$array=pg_fetch_assoc($query);
if ($imprevisto=="No"){

			$fechai=date('d/m/Y');

			$sql2="UPDATE mant_preventivo SET nivel_aceite='".$aceite."', 
			luces_tablero='".$luces."',parada_emergencia='".$parada."',pulsadores='".$pulsadores."',observaciones='".$observaciones."',
			horas_hombre='".$hora_hombre."', tipo_servicio='".$servicio."',costo='".$costo."',proveedor='".$proveedor."',
			 responsable='".$responsable."', imprevisto='".$imprevisto."', fecha_imprevisto='".$fechai."', detalle_imprevisto='".$detallei."' WHERE id_preventivo='".$id."'";

		#	 echo $sql2;
			pg_query($sql2);

			header("Location:ejecucion_mant_preventivo.php?editado_maq=si");
			
}
else{

			$sql2="UPDATE mant_preventivo SET  nivel_aceite='".$aceite."', 
			luces_tablero='".$luces."',parada_emergencia='".$parada."',pulsadores='".$pulsadores."',observaciones='".$observaciones."',
			horas_hombre='".$hora_hombre."', tipo_servicio='".$servicio."',costo='".$costo."',proveedor='".$proveedor."',
			 responsable='".$responsable."', imprevisto='".$imprevisto."', fecha_imprevisto='".$fechai."', detalle_imprevisto='".$detallei."'
			  WHERE id_preventivo='".$id."'";
			#   echo $sql2;
			pg_query($sql2);
			header("Location:ejecucion_mant_preventivo.php?editado_maq=si");

}
		/*	$valor="exito";
			$datos = array(
				0 => $valor,
		    );
			echo json_encode($datos);
*/
		
?>