<?php
  require('seguridad.php');
  require('conexion.php');

   $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=2 LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_convenios']);
  $privilegio_A=$priv[0];
  $privilegio_E=$priv[1];
  $privilegio_M=$priv[2];
  $privilegio_I=$priv[3];
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
              <ajax>
             <div id="mensaje"></div>

             <div id="centro_principal"></div>
                                                            <div id="carga"><h3>Cargando por favor espere...</h3><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>

                <div id="consulta_insu">

              <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="convenios.php">Convenios</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Convenios</span>
                </div>

                 <!-- <p id="reporte_maq"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p>  -->

               <!-- <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
            <?php
              if ($privilegio_A=='A')
              {
            ?>

                  <p id="agregar_insu" style="  margin-top: 1%;
                  margin-left: 75%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Nuevo Convenio &nbsp; <i class="fa fa-plus"></i></button></p> 
            <?php
              }
            ?>
                  <div  id="tabla_usuario">

                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                          <tr>
                            <th width="150">Titulo</th>
                            <th width="150">Primer Ente</th>
                            <th width="150">Segundo Ente</th>
                          
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $sql="SELECT * FROM convenios WHERE estatus='1' AND taller=2";

                          $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                            $fecha_i=explode('-', $array['fecha_inicio']);
                            $ano=$fecha_i[0];
                            $mes=$fecha_i[1].'/';
                            $dia=$fecha_i[2].'/';
                            $fecha=$dia.$mes.$ano;

                            $fecha_f=explode('-', $array['fecha_final']);
                            $ano2=$fecha_f[0];
                            $mes2=$fecha_f[1].'/';
                            $dia2=$fecha_f[2].'/';
                            $fecha2=$dia2.$mes2.$ano2;

                            /*
                            $nombre_per=explode(' ', $array['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;*/
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['titulo'];?></td>
                              <td align="center"><?php echo $array['ente1'];?></td>
                              <td align="center"><?php echo    $array['ente2']; ?></td>
                             

                              <td align="center">
                            <?php
                              if ($privilegio_M=='M')
                              {
                              
                                if ($array['estado']=='en proceso'){ 
                            ?>
                                <a href="javascript:editar_convenio(<?php echo $array['id_convenio'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
                                    <span class="fa fa-edit"></span>
                                  </button>
                                </a>
                            <?php
                                } 
                              }

                              if ($privilegio_E=='E')
                              {
                              
                            ?>
                                <a href="javascript:eliminarConvenio(<?php echo $array['id_convenio'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                            <?php
                              }
                            ?>  
                                <a href="javascript:detalleConvenio(<?php echo $array['id_convenio'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                            <?php
                              if ($privilegio_I=='I')
                              {
                            ?>
                                <a href="javascript:reportandoConvenio(<?php echo $array['id_convenio'];?>);">                
                                  <button class="btn btn-default" title="Reporte">
                                    <span class="fa fa-print"></span>
                                  </button>
                                </a>
                            <?php
                              }

                              if ($privilegio_M=='M')
                              {
                              
                                if ($array['estado']=='en proceso'){ 
                            ?>
                                 <a href="javascript:mostrarClausula(<?php echo $array['id_convenio'];?>);">                
                                  <button class="btn btn-default" title="Clausulas">
                                    <span class="fa fa-list-ol"></span>
                                  </button>
                                </a>
                                 <a href="javascript:concluirConvenio(<?php echo $array['id_convenio'];?>);">                
                                  <button class="btn btn-default" title="Concluir">
                                    <span class="fa fa-check-circle-o"></span>
                                  </button>
                                </a>
                            <?php
                                }
                              }  
                            ?>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Convenio</h4>
                        </div>
                        <div class="modal-body">
                          <ul class="nav nav-tabs">
                            <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                            <li class="active"><a href="#tabinsumosmod" data-toggle="tab">Detalle del Convenio</a></li>
                            <!--<li><a href="#tabinsumosmodx" data-toggle="tab">Cláusulas</a></li>-->

                          </ul>

                          <div class="tab-content">

                                <div class="tab-pane fade in active" id="tabinsumosmod">
                                 <div class="panel panel-default">
                                   <div class="panel-body">
                                     <form action="modificar_convenio.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarmodform()">

                                     
                                       <fieldset id="regmaq">

                                        <input type="hidden" name="id" id="idmod">
                                        <input type="hidden" name="id_per" id="id_per">
                                        <input type="hidden" name="tipo" id="Mtipo" value="modificacion">
                                         <input type="hidden" name="Mresn" id="Mresn" value="1">
                                        <input type="hidden" name="res" id="res">
                                        <input type="hidden" name="resMC" id="resMC" value="1">
                                        <input type="hidden" id="m_id_nb" name="id_nb" /> <!--id del nb-->

                                          <table width="100%">
            <tr>
            <td colspan="2" align="center">

            <label><b>Titulo del Convenio:</b></label><br>
            <input type="text" class="form-control" style="width:60%; display:inline-block" name="titulo" id="titulomod"  maxlength="100" placeholder="Ejem: Convenio Robótica con Metalmecánica" title="Titulo del convenio" onKeyUp="existeTitulo2();" onblur="existeTitulo2();" />
           <div class="promts"> <span id="titulomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           </td>
              
           </tr>

           <tr>
           <td colspan="2" align="center" style="font-size:14px;"><br><b>Entes Actuantes:</b><br><br></td>
           </tr>
           <tr>
          
             <td align="center">
           
        
            <label><b>Primer Ente</b></label> <br> 
            <input type="text"  class="form-control" style="display:inline-block; width:200px" name="ente1" id="ente1mod" size="" maxlength="50" onkeypress="return soloAlfa2(event)" title="Primer Ente actuante" placeholder="Ejem: Metalmécanica" onKeyUp="validarEnte1mod();" onblur="validarEnte1mod();"> 
           <div class="promts"> <span id="ente1modPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              
  
            <td align="center">
           
        
            <label><b>Segundo Ente</b></label>  <br>
            <input type="text" class="form-control" style="display:inline-block; width:200px" name="ente2" id="ente2mod" size="" maxlength="50" onkeypress="return soloAlfa2(event)"  title="Segundo Ente actuante"  placeholder="Ejem: Ferremetal" onKeyUp="validarEnte2mod();" onblur="validarEnte2mod();"> 
           <div class="promts" style="z-index:1;"> <span id="ente2modPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              </tr>
                 <tr>
          
             <td align="center">
           
        <br>
            <label><b>Primer Representante</b></label>  <br>
            <input type="text" class="form-control" style="display:inline-block; width:200px" name="contratante" id="contratantemod" size="" maxlength="50" onkeypress="return soloAlfa(event)" title="Nombre o Apodo del Contratante" placeholder="Ejem: El Instituto" onKeyUp="validarContratantemod();" onblur="validarContratantemod();"> 
           <div class="promts"> <span id="contratantemodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              
  
            <td align="center">
           
        <br>
            <label><b>Segundo Representante</b></label>  <br>
            <input type="text" class="form-control" style="display:inline-block; width:200px" name="contratado" id="contratadomod" size="" maxlength="50" onkeypress="return soloAlfa(event)"  title="Nombre o Apodo del Contratado"  placeholder="Ejem: La Empresa" onKeyUp="validarContratadomod();" onblur="validarContratadomod();"> 
           <div class="promts" style="z-index:1;"> <span id="contratadomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              </tr>
            <tr>
         <br>
            <td align="center">
           
        <br>
            <label><b>Fecha de Inicio</b></label>  <br>
            <input type="text" class="form-control" style="display:inline-block; width:200px; background:#fff;" name="fechai" id="fechaimod" size="" maxlength="10" onKeyPress="return solonum2(event)" title="Fecha de cuando se inicio el convenio" onclick="valida_fecha_mayormod();"  onblur="valida_fecha_mayormod(); " > 
           <div class="promts"> <span id="fechaimodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
       
            <td align="center">
<br>
             <label><b>Fecha Final</b></label><br>
            <input type="text" class="form-control" style="display:inline-block; width:200px; background:#fff;" name="fechaf" id="fechafmod"  size="" maxlength="10" placeholder=""  onKeyPress="return solonum2(event)" title="Fecha de cuando se concluira el convenio" onclick="valida_fecha_mayormod(); valida_fechafmod();"  onblur="valida_fecha_mayormod(); valida_fechafmod();" >
            <div class="promts" style="z-index:1;"> <span id="fechafmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          </td>

            </tr>
             <tr>
          <td colspan="2" align="center">
          <h3><div id="mensaje_incorrectomod"></div></h3>
          </td>
          </tr>
                                  <tr>
             <td colspan="2" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   
             <tr>
            <td colspan="2" align="center">
            <br><br>

            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>               
            <br><br>
            </td>
            </tr>
            
          
          </table>

                                          </fieldset>
                                      </div> 
                                    </div>

                                  </div>
                                 <!-- <div class="tab-pane fade" id="tabinsumosmodx">
                                   <div class="panel panel-default">
                                     <div class="panel-body">
                                       <fieldset >

<?php 


?>
                      <table width="100%">
                      <tr>
            <td colspan="2" align="center"><br>
                         <label>Cláusulas</label>
                         <br>
            <textarea style="display:inline-block; resize: none; width: 80%; max-width: 100%;  height: 200px; max-height: 100%;" id="clausulasmod" name="clausulas" onblur="validarClausulasmod();" onkeyup="validarClausulasmod();"   onKeyPress="return soloAlfa2(event)" title="Escriba aqui todas las clausuras del convenio, incluyendo los compromisos" placeholder="Ejem: Nosotros el taller de Metalmecanica realizamos los siguientes ..."></textarea>
            <div class="promts" style="z-index:1;"> <span id="clausulasmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

            <br>
            </td>
            </tr>
                 <tr>
          <td colspan="3" align="center">
          <h3><div id="mensaje_incorrectomod"></div></h3>
          </td>
          </tr>
             <tr>
            <td colspan="2" align="center">
            <br><br>

            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>               
            <br><br>
            </td>
            </tr>
          
         
       
             </table>
                                    </fieldset>

                                   
                                   </div>                                 
                                 </div>
                               </div>   -->                         
                             </div>

                           </div>
                           <div class="modal-footer">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End modal -->




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
                          <br><br>
                          <h5 style="margin-left:35%;"> Escriba la razón de concluir este convenio</h5>
                           <textarea id="razon" style="resize: none; margin-left:12%; width: 80%; max-width: 100%;  height: 200px; max-height: 100%;" onKeyPress="return soloAlfa2(event)"></textarea>
                            <h3><div id="mensaje_incorrectoR" style="margin-left:35%;"></div></h3>
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
  <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="convenios.php">Convenios</a> <span>></span> <a href="#">Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Convenios</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">

      <br>
         <div id="insumos">
          <form action="registrando_convenio.php" method="post" id="reg_maquina" name="reg_maquina" enctype="multipart/form-data" onSubmit="return validarForm()" >
                    
         <input type="hidden" name="tipo" id="tipo" value="registro">

            <input type="hidden" name="id_maq" id="id_maq">
            <input type="hidden" name="id_per" id="id_per">
            <input type="hidden" name="res" id="res">
            <input type="hidden" name="res2" id="res2">
                 <input type="hidden" name="resn" id="resn">
              
            <table width="100%">
            <tr>
            <td colspan="2" align="center">

            <label><b>Titulo del Convenio:</b></label>
            <input type="text" style="width:50%" name="titulo" id="titulo"  maxlength="100" placeholder="Ejem: Convenio Ferremetal con Metalmecánica" title="Titulo del convenio" onKeyUp="existeTitulo();" onblur="existeTitulo();" onkeypress="return soloAlfa2(event)" />
           <div class="promts"> <span id="tituloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           </td>
              
           </tr>

           <tr>
           <td colspan="2" align="center" style="font-size:14px;"><br><b>Entes Actuantes:</b><br></td>
           </tr>
           <tr>
          
             <td align="center">
           
        
            <label><b>Primer Ente</b></label>  
            <input type="text" name="ente1" id="ente1" size="30" maxlength="50" onkeyup="validarEnte1();" onblur="validarEnte1();" onkeypress="return soloAlfa2(event)" title="Primer Ente actuante" placeholder="Ejem: Metalmécanica" > 
           <div class="promts"> <span id="ente1Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              
  
            <td align="center">
           
        
            <label><b>Segundo Ente</b></label>  
            <input type="text" name="ente2" id="ente2" size="30" maxlength="50" onkeyup="validarEnte2();" onblur="validarEnte2();"  onkeypress="return soloAlfa2(event)"  title="Segundo Ente actuante"  placeholder="Ejem: Ferremetal"> 
           <div class="promts" style="z-index:1;"> <span id="ente2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              </tr>
                 <tr>
          
             <td align="center">
           
        
            <label><b>Primer Representante</b></label>  
            <input type="text" name="contratante" id="contratante" size="30" maxlength="50" onkeyup="validarContratante();" onblur="validarContratante();" onkeypress="return soloAlfa(event)" title="Nombre o Apodo del Contratante" placeholder="Ejem: El Instituto" > 
           <div class="promts"> <span id="contratantePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              
  
            <td align="center">
           
        
            <label><b>Segundo Representante</b></label>  
            <input type="text" name="contratado" id="contratado" size="30" maxlength="50"  onkeyup="validarContratado();" onblur="validarContratado();" onkeypress="return soloAlfa(event)"  title="Nombre o Apodo del Contratado"  placeholder="Ejem: La Empresa"> 
           <div class="promts" style="z-index:1;"> <span id="contratadoPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
              </tr>
            <tr>
         
            <td align="center">
           
        
            <label><b>Fecha de Inicio</b></label>  
            <input type="text" name="fechai" id="fecha" size="" maxlength="20" onchange="valida_fecha_mayor();"  onblur="valida_fecha_mayor();"  title="Fecha de cuando se inicio el convenio"> 
           <div class="promts"> <span id="fechaiPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
     
           </td>
       
            <td align="center">

             <label>Fecha Final</label>
            <input type="text" name="fechaf" id="fecha2"  size="" maxlength="10" placeholder="" onchange="valida_fecha_mayor(); valida_fechaf();"  onblur="valida_fecha_mayor(); valida_fechaf();"  title="Fecha de cuando se concluira el convenio">
            <div class="promts" style="z-index:1;"> <span id="fechafPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          </td>

            </tr>

          <!--  <tr>
            <td colspan="2" align="center"><br>
                         <label>Cláusulas</label>

            <textarea style="display:inline-block; resize: none; width: 80%; max-width: 100%;  height: 200px; max-height: 100%;" id="clausulas" name="clausulas" onblur="validarClausulas();" onkeyup="validarClausulas();"  onKeyPress="return soloAlfa2(event)" title="Escriba aqui todas las clausuras del convenio, incluyendo los compromisos" placeholder="Ejem: Nosotros el taller de Metalmecanica realizamos los siguientes ..."></textarea>
            <div class="promts" style="z-index:1;"> <span id="clausulasPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

            <br>
            </td>
            </tr>-->
          <tr>
          <td colspan="2" align="center">
          <h3><div id="mensaje_incorrecto"></div></h3>
          </td>
          </tr>
                                  <tr>
             <td colspan="2" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   
             <tr>
            <td colspan="2" align="center">
            <br><br>

            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
            <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
            <br></br>
            </td>
            </tr>
          
         
          
          </table>
        </form>
      </div>




      </div>                 
</div>
</div>
  
  <div id="c_clausulas">
     <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="convenios.php">Convenios</a> <span>></span> <a href="#">Clausulas</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Clausulas</span>
                </div>

                 <!-- <p id="reporte_clau" style="display: inline-block; margin-top: 1%; margin-left: 2%; margin-bottom: 1%;"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p> -->

               <!-- <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
                <p id="agregar_clau" style="  margin-top: 1%;
                  margin-left: 76%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Agregar Clausulas &nbsp; <i class="fa fa-plus"></i></button></p> 

                  <div  id="tabla_usuario">

                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-exampleClausulas">
                        <thead>
                          <tr>
                            <th width="20">N°</th>
                            <th width="400">Contenido</th>
                            <th width="50">Seguimiento</th>
                        
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

 <div id="r_clausulas">
  <h4 class="sitio_maq"><a href="#">Académico</a> <span>></span> <a href="convenios.php">Convenios</a> <span>></span> <a href="#" id="linkclausulas">Clausulas</a> <span>></span> <a href="#">Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Clausulas</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">

      <br>
         <div id="clausula">
          <form action="registrando_clausulas.php" method="post" id="reg_maquina" name="reg_maquina" enctype="multipart/form-data" onSubmit="return validarFormC()" >
                    

            <input type="hidden" name="id_convenio" id="id_convenio">
                        
            <table width="100%">
            <tr>
            <td colspan="2" align="center">
            <label><b>Titulo del Convenio:</b></label>
            <input readonly="readonly" name="titulo" id="titulo_clau" style="width:60%; text-align:center;">
            
           </td>
              
           </tr>

           <tr>
           <td colspan="2" align="center" style="font-size:14px;"><br><b>Entes Actuantes:</b><br></td>
           </tr>
           <tr>
          
             <td align="center">
           
        
            <label><b>Primer Ente</b></label>  
            <input readonly="readonly" type="text" name="ente1" id="ente1_clau" size="30"  title="Primer Ente actuante" placeholder="Ejem: Metalmécanica" > 
     
           </td>
              
  
            <td align="center">
           
        
            <label><b>Segundo Ente</b></label>  
            <input readonly="readonly" type="text" name="ente2" id="ente2_clau" size="30"   title="Segundo Ente actuante"  placeholder="Ejem: Ferremetal"> 
     
           </td>
              </tr>
                 <tr>
          
             <td align="center">
           
        
            <label><b>Primer Representante</b></label>  
            <input readonly="readonly" type="text" name="contratante" id="contratante_clau" size="30" title="Nombre o Apodo del Contratante" placeholder="Ejem: El Instituto" > 
     
           </td>
              
  
            <td align="center">
           
        
            <label><b>Segundo Representante</b></label>  
            <input readonly="readonly" type="text" name="contratado" id="contratado_clau" size="30"   title="Nombre o Apodo del Contratado"  placeholder="Ejem: La Empresa"> 
     
           </td>
              </tr>
            <tr>
         
            <td align="center">
           
        
            <label><b>Fecha de Inicio</b></label>  
            <input readonly="readonly" type="text" name="fechai" id="fechai_clau" size="" title="Fecha de cuando se inicio el convenio"> 
     
           </td>
       
            <td align="center">

             <label>Fecha Final</label>
            <input readonly="readonly" type="text" name="fechaf" id="fechaf_clau"  size="" title="Fecha de cuando se concluira el convenio">
          </td>

            </tr>
            </table>
        <input type="hidden" name="control_cantidad" id="control_cantidad" value="1">

            <table id="tablo" width="100%">
            <tr>
            <td>1</td>
            <td colspan="2" align="center"><br>
                         <label>Cláusula</label>

            <textarea style="display:inline-block; resize: none; width: 80%; max-width: 100%;  height: 200px; max-height: 100%;" id="clausula1" name="clausulas[]" onblur="validar_Clausulasmulti();" onkeyup="validar_Clausulasmulti();"  onKeyPress="return soloAlfa2(event)" title="Escriba aqui todas las clausulas del convenio, incluyendo los compromisos" placeholder="Ejem: Nosotros el taller de Metalmecanica realizamos los siguientes ..."></textarea>
            <div class="promts" style="z-index:1;"> <span id="clausulasPrompt1"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

            <br>
            </td>
             <td width="25%" style="vertical-align: bottom;">
              <button type="button" class="btn remove_button btn btn-warning" style="padding: 2px 5px;">Remover &nbsp; <i class="fa fa-minus"></i></button>

            </td>
            </tr>
            </table>
            <table width="100%"> 
            <tr>
            <td colspan="2" align="center">
              <button type="button"  class="add btn btn-success" style="margin-top:5%; ">Agregar Clausula &nbsp; <i class="fa fa-plus"></i></button>
            </td>
          </tr>
          <tr>
          <td colspan="2" align="center">
          <h3><div id="mensaje_incorrectoC"></div></h3>
          </td>
          </tr>
                                  <tr>
             <td colspan="2" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   
             <tr>
            <td colspan="2" align="center">
            <br><br>

            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
            <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
            <br><br>
            </td>
            </tr>
          
         
          
          </table>
        </form>
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
                                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
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
                                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
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
 <script type="text/javascript" src="js/vali_con.js"></script>
     <script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript">
 function concluirConvenio(id){

        $('#aceptar_concluir_convenio').val(id);
        $('#concluir_pre').modal({
            show:true,
            backdrop:'static'
        });
            confirm_user();
    };
     function concluir_Convenio(){
                var razon=document.getElementById('razon').value;
                if (razon==""){
                                  mostrarPrompt("El campo razón esta vacio","mensaje_incorrectoR","red")

                }
                else{
                  var id = document.getElementById('aceptar_concluir_convenio').value;

        window.location.href="concluir_convenio.php?id="+id+"&razon="+razon;
                }

        
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