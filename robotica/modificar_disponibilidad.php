<?php
	require("seguridad.php");
	require("conexion.php");

	$id_persona=$_POST['id_persona'];
	$id_periodo=$_POST['id_periodo'];

	# Obtenemos los datos del usuario
	$sql="SELECT * FROM disponibilidad_persona d, horas h WHERE d.id_horas=h.id_horas AND d.id_personal='$id_persona' AND d.id_periodo='$id_periodo' AND d.estatus=1 AND h.estatus=1 ORDER BY numero_bloque ASC";
    $valores=pg_query($sql);
    
    while($valores2=pg_fetch_assoc($valores))
    {  
        $lunes[]=$valores2['lunes'];
        $martes[]=$valores2['martes'];
        $miercoles[]=$valores2['miercoles'];
        $jueves[]=$valores2['jueves'];
        $viernes[]=$valores2['viernes'];
        #$id_horas[]=$valores2['id_horas'];
        $id_disponibilidad[]=$valores2['id_disponibilidad'];
    }

    $num=pg_num_rows($valores);
    
    $query=pg_query("SELECT * FROM personal WHERE id='$id_persona' AND estatus=1");
    $array=pg_fetch_assoc($query);

    $nom=explode(' ', $array['nombres']);
    $ape=explode(' ', $array['apellidos']);
    $nc=explode('-', $array['ci']);

    $nac=$nc[0].'-';
    $ci=$nc[1];

    $nom_ape=$nom[0].' '.$ape[0].' '.$array['cargo'];

    $con=pg_query("SELECT * FROM periodo WHERE id_periodo='$id_periodo'");
    $dato=pg_fetch_assoc($con);

    $datos = array(
        0 => $num,
        1 => $nac,
        2 => $ci,
        3 => $nom_ape,
        4 => $dato['tipo'],
        5 => $lunes,
        6 => $martes,
        7 => $miercoles,
        8 => $jueves,
        9 => $viernes,
        10 => $id_disponibilidad,
             );
    echo json_encode($datos);
?>