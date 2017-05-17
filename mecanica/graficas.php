<?php
  require('seguridad.php');
  require('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
 <meta name="author" content="Nelson Soto, Sergei Terán, Vicente Cifuentes">
    <meta name="keyword" content="Sistema de Mecánica y Robótica">

    <title>SYS-M&R</title>


    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
      <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="css/nuestro.css" rel="stylesheet">
        <link href="css/nuevo2.css" rel="stylesheet">
  <link href="css/jquery.fancybox.css" type="text/css"  rel="stylesheet">

    <script src="js/Chart.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- DataTables CSS -->
    <!--<link href="assets/css/dataTables.responsive.css" rel="stylesheet"-->
    <link href="assets/css/3/dataTables.bootstrap.css" rel="stylesheet">
    <!--link href="assets/css/jquery.dataTables.min.css" rel="stylesheet"-->

  </head>

  <body>
    <style type="text/css">
    .chart-legend li span{
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
}
</style>
  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
       <header class="header black-bg">
      <?php
        include("header.php");
        $head=cabecera();
        echo $head;
      ?>
    </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
     <?php
        include("sidebar.php");
        $bar=barleft();
        echo $bar;
      ?>
     </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-9 main-chart">
              <ajax>
             <div id="mensaje"></div>

             <div id="centro_principal"></div>

                <div id="consulta_insu">

              <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="maquinas.php">Control de Maquinas</a> <span>></span> <a href="#">Gráficas</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Gráfica de las Maquinas</span>
                </div>

                 <!-- <p id="reporte_maq"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p>  -->

               <!-- <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
                  <p id="ver_graficas" style="margin-top: 1%; display:inline-block; margin-left:5%" onclick="mostrarGrafica();"><button class="btn btn-default">Gráficas Guardadas &nbsp; <span class="fa fa-book"></span></button></p>
                  <p id="agregar_insu" style="  margin-top: 1%;
                  margin-left: 45%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Buscar Maquina &nbsp; <i class="fa fa-search"></i></button></p> 

                  <div  id="tabla_usuario" style="margin-left:2%">
                        <center><h3>Gráficas del Estado de las Máquinas</h3></center>
                           <div id="canvas-holder">

<canvas id="chart-area3" width="700" height="300"></canvas>
<div id="legend" class="chart-legend" style="font-size:14px;"></div>
</div>
<?php
$con=pg_query("SELECT * FROM tipo_maquina WHERE estatus=1");
$con2=pg_query("SELECT nombre FROM tipo_maquina WHERE estatus=1");
$row=pg_num_rows($con);
while ($array=pg_fetch_assoc($con)) {
 
 $nom_maq[]=$array['nombre'];
}

for ($i=0; $i<$row; $i++){
  $q=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='$nom_maq[$i]'");
$q2=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='$nom_maq[$i]'");

$num1=pg_num_rows($q);
$num_op=$num_op+$num1;

$num2=pg_num_rows($q2);
$num_no=$num_no+$num2;

$num_oper[]=pg_num_rows($q);
$num_noper[]=pg_num_rows($q2);

}

$array_oper=json_encode($num_oper);
$array_no=json_encode($num_noper);

//$torno_si=pg_num_rows($q);
//$torno_no=pg_num_rows($q2);

/*$q3=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Esmeril'");
$q4=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='Esmeril'");
$esmeril_si=pg_num_rows($q3);
$esmeril_no=pg_num_rows($q4);
$q5=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Limadora'");
$q6=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='Limadora'");
$limadora_si=pg_num_rows($q5);
$limadora_no=pg_num_rows($q6);
$q7=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Fresadora'");
$q8=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='Fresadora'");
$fresadora_si=pg_num_rows($q7);
$fresadora_no=pg_num_rows($q8);
$q9=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Taladro'");
$q0=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='Taladro'");
$taladro_si=pg_num_rows($q9);
$taladro_no=pg_num_rows($q0);
*/
//$numero_total_si=$torno_si+$esmeril_si+$limadora_si+$fresadora_si+$taladro_si;
//$numero_total_no=$torno_no+$esmeril_no+$limadora_no+$fresadora_no+$taladro_no;
$h=0;
while($array2=pg_fetch_assoc($con2)){
  $tipo[]=$array2['nombre'];
  $h++;

}
 /* $sep=explode(",", $tipo); //Separo todos los arreglos conseguidos
   $ultimo=array_pop($sep);//sacamos el último valor del arreglo
  $uni=implode(",", $tipo);  //Uno todos los arreglos conseguidos
 */
 $arrayjs=json_encode($tipo);

//  echo $uni;

$numero_total_si=$num_op;
$numero_total_no=$num_no;

//echo "\"$numero_total_si\"";


//$total=$total_si+$tota_no;
//$total_si=($total_si*100)/$total;
//$total_no=($total_no*100)/$total;
?>
<script type="text/javascript">
  var barChartData = {
   // labels : '<?php for ($j=0; $j<$row; $j++){ $maq=$nom_maq[$j]; echo "[$maq]".","; } ?>' ,// ["Torno","Esmeril","Limadora","Fresadora","Taladro"],
    labels:  JSON.parse('<?php echo $arrayjs; ?>'),
    datasets : [
      {
        label: 'Total de Maquinas Operativas: <?php  echo $numero_total_si; ?>',
        fillColor : "#6b9dfa",
        strokeColor : "#ffffff",
        highlightFill: "#1864f2",
        highlightStroke: "#ffffff",
        data : JSON.parse('<?php echo $array_oper; ?>'),
        //["<?php echo $torno_si; ?>","<?php echo $esmeril_si; ?>","<?php echo $limadora_si; ?>","<?php echo $fresadora_si; ?>","<?php echo $taladro_si; ?>"]
      },
      {
        label: 'Total de Maquinas Inoperativas: <?php echo $numero_total_no; ?>',
        fillColor : "#eb5d82",
        strokeColor : "#ffffff",
        highlightFill : "#ee7f49",
        highlightStroke : "#ffffff",
        data : JSON.parse('<?php echo $array_no; ?>'),
        //["<?php echo $torno_no; ?>","<?php echo $esmeril_no; ?>","<?php echo $limadora_no; ?>","<?php echo $fresadora_no; ?>","<?php echo $taladro_no; ?>"]
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
var ctx3 = document.getElementById("chart-area3").getContext("2d");
/*window.myPie = new Chart(ctx).Pie(pieData); 
window.myPie = new Chart(ctx2).Doughnut(pieData);       */
var lineChart = new Chart(ctx3).Bar(barChartData,options);
//then you just need to generate the legend
document.getElementById('legend').innerHTML = lineChart.generateLegend();

</script>

                  </div>
                <div align="center">

               
                               <button type="button" id="guardar_grafic" class="btn btn-primary" onclick="save_grafica();">Guardar Gráfica</button>
     <script type="text/javascript">
                

                  function save_grafica(){
     $('#alert_grafica').modal({
      show:true,
      backdrop:'static'
    }).show();
}

            

  function saveImage() {
    var canvas = document.getElementById("chart-area3");
    var data = canvas.toDataURL('image/png');
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      // request complete
      if (xhr.readyState == 4) {
       // window.open('/graficas/'+xhr.responseText,'_blank');
   $('#grafica_guardada').modal({

      show:true,
      backdrop:'static'
    }).show();

      }
    }
    xhr.open('POST','guardando_grafica.php',true);
    xhr.setRequestHeader('Content-Type', 'application/upload');
    xhr.send(data);
  }
            </script>
                 </div>
                 <br>
   </div>


 </div>

 <div id="r_insumos">
  <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="maquinas.php">Control de Maquinas</a> <span>></span> <a href="graficas.php">Gráficas</a> <span>></span> <a href="#">Buscar Maquina</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Buscar Maquina</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <div id="reg_maquina">
        <br>
        <table width="100%">
          <tr>
            <td align="center" >
              <input type="text" id="fechagrafica" style="text-align:center;">
            </td>
          </tr>
          <tr>
            <td align="center">
                 <label>Código de la maquina:</label>
                        <input type="text" style="text-transform:capitalize; width:150px; display:inline-block;" class="form-control" name="codigo" id="codigopre" onchange="codemaquinasReporte(); existeCodigo();" onkeyup="existeCodigo()"  onblur="codemaquinasReporte(); existeCodigo();" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina">
                        <div class="promts" style="margin-left:1px"> <span style="font-size:15px;" id="CodeprePrompt"></span></div>
                         <input type="hidden" name="respre" id="respre">
                         <input type="hidden" id="id_maq_preventivo">
                       </td>
          </tr>
          <tr>
            <td align="center">
              <br>
               <input class="btn btn-primary" type="submit" value="Buscar" title="Buscar" id="buscargrafica" onclick="buscarGrafica();"> 

            </td>
          </tr>
                         </table>

<div id="buscandografica"></div>
</div>


      </div>                 
</div>
</div>
  
 

            <div id="c_clausulas" style="display:none;">
              <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="maquinas.php">Control de Maquinas</a> <span>></span> <a href="graficas.php">Gráficas</a> <span>></span> <a href="#">Consulta de las gráficas</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Graficas de las máquinas operativas e inoperativas</span>
                </div>

                 <!-- <p id="reporte_clau" style="display: inline-block; margin-top: 1%; margin-left: 2%; margin-bottom: 1%;"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p> -->

               <!-- <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
             
                  <div  id="tabla_usuario">

                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-exampleGraficas">
                        <thead>
                          <tr>
                            <th width="400">Fecha</th>
                            <th width="50">Hora</th>
                        
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody id="tbody_consultaClau">
                        
                        </tbody>
                      </table>
                    </div>

                  </div>
  </div>
  </div>

          <!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="alert_grafica" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="confirm">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Guardar Gráfica</h4>
                    </div>
                    <div class="modal-body" align="center">

                      <h4>¿Desea Guardar la Gráfica?</h4>    
                      <h5>Si una gráfica se guarda el mismo día este sustituira la gráfica anterior</h5>
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Aceptar" id="" onclick="saveImage();">Aceptar</button>

                     <button id="cerrar_dialog_eli"class="btn btn-danger" title="Cancelar"  data-dismiss="modal" aria-hidden="true">Cancelar</button>


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->       


          <!-- detalle Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_grafica" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Detalle de la Gráfica</h4>
                      </div>
                      <div class="modal-body">

                        <div id="detalle"></div>

                      </div>
                      <div class="modal-footer">

                      </div>
                    </div>
                  </div>
                </div>
                <!-- End detalle modal -->    

         
<!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="grafica_guardada" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Guardar Gráfica</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Gráfica Guardada con exito</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito --> 

               <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maq" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Gráfica</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar esta gráfica?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_grafica">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Grafica()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>
   

              <!-- Modal Eliminado con exito-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminado_grafica" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="exito">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Eliminar Gráfica</h4>
              </div>
              <div class="modal-body">

                <h4>Gráfica eliminada correctamente</h4>    
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

               <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


             </div>
           </div>
         </div>
       </div>
       <!-- End eliminar modal -->                   

       <?php
 include("form_user_elim.php");
 $user_elim=form_user_elim();
 echo $user_elim;
 ?>

            </div><!-- /col-lg-9 END SECTION MIDDLE -->    
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
            <div class="col-lg-3 ds">
              <?php
                include("right_sidebar.php");
                $barright=barright();
                echo $barright;
              ?>
            </div><!-- /col-lg-3 -->        
          </div><!-- end row -->
        </section>
      </section>
      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
           <?php
        include("footer.php");
        $pie=pie();
        echo $pie;
      ?>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    
    <!-- << DataTables JavaScript >>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>-->

    <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
    
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>

    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
  	<script src="assets/js/zabuto_calendar.js"></script>	
  	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
   <script type="text/javascript" src="js/jquery.fancybox.js"></script>
    <script type="text/javascript">
  $(document).ready(function ($) {
    // trigger event when button is clicked
    var  cantInt;
    var cantidad;
    //$(".add").click(function () 
      $(".add").on("click", function () {
        // add new row to table using addTableRow function
        


  addTableRow($("#tablo"));
        //aqui id de la table a utilizar
    
//---------------End modificado----------

        // prevent button redirecting to new page
       

    });

    // function to add a new row to a table by cloning the last row and 
    // incrementing the name and id values by 1 to make them unique
    function addTableRow(table) {


        // clone the last row in the table
        var $tr = $(table).find("tbody tr:last").clone();

       $tr.find('[id^=clausulasPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + +parts[2];
        }).text("");

        // get the name attribute for the input and select fields
        $tr.find('[id^=clausula]').attr("name", function () {
            // break the field name and it's number into two parts
            

      //  var parts = this.id.match(/(\D+)(\d+)$/);
      
            // create a unique name for the new field by incrementing
            // the number for the previous field by 1

         // 

      //    return parts[1] + ++parts[2];

            // repeat for id attributes
          }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];

          }).val("");

        
        // append the new row to the table
        $(table).find("tbody tr:last").after($tr);
        $tr.show();
        //   $tr.hide().fadeIn('slow');
        // row count
        rowCount = 0;
        $("#tablo tr td:first-child").text(function () {
          return ++rowCount;
        });

        // remove rows
        
        $(".remove_button").on("click", function () {


          if ( $('#tablo tbody tr').length == 1) return;
         


           
            $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;


//--------------modificado-----------

           //  cantidad=document.getElementById("control_cantidad").value;
          
////-----------End modificado-----------

$("#tablo tr td:first-child").text(function () {
  return ++rowCount;
});
});

            

                  });



      };
    });
</script>
<script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/lang/es.js"></script>
     <script type="text/javascript" src="funciones.js"></script>
     <script type="text/javascript" src="js/jquery.fancybox.js"></script>

<script type="text/javascript">

$("#buscargrafica").attr('disabled',true);
   

var d = new Date();
    var month = d.getMonth();
    var day = d.getDate();
    var year = d.getFullYear();
    var dateNow=new Date(year, month, day);
   $("#fechagrafica").attr('readonly',true);

        $("#fechagrafica").datetimepicker({
            format: 'YYYY',
            defaultDate: dateNow,
            useCurrent: true,
            pickTime: false,
            showTodayButton: true,
        });

function existeCodigo(){
 var user = document.getElementById("codigopre").value;

var consulta;

consulta=$("#codigopre").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);

  if (user==0){
      mostrarPrompt("Campo Requerido", "CodeprePrompt", "red");
      return false;
      $("#buscargrafica").attr('disabled',true);

    }
  if(user.length == 0){
      mostrarPrompt("Campo Requerido", "CodeprePrompt", "red");
      return false;
      $("#buscargrafica").attr('disabled',true);

    }
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodeprePrompt", "red");
          return false;
          $("#buscargrafica").attr('disabled',true);

    }

   $.ajax({
      type:"POST",
      url:"verificar_codigo.php",
      data:"codigo="+consultax,
      success: function (data){
        
        $('#respre').val(data);


        var valor2 = document.getElementById("respre").value;

      if (valor2==0)
    {

       mostrarPrompt("No existe", "CodeprePrompt", "red");
       $("#buscargrafica").attr('disabled',true);
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "CodeprePrompt", "green");
         $("#buscargrafica").attr('disabled',false);

    }
      }

    });


 var valor = document.getElementById("respre").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodeprePrompt", "red");

        return false;
      }
 
       if (valor==0)
    {

 
      return false;
    }
   if (valor==1)
    {


      return true;
    }
   

     
}

function codemaquinasReporte(){
     
        var url='buscar_codemaquinas.php';
        var code=document.getElementById('codigopre').value;        

        //alert("funcion personal "+ci);

        $.ajax({
            type:'POST',
            url:url,
            data:'code='+code,
            success:function(valores){
                var datos=eval(valores);

                $('#id_maq_preventivo').val(datos[0]);
                $('#nb_preventivo').val(datos[1]);
            }
        });

        
    };

    function buscarGrafica(){
      var id=document.getElementById('id_maq_preventivo').value;
      var fecha=document.getElementById('fechagrafica').value;
       $.ajax({
            type:'POST',
            url:'buscar_grafica.php',
            data:'id='+id+'&fecha='+fecha,
                 
            success: function(valores){
                
                $('#buscandografica').html(valores);
               
            }
            
        });
    }

  //  AUTOCOMPLETADO
    $(function() {
       $('#codigopre').autocomplete({
           source:'maquina_bus.php',
           minLength: 1
        });
    });


     function mostrarGrafica(){
                $('#c_clausulas').show();
                $('#consulta_insu').hide(); 

              $.ajax({
            type:'POST',
            url:'buscar_graficas.php',
            //data:'id='+id,
            success: function(valores){
                
                
                $('#tbody_consultaClau').html(valores);
                 $('#dataTables-exampleGraficas').DataTable({
              responsive: true
        });
            }
        });
 
    };

        function muestraGrafica(id){
        
        var url='detalle_grafica.php';
        
        $.ajax({
            type:'POST',
            url:url,
            data:'id='+id,
            success: function(valores){
                
                $('#detalle').html(valores);
                
                $('#detalle_grafica').modal({
                    show:true,
                    backdrop:'static'
                });
                    return false;
            }
        });
    };

    function eliminarGrafica(id){

        $('#aceptar_elim_grafica').val(id);
        $('#elim_maq').modal({
            show:true,
            backdrop:'static'
        });
            confirm_user();
    };

     function eliminar_Grafica(){

        var id = document.getElementById('aceptar_elim_grafica').value;

        window.location.href="elim_grafica.php?id="+id;
    };

    </script>
</body>
</html>

<?php
#ELIMINAR MAQUINA
$error=$_REQUEST['form_error'];

if ($error=='1')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
     var mensaje="El Numero del bien ya existe, Formulario no procesado";
    
    $("#error_mensaje").html('<br>'+mensaje);

    $('#error_form').modal({
      show:true,
      backdrop:'static'
    }).show(200);
   
        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }

$elim_maq=$_REQUEST['elim_maq'];

if ($elim_maq=='si')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
    $('#eliminado_maquina').modal({
      show:true,
      backdrop:'static'
    }).show(200);


        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }
# ERRORES MODIFICACION

    if ($error=='usuarioM')
    {
      ?>  
      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#miGestionUsuario').show();
        $('#mensaje').addClass('mal').html("¡..El usuario ya existe..!").show(200).delay(2500).hide(200);

      </script>
      <?php
    }
    $regis_maq=$_REQUEST['registrado_maq'];
    if ($regis_maq=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#registrado_maquina').modal({
          show:true,
          backdrop:'static'
        }).show(200);

     /*   $('#r_maquina').hide();
        $('#slideshow').hide();
        $('#consulta_maq').show();
        $('#mensaje').addClass('bien').html("¡..Edición de usuario exitosa..!").show(200).delay(2500).hide(200);*/
      </script>
      <?php
    }
    $edicion_maq=$_REQUEST['editado_maq'];
    if ($edicion_maq=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#editado_maquina').modal({
          show:true,
          backdrop:'static'
        }).show(200);

     /*   $('#r_maquina').hide();
        $('#slideshow').hide();
        $('#consulta_maq').show();
        $('#mensaje').addClass('bien').html("¡..Edición de usuario exitosa..!").show(200).delay(2500).hide(200);*/
      </script>
      <?php
    }
    $edicion_clau=$_REQUEST['editado_clau'];
    if ($edicion_clau=='si')
    {
      ?>

      <script type="text/javascript">

      
           var buscador="<?php echo $_REQUEST['num']; ?>";
        mostrarClausula(buscador);

        
       
          
          $('#editado_clausula').modal({
          show:true,
          backdrop:'static'
        }).show(200);

      
      
    
      </script>
      <?php
    }

    $elim_clau=$_REQUEST['elim_clau'];
    if ($elim_clau=='si')
    {
      ?>

      <script type="text/javascript">

      
           var buscador="<?php echo $_REQUEST['num']?>";
        mostrarClausula(buscador);

        
       
          
          $('#eliminado_clau').modal({
          show:true,
          backdrop:'static'
        }).show(200);

      
      
    
      </script>
      <?php
    }
     $con_con=$_REQUEST['concluido'];
    if ($con_con=='no')
    {
      ?>

      <script type="text/javascript">   
       
          
          $('#modal_no_concluido').modal({
          show:true,
          backdrop:'static'
        }).show(200);
      
    
      </script>
      <?php
    }

   
    ?>