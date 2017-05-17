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


             <div id="mensaje"></div>

             <div id="centro_principal"></div>





             <div id="consulta_salida_insu">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="insumos.php">Insumos</a> <span>></span> <a href="#">Entrada y Salida</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Entrada y Salida de Insumos</span>
                </div>

                <ajax>
                  <table width="100%">
                    <tr>
                      <td>

                      </td>
                      <td align="right">
                        <p id="agregar_salida_insu" style=" margin-top: 1%; margin-bottom: 1%; margin-right: 1%; display: inline-block;">
                        <!--  <button class="btn btn-success"  >Nuevo Registro  &nbsp; <i class="fa fa-plus"></i></button>-->
                        </p>
                      </td>
                    </tr>
                  </table> 

                  <div  id="tabla_usuario">
                 
                     <div style="color:#000; aling-text:center; margin-left:40%;" >

          <label style="font-weight:bold;">Entrada</label> <input type="radio" name="entrada_salida" id="btn_entrada">
          <label style="margin-left:5%; font-weight:bold;">Salida</label> <input type="radio" name="entrada_salida" id="btn_salida" checked> 
          
        </div>

        <br>


                    <div id="tabla_salida">
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                            <tr>
                              <th>Código</th>
                              <th>Nombre</th>
                              <th>Cant. Salida</th>
                              <th>Fecha</th>
                              <th>Exist. Actual</th>
                              <th>Acciónes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql="SELECT * FROM insumos i , salida s WHERE i.id_insumos=s.id_insumos AND s.tipo='insumo' AND i.estatus='1' AND s.estatus='1' AND i.taller=2";

                            $query=pg_query($sql);

                            while ($array=pg_fetch_assoc($query))
                            {
                            $fecha=explode(' ', $array['realizado']);
                            $date=$fecha[0];
                            $time=$fecha[1];
                            $meridiano=$fecha[2];

                            $fecha_a=explode('-', $date);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano=$fecha_a[0];
                           $mes=$fecha_a[1].'/';
                           $dia=$fecha_a[2].'/';
                           $fecha=$dia.$mes.$ano;

                           $time_a=explode(':', $time);
                           $hora=$time_a[0].':';
                           $minutos=$time_a[1];

                           $time=$hora.$minutos;

                           $fechac=$fecha." ".$time." ".$meridiano;
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['codigo_insumo'];?></td>
                               <td align="center" width="150px"><?php echo $array['nombre']; ?></td>
                              <td align="center"><?php echo $array['cantidad']; ?></td>
                              <td align="center"><?php echo   $fechac; ?></td>
                              <td align="center"><?php echo $array['existencia']?></td>
                              <td align="center">
                               <!-- <a href="javascript:editar_preventivo(<?php echo $array['id_preventivo'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
                                    <span class="fa fa-file-text-o"></span>
                                  </button>
                                </a>
                                -->
                                <a href="javascript:eliminarSalida(<?php echo $array['id_salida'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                                
                                <a href="javascript:detalleSalidaI(<?php echo $array['id_insumos'];?>,<?php echo $array['id_salida'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!--Fin consulta salida-->

                  <!--Consulta entrada -->
                  <div id="tabla_entrada">
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Cant. Entrada</th>
                            <th>Fecha</th>
                            <th>Exist. Actual</th>
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql2="SELECT * FROM insumos i, entrada e WHERE i.id_insumos=e.id_insumos AND e.tipo='insumo' AND i.estatus='1' AND e.estatus='1' AND i.taller=2";

                          $query2=pg_query($sql2);

                          while ($array2=pg_fetch_assoc($query2))
                          {
                            $fechax=explode(' ', $array2['realizado']);
                            $datex=$fechax[0];
                            $timex=$fechax[1];
                            $meridianox=$fechax[2];

                            $fecha_a2=explode('-', $datex);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano2=$fecha_a2[0];
                           $mes2=$fecha_a2[1].'/';
                           $dia2=$fecha_a2[2].'/';
                           $fecha2=$dia2.$mes2.$ano2;

                           $time_a2=explode(':', $timex);
                           $hora2=$time_a2[0].':';
                           $minutos2=$time_a2[1];

                           $time2=$hora2.$minutos2;

                           $fechac2=$fecha2." ".$time2." ".$meridianox;
/* 
                            $nombre_per=explode(' ', $array['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;*/
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array2['codigo_insumo'];?></td>
                              <td align="center" width="150px"><?php echo $array2['nombre']; ?></td>
                              <td align="center"><?php echo $array2['cantidad']; ?></td>
                              <td align="center"><?php echo   $fechac2; ?></td>
                              <td align="center"><?php echo $array2['existencia']?></td>
                              <td align="center">
                              <!--
                                <a href="javascript:editar_preventivo(<?php echo $array2['id_preventivo'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
                                    <span class="fa fa-file-text-o"></span>
                                  </button>
                                </a>
                                -->
  
                                <a href="javascript:eliminarEntrada(<?php echo $array2['id_entrada'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                                
                                <a href="javascript:detalleEntradaI(<?php echo $array2['id_insumos'];?>,<?php echo $array2['id_entrada'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- Fin consulta entrada -->
                </div>
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Mantenimiento Prenventivo</h4>
                      </div>
                      <div class="modal-body">
                        <ul class="nav nav-tabs">
                          <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                          <li class="active"><a href="#tabpreventivomod" data-toggle="tab">Preventivo I</a></li>
                          <li><a href="#tabpreventivomodx" data-toggle="tab">Preventivo II</a></li>

                        </ul>

                        <div class="tab-content">

                          <div class="tab-pane fade in active" id="tabpreventivomod">
                           <div class="panel panel-default">
                             <div class="panel-body">
                               <form action="modificar_preventivo.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarForm_mod()">

                                 <div style="margin-left:30%;">
                                  <label>Interno</label><input type="radio" name="tipo_servicio" id="tipo_servicio_intmod" value="interno">
                                  <label style="margin-left:5%;">Externo</label><input type="radio" name="tipo_servicio" id="tipo_servicio_extmod" value="externo">
                                </div>
                               
                                <fieldset id="regmaq" style="  margin-left: 27%;">

                                  <input type="hidden" id="m_id_prev" name="id" /> <!--id de la maquina-->

                                  <input type="hidden" id="ids_mant_mod" name="ids" />

                                  <input type="hidden" id="nbmod" name="nbmod" />

                                  <label><b>Supervisor:</b></label><br>
                                  <input  readonly="readonly" type="text" name="rev_maquina" id="rev_maquinamod" class="form-control" style="width:160px;" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="mostrarCapa()" onblur="personal()" >
                                  <div class="promts" style=" margin-top: -60px;  margin-left: 156px;"><span id=""></span></div>

                                  <br>
                                  <label><b>Responsable:</b></label>
                                  <textarea name="responsable" id="responsablemod" size="" maxlength="125" placeholder="Se daño ..." onKeyUp="validar()"></textarea>
                                  <span id="Prompt"></span>

                                  <br>
                                  <div id="proveedor_ext">

                                    <label>Provedor:</label>
                                    <textarea name="proveedor" id="proveedormod" size="" maxlength="125" placeholder="Jose Hernandez" onKeyUp="validar()" onKeyPress="return soloAlfa(event)"></textarea>
                                    <span id="Prompt"></span>
                                  </div>



                                  <input type="hidden" name="colocada" id="colocada">
                                  <input type="hidden" name="resultado_fechamod" id="resultado_fechamod">

                                  <label><b>Fecha:</b></label><br>
                                  <input type="date" name="fecha" id="fechamod" class="form-control" style="width:180px;" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="valida_fechamod()" onClick="valida_fechamod()" onBlur="valida_fechamod()">
                                  <div class="promts" style=" margin-top: -60px;  margin-left: 156px;"> <span id="fechamodPrompt"></span></div>

                                  <br><br>

                                  <label><b>Nivel de aceite:</b></label><br>
                                  <select name="niv_aceite" id="niv_aceitemod">
                                    <option>No</option>
                                    <option>Bajo</option>
                                    <option>Medio</option>
                                    <option>Alto</option>
                                  </select>

                                  <br><br>
                                </fieldset>
                              </div> 
                            </div>

                          </div>
                          <div class="tab-pane fade" id="tabpreventivomodx">
                           <div class="panel panel-default">
                             <div class="panel-body">
                               <fieldset style="  margin-left: 27%;">

                                 <label><b>Luces del tablero:</b></label>
                                 <input type="radio" name="luces_mod" id="lucesmod1" value="No" size="30"/>No
                                 <input type="radio" name="luces_mod" id="lucesmod2" value="Si" size="30" />Si

                                 <br><br>

                                 <label><b>Parada de emergencia:</b></label>
                                 <input type="radio" name="parada_mod" id="paradamod1" value="No" size="30"/>No
                                 <input type="radio" name="parada_mod" id="paradamod2" value="Si" size="30" />Si

                                 <br><br>
                                 <label><b>Pulsadores:</b></label>
                                 <input type="radio" name="pulsadores_mod" id="pulsadoresmod1"value="No" size="30" />No
                                 <input type="radio" name="pulsadores_mod" id="pulsadoresmod2"value="Si" size="30" />Si 
                                 <br><br>
                                 <label><b>Observaciones:</b></label><br>
                                 <textarea name="observaciones" id="observacionesmod" size="" maxlength="125"
                                 placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
                                 <span id="Prompt"></span>   

                                 <br>
                                 <label><b>Horas hombre:</b></label><br>
                                 <input type="text" name="hora_hombre" id="hora_hombremod" class="form-control" style="width:140px; display: inline-block;" size="" maxlength="10" placeholder="00:00" onclick="" onblur="">
                                 <div class="promts"> <span id="horaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                 <br>
                                 <br>
                                 <label><b>Costo:</b></label><br>
                                 <input type="text" name="costo" id="costomod" style="width:140px;     display: inline-block;" class="form-control"  size="" maxlength="10" placeholder="00:00" onclick="" onblur="">
                                 <div class="promts"> <span id="horaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>


                               </fieldset>


                             </div>                                 
                           </div>
                         </div>                            
                       </div>

                     </div>
                     <div class="modal-footer">

                      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                      <!-- <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">-->
                      <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>               


                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End modal -->

            <!-- eliminar modal-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_ent" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="confirm">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Eliminar Entrada</h4>
                  </div>
                  <div class="modal-body">

                    <h4>¿Usted esta seguro que desea eliminar esta entrada?</h4>                            

                  </div>
                  <div class="modal-footer">

                    <input type="hidden" id="aceptar_elim_entrada">

                    <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Entrada()">Aceptar</button>
                    <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                  </fieldset>


                </div>
              </div>
            </div>
          </div>

          <!-- eliminar modal-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_sal" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="confirm">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Eliminar Salida</h4>
                  </div>
                  <div class="modal-body">

                    <h4>¿Usted esta seguro que desea eliminar esta Salida?</h4>                            

                  </div>
                  <div class="modal-footer">

                    <input type="hidden" id="aceptar_elim_salida">

                    <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Salida()">Aceptar</button>
                    <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                  </fieldset>


                </div>
              </div>
            </div>
          </div>


          <!-- detalle Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_entrada" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                  <h4 class="modal-title">Detalle del insumo</h4>
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
                <h4 class="modal-title">Registro de Insumo Entrada/Salida</h4>
              </div>
              <div class="modal-body">

                <h4>Datos registrados correctamente</h4>    
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
              <h4 class="modal-title">Editar Insumo Entrada/Salida</h4>
            </div>
            <div class="modal-body">

              <h4>Datos editados correctamente</h4>    
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
            <h4 class="modal-title">Reporte Maquina</h4>
          </div>
          <div class="modal-body">

           <h4>¿Usted esta seguro de que desea generar el reporte de esta maquina?</h4>                            

           <input type="hidden" id="aceptar_reporte_preventivo">
           <input type="hidden" id="aceptar_reporte_preventivo2">
           <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
         </div>
         <div class="modal-footer">
          <button class="btn btn-primary" title="Aceptar" onclick="reportePreventivo()" data-dismiss="modal" >Aceptar</button>
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
          <h4 class="modal-title">Eliminar Insumo Entrada/Salida</h4>
        </div>
        <div class="modal-body">

          <h4>Registro eliminado correctamente</h4>    
        </div>
        <div class="modal-footer">

         <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

         <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


       </div>
     </div>
   </div>
 </div>
 <!-- End eliminar modal -->                
</ajax>
</div>
</div>

<!-- Registro de Salida -->
<div id="r_salida_insu">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="insumos.php">Insumos</a> <span>></span> <a href="insumos_e&s.php">Entrada y Salida</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Entrada y Salida de Insumos</span>
    </div>
    <div id="form_contenedor">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div style="color:#000; aling-text:center; margin-left:35%;" >

          <label style="font-weight:bold;">Entrada</label> <input type="radio" name="entrada_salida" id="service_entrada">
          <label style="margin-left:5%; font-weight:bold;">Salida</label> <input type="radio" name="entrada_salida" id="service_salida"> 

        </div>

        <!--Registro de entrada-->
        <div id="entrada">
          <form action="registrando_insumos_e&s.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_E();" enctype="multipart/form-data">
      
           <fieldset id="regmaq" style="color:#000;">
             <input type="hidden" name="tipo_registro" value="entrada"> 
             <input type="hidden" name="insumo" value="insumo" id="tipo">
             <input type="hidden" name="id_insu" id="id_insu">
             <input type="hidden" name="id_per" id="id_per">
             <input type="hidden" name="res" id="res">
               <input type="hidden" name="resE" id="resE">
                 
             <table width="100%;">
             <tr>
             <td>
             <label><b>Codigo del insumo:</b></label>
             <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo"  maxlength="15" placeholder="Ejemplo:To-00" title="Código del insumo" onkeyup="existeCodigoE();" onblur="buscar_insumo(); existeCodigoE();" />
             <div class="promts" style="margin-left: -34px;"> <span id="CodePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
             </td>
             <td>
             <label><b>Número del Bien:</b></label>  
             <input readonly="readonly"  type="text" name="n_b" id="NB">
              </td>
              <td>
             <label><b>Nombre:</b></label>  
             <input readonly="readonly" type="text" name="descripcion" id="descripcion">
             </td>
             </tr>
             <tr>
             <td>
             <label>Existencia:</label>
             <input type="text" readonly="readonly" name="existencia" id="existencia" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" onblur="calculo_importe(); calculo_danada();">
             </td>
             <td>

             <label><b>Buenas:</b></label>
             <input type="text" readonly="readonly" name="buenas" id="buenas" onblur="calculo_danada();">
            </td>
            <td>

            <label><b>Dañadas:</b></label>
            <input type="text" readonly="readonly" name="danadas" id="danadas">
            </td>
            </tr>
            <tr>
            <td colspan="2">
            <label><b>Stock Minino:</b></label>
            <input type="text" readonly="readonly" name="minimo" id="minimo">
            </td>
            <td>
            <label><b>Stock Máximo:</b></label>
            <input type="text" readonly="readonly" name="maximo" id="maximo">
            </td>
            </tr>
            <tr>
            <td colspan="3" align="center">
               <hr>
            </td>
            </tr>

            <tr>
            <td>
             <label><b>Entrada</b></label>
             <input type="text" name="entrada" id="entrada_existencia" maxlength="10" onblur="calculo_danada_entrada(); validarExistenciaEntrada();" onkeyup="validarExistenciaEntrada();" onKeyPress="return solonum(event)">
              <div class="promts" style="z-index:2; margin-left: -100px;"> <span id="existenciaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td >
             <label><b>Entrada de Buenas</b></label>
             <input type="text" name="entrada_buenas" id="entrada_buenas" maxlength="10" onblur="calculo_danada_entrada(); validarBuenasEntrada(); validarEntradaDanadas();" onkeyup="validarBuenasEntrada(); validarEntradaDanadas();" onKeyPress="return solonum(event)">
             <div class="promts" style="margin-left: -35px;"> <span id="buenasPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Entrada de Dañadas</b></label>
             <input readonly="readonly" type="text" name="entrada_danadas"  id="entrada_danadas" style="margin-left:-50px;" >
              <div class="promts" style="z-index:1; margin-left: -39px;"> <span id="danadasPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

               </td>
             </tr>
             <tr>
               <td colspan="3" align="center">
                <h3><div id="salidaR_INS_E"></div></h3>
              </td>
            </tr>
             <tr>
             <td colspan="3" align="center">
             <br><br>
             <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" id="aceptar1" style="margin-left:-50px;"> 
             <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
             <br><br>
             </td>
             </tr>
             </table>
           </fieldset>
         </form>
       </div>

       <!-- Fin registro de entrada-->
       <!-- Registro de Salida -->
       <div id="salida">
        <form action="registrando_insumos_e&s.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_S()" enctype="multipart/form-data" >
        
         <fieldset id="regmaq" style="color:#000;">
           <input type="hidden" name="tipo_registro" value="salida">
          
           <input type="hidden" name="id_insu" id="id_insu2">
           <input type="hidden" name="id_per" id="id_per">
           <input type="hidden" name="res" id="res">
           <input type="hidden" name="resS" id="resS">

           <table width="100%">
           <tr>
           <td>
           <label><b>Codigo del insumo:</b></label>
           <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo2"  maxlength="30" placeholder="Ejemplo:To-00" title="Código del insumo" onblur="buscar_insumo(); existeCodigoS();" onkeyup="existeCodigoS();" />
           <div class="promts" style="margin-left: -33px;"> <span id="Code2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           </td>
           <td>
           <label><b>Número del Bien:</b></label>  
           <input readonly="readonly" type="text" name="n_b" id="NB2">
           </td>
           <td>
           <label><b>Nombre:</b></label>  
           <input readonly="readonly" type="text" name="descripcion" id="descripcion2">
           </td>
           </tr>
           <tr>
           <td>
           <label>Existencia:</label>
           <input type="text" readonly="readonly" name="existencia" id="existencia2" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000">
           </td>
           <td>
           <label><b>Buenas</b></label>
           <input type="text" readonly="readonly" name="buenas" id="buenas2" onblur="calculo_danada();">
          </td>
          <td>

          <label><b>Dañadas</b></label>
          <input type="text" name="danadas" id="danadas2" readonly="readonly">
          
          </td>
          </tr>
          <tr>
            <td colspan="2">
            <label><b>Stock Minino:</b></label>
            <input type="text" readonly="readonly" name="minimo" id="minimo2">
            </td>
            <td>
            <label><b>Stock Máximo:</b></label>
            <input type="text" readonly="readonly" name="maximo" id="maximo2">
            </td>
            </tr>
           <tr>
            <td colspan="3" align="center">
               <hr>
            </td>
            </tr>
          <tr>
          <td align="center">
              <label style="margin-left:-50px;"><b>Salida</b></label>
             <input type="text" name="salida" id="salida_existencia" maxlength="10" onblur="calculo_danada_salida(); validarExistenciaSalida();" onkeyup="validarExistenciaSalida();"  style="margin-left:-50px;" onKeyPress="return solonum3(event)">
            <div class="promts" style="z-index:3; margin-left: -79px;"> <span id="existencia2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Salida de Buenas</b></label>
             <input type="text" name="salida_buenas" id="salida_buenas" maxlength="10" onblur="calculo_danada_salida(); validarBuenasSalida(); validarSalidaDanadas();" onkeyup="validarBuenasSalida(); validarSalidaDanadas();"style="margin-left:-50px;" onKeyPress="return solonum3(event)">
             <div class="promts" style="z-index:2; margin-left: -48px;"> <span id="buenas2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Salida de Dañadas</b></label>
             <input readonly="readonly" type="text" name="salida_danadas" id="salida_danadas" style="margin-left:-50px;" >
              <div class="promts" style="z-index:1;"> <span id="danadas2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

          </td>
          </tr>
          <tr>
            <td colspan="3" align="center">
              <h3><div id="salidaR_INS_S"></div></h3>
            </td>
          </tr>
          <tr>
          <td colspan="3" align="center">
           <br><br>

           <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" id="aceptar2" style="margin-left:-50px;"> 
           <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
           <br><br>
           </td>
           </tr>
           </table>
         </fieldset>
       </form>
     </div>
     

     
   </div>                 
 </div>
</div>

<!--Fin registro insumos salida-->

<!-- Modal validando file error-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_imagen" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Maquina</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Extensión no valida</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal -->  

<!-- Modal Error formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompleto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Entrada/Salida</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Debe completar el formulario</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

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

    <?php //--------------------------ARREGLADO
    /*
    date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$otro="30/06/2015";
$sqlxx="SELECT * FROM mant_preventivo WHERE fecha_siguiente='".$otro."' AND estatus='1'";

                          $queryxx=pg_query($sqlxx);
                          $hoy_event=pg_num_rows($queryxx);
                          $fila=pg_fetch_assoc($queryxx);

                          
                          if($hoy_event!=0)
                          {

                            $agua=$fila['maquina_id'];

                            $sqlxx2="SELECT * FROM maquinas WHERE id_maquina='".$agua."' AND estatus='1'";
                            $queryxx2=pg_query($sqlxx2);

while($dato=pg_fetch_assoc($queryxx2))
{
?>
<script type="text/javascript">$(document).ready(function () {
    var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenido a SYS-M&R!',
            // (string | mandatory) the text inside the notification
            // no pulsar la tecla enter porque si no se daña
            text: 'Hacerle mantenimiento a: <br><?php echo $dato["codigo"];?><br>',
            // (string | optional) the image to display on the left
            image: 'imagenes/upta.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

    return false;
});</script>
  <?php                        
}




?>

<?php } ------------------------------------------------------------------------*/?>

<!--script for this page-->
<script src="assets/js/sparkline-chart.js"></script>    
<script src="assets/js/zabuto_calendar.js"></script>  
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="funciones.js"></script>

<script type="text/javascript" src="js/jquery.fancybox.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".fancybox").fancybox();
  });
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
</script>

<!--validar formulario-->
<script type="text/javascript" src="js/vali_insu.js"></script>
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
