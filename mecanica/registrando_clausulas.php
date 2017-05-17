<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["id_convenio"]);
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

		
		$id_convenio=$_REQUEST["id_convenio"];

		foreach ($_REQUEST["clausulas"] as $key => $value) {
	    $h++; // contador de registros conseguidos con el mismo nombre.
	    $x[]=$value;
	     //Agarro todos los objetos obtenidos en el formulario con el mismo nombre.
	}
		$jaja=implode("||", $x);  //Uno todos los arreglos conseguidos
		$exp=explode("||", $jaja); //Separo todos los arreglos conseguidos
	
		$cuenta= $h;

		//$clausulas=$_REQUEST["clausulas"];
		//$recambio=$_REQUEST["recambio"];
		for ($i=0;$i<$cuenta;$i++){

      	$objetos=$exp[$i]; //Aqui utilizo el explode, para el registro individual
      	
		$sqlm="INSERT INTO clausulas(contenido,id_convenio)VALUES('".$objetos."','".$id_convenio."')";
		pg_query($sqlm);
		}

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Clausulas','".$_SESSION['nom_usuario']."',1)");

		header("Location:convenios.php?registrado_maq=si");
		

	}
	
	

//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

