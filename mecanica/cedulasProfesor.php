<?php
    require 'seguridad.php';
    require 'conexion.php';

    #$_POST['dia']="lunes_2";
    $d=explode('_', $_POST['dia']);
    $periodo=$_POST['periodo'];

    $query="SELECT * FROM disponibilidad_persona d, horas h, periodo p, personal x WHERE 
    d.id_horas=h.id_horas AND d.id_periodo=p.id_periodo AND d.id_personal=x.id AND p.tipo='$periodo'
    AND d.$d[0]=1 AND h.numero_bloque='$d[1]' AND x.cargo='Profesor' AND x.area='Mecanica' AND d.taller=1
    AND h.taller=1 AND d.estatus=1 AND h.estatus=1 AND x.estatus=1 ORDER BY d.id_disponibilidad ASC";

    $q=pg_query($query);
    $num=pg_num_rows($q);
    
    while ($array=pg_fetch_assoc($q))
    {
        $id_personal[]=$array['id'];
    }

    $cedula[0]="<option value=''> </option>";
    #$ced[0]="<option value=''> </option>";

    for ($i=0; $i < $num ; $i++)
    {
        $j=$i+1;

        $query2=pg_query("SELECT * FROM horario_clase h, periodo p, personal pe WHERE h.id_periodo=p.id_periodo
        AND h.id_personal=pe.id AND p.tipo='$periodo' AND h.id_personal='$id_personal[$i]'
        AND h.dia='".$_POST['dia']."' AND pe.area='Mecanica' AND h.taller=1 AND h.estatus=1 
        AND pe.estatus=1 ORDER BY pe.ci ASC");
        $num2=pg_num_rows($query2);
        $array2=pg_fetch_assoc($query2);

        if($num2>0)
        {
            $p1=1;
        }
        else
        {
            $p1=0;
        }

        $queryp2=pg_query("SELECT * FROM horario_clase h, periodo p, personal pe WHERE h.id_periodo=p.id_periodo
        AND h.id_personal2=pe.id AND p.tipo='$periodo' AND h.id_personal2='$id_personal[$i]' AND h.dia='".$_POST['dia']."'
        AND pe.area='Mecanica' AND h.taller=1 AND h.estatus=1 AND pe.estatus=1 ORDER BY pe.ci ASC");
        $nump2=pg_num_rows($queryp2);
        $arrayp2=pg_fetch_assoc($queryp2);

        if ($nump2>0)
        {
            $p2=1;
        }
        else
        {
            $p2=0;
        }

        $queryp3=pg_query("SELECT * FROM horario_clase h, periodo p, personal pe WHERE h.id_periodo=p.id_periodo
        AND h.id_personal3=pe.id AND p.tipo='$periodo' AND h.id_personal3='$id_personal[$i]' AND h.dia='".$_POST['dia']."'
        AND pe.area='Mecanica' AND h.taller=1 AND h.estatus=1 AND pe.estatus=1 ORDER BY pe.ci ASC");
        $nump3=pg_num_rows($queryp3);
        $arrayp3=pg_fetch_assoc($queryp3);

        if ($nump3>0)
        {
            $p3=1;
        }
        else
        {
            $p3=0;
        }

        if ($p1!=1 AND $p2!=1 AND $p3!=1)
        {
            $con=pg_query("SELECT * FROM personal WHERE id='$id_personal[$i]'");
            $a=pg_fetch_assoc($con);

            $cedula[$j]="<option value='".$a['ci']."'>".$a['ci']."</option>";
        }
        else
        {
            $cedula[$j]=0;
        }
    }

    echo json_encode($cedula);
?>