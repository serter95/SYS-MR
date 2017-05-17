<?php
	require 'seguridad.php';
	require 'conexion.php';

	$id=$_POST['id'];

	# Obtenemos los datos del preventivo

	$valores=pg_query("SELECT * FROM mant_preventivo p, personal s WHERE id_preventivo='".$id."' AND p.id_personal=s.id AND p.estatus=1");
	$valores2=pg_fetch_assoc($valores);
	
	$nombre_per=explode(' ', $valores2['nombres']); 
    $pri_nom=$nombre_per[0];

    $apellido_per=explode(' ', $valores2['apellidos']);
    $prim_ape=$apellido_per[0];

    $encargado_mant=$pri_nom.' '.$prim_ape;

    $costox=explode(' ', $valores2['costo']); 
    $valor=$costox[0];

    $f=explode('-', $valores2['fecha']);
    $fecha=$f[2].'/'.$f[1].'/'.$f[0];

    $fnext=explode('-', $valores2['fecha_siguiente']);
    $fechanext=$fnext[2].'/'.$fnext[1].'/'.$fnext[0];

   	$fecha3=explode('-', $valores2['fecha_ejecucion']);
    $fecha3=$fecha3[2].'/'.$fecha3[1].'/'.$fecha3[0];


    if (!empty($valores2['fecha_imprevisto'])){
    $f2=explode('-', $valores2['fecha_imprevisto']);
    $fecha2=$f2[2].'/'.$f2[1].'/'.$f2[0];
	}
	else{
		$fecha2="";
	}
		$datos = array(
		0 => $valores2['id_preventivo'],
		1 => $encargado_mant,
		2 => $fecha,
		3 => $valores2['nivel_aceite'],
		4 => $valores2['observaciones'],
		5 => $valores2['luces_tablero'],
		6 => $valores2['parada_emergencia'],
		7 => $valores2['pulsadores'],
		8 => $valores2['maquina_id'],
		9 => $valores2['responsable'],
		10 => $valores2['tipo_servicio'],
		11 => $valores2['horas_hombre'],
		12 => $valores2['proveedor'],
		13 => $valor,
		14 => $valores2['imprevisto'],
		15 => $fecha2,
		16 => $valores2['detalle_imprevisto'],
		17 => $fechanext,
		18 => $valores2['estado'],
		19 => $fecha3,
		);
echo json_encode($datos);


?>