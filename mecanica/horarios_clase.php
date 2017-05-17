<?php
  require('seguridad.php');
  require('conexion.php');

    $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_horarios']);
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

    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">

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

                <div id="consulta_horarios">

                  <h4><a href="#">Académico</a> > <a href="#">Horarios</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Horarios</span>
                    </div><br>

                    <table class="tabla_agregar_imprimir">
                      <tr>
                        <td>
                        </td>
                     
                        <td>
                          <?php
                            if ($privilegio_A=='A')
                            {
                          ?>
                          <p id="agregar_per"><button class="btn btn-success" onclick="N_horario()">Nuevo Horario &nbsp; <i class="fa fa-plus"></i></button></p>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                    </table>
                    
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                          <tr>
                            <th>Trayecto</th>
                            <th>Sección</th>
                            <th>Periodo</th>
                            <th>Sede</th>
                            <th>PNF</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                         $sql_mio="SELECT hc.id_seccion, s.id_seccion, p.id_periodo, s.seccion, s.trayecto, p.tipo, s.sede, s.pnf FROM horario_clase hc, horas h, secciones s, periodo p WHERE hc.id_seccion=s.id_seccion AND hc.id_horas=h.id_horas AND hc.id_periodo=p.id_periodo AND hc.taller=1 AND h.taller=1 AND s.taller=1 AND hc.estatus=1 AND h.estatus=1 AND s.estatus=1 GROUP BY s.id_seccion, hc.id_seccion, p.id_periodo ORDER BY s.trayecto, s.seccion ASC";

                        $sql_servidor="SELECT hc.id_seccion, s.id_seccion, p.id_periodo, s.seccion, s.trayecto, p.tipo, s.sede, s.pnf FROM horario_clase hc, horas h, secciones s, periodo p WHERE hc.id_seccion=s.id_seccion AND hc.id_horas=h.id_horas AND hc.id_periodo=p.id_periodo AND hc.taller=1 AND h.taller=1 AND s.taller=1 AND hc.estatus=1 AND h.estatus=1 AND s.estatus=1 GROUP BY s.pnf, s.sede, p.tipo, s.trayecto, s.seccion, s.id_seccion, hc.id_seccion, p.id_periodo ORDER BY s.trayecto, s.seccion ASC";

                        $query=pg_query($sql_servidor);

                          while ($array=pg_fetch_assoc($query))
                          {
                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['trayecto'];?></td>
                            <td align="center"><?php echo $array['seccion'];?></td>
                            <td align="center"><?php echo $array['tipo'];?></td>
                            <td align="center"><?php echo $array['sede'];?></td>
                            <td align="center"><?php echo $array['pnf'];?></td>
                            <td align="center">
                            <?php
                              if ($privilegio_M=='M')
                              {
                            ?>  
                              <a href="javascript:editar_horario(<?php echo $array['id_seccion'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if ($privilegio_E=='E')
                              {
                            ?>
                              <a href="javascript:eliminarHorario(<?php echo $array['id_seccion'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                            <?php
                              }
                            ?>
                              <a href="javascript:detalleHorario(<?php echo $array['id_seccion'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Detalle">
                                  <span class="fa fa-search-plus"></span>
                                </button>
                              </a>
                            <?php
                              if ($privilegio_I=='I')
                              {
                            ?>
                              <a href="javascript:reporteHorario(<?php echo $array['id_seccion'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Reporte">
                                  <span class="fa fa-print"></span>
                                </button>
                              </a>
                            <?php
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
                </div>

                <div id="registro_horarios">

                  <h4><a href="#">Académico</a> > <a href="horarios_clase.php">Horarios</a> > <a href="#">Nuevo Horario</a></h4>

                  <div class="info3">
                  
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Horarios</span>
                    </div><br>

                    <form method="post" action="#" onsubmit="validarHORARIOS()">

                    <table width="100%">
                      <tr>
                        <td colspan="2" class="tit">
                          <label><b>Sección:</b></label><br>
                          <select id="seccion" name="seccion" title="Seleccione la Sección" onchange="valiDiasR('algo')">
                            <option> </option>
                            <?php
                              $con=pg_query("SELECT * FROM secciones WHERE taller=1 AND estatus=1 ORDER BY trayecto, seccion ASC");
                              while($ar=pg_fetch_assoc($con))
                              {
                            ?>
                              <option><?php echo "Año: ".$ar['anio']." Trayecto: ".$ar['trayecto']." Sección: ".$ar['seccion']." Sede: ".$ar['sede']." PNF: ".$ar['pnf']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:-178px;"><span id="SeccionHorario"></span></div>
                        </td>
                      
                        <td class="tit">
                          <label><b>Periodo:</b></label><br>
                          <select id="periodo" name="periodo" onchange="valiDiasR('algo')" title="Seleccione el periodo">
                            <option> </option>
                            <?php
                              date_default_timezone_set('America/Caracas');

                              $fecha=getdate();

                              $con=pg_query("SELECT * FROM periodo WHERE tipo LIKE '%".$fecha['year']."%' ORDER BY tipo ASC");
                              while($arr=pg_fetch_assoc($con))
                              {
                            ?>
                              <option><?php echo $arr['tipo']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:-9px;"><span id="PeriodoHorario"></span></div>
                          <br><br>
                        </td>
                        
                      </tr>
                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_HORARIO"></div></h3><br>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3">
                          <table border="2" width="100%">

                            <tr>
                              <th width="16%" class="tit">Hora</th>
                              <th width="16%" class="tit">Lunes</th>
                              <th width="16%" class="tit">Martes</th>
                              <th width="16%" class="tit">Miercoles</th>
                              <th width="16%" class="tit">Jueves</th>
                              <th width="16%" class="tit">Viernes</th>
                            </tr>
                            <?php
                              $query=pg_query("SELECT * FROM horas WHERE estatus=1 AND taller=1 ORDER BY numero_bloque ASC");
                              $num=pg_num_rows($query);
                              
                              while($array2=pg_fetch_assoc($query))
                              {
                                $en=explode(' ', $array2['entrada']);
                                $sa=explode(' ', $array2['salida']);

                                $entrada[]=$en[0];
                                $salida[]=$sa[0];
                                $ids[]=$array2['id_horas'];
                              }

                              for ($i=1; $i <=$num ; $i++)
                              { 
                                $j=$i-1;

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
                            <input type="hidden" name="id_<?php echo $i; ?>" id="id_<?php echo $i; ?>" value="<?php echo $ids[$j]; ?>">
                            <tr>
                              <td align="center"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
                              <td align="center" height="95px"><button disabled id="lunes_<?php echo $i; ?>" name="lunes_<?php echo $i; ?>" value="0" onclick="color_botonesYvalidarBloque('lunes_<?php echo $i; ?>'), ValidarBloqueProfe()" class="boton_horasH"></button></td>
                              <td align="center" height="95px"><button disabled id="martes_<?php echo $i; ?>" name="martes_<?php echo $i; ?>" value="0" onclick="color_botonesYvalidarBloque('martes_<?php echo $i; ?>'), ValidarBloqueProfe()" class="boton_horasH"></button></td>
                              <td align="center" height="95px"><button disabled id="miercoles_<?php echo $i; ?>" name="miercoles_<?php echo $i; ?>" value="0" onclick="color_botonesYvalidarBloque('miercoles_<?php echo $i; ?>'), ValidarBloqueProfe()" class="boton_horasH"></button></td>
                              <td align="center" height="95px"><button disabled id="jueves_<?php echo $i; ?>" name="jueves_<?php echo $i; ?>" value="0" onclick="color_botonesYvalidarBloque('jueves_<?php echo $i; ?>'), ValidarBloqueProfe()" class="boton_horasH"></button></td>
                              <td align="center" height="95px"><button disabled id="viernes_<?php echo $i; ?>" name="viernes_<?php echo $i; ?>" value="0" onclick="color_botonesYvalidarBloque('viernes_<?php echo $i; ?>'), ValidarBloqueProfe()" class="boton_horasH"></button></td>
                            </tr>
                            <?php
                              }
                            ?>
                              <input type="hidden" name="ciclo" id="ciclo" value="<?php echo $num; ?>">
                          </table>
                        </td>
                      </tr>
                       <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>  
                      <tr>
                        <td class="tit" colspan="3">
                          <button class="btn btn-primary" id="boton_submit" onclick="registrar_horario(<?php echo $num; ?>)" title="Aceptar">Aceptar</button>&nbsp;
                          <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">  
                        </td>
                      </tr>
                    </table>
                    </form>
                  </div>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="validarBloqueProf" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro Horario</h4>
                      </div>
                      <div class="modal-body">

                        <form action="#" method="post">

                            <table width="100%">
                              <tr>
                                <input type="hidden" name="capaValidarProf" id="capaValidarProf">
                                <input type="hidden" name="valorAjaxProf" id="valorAjaxProf">

                                <td class="tit">
                                  <label><b>C.I del Profesor N°1:</b></label><br>
                                  <select id="ci" name="ci" onchange="ValidarBloqueProfe('algo'), nom_ape_horarios('ci','nomApe')" onblur="nom_ape_horarios('ci','nomApe')" title="Seleccione la cedula del profesor">
                                    <option> </option>
                                  </select>
                                  <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                  <div class="promts" style="margin-left:37px;"><span id="CiProfHorario"></span></div>
                                </td>

                                <td class="tit">
                                  <label><b>Nombre y Apellido:</b></label><br>
                                  <input type="text" id="nomApe" name="nomApe" readonly size="30">
                                </td>

                              </tr>
                              
                              <tr>
                                <td class="tit">
                                  <label><b>C.I del Profesor N°2:</b></label><br>
                                  <select id="ci2" name="ci2" onchange="ValidarBloqueProfe('algo'), nom_ape_horarios('ci2','nomApe2')" onblur="nom_ape_horarios('ci2','nomApe2')" title="Seleccione la cedula del profesor">
                                    <option> </option>
                                  </select>
                                </td>

                                <td class="tit">
                                  <label><b>Nombre y Apellido:</b></label><br>
                                  <input type="text" id="nomApe2" name="nomApe2" readonly size="30">
                                </td>
                              </tr>

                              <tr>
                                <td class="tit">
                                  <label><b>C.I del Profesor N°3:</b></label><br>
                                  <select id="ci3" name="ci3" onchange="ValidarBloqueProfe('algo'), nom_ape_horarios('ci3','nomApe3')" onblur="nom_ape_horarios('ci3','nomApe3')" title="Seleccione la cedula del profesor">
                                    <option> </option>
                                  </select>
                                </td>

                                <td class="tit">
                                  <label><b>Nombre y Apellido:</b></label><br>
                                  <input type="text" id="nomApe3" name="nomApe3" readonly size="30">
                                </td>
                              </tr>

                              <tr>
                                <td class="tit">
                                  <label><b>Aula:</b></label><br>
                                  <select id="aula" name="aula" title="Seleccione el aula 'Ejemplo:A5'" onchange="ValidarBloqueProfe('algo2')">
                                    <option> </option>
                                    <?php
                                      $queryx=pg_query("SELECT * FROM aulas WHERE taller=1 AND estatus=1");

                                      while ($arrayx=pg_fetch_assoc($queryx))
                                      {
                                    ?>
                                    <option><?php echo $arrayx['nombre']; ?></option>
                                    <?php
                                      }
                                    ?>
                                  </select>
                                  <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                  <div class="promts" style="margin-left:-4px;"><span id="AulaHorario"></span></div>
                                </td>
                              
                                <td class="tit">
                                  <label><b>Código de Materia:</b></label><br>
                                  <select id="materia" name="materia" title="Seleccione el código de la materia" onchange="materia_horarios()">
                                    <option> </option>
                                    <?php
                                      $con3=pg_query("SELECT * FROM materia WHERE taller=1 AND estatus=1 ORDER BY codigo ASC");
                                      while($ar3=pg_fetch_assoc($con3))
                                      {
                                    ?>
                                      <option><?php echo $ar3['codigo']; ?></option>
                                    <?php
                                      }
                                    ?>
                                  </select>
                                  <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                  <div class="promts" style="margin-left:12px;"><span id="CodMatHorario"></span></div>
                                </td>
                              </tr>
                              <tr>
                                <td class="tit">
                                  <label><b>Nombre de Materia:</b></label><br>
                                  <input type="text" id="nom_materia" name="nom_materia" size="50" title="Nombre de la materia" readonly/>
                                </td>
                                <td class="tit">
                                  <label><b>Horas Semanales:</b></label><br>
                                  <input type="text" id="hora" name="hora" size="7" title="horas Semanales" readonly/>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="3" align="center">
                                  <h3><div id="SeleccionBloque"></div></h3>
                                </td>
                              </tr>
                               <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; "><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>  
                            </table>  
                          
                          <div class="modal-footer">

                            <input class="btn btn-primary" type="submit" id="submit" value="Marcar Bloque" title="Aceptar" disabled onclick="marcarBloque()">&nbsp;
                            <button class="btn btn-danger" data-dismiss="modal" title="Cerrar">Cerrar</button>  
                          
                          </div>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal -->


                <!-- Modal modificar -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_horario" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <form action="#" method="post">

                          <input type="hidden" id="idSeccion" name="idSeccion">
                          <input type="hidden" id="idPeriodo" name="idPeriodo">

                          <table width="100%">  
                            <tr>
                              <td colspan="2" class="tit">
                                <label><b>Sección:</b></label><br>
                                <input type="text" readonly size="90" id="seccionM" name="seccionM">
                              </td>
                            
                              <td class="tit">
                                <label><b>Periodo:</b></label><br>
                                <input type="text" readonly size="5" id="periodoM" name="periodoM">
                              </td>
                              
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_HORARIO"></div></h3><br>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3">
                                <table border="2" width="100%">

                                  <tr>
                                    <th width="16%" class="tit">Hora</th>
                                    <th width="16%" class="tit">Lunes</th>
                                    <th width="16%" class="tit">Martes</th>
                                    <th width="16%" class="tit">Miercoles</th>
                                    <th width="16%" class="tit">Jueves</th>
                                    <th width="16%" class="tit">Viernes</th>
                                  </tr>
                                  <?php
                                    $query=pg_query("SELECT * FROM horas WHERE estatus=1 AND taller=1 ORDER BY numero_bloque ASC");
                                    $num=pg_num_rows($query);
                                    
                                    while($array2=pg_fetch_assoc($query))
                                    {
                                      $en=explode(' ', $array2['entrada']);
                                      $sa=explode(' ', $array2['salida']);

                                      $entrada[]=$en[0];
                                      $salida[]=$sa[0];
                                      $ids[]=$array2['id_horas'];
                                    }

                                    for ($i=1; $i <=$num ; $i++)
                                    { 
                                      $j=$i-1;

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
                                  <input type="hidden" name="id_<?php echo $i; ?>_M" id="id_<?php echo $i; ?>_M" value="<?php echo $ids[$j]; ?>">
                                  <tr>
                                    <td align="center"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
                                    <td align="center" height="95px"><button id="lunes_<?php echo $i; ?>_M" name="lunes_<?php echo $i; ?>_M" value="0" onclick="color_botonesYvalidarBloqueM('lunes_<?php echo $i; ?>'), ValidarBloqueProfeM()" class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="martes_<?php echo $i; ?>_M" name="martes_<?php echo $i; ?>_M" value="0" onclick="color_botonesYvalidarBloqueM('martes_<?php echo $i; ?>'), ValidarBloqueProfeM()" class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="miercoles_<?php echo $i; ?>_M" name="miercoles_<?php echo $i; ?>_M" value="0" onclick="color_botonesYvalidarBloqueM('miercoles_<?php echo $i; ?>'), ValidarBloqueProfeM()" class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="jueves_<?php echo $i; ?>_M" name="jueves_<?php echo $i; ?>_M" value="0" onclick="color_botonesYvalidarBloqueM('jueves_<?php echo $i; ?>'), ValidarBloqueProfeM()" class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="viernes_<?php echo $i; ?>_M" name="viernes_<?php echo $i; ?>_M" value="0" onclick="color_botonesYvalidarBloqueM('viernes_<?php echo $i; ?>'), ValidarBloqueProfeM()" class="boton_horasH"></button></td>
                                  </tr>
                                  <?php
                                    }
                                  ?>
                                    <input type="hidden" name="ciclo_M" id="ciclo_M" value="<?php echo $num; ?>">
                                </table>
                              </td>
                            </tr>
                             <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>  
                          </table>

                          <div class="modal-footer">
                            <button class="btn btn-primary" id="boton_submit_M" onclick="registrar_horario_M(<?php echo $num; ?>)" title="Aceptar">Aceptar</button>&nbsp;
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                          </div>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal modificar -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="validarBloqueProfM" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" id="cerrarModalHorario" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <form action="#" method="post" onsubmit="return validarMATERIAS_M()">

                          <table width="100%">
                            <tr>
                              <input type="hidden" name="capaValidarProfM" id="capaValidarProfM">
                              <input type="hidden" name="valorAjaxProfM" id="valorAjaxProfM">

                              <td class="tit">
                                <label><b>C.I del Profesor:</b></label><br>
                                <select id="ciM" name="ciM" onchange="ValidarBloqueProfeM('algo'), nom_ape_horariosM('ciM','nomApeM')">
                                  <option> </option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:-0px;"><span id="CiProfHorarioM"></span></div>
                              </td>

                              <td class="tit">
                                <label><b>Nombre y Apellido:</b></label><br>
                                <input type="text" id="nomApeM" name="nomApeM" readonly size="30" >
                              </td>
                            </tr>
                            
                            <tr>
                                <td class="tit">
                                  <label><b>C.I del Profesor N°2:</b></label><br>
                                  <select id="ci2M" name="ci2M" onchange="ValidarBloqueProfeM('algo'), nom_ape_horariosM('ci2M','nomApe2M')" onblur="nom_ape_horariosM('ci2M','nomApe2M')" title="Seleccione la cedula del profesor">
                                    <option> </option>
                                  </select>
                                </td>

                                <td class="tit">
                                  <label><b>Nombre y Apellido:</b></label><br>
                                  <input type="text" id="nomApe2M" name="nomApe2M" readonly size="30">
                                </td>
                            </tr>

                            <tr>
                                <td class="tit">
                                  <label><b>C.I del Profesor N°3:</b></label><br>
                                  <select id="ci3M" name="ci3M" onchange="ValidarBloqueProfeM('algo'), nom_ape_horariosM('ci3M','nomApe3M')" onblur="nom_ape_horariosM('ci3M','nomApe3M')" title="Seleccione la cedula del profesor">
                                    <option> </option>
                                  </select>
                                </td>

                                <td class="tit">
                                  <label><b>Nombre y Apellido:</b></label><br>
                                  <input type="text" id="nomApe3M" name="nomApe3M" readonly size="30">
                                </td>
                            </tr>
                              
                            <tr>
                              <td class="tit">
                                <label><b>Aula:</b></label><br>
                                <select id="aulaM" name="aulaM" onchange="ValidarBloqueProfeM('algo2')">
                                  <option> </option>
                                    <?php
                                      $queryx=pg_query("SELECT * FROM aulas WHERE taller=1 AND estatus=1");

                                      while ($arrayx=pg_fetch_assoc($queryx))
                                      {
                                    ?>
                                    <option><?php echo $arrayx['nombre']; ?></option>
                                    <?php
                                      }
                                    ?>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:-4px;"><span id="AulaHorarioM"></span></div>
                              </td>
                            
                              <td class="tit">
                                <label><b>Código de Materia:</b></label><br>
                                <select id="materiaM" name="materiaM" onchange="materia_horariosM()">
                                  <option> </option>
                                  <?php
                                    $con3=pg_query("SELECT * FROM materia WHERE taller=1 AND estatus=1 ORDER BY codigo ASC");
                                    while($ar3=pg_fetch_assoc($con3))
                                    {
                                  ?>
                                    <option><?php echo $ar3['codigo']; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:12px;"><span id="CodMatHorarioM"></span></div>
                              </td>
                            </tr>

                            <tr>
                              <td class="tit">
                                <label><b>Nombre de Materia:</b></label><br>
                                <input type="text" id="nom_materiaM" name="nom_materiaM" size="50" readonly/>
                              </td>
                              <td class="tit">
                                <label><b>Horas Semanales:</b></label><br>
                                <input type="text" id="horaM" name="horaM" size="7" readonly/>
                              </td>
                            </tr>
                            
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="SeleccionBloqueM"></div></h3>
                              </td>
                            </tr>
                             <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; "><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>  
                          </table>  
                        
                        <div class="modal-footer">

                          <input class="btn btn-primary" type="submit" id="submitM" value="Marcar Bloque" title="Aceptar" disabled onclick="marcarBloqueM()">&nbsp;
                          <button class="btn btn-danger" id="btn_cerrar_modH" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                        
                        </div>
                                            
                      </form>                            
                                      
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- Modal modificar -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_horarioD" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Detalle de Horario</h4>
                      </div>
                      <div class="modal-body">

                        <form action="#" method="post">

                          <table width="100%">  
                            <tr>
                              <td colspan="2" class="tit">
                                <label><b>Sección:</b></label><br>
                                <input type="text" readonly size="90" id="seccionD" name="seccionD">
                              </td>
                            
                              <td class="tit">
                                <label><b>Periodo:</b></label><br>
                                <input type="text" readonly size="5" id="periodoD" name="periodoD">
                              </td>
                              
                            </tr>
                            <tr>
                              <td colspan="3">
                                <table border="2" width="100%">

                                  <tr>
                                    <th width="16%" class="tit">Hora</th>
                                    <th width="16%" class="tit">Lunes</th>
                                    <th width="16%" class="tit">Martes</th>
                                    <th width="16%" class="tit">Miercoles</th>
                                    <th width="16%" class="tit">Jueves</th>
                                    <th width="16%" class="tit">Viernes</th>
                                  </tr>
                                  <?php
                                    $query=pg_query("SELECT * FROM horas WHERE taller=1 AND estatus=1 ORDER BY numero_bloque ASC");
                                    $num=pg_num_rows($query);
                                    
                                    while($array2=pg_fetch_assoc($query))
                                    {
                                      $en=explode(' ', $array2['entrada']);
                                      $sa=explode(' ', $array2['salida']);

                                      $entrada[]=$en[0];
                                      $salida[]=$sa[0];
                                      $ids[]=$array2['id_horas'];
                                    }

                                    for ($i=1; $i <=$num ; $i++)
                                    { 
                                      $j=$i-1;

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
                                  <input type="hidden" name="id_<?php echo $i; ?>_D" id="id_<?php echo $i; ?>_D" value="<?php echo $ids[$j]; ?>">
                                  <tr>
                                    <td align="center"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
                                    <td align="center" height="95px"><button id="lunes_<?php echo $i; ?>_D" name="lunes_<?php echo $i; ?>_D" value="0" readonly class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="martes_<?php echo $i; ?>_D" name="martes_<?php echo $i; ?>_D" value="0" readonly class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="miercoles_<?php echo $i; ?>_D" name="miercoles_<?php echo $i; ?>_D" value="0" readonly class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="jueves_<?php echo $i; ?>_D" name="jueves_<?php echo $i; ?>_D" value="0" readonly class="boton_horasH"></button></td>
                                    <td align="center" height="95px"><button id="viernes_<?php echo $i; ?>_D" name="viernes_<?php echo $i; ?>_D" value="0" readonly class="boton_horasH"></button></td>
                                  </tr>
                                  <?php
                                    }
                                  ?>
                                    <input type="hidden" name="ciclo_D" id="ciclo_D" value="<?php echo $num; ?>">
                                </table>
                              </td>
                            </tr>
                          </table>

                          <div class="modal-footer">
                            <button class="btn btn-primary" data-dismiss="modal" title="Cerrar">Cerrar</button>
                          </div>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal modificar -->

                <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_horario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Horario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar este Horario?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="valorIdSeccion">
                            <input type="hidden" id="valorIdPeriodo">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Horario()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_horario" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha registrado el Horario con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_horario_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha Modificado el Horario con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_prof" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Profesor no esta Disponible!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_prof_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Profesor no esta Disponible!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_aula" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Aula no esta Disponible!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_aula_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Aula no esta Disponible!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminarH" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Horario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Horario a sido eliminado con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->
                                  <!-- detalle Modal -->
                 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reporte_horario_indv" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Reporte Horario</h4>
                      </div>
                      <div class="modal-body">

                       <h4>¿Usted esta seguro de que desea generar el reporte de este horario?</h4>                            

                       <input type="hidden" id="aceptar_reporte_horario">
                       <input type="hidden" id="aceptar_reporte_horario2">
                     </div>
                     <div class="modal-footer">
                      <button class="btn btn-primary" title="Aceptar" onclick="reportando_Horario()" data-dismiss="modal" >Aceptar</button>
                      <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                  </div>
                </div>
              </div>
              </div>
<!-- End detalle modal -->
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
    <script type="text/javascript" src="funciones.js"></script>
    <script type="text/javascript" src="js/vali.js"></script>

</body>
</html>
<?php
  $registro=$_REQUEST['registro'];

  if ($registro=='exito')
  {
?>
<script type="text/javascript">
    
    $('#reg_horario').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($registro=='exito_M')
  {
?>
<script type="text/javascript">
    
    $('#reg_horario_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  $error=$_REQUEST['error'];

  if ($error=='prof')
  {
?>
<script type="text/javascript">
    
    $('#error_prof').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='prof_M')
  {
?>
<script type="text/javascript">
    
    $('#error_prof_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='aula')
  {
?>
<script type="text/javascript">
    
    $('#error_aula').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='aula_M')
  {
?>
<script type="text/javascript">
    
    $('#error_aula_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  $elim=$_REQUEST['elim'];

  if ($elim=='nkh')
  {
?>
<script type="text/javascript">
    
    $('#eliminarH').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }
?>