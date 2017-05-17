<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del preventivo
    $valores=pg_query("SELECT * FROM prestamo p, personal s WHERE id_prestamo='$id' AND p.id_personal=s.id");

	//$valores=pg_query("SELECT * FROM mant_correctivo WHERE id_correctivo='".$id."'");
	$valores2=pg_fetch_assoc($valores);
/*
	
    

    $horaarranque=explode(' ', $valores2['horas_arranque']);
     						$horra=$horaarranque[0];
     						$ha12=$horaarranque[1];

 	$costo=explode(' ', $valores2['costo']);
 							$valor=$costo[0];
*/
 							$fecha=explode('-', $valores2['realizado']);
     						$ano=$fecha[0];
     						$mes=$fecha[1].'/';
     						$dia=$fecha[2].'/';
     						$fechac=$dia.$mes.$ano;

     						$nombre_per=explode(' ', $valores2['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $valores2['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado=$pri_nom.' '.$prim_ape;

                         

		$datos = array(

		0 => $valores2['id_prestamo'],
		1 => $fechac,
		2 => $encargado,
		3 => $valores2['responsable'],
		4 => $valores2['estado_prestamo'],
		5 => $valores2['id_herramienta'],
		//1 => $encargado_mant,
		
		);
echo json_encode($datos);


?>