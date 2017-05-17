<?php
require('../conexion.php');

$contacto=$_POST['contacto'];
switch($contacto){
case "0":
	$modelo="0";
	break;
case "1":

	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE 'To-%' ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode('To-', $a);
	$i=$h[1];
	$modelo='To-'.($i+1);
		break;

case "2":
	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE 'Es-%' ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode('Es-', $a);
	$i=$h[1];
	$modelo='Es-'.($i+1);
		break;

case "3":
	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE 'Li-%' ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode('Li-', $a);
	$i=$h[1];
	$modelo='Li-'.($i+1);
		break;

case "4":
	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE 'Fr-%' ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode('Fr-', $a);
	$i=$h[1];
	$modelo='Fr-'.($i+1);
		break;

case "5":
	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE 'Ta-%' ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode('Ta-', $a);
	$i=$h[1];
	$modelo='Ta-'.($i+1);
		break;

}

$informacion=array(1=>$modelo);

echo json_encode($informacion);
?>
