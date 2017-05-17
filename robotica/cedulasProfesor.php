<?php
	require 'seguridad.php';
	require 'conexion.php';

	

    $d=explode('_', $_POST['dia']);
    $periodo=$_POST['periodo'];

    $query="SELECT * FROM disponibilidad_persona d, horas h, periodo p, personal x WHERE 
    d.id_horas=h.id_horas AND d.id_periodo=p.id_periodo AND d.id_personal=x.id AND p.tipo='$periodo'
    AND d.$d[0]=1 AND h.numero_bloque='$d[1]' AND x.cargo='Profesor' AND x.area='Robotica' AND d.taller=2
    AND h.taller=2 AND d.estatus=1 AND h.estatus=1 AND x.estatus=1 ORDER BY d.id_disponibilidad ASC";

    $q=pg_query($query);
    $num=pg_num_rows($q);
    
    while ($array=pg_fetch_assoc($q))
    {
        $id_personal[]=$array['id'];
    }

    for ($i=0; $i < $num ; $i++)
    { 
        $query2=pg_query("SELECT * FROM horario_clase h, periodo p, personal pe WHERE h.id_periodo=p.id_periodo
        AND h.id_personal=pe.id AND p.tipo='$periodo' AND h.id_personal='$id_personal[$i]' AND h.dia='".$_POST['dia']."'
        AND pe.area='Robotica' AND h.taller=2 AND h.estatus=1 AND pe.estatus=1 ORDER BY pe.ci ASC");

        $num2=pg_num_rows($query2);
        $array2=pg_fetch_assoc($query2);

        if($num2==0)
        {
            $query3=pg_query("SELECT * FROM personal WHERE id='$id_personal[$i]'");
            $array3=pg_fetch_assoc($query3);

            $cedula[]="<option value='".$array3['ci']."'>".$array3['ci']."</option>";

        }
    }

    if ($cedula=="")
    {
    	$cedula[0]="<option value=''> </option>";
    }

    echo json_encode($cedula);
?>