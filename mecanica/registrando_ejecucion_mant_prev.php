<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["fecha"])&&trim($_REQUEST["numero_mant"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error

	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
	header("Location:ejecucion_mant_preventivo.php");
	
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
      		header("Location:ejecucion_mant_preventivo.php?error=exis");
      	}
      }

  }
  $fecha=$_REQUEST["fecha"];
  $fecha=explode("/", $fecha);
  $fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
  $niv_aceite=$_REQUEST["niv_aceite"];
  $observaciones=$_REQUEST["observaciones"];
  $luces=$_REQUEST["luces_tab"];
  $parada=$_REQUEST["parada_emer"];
  $pulsadores=$_REQUEST["pulsadores"];
  $nextfecha=$_REQUEST["nextfecha"];
  $nextfecha=explode("/", $nextfecha);
  $nextfecha=$nextfecha[2]."-".$nextfecha[1]."-".$nextfecha[0];
  $responsable=$_REQUEST["responsable"];
  $costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
  $hora_hombre=$_REQUEST["hora_hombre"];
  $sqlm="UPDATE mant_preventivo SET fecha_ejecucion='".$fecha."', nivel_aceite='".$niv_aceite."', luces_tablero='".$luces."', parada_emergencia='".$parada."', pulsadores='".$pulsadores."', fecha_siguiente='".$nextfecha."', observaciones='".$observaciones."', responsable='".$responsable."', costo='".$costo."', horas_hombre='".$hora_hombre."', estado='".$estado."' WHERE id_preventivo='".$numero."'";
  pg_query($sqlm);

  date_default_timezone_set('America/Caracas');

  $hoy=date('Y-m-d h:i:s');

  pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
      VALUES('$hoy','Registro','Ejecución de Mantenemiento Preventivo','".$_SESSION['nom_usuario']."',1)");


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

        date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Mantenemiento','".$_SESSION['nom_usuario']."',1)");


      
        $buscar=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_preventivo='$numero'");
        $cuenta=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_preventivo='$numero'");

      $columnas=pg_num_rows($cuenta);
        if($columnas!=0){
        $array3=pg_fetch_assoc($buscar);
         $idcantidad=$array3['id_repuesto'];
        $cantidad=$array3['salida1'];
       $sumacantidad=(int)$cantidad+(int)$objetos2;
         $modifica=pg_query("UPDATE repuestos SET salida1='".$sumacantidad."',estatus=1 WHERE id_repuesto='$idcantidad'"); 
        }
        else{
        $intror="INSERT INTO repuestos(repuesto1,salida1,id_preventivo)VALUES('".$objetos."','".$objetos2."','".$numero."')";
        pg_query($intror);
      }
      }
  }

header("Location:ejecucion_mant_preventivo.php?registrado_maq=si");

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
      		header("Location:mant_preventivo.php?error=exis");
      	}
      }
  }
  
  $fecha=$_REQUEST["fecha"];
  $fecha=explode("/", $fecha);
  $fecha=$fecha[2]."-".$fecha[1]."-".$fecha[0];
  $niv_aceite=$_REQUEST["niv_aceite"];
  $observaciones=$_REQUEST["observaciones"];
  $luces=$_REQUEST["luces_tab"];
  $parada=$_REQUEST["parada_emer"];
  $pulsadores=$_REQUEST["pulsadores"];
  $nextfecha=$_REQUEST["nextfecha"];
  $nextfecha=explode("/", $nextfecha);
  $nextfecha=$nextfecha[2]."-".$nextfecha[1]."-".$nextfecha[0];
  $proveedor=$_REQUEST["provedor"];
  $responsable=$_REQUEST["responsable"];
  $costo=$_REQUEST["costo"].' '.$_REQUEST["moneda"];
  $hora_hombre=$_REQUEST["hora_hombre"];
 echo $sqlm2="UPDATE mant_preventivo SET fecha_ejecucion='".$fecha."', nivel_aceite='".$niv_aceite."', luces_tablero='".$luces."', parada_emergencia='".$parada."', pulsadores='".$pulsadores."', fecha_siguiente='".$nextfecha."', observaciones='".$observaciones."', responsable='".$responsable."', costo='".$costo."', horas_hombre='".$hora_hombre."', estado='".$estado."' WHERE id_preventivo='".$numero."'";
 pg_query($sqlm2);

 date_default_timezone_set('America/Caracas');

  $hoy=date('Y-m-d h:i:s');

  pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
      VALUES('$hoy','Registro','Ejecución de Mantenemiento Preventivo','".$_SESSION['nom_usuario']."',1)");

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

        date_default_timezone_set('America/Caracas');

        $hoy=date('Y-m-d h:i:s');

        pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
            VALUES('$hoy','Modificación','Insumos','".$_SESSION['nom_usuario']."',1)");



        $buscar=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_preventivo='$numero'");
        $cuenta=pg_query("SELECT * FROM repuestos WHERE repuesto1='$objetos' AND id_preventivo='$numero'");

       $columnas=pg_num_rows($cuenta);
        if($columnas!=0){
        $array3=pg_fetch_assoc($buscar);
         $idcantidad=$array3['id_repuesto'];
        $cantidad=$array3['salida1'];
        $sumacantidad=(int)$cantidad+(int)$objetos2;
         $modifica=pg_query("UPDATE repuestos SET salida1='".$sumacantidad."',estatus=1 WHERE id_repuesto='$idcantidad'"); 
        }
        else{
        $intror="INSERT INTO repuestos(repuesto1,salida1,id_preventivo)VALUES('".$objetos."','".$objetos2."','".$numero."')";
        pg_query($intror);
      }
      }
  }

  header("Location:ejecucion_mant_preventivo.php?registrado_maq=si");
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

