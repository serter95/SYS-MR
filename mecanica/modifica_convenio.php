<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del preventivo
    $valores=pg_query("SELECT * FROM convenios WHERE id_convenio='$id' AND estatus=1");

	//$valores=pg_query("SELECT * FROM mant_correctivo WHERE id_correctivo='".$id."'");
	$valores2=pg_fetch_assoc($valores);
/*
	
    

    $horaarranque=explode(' ', $valores2['horas_arranque']);
     						$horra=$horaarranque[0];
     						$ha12=$horaarranque[1];

 	$costo=explode(' ', $valores2['costo']);
 							$valor=$costo[0];
*/
 							$fecha=explode('-', $valores2['fecha_inicio']);
     						$ano=$fecha[0];
     						$mes=$fecha[1].'/';
     						$dia=$fecha[2].'/';
     						$fechac=$dia.$mes.$ano;

     							$fecha2=explode('-', $valores2['fecha_final']);
     						$ano2=$fecha2[0];
     						$mes2=$fecha2[1].'/';
     						$dia2=$fecha2[2].'/';
     						$fechac2=$dia2.$mes2.$ano2;

     						
                         

		$datos = array(

		0 => $valores2['id_convenio'],
		1 => $valores2['titulo'],
		2 => $valores2['ente1'],
		3 => $valores2['ente2'],
		4 => $valores2['contratante'],
		5 => $valores2['contratado'],
		6 => $fechac,
		7 => $fechac2,
		8 => $valores2['clausulas'],

		//1 => $encargado_mant,
		
		);
echo json_encode($datos);


?>