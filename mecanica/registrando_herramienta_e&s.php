<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim(isset($_REQUEST["codigo"]))&&trim(isset($_REQUEST["existencia"]));


//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->

	<?php
	
//header("Location:maquinas.php");
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{

	date_default_timezone_set('America/Caracas');
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

		$id=$_REQUEST["id_insu"];
		$insumo=$_REQUEST["herramienta"];
		$ahora=date('Y-m-d H:i:s A');
		$user=$_SESSION['nom_usuario'];

		$tipo=$_REQUEST["tipo_registro"];
		if($tipo=="salida"){

		$codigo=$_REQUEST["codigo"];
	
		$descripcion=$_REQUEST["descripcion"];
		$nb=$_REQUEST["n_b"];
		$entrada=$_REQUEST["entrada"];
		$salida=$_REQUEST["salida"];
		$salida=(int)$salida;
		$existencia=$_REQUEST["existencia"];
		$existencia=(int)$existencia;
		$newexistencia=$existencia-$salida;

		if($newexistencia<0){
				?>
	<script language="javascript">
	alert("error existencia no puede quedar en 0");
		location.href="herramientas_e&s.php";
	</script>
	<?php
			
		}
		else{


		$sql="INSERT INTO salida(cantidad,id_herramienta,realizado,responsable,tipo)
		VALUES('".$salida."','".$id."','".$ahora."','".$user."','herramienta')";
		pg_query($sql);

		$sqlm="UPDATE herramientas SET existencia='".$newexistencia."' WHERE id_herramienta='".$id."'";
			pg_query($sqlm);
		header("Location:herramientas_e&s.php?registrado_maq=si");
		}
		}
		else if($tipo=="entrada"){
		

		$codigo=$_REQUEST["codigo"];
	
		$descripcion=$_REQUEST["descripcion"];
		$nb=$_REQUEST["n_b"];
		$entrada=$_REQUEST["entrada"];
		$entrada=(int)$entrada;
	
		$existencia=$_REQUEST["existencia"];
		$existencia=(int)$existencia;
		$newexistencia=$existencia+$entrada;

		$sql2="INSERT INTO entrada(cantidad,id_herramienta,realizado,responsable,tipo)
		VALUES('".$entrada."','".$id."','".$ahora."','".$user."','herramienta')";
		
		pg_query($sql2);
		$sqlm2="UPDATE herramientas SET existencia='".$newexistencia."' WHERE id_herramienta='".$id."'";
		pg_query($sqlm2);
		header("Location:herramientas_e&s.php?registrado_maq=si");



	

		}

	}
	

//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

