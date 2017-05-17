<?php
  require('seguridad.php');
  require('conexion.php');

  
  if($_SESSION['tipo']!='Administrador')
  {
?>
  <script type="text/javascript">
    window.location.href="actividades.php?permiso=negativo";
  </script>
<?php
  }
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
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="css/nuestro.css" rel="stylesheet">
    <link href="css/nuevo2.css" rel="stylesheet">

    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">

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
                                                               <div id="carga"><h3>Cargando por favor espere...</h3><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>

              <div id="consulta_planificacion">

                <h4><a href="#">Administrativo</a> > <a href="actividades.php">Actividades</a> > <a href="#">Planificación Semanal</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Consulta de Planificación Semanal</span>
                  </div><br>

                  <table class="tabla_agregar_imprimir">
                    <tr>
                      <td>
                      </td>
                   
                      <td>
                        <p id="agregar_per"><button class="btn btn-success" onclick="N_planificacion()">Nueva Planificación &nbsp; <i class="fa fa-plus"></i></button></p>
                      </td>
                    </tr>
                  </table>
                  
                  <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Encargado</th>
                          <th width="50%">Actividad</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                       $sql="SELECT * FROM planificacion_semanal INNER JOIN personal
                       ON planificacion_semanal.id_personal = personal.id AND planificacion_semanal.estatus=1
                       AND personal.estatus=1 AND area='Robotica'";
                       
                       $query=pg_query($sql);

                        while ($array=pg_fetch_assoc($query))
                        {

                          $nom=explode(' ', $array['nombres']);
                          $ape=explode(' ', $array['apellidos']);

                          $encargado=$nom[0]." ".$ape[0];

                          $fecha=explode('-', $array['fecha']);
                          $fecha_planif=$fecha[2].'/'.$fecha[1].'/'.$fecha[0];
                      ?>
                        <tr class="odd gradeX">
                          <td align="center"><?php echo $fecha_planif;?></td>
                          <td align="center"><?php echo $encargado;?></td>
                          <td align="center"><?php echo $array['actividad'];?></td>
                          <td align="center">
                            <a <?php if ($array['estado']=='En proceso' || $array['estado']=='0')
                                      {
                                ?>
                                  href="javascript:editar_planificacion(<?php echo $array['id_planif'];?>);"
                                <?php
                                      }
                                ?>
                              >
                              <button class="btn btn-default"
                                <?php if ($array['estado']=='En proceso' || $array['estado']=='0')
                                      {
                                ?>
                                  title="Modificar"
                                <?php
                                      }
                                      else
                                      {
                                ?>
                                  title="Esta Actividad se encuentra 'Concluida' ó 'No conluida'"        
                                <?php
                                      }
                                ?>                                
                              >
                                <span class="fa fa-edit"></span>
                              </button>
                            </a>

                            <a href="javascript:eliminarPlanificacion(<?php echo $array['id_planif'];?>);">
                              <button class="btn btn-default" title="Eliminar">
                                <span class="fa fa-trash-o"></span>
                              </button>
                            </a>
                                    
                            <a <?php if ($array['estado']=='En proceso' || $array['estado']=='0')
                                      {
                                ?>
                                  href="javascript:estadoPlanificacion(<?php echo $array['id_planif'];?>);"
                                <?php
                                      }
                                ?>
                              >
                              <button class="btn btn-default"
                                <?php if ($array['estado']=='En proceso' || $array['estado']=='0')
                                      {
                                ?>
                                  title="Estado"
                                <?php
                                      }
                                      else
                                      {
                                ?>
                                  title="Esta Actividad se encuentra 'Concluida' ó 'No conluida'"        
                                <?php
                                      }
                                ?>                                
                              >
                                <span class="fa fa-check-square-o "></span>
                              </button>
                            </a>

                            <a href="javascript:detallePlanificacion(<?php echo $array['id_planif'];?>);">
                              <button class="btn btn-default" title="Detalle">
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
              </div>

              <div id="registro_planificacion">

                <h4><a href="#">Administrativo</a> > <a href="actividades.php">Actividades</a> > <a href="planificacion_semanal.php">Planificación Semanal</a> > <a href="#">Nueva Planificación</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Registro de la Actividad</span>
                  </div><br>

                  <form method="post" action="registro_planificacion.php" id="reg_planif" onsubmit="return validarR_PLANIF()">

                    <table width="100%">
                      <tr>
                        <td class="tit">

                          <input type="hidden" name="validar_ci_usu_ajax" id="validar_ci_usu_ajax"/>

                          <label><b>Cédula de Identidad:</b></label><br>
                          <select id="nacionalidad_planif" name="nacionalidad_planif" title="Seleccione la nacionalidad de la persona" onChange="validarNAC()">
                            <option> </option>
                            <option>V-</option>
                            <option>E-</option>
                          </select>
                          <input type="text" name="ci_planif" id="ci_planif" maxlength="12" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI(), personal_planif()" onkeyup="validarCI(), personal_planif()" onchange="validarCI(), personal_planif()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -36px;"><span id="C.I_usuario"></span></div>
                        </td>
                        
                        <td class="tit">
                          <label><b>Nombres:</b></label><br>
                          <input readonly="readonly" type="text" name="nombres_usu_planif" id="nombres_usu_planif" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>      
                        </td>
                        <td class="tit">
                          <label><b>Apellidos:</b></label><br>
                          <input readonly="readonly" type="text" name="apellidos_usu_planif" id="apellidos_usu_planif" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
                        </td>
                      </tr>
                      <tr>
                        <td class="tit" colspan="2">

                          <input type="hidden" name="validar_actividad_ajax" id="validar_actividad_ajax"/>

                          <label><b>Actividad:</b></label><br>
                          <textarea type="text" name="nom_act" id="nom_act" placeholder="Ejemplo:Realizar inventario de herramientas" title="Escriba la actividad a realizar 'Ejemplo:Realizar inventario de herramientas'" onkeypress="return letra_num_car(event)" onkeyup="validarACTIVIDAD()" onclick="validarACTIVIDAD()"></textarea>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts"><span id="actividad"></span></div>
                        </td>
                        <td class="tit">
                          <label><b>Fecha:</b></label><br>
                          <input type="text" name="fecha_act" id="fecha_act" placeholder="Ejemplo:Día/Mes/Año" title="coloque la fecha en que se realizará la actividad 'Ejemplo:27/11/2015'" onkeyup="validarFECHA()" onclick="validarFECHA()" onchange="validarFECHA()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts"><span id="fecha_actividad"></span></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_PLANIF"></div></h3>
                        </td>
                      </tr>
                          <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                      <tr>
                        <td class="tit" colspan="3">
                          <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                          <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">  
                        </td>
                      </tr>
                    </table>               

                  </form>

                </div>

              </div>

              <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <form method="post" action="modifica_planificacion.php" id="modif_planif" onsubmit="return validarM_PLANIF()">

                          <input type="hidden" name="id" id="id"/>

                          <input type="hidden" name="id_per" id="id_per"/>

                          <table width="100%">
                            <tr>
                              <td class="tit">
                                
                                <input type="hidden" name="validar_ci_usu_ajaxM" id="validar_ci_usu_ajaxM" value="1"/>

                                <label><b>Cédula de Identidad:</b></label><br>
                                <select id="nacionalidad_planif_M" name="nacionalidad_planif_M" title="Seleccione la nacionalidad de la persona" onChange="validarNAC_M()">
                                  <option> </option>
                                  <option>V-</option>
                                  <option>E-</option>
                                </select>
                                <input type="text" name="ci_planif_M" id="ci_planif_M" maxlength="12" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI_M(), personal_planif_M()" onkeyup="validarCI_M(), personal_planif_M()" onchange="validarCI_M(), personal_planif_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -34px"><span id="C.I_usuarioM"></span></div>
                              </td>
                              <td class="tit">
                                <label><b>Nombres:</b></label><br>
                                <input readonly="readonly" type="text" name="nombres_usu_planif_M" id="nombres_usu_planif_M" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>      
                              </td>
                              <td class="tit">
                                <label><b>Apellidos:</b></label><br>
                                <input readonly="readonly" type="text" name="apellidos_usu_planif_M" id="apellidos_usu_planif_M" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
                              </td>
                            </tr>
                            <tr>
                              <td class="tit" colspan="2">

                                <input type="hidden" name="validar_actividad_ajaxM" id="validar_actividad_ajaxM"/>

                                <label><b>Actividad:</b></label><br>
                                <textarea type="text" name="nom_act_M" id="nom_act_M" placeholder="Ejemplo:Realizar inventario de herramientas" title="Escriba la actividad a realizar 'Ejemplo:Realizar inventario de herramientas'" onkeypress="return letra_num_car(event)" onkeyup="validarACTIVIDAD_M()" onclick="validarACTIVIDAD_M()"></textarea>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts"><span id="actividadM"></span></div>
                              </td>
                              <td class="tit">
                                <label><b>Fecha:</b></label><br>
                                <input type="text" name="fecha_act_M" id="fecha_act_M" placeholder="Ejemplo:Día/Mes/Año" title="coloque la fecha en que se realizará la actividad 'Ejemplo:27/11/2015'" onkeyup="validarFECHA_M()" onclick="validarFECHA_M()" onchange="validarFECHA_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts"><span id="fecha_actividadM"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_PLANIF"></div></h3>
                              </td>
                            </tr>
                                <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                            <tr>
                              <td class="tit" colspan="3">
                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                              </td>
                            </tr>
                          </table>               

                        </form>
                            
                      </div>                    
                    </div>
                  </div>
                </div>
              <!-- End modal -->

              <!-- estado Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="estado_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado de la Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <form method="post" action="estado_planificacion.php" id="estado_planif">

                          <input type="hidden" name="id_planif" id="id_planif"/>

                          <table width="100%">
                            <tr>
                              <td class="tit">
                                <label><b>Concluida:</b></label>
                                <input type="radio" name="estado" value="Concluida" id="concluida" onclick="verif_estado('Concluida')" data-dismiss="modal"/>
                              </td>
                              <td class="tit">
                                <label><b>En proceso:</b></label>
                                <input type="radio" name="estado" value="En proceso" id="en_proceso"/>
                              </td>
                              <td class="tit">
                                <label><b>No concluida:</b></label>
                                <input type="radio" name="estado" value="No concluida" id="no_concluida" onclick="verif_estado('No concluida')" data-dismiss="modal"/>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaE_PLANIF"></div></h3>
                              </td>
                            </tr>
                            <tr>
                              <td class="tit" colspan="3">
                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                              </td>
                            </tr>
                          </table>               

                        </form>
                            
                      </div>                    
                    </div>
                  </div>
                </div>
              <!-- End estado modal -->

              <!-- eliminar modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="verif_estado" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado de la Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <input type="hidden" id="valor2" name="valor2"/>

                        <h4 align="center">¿Usted esta seguro que desea cambiar el estado de la Actividad a "<span id="valor"></span>"?
                        <br><br>¡Si acepta realizar este cambio después no podrá realizar ninguna modificación ni eliminar la Actividad seleccionada!</h4>                            
                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" onclick="aceptar()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar modal -->

              <!-- detalle Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_planificacion" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Detalle de la Actividad</h4>
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

              <!-- eliminar modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_planificacion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Eliminar Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¿Usted esta seguro que desea eliminar esta Actividad?</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_planificacion">
                                                    
                        <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Planificacion()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar modal -->

              <!-- registro planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registro_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Actividad registrada con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End registro planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Actividad modificada con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! La Actividad ya esta asignada a la persona en el mismo día</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- eliminar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminacion_planif" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Eliminar Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Actividad eliminada con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar planificacion modal -->

              <!-- estado planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="exito_estado" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado de Actividad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se cambio el estado de la Actividad con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End estado planificacion modal -->
<?php
 include("form_user_elim.php");
 $user_elim=form_user_elim();
 echo $user_elim;
?>
              </ajax>
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
    
    <!--script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script-->

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
  	<script src="assets/js/zabuto_calendar.js"></script>	
  	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/lang/es.js"></script>
    <script type="text/javascript" src="funciones.js"></script>
    <script type="text/javascript" src="js/vali_actividades.js"></script>

</body>
</html>
<?php

  $registro=$_REQUEST['registro'];

  if ($registro=='exito')
  {
?>
<script type="text/javascript">
    
    $('#registro_planif').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  $modificar=$_REQUEST['modificar'];

  if ($modificar=='exito')
  {
?>
<script type="text/javascript">
    
    $('#modificar_planif').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  $error=$_REQUEST['error'];

  if ($error=='si')
  {
?>
<script type="text/javascript">
    
    $('#error_planif').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  $elim_planif=$_REQUEST['elim_planif'];

  if ($elim_planif=='si')
  {
?>
<script type="text/javascript">
    
    $('#eliminacion_planif').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  $estado=$_REQUEST['estado'];

  if ($estado=='exito')
  {
?>
<script type="text/javascript">
    
    $('#exito_estado').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }
?>
