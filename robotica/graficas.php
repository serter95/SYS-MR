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
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Prototipo con boostrap</title>

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
           
                  <p id="agregar_insu" style="  margin-top: 1%;
                  margin-left: 75%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Buscar Maquina &nbsp; <i class="fa fa-search"></i></button></p> 

                  <div  id="tabla_usuario" style="margin-left:2%">

                           <div id="canvas-holder">

<canvas id="chart-area3" width="700" height="300"></canvas>
<div id="legend" class="chart-legend" style="font-size:14px;"></div>
</div>
<?php
$q=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Torno'");
$q2=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='No Operativo' AND maquina='Torno'");
$torno_si=pg_num_rows($q);
$torno_no=pg_num_rows($q2);
$q3=pg_query("SELECT estado FROM maquinas WHERE estatus=1 AND estado='Operativo' AND maquina='Esmeril'");
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

$numero_total_si=$torno_si+$esmeril_si+$limadora_si+$fresadora_si+$taladro_si;
$numero_total_no=$torno_no+$esmeril_no+$limadora_no+$fresadora_no+$taladro_no;

//$total=$total_si+$tota_no;
//$total_si=($total_si*100)/$total;
//$total_no=($total_no*100)/$total;
?>
<script type="text/javascript">

  var barChartData = {
    labels : ["Torno","Esmeril","Limadora","Fresadora","Taladro"],
    datasets : [
      {
        label: 'Total de Maquinas Operativas: <?php  echo $numero_total_si; ?>',
        fillColor : "#6b9dfa",
        strokeColor : "#ffffff",
        highlightFill: "#1864f2",
        highlightStroke: "#ffffff",
        data : ["<?php echo $torno_si; ?>","<?php echo $esmeril_si; ?>","<?php echo $limadora_si; ?>","<?php echo $fresadora_si; ?>","<?php echo $taladro_si; ?>"]
      },
      {
        label: 'Total de Maquinas Inoperativas: <?php echo $numero_total_no; ?>',
        fillColor : "#eb5d82",
        strokeColor : "#ffffff",
        highlightFill : "#ee7f49",
        highlightStroke : "#ffffff",
        data : ["<?php echo $torno_no; ?>","<?php echo $esmeril_no; ?>","<?php echo $limadora_no; ?>","<?php echo $fresadora_no; ?>","<?php echo $taladro_no; ?>"]
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
          




                  <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_pre" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Convenio</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar este convenio?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_convenio">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Convenio()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>

<!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="concluir_pre" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Concluir Convenio</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea concluir este convenio?</h4>                            
                          <h5>Hay cláusulas sin completar, el convenio pasará a no concluido.
                          No podrá realizar cambios al convenio después de aceptar.</h5>
                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_concluir_convenio">

                          <button class="btn btn-primary" title="Aceptar" onclick="concluir_Convenio()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>

                

                <!-- detalle Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_convenio" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Detalle del Convenio</h4>
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

                <!--Reporte de maquina-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rep_maq" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Reporte de Insumos</h4>
                      </div>
                      <div class="modal-body">

                        <h4>¿Usted esta seguro de que desea generar el reporte de los insumos?</h4>                            

                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_maquina">

                        <button class="btn btn-primary" title="Aceptar" onclick="reporte_Insumos()" data-dismiss="modal" >Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                      </fieldset>

                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registrado_maquina" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Registro de Convenio</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Convenio registrado correctamente</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->        

               <!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registrado_clausula" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Registro de Clausulas</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Clausula registrado correctamente</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->        

             <!-- Modal Editado con exito-->
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editado_maquina" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="exito">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Editar Convenio</h4>
                  </div>
                  <div class="modal-body">

                    <h4>Convenio editado correctamente</h4>    
                  </div>
                  <div class="modal-footer">

                   <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                   <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                 </div>
               </div>
             </div>
           </div>
           <!-- End eliminar modal -->  
           <!-- detalle Modal -->
           <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="agua_maq" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" id="confirm">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                  <h4 class="modal-title">Reporte Convenio</h4>
                </div>
                <div class="modal-body">

                 <h4>¿Usted esta seguro de que desea generar el reporte de este convenio?</h4>                            

                 <input type="hidden" id="aceptar_reporte_convenio">
                 <input type="hidden" id="aceptar_reporte_preventivo2">
                 <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
               </div>
               <div class="modal-footer">
                <button class="btn btn-primary" title="Aceptar" onclick="reporteConvenio()" data-dismiss="modal" >Aceptar</button>
                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

              </div>
            </div>
          </div>
        </div>
        <!-- End detalle modal --> 

        <!-- Modal Eliminado con exito-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminado_maquina" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="exito">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Eliminar Convenio</h4>
              </div>
              <div class="modal-body">

                <h4>Convenio eliminado correctamente</h4>    
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

               <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


             </div>
           </div>
         </div>
       </div>
       <!-- End eliminar modal -->                
        <!-- Modal Editado con exito-->
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal_no_concluido" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="exito">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Concluido Convenio</h4>
                  </div>
                  <div class="modal-body">

                    <h4>El Convenio ha cambiado el estado a "No Concluido"</h4>    
                  </div>
                  <div class="modal-footer">

                   <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                   <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                 </div>
               </div>
             </div>
           </div>
           <!-- End eliminar modal -->  
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
  
 


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_clausula" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Clausula</h4>
                        </div>
                        <div class="modal-body">
                       <form action="modificar_clausula.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarFormCmod()">

                         <input type="hidden" name="id" id="idclausulamod">
                         <input type="hidden" name="id2" id="idconvenioClau1">
                         <input type="hidden" name="tipo" value="clausula">
                          <table width="100%">
                              <tr>
                              <td align="center">

                              <label><b>Contenido de la Clausula:</b></label><br>
                              <textarea type="text" class="form-control" style="width:60%; display:inline-block; resize:none; height:250px;" name="clausula" id="clausulamod"    onKeyUp="validarClausulasmod();" onblur="validarClausulasmod();" onkeypress="return soloAlfa2(event);"></textarea>
                             <div class="promts"> <span id="clausulamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                             </td>
                                
                             </tr>
                             <tr>
                              <td align="center">
                              <h3><div id="mensaje_incorrectoCmod"></div></h3>
                              </td>
                              </tr>
                                 <tr>
                                <td align="center">
                                <br><br>

                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
                                <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
                                <br><br>
                                </td>
                                </tr>
                                </table>
                           </div>

                           <div class="modal-footer">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End modal -->

                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_seguimiento" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Seguimiento de la Clausula</h4>
                        </div>
                        <div class="modal-body">
                       <form action="modificar_clausula.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarFormSmod()">

                         <input type="hidden" name="id" id="idclausulamodS">
                         <input type="hidden" name="tipo" value="seguimiento">
                         <input type="hidden" name="id2" id="idconvenioClau2">
                          <table width="100%">
                              <tr>
                              <td align="center">
                              <div style="display:table;">
                              <label><b>Porcentaje de Cumplimiento de la clausula:</b></label><br>
                              <input type="text" class="form-control" style="width:20%; display:inline-block;" maxlength="3" name="seguimiento" id="seguimientomod"    onKeyUp="validarSeguimientomod();" onblur="validarSeguimientomod();" onchange="limitaInputS(this);" onkeypress="return solonum3(event)" >
                              <input type="text" readonly="readonly" value="%" class="form-control" style="width:10%; display:inline-block;">
                             <div class="promts" style="margin-left:70px;"> <span id="seguimientomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                             </div>
                             </td>
                                
                             </tr>
                             <tr>
                              <td align="center">
                              <h3><div id="mensaje_incorrectoSmod"></div></h3>
                              </td>
                              </tr>
                                 <tr>
                                <td align="center">
                                <br><br>

                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
                                <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
                                <br><br>
                                </td>
                                </tr>
                                </table>
                           </div>

                           <div class="modal-footer">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End modal -->

                  <!-- Modal Editado con exito-->
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editado_clausula" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="exito">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Editar Clausula</h4>
                  </div>
                  <div class="modal-body">

                    <h4>Clausula editada correctamente</h4>    
                  </div>
                  <div class="modal-footer">

                   <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                   <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                 </div>
               </div>
             </div>
           </div>
           <!-- editada con exito modal -->

           <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_clau" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Clausula</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar esta Clausula?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_clausula">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Clausula()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>

           <!-- End eliminar modal -->  
            <!-- Modal Eliminado con exito-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminado_clau" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="exito">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Eliminar Clausula</h4>
              </div>
              <div class="modal-body">

                <h4>Clausula eliminada correctamente</h4>    
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

               <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


             </div>
           </div>
         </div>
       </div>
       <!-- End eliminar modal -->      
<!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="convenio_concluido" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Concluir Convenio</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Todas las clausulas han sido completadas, Convenio Concluido con exito</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->       

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