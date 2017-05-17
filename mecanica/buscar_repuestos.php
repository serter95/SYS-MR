<?php
require ('seguridad.php');
require ('conexion.php');

	$id=$_REQUEST['id'];
	$tipo=$_REQUEST['tipo'];
	if($tipo=='preventivo'){
	
	$sql="SELECT * FROM repuestos WHERE id_preventivo='".$id."' AND estatus=1";
	$query=pg_query($sql);
	while($array=pg_fetch_assoc($query)){
	//$array["id_maquina"];
	$maquina=$array["repuesto1"];
	$cantidad=$array["salida1"];
	$sqlinsu=pg_query("SELECT * FROM insumos WHERE id_insumos='".$maquina."' AND estatus=1");
	    $fila=pg_fetch_assoc($sqlinsu);
		//$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
		 $encontrado=$encontrado."<option value='".$array['id_repuesto']."'>".$fila['nombre']."</option>";
		// $encontrado2=$cantidad;
		}

		 	$completo="<option value=''></option>".$encontrado;

 		$datos = array(
			0 => $completo,
			
			
		);
			
	echo json_encode($datos);
	
	//echo ($encontrado);

	
	}

	if($tipo=='correctivo'){
	
	$sql="SELECT * FROM repuestos WHERE id_correctivo='".$id."' AND estatus=1";
	$query=pg_query($sql);
	while($array=pg_fetch_assoc($query)){
	//$array["id_maquina"];
	$maquina=$array["repuesto1"];
	$cantidad=$array["salida1"];

	$sqlinsu=pg_query("SELECT * FROM insumos WHERE id_insumos='".$maquina."' AND estatus=1");
	    $fila=pg_fetch_assoc($sqlinsu);
		//$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
		 $encontrado=$encontrado."<option value='".$array['id_repuesto']."'>".$fila['nombre']."</option>";
		

		}

 	$completo="<option value=''></option>".$encontrado;
	
	$datos = array(
			0 => $completo,
		

		);
			
	echo json_encode($datos);

	
	}


?>

