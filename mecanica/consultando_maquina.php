<?php
require('seguridad.php');
require('conexion.php');

$contacto=$_POST['contacto'];

//switch($contacto){
//case "0":
	
	//	$modelo="0";


	//break;
//case "Torno":
$busca="SELECT * FROM tipo_maquina WHERE nombre='$contacto' AND estatus=1";
$query=pg_query($busca);
$array2=pg_fetch_assoc($query);

$code=$array2['codigo'];

	$sqlz = "SELECT * FROM maquinas WHERE codigo LIKE '$code%' AND estatus=1 ORDER BY id_maquina DESC LIMIT 1"; 
	$resultado = pg_query($sqlz);
	while ($array=pg_fetch_assoc($resultado)){
		$a= $array['codigo'];
	}
	$h=explode($code, $a);
	$i=$h[1];
	$modelo=$code.($i+1);
	

//$informacion=array(1=>$modelo);

//echo json_encode($informacion);

	$informacion=$modelo;

echo $informacion;
?>
