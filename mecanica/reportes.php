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
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="css/nuestro.css" rel="stylesheet">
    <link href="css/nuevo2.css" rel="stylesheet">
    <link href="css/fancybox/jquery.fancybox.css" type="text/css"  rel="stylesheet">
    <script src="assets/js/chart-master/Chart.js"></script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

        <!-- DataTables CSS -->
    <!--<link href="assets/css/dataTables.responsive.css" rel="stylesheet"-->
    <link href="assets/css/3/dataTables.bootstrap.css" rel="stylesheet">
    <!--link href="assets/css/jquery.dataTables.min.css" rel="stylesheet"-->

    <link href="css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet">

  </head>

  <body>

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
                                                  
              <div id="consulta_maq">
                
                <h4 class="sitio_maq"><a href="#">Reportes</a></h4>
                  <div class="info3">
                    <ajax>  
                      <div id="text_center_title">
                      <span>FILTRO</span>
                    </div>
                    <div style="margin-left:40%; margin-top:2%; margin-bottom:2%;">
                    <input type="radio" name="filtro" id="filtro_todos" checked="">Todos
                    <input type="radio" name="filtro" id="filtro_fecha" style="margin-left: 15%;">Fecha
                    </div>

                     <div style="margin-left:20%; margin-top:2%; margin-bottom:2%;" id="rango">

                       <span for="from">Desde:</span>
                       <input type='text' readonly="readonly" name="desde" style="width:150px; display:inline-block;" class="form-control"  id='desde'/>

                       <label for="to" style="margin-left:10%;">Hasta:</label>
                       <input type='text' readonly="readonly" style="width:150px; display:inline-block;" class="form-control" id='hasta' />
                     </div>

                     <!--
                     <div id="div_academico">
                     <div id="text_center_title">
                      <span>ACADÉMICO</span>
                    </div>
                       <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabhorarios" data-toggle="tab">Horarios</a></li>
                                <li><a href="#tabproyectos" data-toggle="tab">Proyectos</a></li>
                                <li><a href="#tabconvenios" data-toggle="tab">Convenios</a></li>
                 

                        </ul>

                            <div class="tab-content">
                                                 
                 <div class="tab-pane fade in active" id="tabhorarios">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Horarios</h5>
                     </div>

                     <div style="margin-left:43%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;;"> 
                        <a href="#">
                          <p id="reporte_horarios">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Horarios</h4>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="tabproyectos">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Proyectos</h5>
                     </div>

                     <div style="margin-left:43%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;;"> 
                        <a href="#">
                          <p id="reporte_proyectos">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Proyectos</h4>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="tab-pane fade" id="tabconvenios">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Convenios</h5>
                     </div>

                     <div style="margin-left:42%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;;"> 
                        <a href="#">
                          <p id="reporte_convenios">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Convenios</h4>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              </div>

-->
                    <div id="text_center_title">
                      <span>MÓDULOS</span>
                    </div>

                     

                        <ul class="nav nav-tabs">
                                <li id="li_tabinventario" class="active"><a href="#tabinventario" data-toggle="tab">Inventario</a></li>
                                <li><a href="#tabmaquina" data-toggle="tab">Control de Máquinas</a></li>
                                <li><a href="#tabmantenimiento" data-toggle="tab">Mantenimiento</a></li>
                                <li><a id="li_tabactividades" href="#tabactividades" data-toggle="tab">Control de Actividades</a></li>
                                <li id="li_tabpersonal"><a href="#tabpersonal" data-toggle="tab">Personal</a></li>
                                <li id="li_tabhorario"><a href="#tabhorario" data-toggle="tab">Horario</a></li>
                        </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tabinventario">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        <div id="inventario_todos">
                       <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5> Inventario</h5>
                     </div>

                      <div style="margin-left:16%; margin-top:2%;">
                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 

                                  <form action="pdf/tcpdf/herramientas/reporte_herramientas.php" method="get" target="_blank">

                            <?php
                $estante="SELECT estante FROM herramientas WHERE estatus=1 AND taller=1 GROUP BY estante";
                $querye=pg_query($estante);
                ?>
                <label>Estante</label>
                <select name="estante"  class="form-control" >
                <?php
                while ($array=pg_fetch_assoc($querye)) {
                  ?>
                  <option value="<?php echo $array['estante']; ?>"><?php echo $array['estante']; ?></option>
                  <?php
                }
                ?>
                </select><br><br>

                             <span style="color: #333;" class="fa fa-file-text-o"></span>
                                                       <h4>Herramientas</h4>
                                                       <input type="submit"  class="form-control"  style="color: #000;" value="Visualizar">

                        <!-- <a href="pdf/reporte_herramientas.php" target="_blank">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                        </a>

                          -->
                         
                          </form>
       
                        </div>

                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="pdf/reporte_insumos.php" target="_blank">
                          
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                         </a>
                          <h4>Insumos</h4>
                        </div>
                      </div>
                    </div>

                     <div id="inventario_fecha">
                       <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5> Inventario</h5>
                     </div>

                      <div style="margin-left:16%; margin-top:2%;">
                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="#">
                          <p id="reporte_herramientas">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Herramientas</h4>
                        </div>

                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="#">
                          <p id="reporte_insumos">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Insumos</h4>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                  
                      <div class="tab-pane fade" id="tabmaquina">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                      <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5> Control de Máquinas</h5>
                     </div>
                    
                        <div id="maquinas_todos">
                          <table width="100%">
                            <tr>
                              <td width="50%" align="center">
                          <br>
                         <div> <label>Seleccione Tipo de Máquina</label><br>
                    <select name="maquina" id="select_maqs" class="form-control" style="width:70%;">
                      <?php 
                      $select=pg_query("SELECT * FROM tipo_maquina WHERE estatus=1");

                      while($array=pg_fetch_assoc($select)){
                        ?>
                        <option value="<?php echo $array['nombre'];?>" ><?php echo $array['nombre'];?></option>
                      <?php
                    }
                    ?>
                    </select>
                    <br><br>
                          <button type="button" class="btn btn-primary" id="reporte_maqs" >Aceptar</button>

                  </div>
                </td>
                <td>


                              <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:14%;"> 
                                <a href="pdf/reporte_maquina.php" target="_blank">
                                    <span style="color: #333;" class="fa fa-file-text-o"></span> 
                                    </a>
                                  <h4>Completo</h4>
                                </div>
                                </td>
                              </tr>
                          </table>      
                    </div>

                    <div id="maquinas_fecha">

                    <table width="100%">
                            <tr>
                              <td width="50%" align="center">
                          <br>
                         <div> <label>Seleccione Tipo de Máquina</label><br>
                    <select name="maquina" id="select_maqs2">
                      <?php 
                      $select=pg_query("SELECT * FROM tipo_maquina WHERE estatus=1");

                      while($array=pg_fetch_assoc($select)){
                        ?>
                        <option value="<?php echo $array['nombre'];?>" ><?php echo $array['nombre'];?></option>
                      <?php
                    }
                    ?>
                    </select>
                    <br><br>
                          <button type="button" class="btn btn-primary" id="reporte_maqs2" >Aceptar</button>

                  </div>
                </td>
                <td>


                              <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:14%;"> 
                                <a href="#">
                                  <p id="reporte_maq_completo">
                                    <span style="color: #333;" class="fa fa-file-text-o"></span> 
                                  </p>  </a>
                                  <h4>Completo</h4>
                                </div>
                                 </td>
                              </tr>
                          </table>  
                              
                    </div>
                    </div>
                  </div>
                </div>
                  <div class="tab-pane fade" id="tabmantenimiento">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Mantenimientos</h5>
                     </div>
                     
                   <div style="margin-left:16%; margin-top:2%;" id="mantenimiento_todos">
                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="pdf/reporte_preventivo.php" target="_blank">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                        </a>
                          <h4>Preventivo</h4>
                        </div>

                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="pdf/reporte_correctivo.php" target="_blank">
                          
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                         </a>
                          <h4>Correctivo</h4>
                        </div>
                      </div>
                        <div style="margin-left:16%; margin-top:2%;" id="mantemiento_fecha">
                        <input type="radio" name="filtro_codigo" id="filtro_codigo_no" checked="" style="margin-left: 25%;">Todos
                        <input type="radio" name="filtro_codigo" id="filtro_codigo_si" style="margin-left: 15%;">Individual
                   
                        <div id="mantentimiento_fecha_todos">
                        <div id="mantenimiento_rango_todos">
                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="#" >
                            <span style="color: #333;" class="fa fa-file-text-o" id="reporte_preventivos_rango"></span> 
                        </a>
                          <h4>Preventivo</h4>
                        </div>

                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                        <a href="#">
                          
                            <span style="color: #333;" class="fa fa-file-text-o"  id="reporte_correctivos_rango"></span> 
                         </a>
                          <h4>Correctivo</h4>
                        </div>
                      </div>
                      </div>
                      <div id="mantenimiento_individual">
                         
                      <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                                 <form id="form_preventivo" method="post" action="pdf/reporte_individual_preventivo_rango.php" target="_blank">
                         <label>Código de la maquina:</label><br>
                        <input type="text" style="text-transform:capitalize; width:150px; display:inline-block;" class="form-control" name="codigo" id="codigopre" onkeyup="existeCodigo()" onblur="codemaquinasReporte(); existeCodigo();" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina">
                        <div class="promts" style="margin-left: 70px; margin-top: -60px;"> <span style="font-size:15px;" id="CodeprePrompt"></span></div>
                        <input type="hidden" name="respre" id="respre">
                        <input type="hidden" name="desde" id="desde_preventivo">
                        <input type="hidden" name="hasta" id="hasta_preventivo">
                        <input type="hidden" name="id_maq" id="id_maq_preventivo">
                        <input type="hidden" name="nb" id="nb_preventivo">
                      </form>
                      <br><br>
                        <a href="#" onclick="reporte_mantenimiento_preventivo_rango();" >
                            <span style="color: #333;" class="fa fa-file-text-o" ></span> 
                        </a>
                          <h4>Preventivo</h4>
                        </div>
               

                         <div class="box1" style="display:inline-block; border-bottom:0px; margin-left:15%;"> 
                          <form id="form_correctivo" method="post" action="pdf/reporte_individual_correctivo_rango.php" target="_blank">
                         <label>Código de la maquina:</label><br>
                        <input type="text" style="text-transform:capitalize; width:150px; display:inline-block;" class="form-control"  name="codigo" id="codigocor" onkeyup="existeCodigo2()" onblur="codemaquinasReporte(); existeCodigo2();" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina">
                        <div class="promts" style="margin-left: 70px; margin-top: -60px;"> <span style="font-size:15px;" id="CodecorPrompt"></span></div>
                        <input type="hidden" name="rescor" id="rescor">
                        <input type="hidden" name="desde" id="desde_correctivo">
                        <input type="hidden" name="hasta" id="hasta_correctivo">
                        <input type="hidden" name="id_maq" id="id_maq_correctivo">
                        <input type="hidden" name="nb" id="nb_correctivo">
                      </form>
                       <br><br>
                        <a href="#" onclick="reporte_mantenimiento_correctivo_rango();">
                          
                            <span style="color: #333;" class="fa fa-file-text-o" ></span> 
                         </a>
                          <h4>Correctivo</h4>
                        </div>
                      

                      </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="tabactividades">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Control de Actividades</h5>
                     </div>

                    <div style="margin-left:40%; margin-top:2%; margin-bottom:2%;" id="div_radio_filtro_cedula">
                    <input type="radio" name="filtro_cedula" id="filtro_cedula_no" checked="">Todos
                    <input type="radio" name="filtro_cedula" id="filtro_cedula_si" style="margin-left: 15%;">Individual
                    </div>

                     <div style="margin-left:43%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;" id="div_filtro_cedula_no"> 
                        <a href="#">
                          <p id="reporte_actividades">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Actividades</h4>
                        </div>                  
                        <form id="form_actividades" method="post" action="pdf/reporte_semanal_rango.php" target="_blank">
                         <div class="box1" style="display:inline-block; border-bottom:0px;" id="div_filtro_cedula_si"> 
                         <div style="display:table;">
                         <label>Cédula del personal:</label><br>
                         <select id="nacionalidad" name="nacionalidad" style="width:70px; display:inline-block;" class="form-control" title="Seleccione la nacionalidad de la persona" onkeyup="validarNAC();" onblur="validarNAC();" onclick="validarNAC();">
                    <option></option>
                    <option>V-</option>
                    <option>E-</option>
                  </select>
                  <input type='text' name="ci_per" style="width:150px; display:inline-block;" class="form-control"  id='ci_per' maxlength="8" onkeyup="validarCI();" onblur="validarCI();" />
                  <div class="promts" > <span style="font-size:15px;" id="C.I_per"></span></div>
                  <input type="hidden" name="validar_ci_ajax" id="validar_ci_ajax">
                   <input type="hidden" name="desde" id="desde_actividades">
                   <input type="hidden" name="hasta" id="hasta_actividades">
                   <input type="hidden" name="cedula" id="cedula_filtro_actividades">
                          </div>
                          <br><br>

                        <a href="#">
                          <p onclick="reporte_nombre_semanal()">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Actividades</h4>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                 <div class="tab-pane fade" id="tabpersonal">
                  <div class="panel panel-default">
                    <div class="panel-body" id="personal_todos">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Personal</h5>
                     </div>

                     <div style="margin-left:45%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;;"> 
                        <a href="pdf/reporte_personal.php" target="_blank">
                          <p id="reporte_personal">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Personal</h4>
                        </div>

                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="tabhorario">
                  <div class="panel panel-default">
                    <div class="panel-body">
                     <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Horario</h5>
                     </div>

                     <div style="margin-left:40%; margin-top:2%;">                  
                        <form id="form_actividades" method="post" action="pdf/reporte_semanal_rango.php" target="_blank">
                         
                         <div class="box1" style="display:inline-block; border-bottom:0px;" id="div_horario"> 
                          
                          <div style="display:table;">
                           <label>Nombre del profesor:</label><br>
                            <select id="ced_p" name="ced_p" style="display:inline-block;" class="form-control" title="Seleccione la cedula del profesor">
                              
                              <option></option>
                              <?php
                                $query=pg_query("SELECT * FROM personal WHERE area='Mecanica' AND cargo='Profesor' AND estatus=1");

                                while($array=pg_fetch_assoc($query))
                                {

                                  $nom=explode(' ', $array['nombres']);
                                  $ape=explode(' ', $array['apellidos']);
                              ?>
                              <option value="<?php echo $array['id']; ?>"><?php echo $nom[0].' '.$ape[0]; ?></option>
                              <?php
                                }
                              ?>
                            </select>

                            <label>Periodo:</label><br>
                            <select id="id_periodo" name="id_periodo" style="display:inline-block;" class="form-control" title="Seleccione la cedula del profesor">
                              
                              <option></option>
                              <?php
                                $query=pg_query("SELECT * FROM periodo");

                                while($array=pg_fetch_assoc($query))
                                {
                              ?>
                              <option value="<?php echo $array['id_periodo'];?>"><?php echo $array['tipo']?></option>
                              <?php
                                }
                              ?>
                            </select>
                          
                          </div>
                          <br><br>

                        <a href="#">
                          <p onclick="reporte_profesor()">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Horario de Profesor</h4>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
<!--                <div id="configuracion_todos">
                   <div id="text_center_title">
                      <span>CONFIGURACIÓN</span>
                    </div>
                        <div style="text-align: center;border-bottom: 1px solid #989898;">
                       <h5>Configuración</h5>
                     </div>

                     <div style="margin-left:45%; margin-top:2%;">
                       <div class="box1" style="display:inline-block; border-bottom:0px;;"> 
                        <a href="#">
                          <p id="reporte_auditoria">
                            <span style="color: #333;" class="fa fa-file-text-o"></span> 
                          </p>  </a>
                          <h4>Auditoria</h4>
                        </div>

                        
                      </div>
              </div>
-->
              </div>            


              <!-- Modal Error formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompleto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Reportes</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Faltan Datos, para generar el reporte</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar" id="btn_error_incompleto">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 


                    <!--Reporte de maquina-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rep_maq" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Reporte de Maquina</h4>
                          </div>
                          <div class="modal-body">

                            <h4>¿Usted esta seguro de que desea generar el reporte de las maquinas?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_maquina">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="reporte_Maquina()" data-dismiss="modal" >Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!--Reporte de maquina-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="SC" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Reporte de Horarios de profesores</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Seleccione el nombre del profesor y el periodo!</h4>                            
                          
                          </div>
                          <div class="modal-footer">
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>  
                          </div>
                        </div>
                      </div>
                    </div>

       
                    

                          
                </ajax>
              </div>
            </div>

             
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
    <script type="text/javascript" src="funciones.js"></script>
         <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
   
    <script type="text/javascript" src="js/jquery.fancybox.js"></script>

    <script type="text/javascript" src="js/lang/es.js"></script>

 
<script type="text/javascript">
    $(function () {
      var d = new Date();
      var month = d.getMonth();
      var day = d.getDate()+1;
      var year = d.getFullYear();
      var dateNow= new Date();
      var dateNext=new Date(year, month, day);
        $('#desde').datetimepicker({ 
          format: 'DD/MM/YYYY', useCurrent:true,pickTime: false,defaultDate:dateNow,  showTodayButton: true}
          );
        $('#hasta').datetimepicker({
          format: 'DD/MM/YYYY',useCurrent:true, defaultDate:dateNext, pickTime: false,    startDate: '+1d'
        });
        $("#desde").on("dp.change", function (e) {
            $('#hasta').data("DateTimePicker").setMinDate(e.date);
        });
        $("#hasta").on("dp.change", function (e) {
            $('#desde').data("DateTimePicker").setMaxDate(e.date);
        });
    });
</script>

<script type="text/javascript">
 $('#rango').hide();
     $('#inventario_fecha').hide();
     $('#maquinas_fecha').hide();
     $('#div_filtro_cedula_si').hide();
     $('#div_radio_filtro_cedula').hide();
     $('#mantemiento_fecha').hide();
     $('#mantenimiento_individual').hide();
 $('#filtro_todos').click(function(){
  $('#div_academico').show();
  $('#rango').hide();
  $('#inventario_todos').show();
  $('#inventario_fecha').hide();
  $('#maquinas_fecha').hide();
    $('#maquinas_todos').show();
     $('#configuracion_todos').show();
    $('#div_filtro_cedula_si').hide();
    $('#div_filtro_cedula_no').show();
    $('#div_radio_filtro_cedula').hide();
    $('#mantenimiento_todos').show();
    $('#mantemiento_fecha').hide();
    $('#li_tabpersonal').show();
    $('#personal_todos').show();
    $('#li_tabinventario').show();
     $('#inventario_fecha').hide();
    $('#li_tabactividades').hide();
    $('#tabactividades').attr('style','display:none;');

    document.getElementById('filtro_cedula_si').checked=false;
        document.getElementById('filtro_cedula_no').checked=true;

    });

  $('#filtro_fecha').click(function(){
  $('#div_academico').hide();
  $('#rango').show();
  $('#inventario_todos').hide();
  $('#inventario_fecha').show();
  $('#maquinas_fecha').show();
    $('#maquinas_todos').hide();
  $('#configuracion_todos').hide();
  $('#div_radio_filtro_cedula').show();
  $('#mantemiento_fecha').show();
  $('#mantenimiento_todos').hide();
  $('#li_tabpersonal').hide();
  $('#personal_todos').hide();
   $('#li_tabinventario').hide();
  $('#inventario_fecha').hide();
   //   $('#inventario_fecha').show();
     $('#li_tabactividades').show();
    $('#tabactividades').attr('style','');

    });

$('#filtro_cedula_no').click(function(){
   $('#div_filtro_cedula_si').hide();
  $('#div_filtro_cedula_no').show();
});

$('#filtro_cedula_si').click(function(){
   $('#div_filtro_cedula_si').show();
  $('#div_filtro_cedula_no').hide();
});

$('#filtro_codigo_no').click(function(){
   $('#mantenimiento_individual').hide();
  $('#mantenimiento_rango_todos').show();
});

$('#filtro_codigo_si').click(function(){
   $('#mantenimiento_individual').show();
  $('#mantenimiento_rango_todos').hide();
});


$('#reporte_maqs').click(function(){
  var maq= document.getElementById('select_maqs').value;
 
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_maqs.php?maq="+maq+"","_blank");
    });

$('#reporte_maqs2').click(function(){
  var maq= document.getElementById('select_maqs2').value;
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");

      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");

     window.open("pdf/reporte_maqs_rango.php?desde="+desde+"&hasta="+hasta+"&maq="+maq+"","_blank");

   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
    });



$('#reporte_torno').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_tornos.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_esmeril').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_esmeril_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_limadora').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_limadora_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_fresadora').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_fresadora_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_taladro').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_taladro_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_maq_completo').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_maquinas_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_preventivos_rango').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_preventivos_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_correctivos_rango').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_correctivos_rango.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });

$('#reporte_actividades').click(function(){
  var desde= document.getElementById('desde').value;
   var hasta= document.getElementById('hasta').value;
      //    window.open("pdf/html2pdfcopy.php?id_maq='"+id+"'&user="+user+"","_blank");


   
      //window.open("pdf/reporte_tornos.php?desde=2015-07-06&hasta=2015-07-06","_blank");
     window.open("pdf/reporte_semanal_completo.php?desde="+desde+"&hasta="+hasta+"","_blank");
    });



function validarCI()
{
    var user = document.getElementById("ci_per").value;    
    var nac = document.getElementById("nacionalidad").value;

    var ci=nac+user;

  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_per", "red");
        return false;
    }
  else if(user.length == 0){
         mostrarPrompt("Campo Requerido", "C.I_per", "red");
        return false;
      }
   else if(!user.match(/^[0-9]{7,9}$/)){
        mostrarPrompt("Invalido", "C.I_per", "red");
        return false;     
      }

    $.ajax({
      type:"POST",
      url:"veri_ci.php",
      data:"ci="+ci,
      success: function (data){
        
        $('#validar_ci_ajax').val(data);

        var culo = document.getElementById("validar_ci_ajax").value;

      if (culo==0)
      {
        mostrarPrompt("No existe", "C.I_per", "red");
      }
      if (culo==1)
      {
        mostrarPrompt("Valido", "C.I_per", "green");
      }

      }
    });

    var valor = document.getElementById("validar_ci_ajax").value;

    if (valor==1)
    {
      return true;
    }
    if (valor==0)
    {
      return false;
    }
}

function validarNAC()
{
  var nac = document.getElementById("nacionalidad").selectedIndex;


  if (nac==0){
      mostrarPrompt("Seleccione la nacionalidad", "C.I_per", "red");
        return false;
    }


    return true;
}

function reporte_nombre_semanal(){
  var desde = document.getElementById("desde").value;
  var hasta = document.getElementById("hasta").value;
  var user = document.getElementById("ci_per").value;    
    var nac = document.getElementById("nacionalidad").value;

    var ci=nac+user;

  if (validarCI()==false){
     $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);

  }
  else if(validarNAC()==false){
  $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);
  }
  else{
    $('#desde_actividades').val(desde);
    $('#hasta_actividades').val(hasta);
    $('#cedula_filtro_actividades').val(ci);
    document.getElementById('form_actividades').submit();
  }
}

function existeCodigo(){
 var user = document.getElementById("codigopre").value;

var consulta;

consulta=$("#codigopre").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);

  if (user==0){
      mostrarPrompt("Campo Requerido", "CodeprePrompt", "red");
      return false;
    }
  if(user.length == 0){
      mostrarPrompt("Campo Requerido", "CodeprePrompt", "red");
      return false;
    }
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodeprePrompt", "red");
          return false;
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
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "CodeprePrompt", "green");
  
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
function existeCodigo2(){
 var user = document.getElementById("codigocor").value;

var consulta;

consulta=$("#codigocor").val();
var consultax;
consultax=consulta.charAt(0).toUpperCase()+consulta.slice(1);

  if (user==0){
      mostrarPrompt("Campo Requerido", "CodecorPrompt", "red");
      return false;
    }
  if(user.length == 0){
      mostrarPrompt("Campo Requerido", "CodecorPrompt", "red");
      return false;
    }
  if (user.match(/^\s/))
    {
      mostrarPrompt("Invalido", "CodecorPrompt", "red");
          return false;
    }

   $.ajax({
      type:"POST",
      url:"verificar_codigo.php",
      data:"codigo="+consultax,
      success: function (data){
        
        $('#rescor').val(data);


        var valor2 = document.getElementById("rescor").value;

      if (valor2==0)
    {

       mostrarPrompt("No existe", "CodecorPrompt", "red");
    
    }
   if (valor2==1)
    {
       mostrarPrompt("Valido", "CodecorPrompt", "green");
  
    }
      }

    });


 var valor = document.getElementById("rescor").value;
 if(user.length == 0){
         mostrarPrompt("Campo Requerido", "CodecorPrompt", "red");
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
        var code2=document.getElementById('codigocor').value;
        

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

         $.ajax({
            type:'POST',
            url:url,
            data:'code='+code2,
            success:function(valores){
                var datos=eval(valores);

                $('#id_maq_correctivo').val(datos[0]);
                $('#nb_correctivo').val(datos[1]);
            }
        });
    };

function reporte_mantenimiento_preventivo_rango(){
  var desde = document.getElementById("desde").value;
  var hasta = document.getElementById("hasta").value;
  var id = document.getElementById("id_maq_preventivo").value;    


  if (existeCodigo()==false){
     $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);

  }

  else{
    $('#desde_preventivo').val(desde);
    $('#hasta_preventivo').val(hasta);
    $('#id_maq_preventivo').val(id);
    document.getElementById('form_preventivo').submit();
  }
}

function reporte_mantenimiento_correctivo_rango(){
  var desde = document.getElementById("desde").value;
  var hasta = document.getElementById("hasta").value;
  var id = document.getElementById("id_maq_correctivo").value;    


  if (existeCodigo2()==false){
     $('#error_incompleto').modal({
                    show:true,
                    backdrop:'static'
                }).show(200);

  }

  else{
    $('#desde_correctivo').val(desde);
    $('#hasta_correctivo').val(hasta);
    $('#id_maq_correctivo').val(id);
    document.getElementById('form_correctivo').submit();
  }
}

</script>




 <script type="text/javascript">
function DameDatos(){
  $.ajax({
    type:"POST",
    url:"ajax/registro_maquina2.php",
    data:"contacto="+document.getElementById("contacto").value,

    success: function(respuesta){
    /*  Como era

    if(respuesta.modelo!="0") document.getElementById('informacion').innerHTML='<br>'+respuesta.modelo;
        else document.getElementById('informacion').innerHTML='<br><div class="info"><p>Seleccione una maquina por favor</p></div>';
    */
  if (respuesta!=0)
            {
              $('#informacion').html('<br>'+respuesta);
            }  
            else
            {
                $('#informacion').html('<br><div class="info"><p>Seleccione una máquina por favor</p></div>');
            }
    }

  });

   $.ajax({
    type:"POST",
    url:"ajax/consultando_maquina.php",
    data:"contacto="+document.getElementById("contacto").value,
    dataType:"json",
    success: function(valores){
       var datos=eval(valores);
      if(valores.modelo=!0){
         $('#codigo').val(datos[1]);
      }

      
      else {
        $('#codigo').val(valores.modelo);
      }
}
  });

}

/*$('#reporte_torno').click(function(){

       window.open("pdf/reporte_tornos.php","_blank");
    });*/
</script>

    <!--validar formulario-->
    <script type="text/javascript" src="js/vali_maq.js"></script>
</body>
</html>


<?php
#ELIMINAR MAQUINA
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
?>

<script type="text/javascript">
function reporte_profesor()
{
  var id=document.getElementById('ced_p').value;
  var periodo=document.getElementById('id_periodo').value;

  //alert(id);

  if (id==0 || periodo==0)
  {
    $('#SC').modal({
        show:true,
        backdrop:'static'
    }).show();
  }
  if (id!=0 && periodo!=0)
  {
    window.open("pdf/reporte_horario_individual.php?id="+id+"&periodo="+periodo,"_blank");
  }
}
</script>