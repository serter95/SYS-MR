<?php
require('seguridad.php');
require('conexion.php');

$contacto=$_POST['code'].'-';


$busca="SELECT * FROM tipo_maquina WHERE codigo='$contacto' AND estatus=1";
$query=pg_query($busca);
$cant=pg_num_rows($query);
if ($cant>0){
	echo $valor=0;
}
else {
echo $valor=1;
}


?>
