<?php
require ('seguridad.php');
require ('conexion.php');

  $id=$_REQUEST['id'];
  $fecha=$_REQUEST['fecha'];
  $pr1=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id=$id AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-01-01' AND '$fecha-01-31'"));
  //
  //$pr1=pg_num_rows($pr1);
  //$datos=pg_query("SELECT * FROM maquinas m, mant_correctivo p, personal s, numero_bien n WHERE p.id_maquina='$id' AND m.id_maquina=p.id_maquina AND m.n_b=n.id_nb AND p.id_personal=s.id  AND m.estatus='1' AND p.estatus='1'  AND p.estado<>'en proceso' AND fecha_ejecucion BETWEEN  '".$desde."' AND '".$hasta."' ORDER BY fecha_ejecucion DESC");
  $fechaf=(int)$fecha+1;
  if (($fecha%4==0 and $fecha%100!=0) or $fecha%400==0)
  {
  $pr2=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-02-01' AND '$fecha-02-29'"));
  }
  else{
  $pr2=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-02-01' AND '$fecha-02-28'"));
    }
  $pr3=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-03-01' AND '$fecha-03-31'"));
  $pr4=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-04-01' AND '$fecha-04-30'"));
  $pr5=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-05-01' AND '$fecha-05-31'"));
  $pr6=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-06-01' AND '$fecha-06-30'"));
  $pr7=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-07-01' AND '$fecha-07-31'"));
  $pr8=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-08-01' AND '$fecha-08-31'"));
  $pr9=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-09-01' AND '$fecha-09-30'"));
  $pr10=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-10-01' AND '$fecha-10-31'"));
  $pr11=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-11-01' AND '$fecha-11-30'"));
  $pr12=pg_num_rows(pg_query("SELECT * FROM mant_preventivo WHERE maquina_id='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-12-01' AND '$fecha-12-31'"));
  $co1=pg_num_rows(pg_query("SELECT * 
    FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-01-01' AND '$fecha-02-31'"));
   if (($fecha%4==0 and $fecha%100!=0) or $fecha%400==0)
  {
  $co2=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-02-01' AND '$fecha-02-29'"));
  }
  else{
  $co2=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-02-01' AND '$fecha-02-28'"));
    }
  
  $co3=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-03-01' AND '$fecha-03-31'"));
  $co4=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-04-01' AND '$fecha-04-30'"));
  $co5=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-05-01' AND '$fecha-05-31'"));
  $co6=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-06-01' AND '$fecha-06-30'"));
  $co7=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-07-01' AND '$fecha-07-31'"));
  $co8=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-08-01' AND '$fecha-08-31'"));
  $co9=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-09-01' AND '$fecha-09-30'"));
  $co10=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-10-01' AND '$fecha-10-31'"));
  $co11=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-11-01' AND '$fecha-11-30'"));
  $co12=pg_num_rows(pg_query("SELECT * FROM mant_correctivo WHERE id_maquina='".$id."' AND estatus=1 AND fecha_ejecucion BETWEEN  '$fecha-12-01' AND '$fecha-12-31'"));
$numero_total_si=$pr1+$pr2+$pr3+$pr4+$pr5+$pr6+$pr7+$pr8+$pr9+$pr10+$pr11+$pr12;
$numero_total_no=$co1+$co2+$co3+$co4+$co5+$co6+$co7+$co8+$co9+$co10+$co11+$co12;

//$total=$total_si+$tota_no;
//$total_si=($total_si*100)/$total;
//$total_no=($total_no*100)/$total;

  $numero_total=$numero_total_si+$numero_total_no;

  if ($numero_total!=0){
  ?>
<center><h3>Gráficas de los Mantenimientos</h3></center>
                            <div id="canvas-holder">
<canvas id="chart-area2" width="700" height="300"></canvas>
<div id="legend2" class="chart-legend" style="font-size:14px;"></div>
</div>


<script type="text/javascript">

  var barChartData = {
    labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
    datasets : [
      {
        label: 'Total de Mantenimientos Preventivos: <?php  echo $numero_total_si; ?>',
        fillColor : "#6b9dfa",
        strokeColor : "#ffffff",
        highlightStroke: "#ffffff",
        data : ["<?php echo $pr1; ?>","<?php echo $pr2; ?>","<?php echo $pr3; ?>","<?php echo $pr4; ?>","<?php echo $pr5; ?>","<?php echo $pr6; ?>","<?php echo $pr7; ?>","<?php echo $pr8; ?>","<?php echo $pr9; ?>","<?php echo $pr10; ?>","<?php echo $pr11; ?>","<?php echo $pr12; ?>"]
      },
      {
        label: 'Total de Mantenimientos Correctivos: <?php echo $numero_total_no; ?>',
        fillColor : "#eb5d82",
        strokeColor : "#ffffff",
        highlightStroke : "#ffffff",
        data : ["<?php echo $co1; ?>","<?php echo $co2; ?>","<?php echo $co3; ?>","<?php echo $co4; ?>","<?php echo $co5; ?>","<?php echo $co6; ?>","<?php echo $co7; ?>","<?php echo $co8; ?>","<?php echo $co9; ?>","<?php echo $co10; ?>","<?php echo $co11; ?>","<?php echo $co12; ?>"]
      }
    ]

  } 
  var options = {
    segmentShowStroke: false,
    animateRotate: true,
    animateScale: false,
    percentageInnerCutout: 50,
    tooltipTemplate: "<%= value %>%"
}
 

   
/*var ctx = document.getElementById("chart-area").getContext("2d");
var ctx2 = document.getElementById("chart-area2").getContext("2d");*/
var ctx3 = document.getElementById("chart-area2").getContext("2d");
/*window.myPie = new Chart(ctx).Pie(pieData); 
window.myPie = new Chart(ctx2).Doughnut(pieData);       */
var lineChart = new Chart(ctx3).Bar(barChartData,options);
//then you just need to generate the legend
document.getElementById('legend2').innerHTML = lineChart.generateLegend();

</script>

          <?php
}
else{
  ?>
<div style="margin-left:25%;">
  <label>La maquina no posee mantenimientos en el rango indicadicado</label>
</div>
  <?php
}
          
    #array("modelo"=>$modelo);

?>

