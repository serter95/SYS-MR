<?php
include("seguridad.php");
include("conexion.php");

		$id=$_REQUEST["id_herra"];
		$id_per=$_REQUEST["id_per"];
		$responsable=$_REQUEST['responsable'];
		
		$f=explode("/", $_REQUEST["fecha"]);
		$fecha=$f[2]."-".$f[1]."-".$f[0];

		$f2=explode("/", $_REQUEST["fecha2"]);
		$fecha2=$f2[2]."-".$f2[1]."-".$f2[0];
		
		$tipo=$_REQUEST["tipo"];			

	echo	$sql2="INSERT INTO prestamo(responsable,id_herramienta,realizado,tentativa,estado_prestamo,id_personal)
		VALUES('".$responsable."','".$id."','".$fecha."','".$fecha2."','Activo','".$id_per."')";
		pg_query($sql2);

		$sqlm2="UPDATE herramientas SET estado='En prestamo' WHERE id_herramienta='".$id."'";
		pg_query($sqlm2);

		date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Registro','Prestamo','".$_SESSION['nom_usuario']."')");
		
		if($tipo=="externo")
		{
		header("Location:herramientas.php?prestamo_herra=si");
        }
        
        else if ($tipo=="interno")
        {
		header("Location:herramientas.php?prestamo_herra=si");
        }	
//---------------------------------------Hasta aqui funciona todo calidad------------------------

?>

