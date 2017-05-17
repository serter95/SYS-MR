<?php
include("seguridad.php");
include("conexion.php");


$recibiendo=trim($_REQUEST["descripcion"])&&trim($_REQUEST["existencia"]);


//lo que recibo pasa por aqui, y se verfica si esta vacio
if ($recibiendo==""){ //si esta vacio marca un error
	?>
	<!--<script language="javascript">
		alert("Hay campos vacios, registro no procesado");
		location.href="maquinas.php";
	</script>-->

	<?php
	
//header("Location:insumos.php");
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
		$insumo=$_REQUEST["insumo"];
		$ahora=date('Y-m-d h:i:s A');
		$user=$_SESSION['nom_usuario'];

		$tipo=$_REQUEST["tipo_registro"];
		if($tipo=="salida"){

		$codigo=$_REQUEST["codigo"];
	
		$descripcion=$_REQUEST["descripcion"];
		$nb=$_REQUEST["n_b"];
	
		$salida=$_REQUEST["salida"];
		$salida=(int)$salida;
		$existencia=$_REQUEST["existencia"];
		$existencia=(int)$existencia;
		$newexistencia=$existencia-$salida;

		$salida_buenas=$_REQUEST["salida_buenas"];
		$salida_buenas=(int)$salida_buenas;
		$buenas=$_REQUEST["buenas"];
		$buenas=(int)$buenas;
		$newbuenas=$buenas-$salida_buenas;

		$salida_danadas=$_REQUEST["salida_danadas"];
		$salida_danadas=(int)$salida_danadas;
		$danadas=$_REQUEST["danadas"];
		$danadas=(int)$danadas;
		$newdanadas=$danadas-$salida_danadas;

		if($newexistencia<0){
				?>
	<script language="javascript">
	alert("error existencia no puede quedar en < 0");
		location.href="insumos.php";
	</script>
	<?php
			
		}
	

else if($newbuenas<0){
				?>
	<script language="javascript">
	alert("error buenas no puede quedar en < 0");
		location.href="insumos.php";
	</script>
	<?php
}
	else if($newdanadas<0){
				?>
	<script language="javascript">
	alert("error danadas no puede quedar en < 0");
		location.href="insumos.php";
	</script>
	<?php
}	
		else{


		$sql="INSERT INTO salida(cantidad,id_insumos,realizado,responsable,tipo)
		VALUES('".$salida."','".$id."','".$ahora."','".$user."','insumo')";
		pg_query($sql);

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Salida','".$_SESSION['nom_usuario']."',1)");

		$sqlm="UPDATE insumos SET existencia='".$newexistencia."', buenas='".$newbuenas."',danadas='".$newdanadas."' WHERE id_insumos='".$id."'";
			pg_query($sqlm);

		$sql3="SELECT * FROM insumos WHERE id_insumos='".$id."' AND  estatus='1' ";
		$query3=pg_query($sql3);
		$suma=pg_fetch_assoc($query3);
		$actualexistencia=$suma['existencia'];
		$actualprecio=$suma['precio_unitario'];
		$actualexistencia=(int)$actualexistencia;
		$actualprecio=(int)$actualprecio;
		$newimporte=$actualprecio*$actualexistencia.' '.'Bs';
		$sqlm3="UPDATE insumos SET importe='".$newimporte."' WHERE id_insumos='".$id."'";
		 pg_query($sqlm3);
		header("Location:insumos.php?editado_maq=si");
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

		$entrada_buenas=$_REQUEST["entrada_buenas"];
		$entrada_buenas=(int)$entrada_buenas;
		$buenas=$_REQUEST["buenas"];
		$buenas=(int)$buenas;
		$newbuenas=$buenas+$entrada_buenas;

		$entrada_danadas=$_REQUEST["entrada_danadas"];
		$entrada_danadas=(int)$entrada_danadas;
		$danadas=$_REQUEST["danadas"];
		$danadas=(int)$danadas;
		$newdanadas=$danadas+$entrada_danadas;

		$sql2="INSERT INTO entrada(cantidad,id_insumos,realizado,responsable,tipo)
		VALUES('".$entrada."','".$id."','".$ahora."','".$user."','insumo')";
		pg_query($sql2);

		date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Entrada','".$_SESSION['nom_usuario']."',1)");

		$sqlm2="UPDATE insumos SET existencia='".$newexistencia."', buenas='".$newbuenas."',danadas='".$newdanadas."' WHERE id_insumos='".$id."'";
			pg_query($sqlm2);
		

		$sql3="SELECT * FROM insumos WHERE id_insumos='".$id."' AND  estatus='1' ";
		$query3=pg_query($sql3);
		$suma=pg_fetch_assoc($query3);
		$actualexistencia=$suma['existencia'];
		$actualprecio=$suma['precio_unitario'];
		$actualexistencia=(int)$actualexistencia;
		$actualprecio=(int)$actualprecio;
		$newimporte=$actualprecio*$actualexistencia.' '.'Bs';
		$sqlm3="UPDATE insumos SET importe='".$newimporte."' WHERE id_insumos='".$id."'";
		 pg_query($sqlm3);

		 header("Location:insumos.php?editado_maq=si");

		}

	}
	

//---------------------------------------Hasta aqui funciona todo calidad------------------------

              //no existe usuario




         //  mysql_close($db_db);


?>

