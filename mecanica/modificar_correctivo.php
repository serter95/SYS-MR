<?php
require("seguridad.php");
require("conexion.php");

$id=$_POST["id"];
//$encargado=$_POST["rev_maquina"];
$fecha=$_POST["fecha_falla"];


$observaciones=$_POST["observaciones"];
$responsable=$_POST["responsable"];
$hora=$_REQUEST["hora_falla"];
$pieza=$_REQUEST["pieza_cambio"];
$hora_arranque=$_REQUEST["hora_arranque"];
$hora_hombre=$_REQUEST["hora_hombre"];
$proveedor=$_REQUEST["proveedor"];
$servicio=$_REQUEST["tipo_servicio"];
$costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
$motivo=$_REQUEST["motivo"];
    # comparamos nombre de usuario

    //$sql="SELECT * FROM maquinas WHERE codigo='".$codigo."'";
	//$query=pg_query($sql);
	//$num=pg_num_rows($query);

	//$array=pg_fetch_assoc($query);



echo $sql2="UPDATE mant_correctivo SET fecha_falla='".$fecha."', hora_falla='".$hora."',
observaciones='".$observaciones."', pieza_recambio='".$pieza."', horas_arranque='".$hora_arranque."', horas_hombre='".$hora_hombre."',
tipo_servicio='".$servicio."',costo='".$costo."',proveedor='".$proveedor."', responsable='".$responsable."', motivo='".$motivo."' WHERE id_correctivo='".$id."'";

pg_query($sql2);


date_default_timezone_set('America/Caracas');

$hoy=date('Y-m-d h:i:s');

pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
    VALUES('$hoy','Modificación','Ejecución de Mantenemiento Correctivo','".$_SESSION['nom_usuario']."',1)");

header("Location:ejecucion_mant_correctivo.php?editado_maq=si");

		/*	$valor="exito";
			$datos = array(
				0 => $valor,
		    );
			echo json_encode($datos);
*/
			
			?>