<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["titulo"])&&trim($_REQUEST["ente1"])&&trim($_REQUEST["ente2"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if (empty($recibiendo)){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="insumos.php";
	</script>-->
	<?php
header("Location:convenios.php");
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{

		

		$titulo=$_REQUEST["titulo"];
		$titulo=ucwords($titulo);
		$ente1=$_REQUEST["ente1"];
		$ente2=$_REQUEST["ente2"];

		$fechai=$_REQUEST["fechai"];
		$fechai=explode("/", $fechai);
  		$fechai=$fechai[2]."-".$fechai[1]."-".$fechai[0];
		$fechaf=$_REQUEST["fechaf"];
		$fechaf=explode("/", $fechaf);
  		$fechaf=$fechaf[2]."-".$fechaf[1]."-".$fechaf[0];

		$contratante=$_REQUEST["contratante"];
		$contratado=$_REQUEST["contratado"];
		
		//$clausulas=$_REQUEST["clausulas"];
		//$recambio=$_REQUEST["recambio"];
		

		$sqlm="INSERT INTO convenios(titulo,ente1,ente2,contratante,contratado,fecha_inicio,fecha_final,taller)VALUES('".$titulo."','".$ente1."','".$ente2."','".$contratante."','".$contratado."','".$fechai."','".$fechaf."','2')";
		pg_query($sqlm);

		date_default_timezone_set('America/Caracas');

	$hoy=date('Y-m-d h:i:s');

	pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario)
    VALUES('$hoy','Registro','Convenios','".$_SESSION['nom_usuario']."')");

		header("Location:convenios.php?registrado_maq=si");
		

	}
	
	

//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

