<?php
session_start(); 
if ($_SESSION["g2tr1sv"] != "SI")
{   
	header("Location:../../salir.php");
}
include("../conexion.php");

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

ob_start();

date_default_timezone_set('America/Caracas');

$hoy=date('d/m/Y');

$id_periodo=$_REQUEST['id_periodo'];
$id_seccion=$_REQUEST['id_seccion'];

$datos=pg_query("SELECT * FROM horario_clase hc, horas h, materia m, personal p WHERE hc.id_horas=h.id_horas AND hc.id_materia=m.id_materia AND hc.id_personal=p.id AND hc.id_seccion='$id_seccion' AND hc.id_periodo='$id_periodo' AND hc.taller=2 AND h.taller=2 AND hc.estatus=1 AND h.estatus=1 ORDER BY h.numero_bloque ASC");
$num2=pg_num_rows($datos);

$datos2=pg_query("SELECT m.codigo, m.nombre FROM horario_clase hc, materia m WHERE hc.id_materia=m.id_materia AND hc.id_seccion='$id_seccion' AND hc.id_periodo='$id_periodo' AND hc.estatus=1 AND m.estatus=1 GROUP BY m.codigo, m.nombre ORDER BY m.codigo ASC");

    while($array=pg_fetch_assoc($datos))
    {
        $dia[]=$array['dia'];
        $aula[]=$array['aula'];
        $materia[]=$array['codigo'];

        $n=explode(' ', $array['nombres']);
        $a=explode(' ', $array['apellidos']);

        $nombreProf[]=$n[0]." ".$a[0];
    }
$datos3=pg_query("SELECT * FROM secciones WHERE id_seccion='$id_seccion'");
$array3=pg_fetch_assoc($datos3);

$sede=$array3['sede'];
$pnf=$array3['pnf'];
$seccion=$array3['seccion'];
$trayecto=$array3['trayecto'];

$datos4=pg_query("SELECT * FROM periodo WHERE id_periodo='$id_periodo'");
$array4=pg_fetch_assoc($datos4);

$periodo=$array4['tipo'];
?>

<style type="text/css">
    
    page{
        font-size: 10px;
    }

    .page_header{
        font-size: 10px;
    }

    table.page_header{
        width: 100%;
        border: none;
        margin: 0 auto;
        margin-left: -240px; padding: 0;
        display: inline-block;
    }
    
    #lol{
        margin-left: 30px;

        position: absolute;
    }

    #fecha{
        margin-left: 700px;
        position: absolute;
    }
</style>

<page orientation='P' backtop="22mm" backbottom="14mm" backleft="10mm" backright="10mm" footer="page;">
	<page_header style="margin-bottom:20px;" align="center">
	<div id="lol" >
		<img src="upta.jpg" alt="Logo" height="80" width="90" />
	</div>
    
    <table class="page_header">
    <?php
       include("membrete.php");
       $bar=membrete();
       echo $bar;
?>
    </table>
    <div id="fecha">
    	<?php echo $hoy;?>
    </div>
    </page_header>

    <page_footer align="center">
        		<span>&copy; Derechos Reservados</span><br>
    </page_footer>
    
    
    <div align="center">
    	<h3>Reporte de Horario</h3>
    </div>

    <?php

    $query2=pg_query("SELECT * FROM horas WHERE estatus=1 AND taller=2 ORDER BY numero_bloque ASC");
    $num=pg_num_rows($query2);

    ?>

    <table border="0" align="center">
        <tr>
            <th width="0">Sede:</th>
            <td width="0"><?php echo $sede; ?></td>
            
            <th width="0">PNF:</th>
            <td width="0"><?php echo $pnf; ?></td>
            
            <th width="0">Sección:</th>
            <td width="0"><?php echo $seccion; ?></td>
            
            <th width="0">Trayecto:</th>
            <td width="0"><?php echo $trayecto; ?></td>
            
            <th width="0">Periodo:</th>
            <td width="0"><?php echo $periodo; ?></td>
        </tr>    
    </table>

    <br>

    <table border="1" align="center">
        <tr>
            <th width="325">Código de materia:</th>
            <th width="325">Nombre de materia:</th>
        </tr>

    <?php
        while ($ar=pg_fetch_assoc($datos2))
        {
    ?>
        <tr>    
            <td width="325"><?php echo $ar['codigo']; ?></td>
            <td width="325"><?php echo $ar['nombre']; ?></td>
        </tr>    
    <?php
        }
    ?>
    </table>
<br>
    <table border="2" align="center">
        <tr>
          <th width="100" align="center">Hora</th>
          <th width="100" align="center">Lunes</th>
          <th width="100" align="center">Martes</th>
          <th width="100" align="center">Miercoles</th>
          <th width="100" align="center">Jueves</th>
          <th width="100" align="center">Viernes</th>
        </tr>
        <?php
          
          while($array2=pg_fetch_assoc($query2))
          {
            $en=explode(' ', $array2['entrada']);
            $sa=explode(' ', $array2['salida']);

            $entrada[]=$en[0];
            $salida[]=$sa[0];
          }

          for ($i=1; $i <=$num; $i++)
          { 
            $j=$i-1;

            $lunes='lunes_'.$i;
            $martes='martes_'.$i;
            $miercoles='miercoles_'.$i;
            $jueves='jueves_'.$i;
            $viernes='viernes_'.$i;

            if ($i==7)
            {
        ?>
        <tr>
          <td align="center" colspan="6">
            <b>Hora de Almuerzo</b>
          </td>
        </tr>
        <?php
            }
        ?>
        <tr>
          <td align="center" width="100"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
<!--LUNES-->
          <td align="center" width="100" height="35">
            <?php 
                for ($j=0; $j<$num2; $j++)
                { 
                    if($dia[$j]==$lunes)
                    {
                        echo $aula[$j]."<br>".$materia[$j]."<br>".$nombreProf[$j];
                    }
                }
            ?>
          </td>
<!--MARTES-->
          <td align="center" width="100">
            <?php 
                 for ($j=0; $j<$num2; $j++)
                { 
                    if($dia[$j]==$martes)
                    {
                        echo $aula[$j]."<br>".$materia[$j]."<br>".$nombreProf[$j];
                    }
                }
            ?>
          </td>
<!--MIERCOLES-->
          <td align="center" width="100">
            <?php 
                for ($j=0; $j<$num2; $j++)
                { 
                    if($dia[$j]==$miercoles)
                    {
                        echo $aula[$j]."<br>".$materia[$j]."<br>".$nombreProf[$j];
                    }
                }
            ?>
          </td>
<!--JUEVES-->
          <td align="center" width="100">
            <?php 
                for ($j=0; $j<$num2; $j++)
                { 
                    if($dia[$j]==$jueves)
                    {
                        echo $aula[$j]."<br>".$materia[$j]."<br>".$nombreProf[$j];
                    }
                }
            ?>
          </td>
<!--VIERNES-->
          <td align="center" width="100">
            <?php 
                for ($j=0; $j<$num2; $j++)
                { 
                    if($dia[$j]==$viernes)
                    {
                        echo $aula[$j]."<br>".$materia[$j]."<br>".$nombreProf[$j];
                    }
                }
            ?>
          </td>
        </tr>
        <?php

          }
        ?>
      </table>
    <br>
</page>

<?php 
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('P', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_horario'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>