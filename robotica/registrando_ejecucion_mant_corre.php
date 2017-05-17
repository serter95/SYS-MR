<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["fecha"])&&trim($_REQUEST["numero_mant"])&&trim($_REQUEST["fecha_falla"])&&trim($_REQUEST["hora_falla"])&&trim($_REQUEST["observaciones"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error

	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
	header("Location:ejecucion_mant_correctivo.php");
	
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{

	$service=$_REQUEST["tipo_servicio"];
	if($service=='interno'){

		$numero=$_REQUEST["numero_mant"];
		$estado=$_REQUEST["estado"];
		
		$cantidad=$_REQUEST["control_cantidad"];
		if ($_REQUEST["incluir"]=='si'){
			$h=0;
			foreach ($_REQUEST["repuestoI"] as $key => $value) {
	    $h++; // contador de registros conseguidos con el mismo nombre.
	    $x[]=$value;
	     //Agarro todos los objetos obtenidos en el formulario con el mismo nombre.
	}
		$jaja=implode("||", $x);  //Uno todos los arreglos conseguidos
		$exp=explode("||", $jaja); //Separo todos los arreglos conseguidos

		$cuenta= $h;

		$h2=0;

		foreach ($_REQUEST["utilizadaRI"] as $key2 => $value2) {
     	$h2++; // contador de registros conseguidos con el mismo nombre.
      	$x2[]=$value2;//Agarro todos los objetos obtenidos en el formulario con el mismo nombre.
      }
        $jaja2=implode("||", $x2);  //Uno todos los arreglos conseguidos
	    $exp2=explode("||", $jaja2); //Separo todos los arreglos conseguidos

	    for ($i=0;$i<$cuenta;$i++){

      	$objetos=$exp[$i]; //Aqui utilizo el explode, para el registro individual
      	$objetos2=$exp2[$i];
      	
      	$sql3="SELECT * FROM insumos WHERE id_insumos='".$objetos."' AND  estatus='1' ";
      	$query3=pg_query($sql3);
      	$suma=pg_fetch_assoc($query3);

      	$buenas=$suma["buenas"];
      	$salida=(int)$buenas-(int)$objetos2;
      	$actualexistencia=$suma['existencia'];
      	$actualprecio=$suma['precio_unitario'];
      	$actualexistencia=(int)$actualexistencia-(int)$objetos2;
      	if($actualexistencia<0){
      		header("Location:ejecucion_mant_correctivo.php?error=exis");
      	}
      }
  }
  $fecha=$_REQUEST["fecha"];
  $fecha=explode("/", $fecha);
  $fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
  $fechaf=$_REQUEST["fecha_falla"];
  $fechaf=explode("/", $fechaf);
  $fechaf=$fechaf[2]."-".$fechaf[1]."-".$fechaf[0];
  $hora=$_REQUEST["hora_falla"];
  $observaciones=$_REQUEST["observaciones"];
	//$pieza=$_REQUEST["pieza_cambio"];
  $hora_arranque=$_REQUEST["hora_arranque"];
  $hora_hombre=$_REQUEST["hora_hombre"];
  $costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
  $estado=$_REQUEST["estado"];
  $responsable=$_REQUEST["responsable"];
  echo $sqlm="UPDATE mant_correctivo SET fecha_ejecucion='".$fecha."', fecha_falla='".$fechaf."', hora_falla='".$hora."', observaciones='".$observaciones."', horas_arranque='".$hora_arranque."', costo='".$costo."', horas_hombre='".$hora_hombre."', estado='".$estado."' WHERE id_correctivo='".$numero."'";
  pg_query($sqlm);

  if ($_REQUEST["incluir"]=='si'){


  	for ($i=0;$i<$cuenta;$i++){

      	$objetos=$exp[$i]; //Aqui utilizo el explode, para el registro individual
      	$objetos2=$exp2[$i];
      	
      	$sql3="SELECT * FROM insumos WHERE id_insumos='".$objetos."' AND  estatus='1' ";
      	$query3=pg_query($sql3);
      	$suma=pg_fetch_assoc($query3);

      	$buenas=$suma["buenas"];
      	$salida=(int)$buenas-(int)$objetos2;
      	$actualexistencia=$suma['existencia'];
      	$actualprecio=$suma['precio_unitario'];
      	$actualexistencia=(int)$actualexistencia-(int)$objetos2;
      	$actualprecio=(int)$actualprecio;
      	$newimporte=$actualprecio*$actualexistencia.' '.'Bs';

      	$sqlm3="UPDATE insumos SET importe='".$newimporte."', existencia='".$actualexistencia."', buenas='".$salida."' WHERE id_insumos='".$objetos."'";
      	pg_query($sqlm3);
      	$buscar=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_correctivo='$numero'");
      	$cuenta=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_correctivo='$numero'");

      	$columnas=pg_num_rows($cuenta);
      	if($columnas!=0){
      		$array3=pg_fetch_assoc($buscar);
      		$idcantidad=$array3['id_repuesto'];
      		$cantidad=$array3['salida1'];
      		$sumacantidad=(int)$cantidad+(int)$objetos2;
      		$modifica=pg_query("UPDATE repuestos SET salida1='".$sumacantidad."',estatus=1 WHERE id_repuesto='$idcantidad'"); 
      	}
      	else{
      		$intror="INSERT INTO repuestos(repuesto1,salida1,id_correctivo)VALUES('".$objetos."','".$objetos2."','".$numero."')";
      		pg_query($intror);
      	}
      }

  }
  header("Location:ejecucion_mant_correctivo.php?registrado_maq=si");

}
else if ($service=='externo'){
	$numero=$_REQUEST["numero_mant"];
	$estado=$_REQUEST["estado"];

	$cantidad=$_REQUEST["control_cantidad"];
	if ($_REQUEST["incluir"]=='si'){
		$h=0;
		foreach ($_REQUEST["repuestoE"] as $key => $value) {
	    $h++; // contador de registros conseguidos con el mismo nombre.
	    $x[]=$value; //Agarro todos los objetos obtenidos en el formulario con el mismo nombre.
	}
		$jaja=implode("||", $x);  //Uno todos los arreglos conseguidos
		$exp=explode("||", $jaja); //Separo todos los arreglos conseguidos

		$cuenta= $h;

		$h2=0;

		foreach ($_REQUEST["utilizadaRE"] as $key2 => $value2) {
     	$h2++; // contador de registros conseguidos con el mismo nombre.
     	$x2[]=$value2;
  	     //Agarro todos los objetos obtenidos en el formulario con el mismo nombre.
     }
        $jaja2=implode("||", $x2);  //Uno todos los arreglos conseguidos
	    $exp2=explode("||", $jaja2); //Separo todos los arreglos conseguidos


	    for ($i=0;$i<$cuenta;$i++){

      	$objetos=$exp[$i]; //Aqui utilizo el explode, para el registro individual
      	$objetos2=$exp2[$i];
      	
      	$sql3="SELECT * FROM insumos WHERE id_insumos='".$objetos."' AND  estatus='1' ";
      	$query3=pg_query($sql3);
      	$suma=pg_fetch_assoc($query3);

      	$buenas=$suma["buenas"];
      	$salida=(int)$buenas-(int)$objetos2;
      	$actualexistencia=$suma['existencia'];
      	$actualprecio=$suma['precio_unitario'];
      	$actualexistencia=(int)$actualexistencia-(int)$objetos2;
      	if($actualexistencia<0){
      		header("Location:ejecucion_mant_correctivo.php?error=exis");
      	}
      }
  }

  $fecha=$_REQUEST["fecha"];
  $fecha=explode("/", $fecha);
  $fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
  $fechaf=$_REQUEST["fecha_falla"];
  $fechaf=explode("/", $fechaf);
  $fechaf=$fechaf[2]."-".$fechaf[1]."-".$fechaf[0];
  $hora=$_REQUEST["hora_falla"];
  $observaciones=$_REQUEST["observaciones"];

  $hora_arranque=$_REQUEST["hora_arranque"];
  $hora_hombre=$_REQUEST["hora_hombre"];
  $costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
  $estado=$_REQUEST["estado"];
  $responsable=$_REQUEST["responsable"];

  echo $sqlm="UPDATE mant_correctivo SET fecha_ejecucion='".$fecha."', fecha_falla='".$fechaf."', hora_falla='".$hora."', observaciones='".$observaciones."', horas_arranque='".$hora_arranque."', costo='".$costo."', horas_hombre='".$hora_hombre."', estado='".$estado."' WHERE id_correctivo='".$numero."'";
  pg_query($sqlm);
  if ($_REQUEST["incluir"]=='si'){
  	for ($i=0;$i<$cuenta;$i++){

      	$objetos=$exp[$i]; //Aqui utilizo el explode, para el registro individual
      	$objetos2=$exp2[$i];
      	
      	$sql3="SELECT * FROM insumos WHERE id_insumos='".$objetos."' AND  estatus='1' ";
      	$query3=pg_query($sql3);
      	$suma=pg_fetch_assoc($query3);

      	$buenas=$suma["buenas"];
      	$salida=(int)$buenas-(int)$objetos2;
      	$actualexistencia=$suma['existencia'];
      	$actualprecio=$suma['precio_unitario'];
      	$actualexistencia=(int)$actualexistencia-(int)$objetos2;
      	$actualprecio=(int)$actualprecio;
      	$newimporte=$actualprecio*$actualexistencia.' '.'Bs';

      	$sqlm3="UPDATE insumos SET importe='".$newimporte."', existencia='".$actualexistencia."', buenas='".$salida."' WHERE id_insumos='".$objetos."'";
      	pg_query($sqlm3);

      	$buscar=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_correctivo='$numero'");
      	$cuenta=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_correctivo='$numero'");

      	$columnas=pg_num_rows($cuenta);
      	if($columnas!=0){
      		$array3=pg_fetch_assoc($buscar);
      		$idcantidad=$array3['id_repuesto'];
      		$cantidad=$array3['salida1'];
      		$sumacantidad=(int)$cantidad+(int)$objetos2;
      		$modifica=pg_query("UPDATE repuestos SET salida1='".$sumacantidad."',estatus=1 WHERE id_repuesto='$idcantidad'"); 
      	}
      	else{
      		$intror="INSERT INTO repuestos(repuesto1,salida1,id_correctivo)VALUES('".$objetos."','".$objetos2."','".$numero."')";
      		pg_query($intror);
      	}
      }
  }
  header("Location:ejecucion_mant_correctivo.php?registrado_maq=si");
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

