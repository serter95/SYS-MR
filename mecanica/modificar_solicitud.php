<?php
	require("seguridad.php");
	require("conexion.php");


$tipo=$_POST["tipo"];
if ($tipo=="correctivo"){


$id=$_POST["id"];
//$encargado=$_POST["rev_maquina"];




//$fecha=$_POST["fecha"];


$responsable=$_POST["responsable"];
$proveedor=$_REQUEST["proveedor"];
$servicio=$_REQUEST["tipo_servicio"];
$motivo=$_REQUEST["motivo"];
    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
	//$query=pg_query($sql);
	//$num=pg_num_rows($query);

	//$array=pg_fetch_assoc($query);



			$sql2="UPDATE mant_correctivo SET tipo_servicio='".$servicio."', proveedor='".$proveedor."', responsable='".$responsable."', motivo='".$motivo."'  WHERE id_correctivo='".$id."'";

			pg_query($sql2);

			date_default_timezone_set('America/Caracas');

			$hoy=date('Y-m-d h:i:s');

			pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				VALUES('$hoy','Modificacion','Mantenemiento Correctivo','".$_SESSION['nom_usuario']."',1)");

			header("Location:mant_correctivo.php?editado_maq=si");
}

else if($tipo=="preventivo"){
$id=$_POST["id"];
//$encargado=$_POST["rev_maquina"];




//$fecha=$_POST["fecha"];


$responsable=$_POST["responsable"];
$proveedor=$_REQUEST["proveedor"];
$servicio=$_REQUEST["tipo_servicio"];
$motivo=$_REQUEST["motivo"];
    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
	//$query=pg_query($sql);
	//$num=pg_num_rows($query);

	//$array=pg_fetch_assoc($query);



			$sql2="UPDATE mant_preventivo SET tipo_servicio='".$servicio."', proveedor='".$proveedor."', responsable='".$responsable."', motivo='".$motivo."'  WHERE id_preventivo='".$id."'";

			pg_query($sql2);

			date_default_timezone_set('America/Caracas');

			$hoy=date('Y-m-d h:i:s');

			pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
				VALUES('$hoy','Modificacion','Mantenemiento Preventivo','".$_SESSION['nom_usuario']."',1)");

			header("Location:mant_preventivo.php?editado_maq=si");
}
		/*	$valor="exito";
			$datos = array(
				0 => $valor,
		    );
			echo json_encode($datos);
*/
		
?>