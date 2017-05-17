<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["numero_mant"])&&trim($_REQUEST["cantidad"])&&trim($_REQUEST["repuesto"]);
//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error

	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->
	<?php
	header("Location:reposicion.php");
	
}



//$recibiendo2=trim($_REQUEST["rev_maquina"])&&trim($_REQUEST["fecha"])&&trim($_REQUEST["niv_aceite"]);

else{



		$numero=$_REQUEST["numero_mant"];
		$repuesto=$_REQUEST["repuesto"];
		$cantidad=$_REQUEST["cantidad"];

        $sql="SELECT * FROM repuestos WHERE id_repuesto='".$repuesto."' AND  estatus='1' ";
        $query=pg_query($sql);
        $valor=pg_fetch_assoc($query);

        $insumo=$valor['repuesto1'];
        $existencia=$valor['salida1'];

       echo $validar=(int)$existencia-(int)$cantidad;
        if ($validar<0){
        header("Location:reposicion.php?error=si");
        }
        else{
      	$sql3="SELECT * FROM insumos WHERE id_insumos='".$insumo."' AND  estatus='1' ";
      	$query3=pg_query($sql3);
      	$suma=pg_fetch_assoc($query3);

      	$buenas=$suma["buenas"];
      	$reposicion=(int)$buenas+(int)$cantidad;
      	$actualexistencia=$suma['existencia'];
      	$actualprecio=$suma['precio_unitario'];
      	$actualexistencia=(int)$actualexistencia+(int)$cantidad;
      	$actualprecio=(int)$actualprecio;
        $newimporte=$actualprecio*$actualexistencia.' '.'Bs';

        $sqlm3="UPDATE insumos SET importe='".$newimporte."', existencia='".$actualexistencia."', buenas='".$reposicion."' WHERE id_insumos='".$insumo."'";
        pg_query($sqlm3);


      date_default_timezone_set('America/Caracas');

      $hoy=date('Y-m-d h:i:s');

      pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
          VALUES('$hoy','Modificación','Insumos','".$_SESSION['nom_usuario']."',1)");

        $existenciar=(int)$existencia-(int)$cantidad;

        if ($existenciar=='0'){
         $modifica=pg_query("UPDATE repuestos SET salida1='".$existenciar."', estatus='0' WHERE id_repuesto='$repuesto'"); 
         
         date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Reposición','".$_SESSION['nom_usuario']."',1)");

         header("Location:reposicion.php?registrado_maq=si");
       }
        
        else{
          $modifica=pg_query("UPDATE repuestos SET salida1='".$existenciar."' WHERE id_repuesto='$repuesto'");

          date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Reposición','".$_SESSION['nom_usuario']."',1)"); 
        header("Location:reposicion.php?registrado_maq=si");


        }       
          }
}
