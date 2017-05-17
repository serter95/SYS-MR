<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del preventivo
    $valores=pg_query("SELECT * FROM mant_correctivo p, personal s WHERE id_correctivo=".$id." AND p.id_personal=s.id AND p.estatus=1");

	//$valores=pg_query("SELECT * FROM mant_correctivo WHERE id_correctivo='".$id."'");
	$valores2=pg_fetch_assoc($valores);

	$nombre_per=explode(' ', $valores2['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $valores2['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
    $horafalla=explode(' ', $valores2['hora_falla']);
     						$horaf=$horafalla[0];
     						$hf12=$horafalla[1];

    $horaarranque=explode(' ', $valores2['horas_arranque']);
     						$horra=$horaarranque[0];
     						$ha12=$horaarranque[1];

 	$costo=explode(' ', $valores2['costo']);
 							$valor=$costo[0];

 	$f=explode('-', $valores2['fecha_falla']);
 	$fecha=$f[2].'/'.$f[1].'/'.$f[0];

 	 	$fx=explode('-', $valores2['fecha']);
 	$fechax=$fx[2].'/'.$fx[1].'/'.$fx[0];

 	 	 	$fe=explode('-', $valores2['fecha_ejecucion']);
 	$fechae=$fe[2].'/'.$fe[1].'/'.$fe[0];


		$datos = array(
		0 => $valores2['id_correctivo'],
		1 => $encargado_mant,
		2 => $valores2['responsable'],
		3 => $fecha,
		4 => $valores2['hora_falla'],
		5 => $valores2['observaciones'],
		6 => $valores2['pieza_recambio'],
		7 =>  $valores2['horas_arranque'],
		8 => $valores2['tipo_servicio'],
		9 => $valores2['horas_hombre'],
		10 => $valores2['proveedor'],
		11 => $valor,
		12 => $valores2['id_maquina'],
		13 => 0,
		14 => 0,
		15 => $valores2['estado'],
		16 => $fechax,
		17 => $fechae,
		18 => $valores2['motivo'],
		);
echo json_encode($datos);


?>