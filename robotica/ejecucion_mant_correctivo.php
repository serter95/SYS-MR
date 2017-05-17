<?php
require('seguridad.php');
require('conexion.php');

$sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario    AND nom_usuario='".$_SESSION['nom_usuario']."' LIMIT 1";
$query2=pg_query($sql2);
$array2=pg_fetch_assoc($query2);

$priv=explode('-', $array2['priv_maquinas']);
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
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>Prototipo con boostrap</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
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


             <div id="mensaje"></div>

             <div id="centro_principal"></div>





             <div id="consulta_prev">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="mantenimiento.php">Mantenimiento</a> <span>></span> <a href="#">Ejecución del Mantenimiento Correctivo</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Ejecucion de Mantenimiento Correctivo</span>
                </div>

                <ajax>
                  <table class="tabla_agregar_imprimir">
                    <tr>
                      <td>
                        <?php
                        if ($privilegio_I=='I')
                        {
                          ?>
                          <p id="reporte_maq"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p> 
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                       <?php
                       if ($privilegio_A=='A')
                       {
                        ?>
                        <p id="agregar_man" style="  margin-top: 1%;
                        margin-left: 52%;
                        margin-bottom: 1%;
                        display: inline-block;"><button class="btn btn-success"  >Ejecutar Mant. Correctivo &nbsp; <i class="fa fa-plus"></i></button></p> 
                        <?php  
                      }
                      ?>
                    </td>
                  </tr>
                </table>
                <div  id="tabla_usuario">

                  <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>N°</th>
                          <th>Código</th>
                          <th>Servicio</th>
                          <th>Encargado</th>
                          <th>Fecha de Ejecución</th>
                          <th>Estado</th>
                          <th>Acciónes</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql="SELECT * FROM maquinas m, mant_correctivo p, personal s WHERE m.id_maquina=p.id_maquina AND p.id_personal=s.id  AND m.estatus='1' AND p.estatus='1' AND p.estado<>'en proceso' ORDER BY fecha DESC";

                        $query=pg_query($sql);

                        while ($array=pg_fetch_assoc($query))
                        {
                          $fecha_a=explode('-', $array['fecha_ejecucion']);
                          $ano=$fecha_a[0];
                          $mes=$fecha_a[1].'/';
                          $dia=$fecha_a[2].'/';
                          $fecha=$dia.$mes.$ano;

                          $nombre_per=explode(' ', $array['nombres']); 
                          $pri_nom=$nombre_per[0];

                          $apellido_per=explode(' ', $array['apellidos']);
                          $prim_ape=$apellido_per[0];

                          $encargado_mant=$pri_nom.' '.$prim_ape;
                          ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['id_correctivo']; ?></td>
                            <td align="center"><?php echo $array['codigo'];?></td>
                            <td align="center"><?php echo $array['tipo_servicio'];?></td>
                            <td align="center"><?php echo    $encargado_mant; ?></td>
                            <td align="center"><?php echo $fecha; ?></td>
                            <td align="center"><?php echo $array['estado'];?></td>
                            <td align="center">
                             <?php
                             if ($privilegio_M=='M')
                             {

                              ?>    
                              <a href="javascript:editar_correctivo(<?php echo $array['id_correctivo'];?>);">

                                <button class="btn btn-default" title="Modificar" id="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                              <?php
                            }
                            ?>
                            <?php
                            if ($privilegio_E=='E')
                            {
                              ?>
                              <a href="javascript:eliminarCorrectivo(<?php echo $array['id_correctivo'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                              <?php
                            }
                            ?>  
                            <a href="javascript:detalleCorrectivo(<?php echo $array['id_maquina'];?>,<?php echo $array['id_correctivo'];?>);">                
                              <button class="btn btn-default" title="Ver">
                                <span class="fa fa-search-plus"></span>
                              </button>
                            </a>
                            <a href="javascript:reportandoCorrectivo(<?php echo $array['id_maquina'];?>,<?php echo $array['id_correctivo'];?>);">                
                              <button class="btn btn-default" title="Reporte">
                                <span class="fa fa-print"></span>
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
              <!-- Modal -->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Modificar Mantenimiento Correctivo</h4>
                    </div>
                    <div class="modal-body">
                      <ul class="nav nav-tabs">
                        <li class="active"><a href="#tabcorrectivomod" data-toggle="tab">Correctivo I</a></li>
                        <li><a href="#tabcorrectivomodx" data-toggle="tab">Correctivo II</a></li>
                      </ul>

                      <div class="tab-content">

                       <div class="tab-pane fade in active" id="tabcorrectivomod">
                         <div class="panel panel-default">
                          <div class="panel-body">
                            <form action="modificar_correctivo.php" method="post" id="modif_maq" name="modif_maqs" onSubmit="return validarForm_mod()">

                              <div style="margin-left:40%;">
                                <label>Interno</label><input type="radio" name="tipo_servicio" id="tipo_servicio_intmodc" value="interno">
                                <label style="margin-left:5%;">Externo</label><input type="radio" name="tipo_servicio" id="tipo_servicio_extmodc" value="externo">
                              </div>

                              <fieldset id="regmaq" style="  margin-left: 10%;">

                                <input type="hidden" id="m_id_corre" name="id" /> <!--id de la maquina-->

                                <input type="hidden" id="ids_mant_mod" name="ids" />
                                <input type="hidden" name="resultado_fechamod" id="resultado_fechamod" value="valido">

                                <input type="hidden" id="nbmod" name="nbmod" />
                                <table width="100%">
                                  <tr>
                                    <td colspan="2" align="center">
                                      <label style="margin-left:-50px;"><b>Supervisor:</b></label><br>
                                      <input readonly="readonly" type="text" name="rev_maquina" id="rev_maquinamod" class="form-control" style="width:160px; margin-left:-50px;" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" >
                                      <br>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>

                                      <label><b>Responsable:</b></label><br>
                                      <textarea style="display:inline-block; resize:none; width:90%;" class="form-control"  name="responsable" id="responsablemod" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsablemod();" onblur="validarResponsablemod();" onKeyPress="return soloAlfa(event)"></textarea>
                                      <div class="promts"> <span id="responsablemodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>                                         
                                    </td>
                                    <td>

                                      <div id="proveedor_ext">
                                        <label><b>Provedor:</b></label>
                                        <br>
                                        <textarea style="display:inline-block; resize:none;  width:90%;" class="form-control"  name="proveedor" id="proveedormod" size="" maxlength="125" placeholder="Jose Hernandez" onKeyUp="validarProveedormod();" onblur="validarProveedormod();" onKeyPress="return soloAlfa(event)"></textarea>
                                        <div class="promts" style="z-index:1;"> <span id="proveedormodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>

                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td >                                     
                                      <label><b>Fecha de la Solicitud:</b></label><br>
                                      <input readonly="readonly" type="text" id="fechaSmod" style="width:180px; display: inline-block;"  class="form-control"  size="" maxlength="10" placeholder="00/00/0000" disabled>
                                    </td>
                                    <td >                                     
                                      <label><b>Fecha de la Ejecución:</b></label><br>
                                      <input readonly="readonly" type="text" id="fechaEmod" style="width:180px; display: inline-block;"  class="form-control"  size="" maxlength="10" placeholder="00/00/0000" disabled>
                                    </td>

                                  </tr>

                                </table>
                              </fieldset>
                            </div> </div>
                            <!-- /.table-responsive -->
                          </div>

                          <div class="tab-pane fade" id="tabcorrectivomodx">
                           <div class="panel panel-default">
                             <div class="panel-body">
                              <fieldset style="  margin-left: 5%;">
                                <table width="100%">
                                 <tr>
                                   <tr>
                                    <td colspan="2">                                     
                                      <label><b>Fecha de la falla:</b></label><br>
                                      <input type="text" name="fecha_falla" id="fechamod" style="width:180px; display: inline-block;"  class="form-control"  size="" maxlength="10" placeholder="00-00-0000" onclick="valida_fechamod();" onblur="valida_fechamod();">
                                      <div class="promts"> <span id="fechamodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                    </td>
                                    <td>
                                     <div style="display: table;">
                                      <label><b>Hora de la falla:</b></label><br>
                                      <input readonly type="text" name="hora_falla" id="hora_fallamod" style="width:140px; display: inline-block; background-color:#fff;"  class="form-control"  size="" maxlength="8" placeholder="00:00" onclick="validarFallamod();" onblur="validarFallamod();" onkeyup="validarFallamod();" onkeypress="return solonum4(event)">
                                      <div class="promts"> <span id="hora_fallamodPrompt"></span></div>

                                      <p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                    </div>
                                    <br>
                                  </td>
                                </tr>
                                <td colspan="3">

                                  <label><b>Observaciones:</b></label><br>
                                  <textarea style="display:inline-block; resize:none; width:95%;" class="form-control" name="observaciones" id="observacionesmod" size="" maxlength="125" placeholder="Se daño ..." onKeyUp="validarObservacionesmod();" onblur="validarObservacionesmod();" onKeyPress="return soloAlfa(event)"></textarea>
                                  <div class="promts" > <span id="observacionesmodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>

                                  <br>
                                </td>

                              </tr>
                              <tr>
                                <td>
                                  <div style="display: table;">
                                    <label><b>Hora de arranque:</b></label><br>
                                    <input readonly type="text" name="hora_arranque" id="hora_arranquemod" style="width:140px; display: inline-block; background-color:#fff;" class="form-control" size="" maxlength="8" placeholder="00:00" onkeyup="validarArranquemod()" onblur="validarArranquemod()" onkeypress="return solonum4(event)">
                                    <div class="promts" style="margin-left: -31px;"> <span id="hora_arranquemodPrompt"></span></div>

                                    <p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                  </div>                                          
                                </td>
                                <td>
                                  <label><b>Horas hombre:</b></label><br>
                                  <input type="text" name="hora_hombre" id="hora_hombremod" style="width:140px; display: inline-block;" class="form-control" size="" maxlength="3" placeholder="00:00" onkeyup="validarHombremod()" onblur="validarHombremod()" onkeypress="return solonum3(event)">
                                  <div class="promts"> <span id="hora_hombremodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                  <br>
                                </td>
                                <td align="center">
                                  <div style="display: table;">
                                    <label><b>Costo:</b></label><br>
                                    <input type="text" name="costo" id="costomod" style="width:140px; display: inline-block;" class="form-control" size="" maxlength="10" placeholder="200" onkeyup="validarCostomod()" onblur="validarCostomod()" onkeypress="return solonum3(event)">
                                    <input readonly="readonly" type="text" name="moneda" value="Bs" class="form-control" style="width:80px; display:inline-block;">
                                    <div class="promts"> <span id="costomodPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" align="center">
                                  <h3><div id="salidaM_COR"></div></h3>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" align="center">
                                  <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                  <!-- <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">-->
                                  <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                </td>
                              </tr>
                            </table>
                          </fieldset>
                        </div>
                      </div>
                    </div>                              </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- eliminar modal-->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maq" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" id="confirm">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                  <h4 class="modal-title">Eliminar Mantenimiento Correctivo</h4>
                </div>
                <div class="modal-body">

                  <h4>¿Usted esta seguro que desea eliminar este mantenimineto correctivo?</h4>                            

                </div>
                <div class="modal-footer">

                  <input type="hidden" id="aceptar_elim_correctivo">

                  <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Correctivo()">Aceptar</button>
                  <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                </fieldset>


              </div>
            </div>
          </div>
        </div>


        <!-- detalle Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_maquina" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Detalle de la Maquina</h4>
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
                <h4 class="modal-title">Reporte de Mantenimiento Correctivo</h4>
              </div>
              <div class="modal-body">

                <h4>¿Usted esta seguro de que desea generar el reporte de los mantenimientos Correctivos?</h4>                            

              </div>
              <div class="modal-footer">

                <input type="hidden" id="aceptar_elim_maquina">

                <button class="btn btn-primary" title="Aceptar" onclick="reporte_Correctivo()" data-dismiss="modal" >Aceptar</button>
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
              <h4 class="modal-title">Registro Mantenimento Correctivo</h4>
            </div>
            <div class="modal-body">

              <h4>Mantenimiento Correctivo registrado correctamente</h4>    
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
            <h4 class="modal-title">Editar Mantenimiento Correctivo</h4>
          </div>
          <div class="modal-body">

            <h4>Mantenimiento Correctivo editado correctamente</h4>    
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

         <input type="hidden" id="aceptar_reporte_correctivo">
         <input type="hidden" id="aceptar_reporte_correctivo2">
         <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
       </div>
       <div class="modal-footer">
        <button class="btn btn-primary" title="Aceptar" onclick="reporteCorrectivo()" data-dismiss="modal" >Aceptar</button>
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
        <h4 class="modal-title">Eliminar Mantenimiento Correctivo</h4>
      </div>
      <div class="modal-body">

        <h4>Mantenimiento Correctivo eliminado correctamente</h4>    
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

<div id="r_mant_prev">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="mantenimiento.php">Mantenimiento</a> <span>></span> <a href="ejecucion_mant_correctivo.php">Ejecución del Mantenimiento Correctivo</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Ejecución del Mantenimiento Correctivo</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div style="color:#000; aling-text:center; margin-left:40%;" >

          <label style="font-weight:bold;">Interno</label> <input type="radio" name="service" id="service_interno">
          <label style="margin-left:5%; font-weight:bold;">Externo</label> <input type="radio" name="service" id="service_externo"> 

        </div>
        <div id="interno">
          <form action="registrando_ejecucion_mant_corre.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarFormI()" enctype="multipart/form-data" >

           <fieldset id="regmaq" style="color:#000;">

            <input type="hidden" name="id_maq" id="id_maq">
            <input type="hidden" name="id_per" id="id_per">
            <input type="hidden" name="res" id="res">
            <input type="hidden" name="tipo_servicio" value="interno"> 


            <table width="100%">
              <tr>
                <td colspan="3" align="center">
                  <input type="hidden" id="validaNI">
                  <label><b>Número del Mantenimiento:</b></label>
                  <input type="text" name="numero_mant" id="numero_mantI" onkeypress="return solonum3(event);" maxlength="6" onblur="buscaNumeroMantI();" value="<?php echo $_REQUEST['numeros_mant']; ?>">
                  <div class="promts" style="margin-left: 9px;"> <span id="numeroIPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                  <input type="hidden" id='maquina_id' >
                </td>
              </tr>
              <tr>
                <td  align="center">
                  <label  style="margin-left:-50px;"><b>Supervisor:</b></label><br>
                  <input  readonly="readonly" type="text" name="rev_maquina" id="rev_maquina" class="form-control" style="width:160px; margin-left:-50px" size="" maxlength="30" placeholder="" onKeyPress="return soloLetras(event)" >
                </td>
                
                <td >
                  <label><b>Responsable:</b></label><br>
                  <textarea  readonly="readonly" name="responsable" id="responsable"  class="form-control" style="display:inline-block; width:160px;" size="" maxlength="125" placeholder="" onKeyUp="validarResponsablemod();" onblur="validarResponsablemod();"></textarea>
                  <br>
                </td>
                
                
                <td>
                  <label><b>Fecha de Solicitud:</b></label><br>
                  <input type="text"  readonly="readonly" name="fechapropuesta" id="fechapropuesta" class="form-control" style="width:180px;" size="" maxlength="10" placeholder="00/00/0000">
                  
                </td>
              </tr>


              <input type="hidden" name="colocada" id="colocada">
              
              
              <tr>

                <td>
                  <label><b>Fecha de la falla:</b></label>
                  <input type="text" name="fecha_falla" id="fecha" style="width:140px;" size="" maxlength="10" placeholder="00/00/0000" onclick="valida_fecha()" onchange="valida_fecha()" onblur="valida_fecha()">
                  <div class="promts" style="margin-left:2px; z-index:2;"> <span id="fechaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                </td>

                <td>
                  <div  style="display: table;">
                    <label><b>Hora de la falla:</b></label>
                    <input readonly type="text" name="hora_falla" id="hora_f" style="width:140px;" size="" maxlength="8" placeholder="00:00" onclick="validarFalla();" onkeyup="validarFalla();" onblur="validarFalla();" onkeypress="return solonum4(event)">
                    <div class="promts"> <span id="hora_fPrompt"></span></div>
                    <p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
                  </div>
                </td>

                <td>
                  <input type="hidden" name="resultado_fecha" id="resultado_fecha">

                  <label>Fecha de Ejecucion:</label>
                  <input type="text" name="fecha" id="nextfecha" style="width:140px;" size="" maxlength="10" placeholder="00/00/0000" onclick="valida_fechaEj()" onchange="valida_fechaEj()" onblur="valida_fechaEj()" >
                  <div class="promts" style="margin-left: -10px; z-index:2;"> <span id="fechaxPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                </td>

              </tr>
              <tr>
               <td>
                <div  style="display: table;">
                  <label><b>Hora de arranque:</b></label>
                  <input readonly type="text" name="hora_arranque" id="hora_a" style="width:140px;" size="" maxlength="8" placeholder="00:00" onclick="validarArraque()" onkeyup="validarArraque()" onblur="validarArraque()" onkeypress="return solonum4(event)">
                  <div class="promts" style="margin-left: -27px;"> <span id="hora_aPrompt"></span></div>
                  <p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
                </div>
              </td>
              <td >

                <label><b>Horas hombre:</b></label>
                <input type="text" name="hora_hombre" id="hora_h" style="width:140px;" size="" maxlength="3" placeholder="00:00" onkeyup="validarHombre()" onblur="validarHombre()" onKeyPress="return solonum3(event)">
                <div class="promts" style="margin-left: -54px;"> <span id="hora_hPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
              </td>
              <td>
                <div  style="display: table;">
                  <label><b>Costo:</b></label>
                  <input type="text" name="costo" id="costo" maxlength="10" style="width:140px;" onkeyup="validarCosto();" onblur="validarCosto();"  onKeyPress="return solonum(event)">
                  <div class="promts" style="margin-left: -59px;"> <span id="costoPrompt"></span></div>
                  <input type="text" readonly="readonly" name="moneda" value="Bs" size="3"><p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
                </div>

              </td>
            </tr>

            <tr>

              <td colspan="3" align="center">
                <label>Observaciones:</label>
                <textarea name="observaciones" id="observaciones" size="" style="display:inline-block; width:50%;" maxlength="200" placeholder="La máquina requiere de: ..." onKeyUp="validarObservaciones();" onblur="validarObservaciones();"></textarea>
                <div class="promts"> <span id="observacionesPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
              </td>

            </tr>
          </table>
          <table width="100%" id="repuesto_asoc">
            <tr ><td colspan="3"> <hr></td></tr>
            <tr><td style="font-size:20px;" colspan="3" align="center"><b>Repuesto Registrados Anteriormente</b></td></tr>
            <tr >
              <td align="center">
                <label>Nombre del Repuesto:</label> 
                <select  id="repuestoPB" title="Repuesto encontrados" onchange="busca_cantidadP();">
                  <option></option>

                </select>
              </td>
              <td >
                <label>Cantidad Salida:</label> 
                <input readonly="readonly" id="repuestoPC" title="Cantidad de salida">

              </td>


            </tr>
          </table>
          <table width="100%">
            <tr><td colspan="3"><hr></td></tr>
            <tr>
             <td colspan="2">
              <label style="font-size:15px;">Ejecutado:</label>
              <input type="radio" name="estado" value="concluido" >Total
              <input type="radio" name="estado" value="no concluido" checked="">Parcial
            </td>
            <td>
              <label style="font-size:15px;">Incluir Repuestos:</label>
              <input type="radio" name="incluir" value="no" checked="" id="incluir_noI">No
              <input type="radio" name="incluir" value="si" id="incluir_siI">Si
            </td>

          </tr>
        </table>
        <input type="hidden" id="control_cantidad" name="control_cantidad" value="1">

        <table width="100%" id="tablo">
          <tr>
            <td width="25%">
              <label>Repuesto:</label>
              <select name="repuestoI[]" id="repuestoI1" style="width:140px;" onchange="buscar_repuestoI1(repuestoI1);">
                <option value=""></option>
              </select>
              <div class="promts" style="margin-left:-80px;"> <span id="repuestoIPrompt1"></span></div>
              <input type="hidden" name="idRI[]" id="idR1">
            </td>
            <td width="25%">
              <label>Cantidad en Existencia:</label>
              <input readonly="readonly" name="existenciaR1" id="existenciaIR1" >

            </td>
            <td width="25%">

              <label>Cantidad Utilizada:</label>
              <input  name="utilizadaRI[]" id="utilizadaIR1" onkeypress="return solonum3(event)" maxlength="2" onkeyup="validar_utilizadaIR1();" onblur="validar_utilizadaIR1();">
              <div class="promts"> <span id="utilizadaIRPrompt1"></span></div>
        <!--  <select name="repuesto2" id="repuesto2">
            <option value=""></option>
      <?php 
          $consultaR1=pg_query("SELECT * FROM insumos WHERE id_insumos<>3 AND estatus=1");
          while ($fila=pg_fetch_assoc($consultaR1)) {
          echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
          }
      ?>
    </select>-->
    
  </td>
  <td width="25%" style="vertical-align: bottom;">
    <button type="button" class="btn remove_button btn btn-warning" style="padding: 2px 5px;">Remover &nbsp; <i class="fa fa-minus"></i></button>
  </td>
</tr>
</table>



<table width="100%" >
  <tr id="div_sumaI">
    <td colspan="4" align="center">
      <button type="button"  class="add btn btn-success" style="margin-top:5%; ">Agregar Repuesto &nbsp; <i class="fa fa-plus"></i></button>
    </td>
  </tr>

  <tr>
    <td colspan="4" align="center">
      <h3><div id="salidaR_PRE"></div></h3>
    </td>
  </tr>

  <tr>
    <td align="center" colspan="4">
      <br><br>

      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
      <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
      <br><br>
    </td>
  </tr>
</table>




</fieldset>
</form>
</div>
<div id="externo">
  <form action="registrando_ejecucion_mant_corre.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarFormE()" enctype="multipart/form-data" >

   <fieldset id="regmaq" style="color:#000;">

     <input type="hidden" name="tipo_servicio" value="externo">
     <input type="hidden" name="id_per" id="id_per2"> 
     <input type="hidden" name="id_maq" id="id_maq2">
     <input type="hidden" name="res" id="res2">
     <table width="100%">
      <tr>
        <td colspan="3" align="center">
          <input type="hidden" id="validaNE">

          <label><b>Número del Mantenimiento:</b></label>
          <input type="text" name="numero_mant" id="numero_mantE" onkeypress="return solonum3(event);" maxlength="6" onblur="buscaNumeroMantE();">
          <div class="promts" style="margin-left: -1px;"> <span id="numeroEPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          <input type="hidden" id='maquina_id2' >
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label><b>Supervisor:</b></label><br>
          <input  readonly="readonly" type="text" name="rev_maquina" id="rev_maquina2" class="form-control" style="width:160px;" size="" maxlength="30" placeholder="" onKeyPress="return soloLetras(event)"  >
        </td>

        <td >
          <label ><b>Proveedor:</b></label><br>
          <textarea readonly="readonly" name="proveedor" id="provedor" class="form-control" size="" maxlength="125" style="display:inline-block; width:160px;" placeholder="" onkeypress="return soloAlfa(event)"></textarea>
        </td>


      </tr>
      <tr>

        <td colspan="2">
          <label><b>Responsable:</b></label><br>
          <textarea  readonly="readonly" name="responsable" id="responsable2"  class="form-control" style="display:inline-block; width:160px;" size="" maxlength="125" placeholder="" onKeyUp="validarResponsablemod();" onblur="validarResponsablemod();"></textarea>
          <br>
        </td>
        
        
        <td>
          <label><b>Fecha de Solicitud:</b></label><br>
          <input type="text"  readonly="readonly" name="fechapropuesta" id="fechapropuesta2" class="form-control" style="width:180px;" size="" maxlength="10" placeholder="00/00/0000">
          
        </td>
      </tr>
      <tr>

        <td colspan="2">
          <label><b>Fecha de la falla:</b></label>
          <input type="text" name="fecha_falla" id="fecha2" style="width:140px;" size="" maxlength="10" placeholder="00/00/0000" onclick="valida_fecha2()" onchange="valida_fecha2()" onblur="valida_fecha2()">
          <div class="promts" style="z-index:1;"> <span id="fecha2Prompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
        </td>
        <td>
          <div  style="display: table;">
            <label><b>Hora de la falla:</b></label>
            <input readonly type="text" name="hora_falla" id="hora_f2" style="width:140px;" size="" maxlength="8" placeholder="00:00" onkeyup="validarFalla2()" onblur="validarFalla2()" onkeypress="return solonum4(event)">
            <div class="promts"> <span id="hora_f2Prompt"></span></div>
            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          </div>
        </td>
      </tr>
      <tr>


        <td>
          <input type="hidden" name="resultado_fecha2" id="resultado_fecha2">

          <label>Fecha de Ejecucion:</label>
          <input type="text" name="fecha" id="nextfecha2" style="width:140px;" size="" maxlength="10" placeholder="00/00/0000"  onclick="valida_fechaEj2()" onchange="valida_fechaEj2()" onblur="valida_fechaEj2()">
          <div class="promts" style="margin-left: -10px; z-index:2;"> <span id="fecha2xPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
        </td>

        <td>
          <div  style="display: table;">
            <label><b>Hora de arranque:</b></label>
            <input readonly type="text" style="resize:none;" name="hora_arranque" id="hora_a2" style="width:140px;" size="" maxlength="8" placeholder="00:00" onclick="validarArranque2()" onkeyup="validarArranque2()" onblur="validarArranque2()">
            <div class="promts"> <span id="hora_a2Prompt"></span></div>
            <p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
          </div>

        </td>
        <td>
          <label><b>Horas hombre:</b></label>
          <input type="text" name="hora_hombre" id="hora_h2" style="width:140px;" size="" maxlength="3" placeholder="00:00" onkeyup="validarHombre2()"  onkeyup="validarHombre2()"  onKeyPress="return solonum(event)">
          <div class="promts"> <span id="hora_h2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>
        </td>
      </tr>

      <tr>
        <td>
         <div  style="display: table;">
          <label>Costo:</label>
          <input type="text" name="costo" id="costo2" style="width:140px;" maxlength="10" onkeyup="validarCosto2();" onblur="validarCosto2();"  onKeyPress="return solonum3(event)">
          <div class="promts"> <span id="costo2Prompt"></span></div>
          <input type="text" readonly="readonly" name="moneda" value="Bs" size="3"><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
        </div>
      </td>

      <td colspan="2">
        <label>Observaciones:</label>
        <textarea name="observaciones" id="observaciones2" style="display:inline-block; width:90%;"  size="" maxlength="200" placeholder="La máquina requiere de: ..." onKeyUp="validarObservaciones2();" onblur="validarObservaciones2();"></textarea>
        <div class="promts"> <span id="observaciones2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

      </td>
    </tr>
    <table width="100%" id="repuesto_asoc2">
      <tr ><td colspan="3"> <hr></td></tr>
      <tr><td style="font-size:20px;" colspan="3" align="center"><b>Repuesto Registrados Anteriormente</b></td></tr>
      <tr >
        <td align="center">
          <label>Nombre del Repuesto:</label> 
          <select  id="repuestoPB2" title="Repuesto encontrados" onchange="busca_cantidadP2();">
            <option></option>

          </select>
        </td>
        <td >
          <label>Cantidad Salida:</label> 
          <input readonly="readonly" id="repuestoPC2" title="Cantidad de salida">

        </td>


      </tr>
    </table>
    <table width="100%">
      <tr><td colspan="3"><hr></td></tr>
      <tr>
       <td colspan="2">
        <label style="font-size:15px;">Ejecutado:</label>
        <input type="radio" name="estado" value="concluido">Total
        <input type="radio" name="estado" value="no concluido"  checked="">Parcial
      </td>
      <td>
        <label style="font-size:15px;">Incluir Repuestos:</label>
        <input type="radio" name="incluir" value="no" checked="" id="incluir_noE">No
        <input type="radio" name="incluir" value="si" id="incluir_siE">Si
      </td>

    </tr>
  </table>

  <input type="hidden" id="control_cantidad2" name="control_cantidad" value="1">


  <table width="100%" id="tablo2">
    <tr>
      <td width="25%">
        <label>Repuesto:</label>
        <select name="repuestoE[]" id="repuestoE1" style="width:140px;" onchange="buscar_repuestoE1(repuestoE1);">
          <option value=""></option>
        </select>
        <div class="promts" style="margin-left:-80px;"> <span id="repuestoEPrompt1"></span></div>
        <input type="hidden" name="idRE[]" id="idRE1">
        <!--<input type="hidden" id="idR1">-->
      </td>
      <td width="25%">
        <label>Cantidad en Existencia:</label>
        <input readonly="readonly" name="existenciaR1" id="existenciaER1" >

      </td>
      <td width="25%">

        <label>Cantidad Utilizada:</label>
        <input  name="utilizadaRE[]" id="utilizadaER1" onkeypress="return solonum3(event)" maxlength="2" onkeyup="validar_utilizadaER1();" onblur="validar_utilizadaER1();">
        <div class="promts"> <span id="utilizadaERPrompt1"></span></div>

        <!--  <select name="repuesto2" id="repuesto2">
            <option value=""></option>
      <?php 
          $consultaR1=pg_query("SELECT * FROM insumos WHERE id_insumos<>3 AND estatus=1");
          while ($fila=pg_fetch_assoc($consultaR1)) {
          echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
          }
      ?>
    </select>-->
    
  </td>
  <td width="25%" style="vertical-align: bottom;">
    <button type="button" class="btn remove_button2 btn btn-warning" style="padding: 2px 5px;">Remover &nbsp; <i class="fa fa-minus"></i></button>

  </td>
</tr>
</table>
<table width="100%" >
  <tr id="div_sumaE">
    <td colspan="4" align="center">
      <button type="button"  class="add2 btn btn-success" style="margin-top:5%; ">Agregar Repuesto &nbsp; <i class="fa fa-plus"></i></button>
    </td>
  </tr>

  <tr>
    <td colspan="4" align="center">
      <h3><div id="salidaR_PRE2"></div></h3>
    </td>
  </tr>
  <tr>
    <td colspan="4" align="center">
      <br><br>

      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
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
        <h4 class="modal-title">Registro Maquina</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Debe completar el formulario</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar" id="btn_error_incompleto">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

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
    <script type="text/javascript" src="funciones.js"></script>

    <script type="text/javascript" src="js/jquery.fancybox.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $(".fancybox").fancybox();



      $('#hora_a').datetimepicker({ 
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      }
      );
      $('#hora_f').datetimepicker({
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      });
      $('#hora_f2').datetimepicker({ 
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      }
      );
      $('#hora_a2').datetimepicker({
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      });
      $('#hora_fallamod').datetimepicker({ 
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      }
      );
      $('#hora_arranquemod').datetimepicker({
        format: 'hh:mm A',useCurrent:true, showTodayButton: true, pickTime:true, pickDate:false
      });
    });
    </script>

    <script type="text/javascript">
    $(document).ready(function ($) {
    // trigger event when button is clicked
    var  cantInt;
    var cantidad;
    //$(".add").click(function () 
      $(".add").on("click", function () {
        // add new row to table using addTableRow function
        

//--------------modificado----------------
cantidad=document.getElementById("control_cantidad").value;

if (cantidad<10){
  addTableRow($("#tablo"));
        //aqui id de la table a utilizar
        cantInt=parseInt(cantidad);
        cantInt+=1;
        $('#control_cantidad').val(cantInt);
//---------------End modificado----------

        // prevent button redirecting to new page
        return false;
      }

    });

    // function to add a new row to a table by cloning the last row and 
    // incrementing the name and id values by 1 to make them unique
    function addTableRow(table) {

        // clone the last row in the table
        var $tr = $(table).find("tbody tr:last").clone();

        $tr.find('[id^=controlPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + ++parts[2];
        }).text("");

        $tr.find('[id^=repuestoIPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + +parts[2];
        }).text("");

        $tr.find('[id^=utilizadaIRPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + +parts[2];
        }).text("");

        // get the name attribute for the input and select fields
        $tr.find('[id^=repuestoI]').attr("name", function () {
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

          }).attr("onchange", function(){

            var parts = this.id.match(/(\D+)(\d+)$/);
            var opcion = "buscar_repuestoI1("+parts[1] + +parts[2]+")";
            //return parts[1] + +parts[2];  
            return opcion;
            
            
          });

          $tr.find('[id^=existenciaIR]').attr("name", function () {
            // break the field name and it's number into two parts
        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



         //  return parts[1] + ++parts[2];

            // repeat for id attributes
          }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];

          }).val("");

          $tr.find('[id^=utilizadaIR]').attr("name", function () {
            // break the field name and it's number into two parts
            



        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



       //  return parts[1] + ++parts[2];

            // repeat for id attributes
          }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];

          }).attr("onkeyup", function(){

            var parts = this.id.match(/(\D+)(\d+)$/);
            var opcion = "validar_utilizadaIR1()";
            //return parts[1] + +parts[2];  
            return opcion;
            
            
          }).val("");


          $tr.find('[id^=idR]').attr("name", function () {
            // break the field name and it's number into two parts
            



        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



       //  return parts[1] + ++parts[2];

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
        $("#table tr td:first-child").text(function () {
          return ++rowCount;
        });

        // remove rows
        
        $(".remove_button").on("click", function () {


          if ( $('#table tbody tr').length == 1) return;
          cantidad=document.getElementById("control_cantidad").value;
          if (cantidad>1){



            $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;


//--------------modificado-----------

           //  cantidad=document.getElementById("control_cantidad").value;
           cantInt=parseInt(cantidad);
           cantInt=cantInt-1;
           $('#control_cantidad').val(cantInt);
////-----------End modificado-----------

$("#table tr td:first-child").text(function () {
  return ++rowCount;
});
});

            

          }
        });



      };
    });
</script>
<script type="text/javascript">
$(document).ready(function ($) {
    // trigger event when button is clicked
    var  cantInt;
    var cantidad;
    //$(".add").click(function () 
      $(".add2").on("click", function () {
        // add new row to table using addTableRow function
        

//--------------modificado----------------
cantidad=document.getElementById("control_cantidad2").value;

if (cantidad<10){
  addTableRow2($("#tablo2"));
        //aqui id de la table a utilizar
        cantInt=parseInt(cantidad);
        cantInt+=1;
        $('#control_cantidad2').val(cantInt);
//---------------End modificado----------

        // prevent button redirecting to new page
        return false;
      }

    });

    // function to add a new row to a table by cloning the last row and 
    // incrementing the name and id values by 1 to make them unique
    function addTableRow2(table) {

        // clone the last row in the table
        var $tr = $(table).find("tbody tr:last").clone();

        $tr.find('[id^=controlPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + ++parts[2];
        }).text("");

        $tr.find('[id^=repuestoEPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + +parts[2];
        }).text("");

        $tr.find('[id^=utilizadaERPrompt]').attr("id", function () {
          var parts = this.id.match(/(\D+)(\d+)$/);
          return parts[1] + +parts[2];
        }).text("");

        // get the name attribute for the input and select fields
        $tr.find('[id^=repuestoE]').attr("name", function () {
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

          }).attr("onchange", function(){

            var parts = this.id.match(/(\D+)(\d+)$/);
            var opcion = "buscar_repuestoE1("+parts[1] + +parts[2]+")";
            //return parts[1] + +parts[2];  
            return opcion;
            
            
          });

          $tr.find('[id^=existenciaER]').attr("name", function () {
            // break the field name and it's number into two parts
        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



         //  return parts[1] + ++parts[2];

            // repeat for id attributes
          }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];

          }).val("");

          $tr.find('[id^=utilizadaER]').attr("name", function () {
            // break the field name and it's number into two parts
            



        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



       //  return parts[1] + ++parts[2];

            // repeat for id attributes
          }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];

          }).attr("onkeyup", function(){

            var parts = this.id.match(/(\D+)(\d+)$/);
            var opcion = "validar(this.id)";
            //return parts[1] + +parts[2];  
            return opcion;
            
            
          }).val("");

          $tr.find('[id^=idRE]').attr("name", function () {
            // break the field name and it's number into two parts
            



        //var parts = this.id.match(/(\D+)(\d+)$/);
        

            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            



       //  return parts[1] + ++parts[2];

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
        $("#table tr td:first-child").text(function () {
          return ++rowCount;
        });

        // remove rows
        
        $(".remove_button2").on("click", function () {


          if ( $('#table tbody tr').length == 1) return;
          cantidad=document.getElementById("control_cantidad2").value;
          if (cantidad>1){



            $(this).parents("tr").fadeOut('slow', function () {
              $(this).remove();
              rowCount = 0;


//--------------modificado-----------

           //  cantidad=document.getElementById("control_cantidad").value;
           cantInt=parseInt(cantidad);
           cantInt=cantInt-1;
           $('#control_cantidad2').val(cantInt);
////-----------End modificado-----------

$("#table tr td:first-child").text(function () {
  return ++rowCount;
});
});

            

          }
        });



      };
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
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/lang/es.js"></script>
<!--validar formulario-->
<script type="text/javascript" src="js/vali_corre.js"></script>
</body>
</html>
<?php
#ELIMINAR MAQUINA
$recibido=$_REQUEST['numeros_mant'];

if ($recibido!='')
{
  ?>
  <script type="text/javascript">


  $('#consulta_prev').hide();
  $('#interno').show();
  $('#r_mant_prev').show();
  buscaNumeroMantI();
  
        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

        </script>

        <?php
      }
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
