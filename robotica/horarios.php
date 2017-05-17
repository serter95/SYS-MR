<?php
  require('seguridad.php');
  require('conexion.php');

    $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=2 LIMIT 1";
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

                <div id="consulta_materias">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#">Materias</a></h4>

                  <div id="radios" style="text-align:center; margin-top:1%;">

                    <b>Seleccione el modulo que desea ver:</b>&nbsp;&nbsp;&nbsp;

                    <b>Materias:</b><input checked type="radio" name="seleccion1" id="materia1" class="materia" onclick="mostrarHorario('materia')">&nbsp;
                    <b>Secciones:</b><input type="radio" name="seleccion1" id="secciones1" class="secciones" onclick="mostrarHorario('secciones')">&nbsp;
                    <b>Horas:</b><input type="radio" name="seleccion1" id="horas1" class="horas" onclick="mostrarHorario('horas')">&nbsp;
                    <b>Disponibilidad:</b><input type="radio" name="seleccion1" id="disponibilidad1" class="disponibilidad" onclick="mostrarHorario('disponibilidad')">
                    <b>Aulas:</b><input type="radio" name="seleccion1" id="aulas1" class="" onclick="mostrarHorario('aulas')">
                  </div>
                  <br>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Materias</span>
                    </div><br>

                    <table class="tabla_agregar_imprimir">
                      <tr>
                        <td>
                        </td>
                     
                        <td>
                          <?php 
                          if ($privilegio_A=="A")
                          {
                        ?>
                          <p id="agregar_per"><button class="btn btn-success" onclick="N_materia()">Nueva Materia &nbsp; <i class="fa fa-plus"></i></button></p>
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Trayecto</th>
                            <th>Horas Semanales</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                         $sql="SELECT * FROM materia WHERE taller=2 AND estatus=1";
                         
                         $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['codigo'];?></td>
                            <td align="center"><?php echo $array['nombre'];?></td>
                            <td align="center"><?php echo $array['trayecto'];?></td>
                            <td align="center"><?php echo $array['hora'];?></td>
                            <td align="center">
                              
                            <?php
                              if($privilegio_M=="M")
                              {
                            ?>
                              <a href="javascript:editar_materia(<?php echo $array['id_materia'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if($privilegio_E=="E")
                              {
                            ?>
                              <a href="javascript:eliminarMateria(<?php echo $array['id_materia'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
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

                <div id="registro_materias">

                <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="horarios.php">Materias</a> > <a href="#">Nueva Materia</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Materias</span>
                    </div><br>

                  <form method="post" action="registro_materias.php" id="reg_materias" onsubmit="return validarMATERIAS()">

                    <table width="100%">
                      <tr>
                        <td colspan="3" class="tit">
                          <label><b>Código:</b></label><br>
                          <input type="text" id="codigo" name="codigo" placeholder="Ejemplo:PIPT309-3" maxlength="9" title="Coloque el código de la materia 'Ejemplo:PIPT309-3'" onkeypress="return letra_num_car(event)" onclick="validarCODIGO()" onkeyup="validarCODIGO()" onchange="validarCODIGO()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts"><span id="Codigo"></span></div>
                        </td>
                      </tr>
                      <tr>
                        <input type="hidden" id="validar_codigo_ajax" name="validar_codigo_ajax"/>
    
                        <td width="33%" class="tit">
                          <label><b>Nombre:</b></label><br>
                          <input type="text" name="nombre" id="nombre" maxlength="100" placeholder="Ejemplo:Proyecto Socio-Tecnológico" title="Coloque el nombre de la materia 'Ejemplo:Proyecto Socio-Tecnológico'" onkeypress="return sololetras(event)" onclick="validarNOMBRE()" onkeyup="validarNOMBRE()" onchange="validarNOMBRE()"/>      
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:-49px;"><span id="Nombre"></span></div>
                        </td>
                      
                        <td width="33%" class="tit">
                          <label><b>Trayecto:</b></label><br>
                          <select name="trayecto" id="trayecto" title="Seleccione el trayecto en que se ve la materia" onchange="validarTRAYECTO()">
                            <option></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:14px;"><span id="Trayecto"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Horas Semanales:</b></label><br>
                          <input type="text" name="horas" id="hora" placeholder="Ejemplo:3" size="7" maxlength="1" title="Coloque las horas semanales de la materia 'Ejemplo:3'" onkeypress="return solonum(event)" onclick="validarHORAS()" onkeyup="validarHORAS()" onchange="validarHORAS()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:24px;"><span id="Horas"></span></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_MATERIAS"></div></h3>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_materia" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Materia</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modificar_materia.php" method="post" id="mod_materia" name="mod_materia" onsubmit="return validarMATERIAS_M()">

                          <table width="100%">
                            <tr>

                              <input type="hidden" name="id" id="id">

                              <td class="tit" colspan="3">
                                <label><b>Código:</b></label><br>
                                <input type="text" id="codigo_M" name="codigo_M" placeholder="Ejemplo:PIPT309-3" maxlength="9" title="Coloque el código de la materia 'Ejemplo:PIPT309-3'" onkeypress="return letra_num_car(event)" onclick="validarCODIGO_M()" onkeyup="validarCODIGO_M()" onchange="validarCODIGO_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts"><span id="CodigoM"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <input type="hidden" id="validar_codigo_ajax_M" name="validar_codigo_ajax_M"/>
          
                              <td width="33%" class="tit">
                                <label><b>Nombre:</b></label><br>
                                <input type="text" name="nombre_M" id="nombre_M" maxlength="100" placeholder="Ejemplo:Proyecto Socio-Tecnológico" title="Coloque el nombre de la materia 'Ejemplo:Proyecto Socio-Tecnológico'" onkeypress="return sololetras(event)" onclick="validarNOMBRE_M()" onkeyup="validarNOMBRE_M()" onchange="validarNOMBRE_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:-49px;"><span id="NombreM"></span></div>
                              </td>
                            
                              <td width="33%" class="tit">
                                <label><b>Trayecto:</b></label><br>
                                <select name="trayecto_M" id="trayecto_M" title="Seleccione el trayecto en que se ve la materia" onchange="validarTRAYECTO_M()">
                                  <option></option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:14px;"><span id="TrayectoM"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <label><b>Horas Semanales:</b></label><br>
                                <input type="text" name="horas_M" id="horas_M" placeholder="Ejemplo:3" maxlength="1" size="7" title="Coloque las horas semanales de la materia 'Ejemplo:3'" onkeypress="return solonum(event)" onclick="validarHORAS_M()" onkeyup="validarHORAS_M()" onchange="validarHORAS_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:24px;"><span id="HorasM"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_MATERIAS"></div></h3>
                              </td>
                            </tr>
                               <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     

                          </table>  
                                      
                          <div class="modal-footer">

                            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                          
                          </div>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal -->

                <div id="consulta_horas">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#">Horas</a></h4>

                  <div id="radios" style="text-align:center; margin-top:1%;">

                    <b>Seleccione el modulo que desea ver:</b>&nbsp;&nbsp;&nbsp;

                    <b>Materias:</b><input checked type="radio" name="seleccion2" id="materia2" class="materia" onclick="mostrarHorario('materia')">&nbsp;
                    <b>Secciones:</b><input type="radio" name="seleccion2" id="secciones2" class="secciones" onclick="mostrarHorario('secciones')">&nbsp;
                    <b>Horas:</b><input type="radio" name="seleccion2" id="horas2" class="horas" onclick="mostrarHorario('horas')">&nbsp;
                    <b>Disponibilidad:</b><input type="radio" name="seleccion2" id="disponibilidad2" class="disponibilidad" onclick="mostrarHorario('disponibilidad')">
                    <b>Aulas:</b><input type="radio" name="seleccion2" id="aulas2" class="" onclick="mostrarHorario('aulas')">
                  </div>
                  <br>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Bloques de Horas</span>
                    </div><br>

                    <table class="tabla_agregar_imprimir">
                      <tr>
                        <td>
                          <?php
                            $sql="SELECT * FROM horas WHERE taller=2 AND estatus=1";
                         
                            $query=pg_query($sql);
                            $num=pg_num_rows($query);
                          ?>
                        </td>
                     
                        <td>
                        <?php
                          if ($privilegio_A=='A')
                          {
                        ?>
                          <p id="agregar_per"><button class="btn btn-success" <?php if($num<12) { ?>onclick="N_hora()"<?php }else{ ?> title="Ya no puede Registrar mas Bloques, El limite es 12" <?php } ?> >Nuevo Bloque de Horas &nbsp; <i class="fa fa-plus"></i></button></p>
                        <?php
                          }
                        ?>
                        </td>
                      </tr>
                    </table>
                    
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                        <thead>
                          <tr>
                            <th>Numero del bloque</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                          while ($array=pg_fetch_assoc($query))
                          {
                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['numero_bloque'];?></td>
                            <td align="center"><?php echo $array['entrada'];?></td>
                            <td align="center"><?php echo $array['salida'];?></td>
                            <td align="center">
                            <?php
                              if ($privilegio_M=='M')
                              {
                            ?>
                              <a href="javascript:editar_horas(<?php echo $array['id_horas'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if ($privilegio_E=='E')
                              {
                            ?>
                              <a href="javascript:eliminarHoras(<?php echo $array['id_horas'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
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

                <div id="registro_horas">

                <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#" onclick="mostrarHorario('horas')">Horas</a> > <a href="#">Nuevo Bloque de Horas</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Bloques de Horas</span>
                    </div><br>

                  <form method="post" action="registro_horas.php" id="reg_horas" onsubmit="return validarBLOQUEDEHORAS()">

                    <table width="100%">
                      <tr>
                        <td width="33%" class="tit">
                          
                          <input type="hidden" id="validar_bloque_ajax" name="validar_bloque_ajax"/>

                          <label><b>Bloque Número:</b></label><br>
                          <select name="bloque" id="bloque" title="Seleccione el bloque de clases" onchange="validarBLOQUE()">
                            <option> </option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:32px;"><span id="Bloque"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Inicia:</b></label><br>
                          <input type="text" id="inicio" name="inicio" placeholder="Ejemplo:7:30" maxlength="5" title="Coloque la hora donde comienzo del bloque 'Ejemplo:7:30'" onkeypress="return solonum1(event)" onclick="validarINICIO()" onkeyup="validarINICIO()" onchange="validarINICIO()"/>
                          <select name="hora_entrada" id="hora_entrada" onchange="validarINICIO()">
                            <option>Am</option>
                            <option>Pm</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:-78px;"><span id="Inicio"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Finaliza:</b></label><br>
                          <input type="text" name="fin" id="fin" placeholder="Ejemplo:8:15" maxlength="5" title="Coloque la hora donde finaliza el bloque 'Ejemplo:8:15'" onkeypress="return solonum1(event)" onclick="validarFIN()" onkeyup="validarFIN()" onchange="validarFIN()"/>
                          <select name="hora_salida" id="hora_salida" onchange="validarFIN()">
                            <option>Am</option>
                            <option>Pm</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -80px; margin-top: -52px;"><span id="Fin"></span></div>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3" align="center">
                          <input type="hidden" id="validar_completo_ajax" name="validar_completo_ajax"/>
                          <h3><div id="salidaR_HORAS"></div></h3>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_horas" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Horas</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modificar_horas.php" method="post" id="mod_horas" name="mod_horas" onsubmit="return validarBLOQUEDEHORAS_M()">

                          <table width="100%">

                            <input type="hidden" id="id_horas" name="id_horas">
                            <tr>
                              <td width="33%" class="tit">
                                <input type="hidden" id="validar_bloque_ajax_M" name="validar_bloque_ajax_M">

                                <label><b>Bloque Número:</b></label><br>
                                <select name="bloque_M" id="bloque_M" title="Seleccione el bloque de clases" onchange="validarBLOQUE_M()">
                                  <option> </option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                  <option>8</option>
                                  <option>9</option>
                                  <option>10</option>
                                  <option>11</option>
                                  <option>12</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:30px;"><span id="Bloque_M"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <label><b>Inicia:</b></label><br>
                                <input type="text" id="inicio_M" name="inicio_M" placeholder="Ejemplo:7:30" maxlength="5" title="Coloque la hora donde comienzo del bloque 'Ejemplo:7:30'" onkeypress="return solonum1(event)" onclick="validarINICIO_M()" onkeyup="validarINICIO_M()" onchange="validarINICIO_M()"/>
                                <select name="hora_entrada_M" id="hora_entrada_M" onchange="validarINICIO_M()">
                                  <option>Am</option>
                                  <option>Pm</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -81px;"><span id="Inicio_M"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <label><b>Finaliza:</b></label><br>
                                <input type="text" name="fin_M" id="fin_M" placeholder="Ejemplo:8:15" maxlength="5" title="Coloque la hora donde finaliza el bloque 'Ejemplo:8:15'" onkeypress="return solonum1(event)" onclick="validarFIN_M()" onkeyup="validarFIN_M()" onchange="validarFIN_M()"/>
                                <select name="hora_salida_M" id="hora_salida_M" onchange="validarFIN_M()">
                                  <option>Am</option>
                                  <option>Pm</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -80px; margin-top: -52px;"><span id="Fin_M"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <input type="hidden" id="validar_completo_ajax_M" name="validar_completo_ajax_M"/>
                                <h3><div id="salidaM_HORAS"></div></h3>
                              </td>
                            </tr>
                               <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     

                                </table>  
                                            
                                <div class="modal-footer">

                                  <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                  <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                                
                                </div>
                                                    
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End modal -->
                              

                <div id="consulta_secciones">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#">Secciones</a></h4>

                  <div id="radios" style="text-align:center; margin-top:1%;">

                    <b>Seleccione el modulo que desea ver:</b>&nbsp;&nbsp;&nbsp;

                    <b>Materias:</b><input checked type="radio" name="seleccion3" id="materia3" class="materia" onclick="mostrarHorario('materia')">&nbsp;
                    <b>Secciones:</b><input type="radio" name="seleccion3" id="secciones3" class="secciones" onclick="mostrarHorario('secciones')">&nbsp;
                    <b>Horas:</b><input type="radio" name="seleccion3" id="horas3" class="horas" onclick="mostrarHorario('horas')">&nbsp;
                    <b>Disponibilidad:</b><input type="radio" name="seleccion3" id="disponibilidad3" class="disponibilidad" onclick="mostrarHorario('disponibilidad')">
                    <b>Aulas:</b><input type="radio" name="seleccion3" id="aulas3" class="" onclick="mostrarHorario('aulas')">
                  </div>

                  <br>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Secciones</span>
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
                          <p id="agregar_per"><button class="btn btn-success" onclick="N_seccion()">Nueva Sección &nbsp; <i class="fa fa-plus"></i></button></p>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                    </table>
                    
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example3">
                        <thead>
                          <tr>
                            <th>Trayecto</th>
                            <th>Sección</th>
                            <th>Año</th>
                            <th>Sede</th>
                            <th>PNF</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                         $sql="SELECT * FROM secciones WHERE taller=2 AND estatus=1";
                         
                         $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['trayecto'];?></td>
                            <td align="center"><?php echo $array['seccion'];?></td>
                            <td align="center"><?php echo $array['anio'];?></td>
                            <td align="center"><?php echo $array['sede'];?></td>
                            <td align="center"><?php echo $array['pnf'];?></td>
                            <td align="center">
                            <?php
                              if ($privilegio_M=='M')
                              {
                            ?>
                              <a href="javascript:editar_seccion(<?php echo $array['id_seccion'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if ($privilegio_E=='E')
                              {
                            ?>
                              <a href="javascript:eliminarSeccion(<?php echo $array['id_seccion'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
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

                <div id="registro_secciones">

                <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#" onclick="mostrarHorario('secciones')">Secciones</a> > <a href="#">Nueva Sección</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Secciones</span>
                    </div><br>

                  <form method="post" action="registro_secciones.php" id="reg_secciones" onsubmit="return validarSECCIONES()">

                    <table width="100%">
                      <tr>

                        <td width="33%" class="tit">
                          <label><b>PNF:</b></label><br>
                          <select name="pnf" id="pnf" title="Seleccione el PNF en que se creara la sección" onchange="validarPNF()">
                            <option> </option>
                            <option>Laboratorio</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:14px;"><span id="Pnf"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Sede:</b></label><br>
                          <select name="sede" id="sede" title="Seleccione la sede en que se creara la sección" onchange="validarSEDE()">
                            <option> </option>
                            <option>La Victoria</option>
                            <option>Maracay</option>
                            <option>Barabacoa</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:14px;"><span id="Sede"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Año:</b></label><br>
                          <input type="text" id="anio" name="anio" size="10" maxlength="4" placeholder="Ejemplo:2015" title="Coloque el año donde se creara la sección 'Ejemplo:2015'" onkeypress="return solonum(event)" onclick="validarANIO()" onkeyup="validarANIO()" onchange="validarANIO()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -26px;"><span id="Anio"></span></div>
                        </td>

                      </tr>
                      <tr>
                      
                        <td width="33%" class="tit">
                          <label><b>Trayecto:</b></label><br>
                          <select name="trayecto_s" id="trayecto_s" title="Seleccione el trayecto en que se creara la sección" onchange="validarTRAYECTO_S()">
                            <option> </option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:14px;"><span id="Trayecto_s"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>Sección:</b></label><br>
                          <input type="text" name="seccion" id="seccion" placeholder="Ejemplo:3" size="7" maxlength="1" title="Coloque la sección 'Ejemplo:3'" onkeypress="return solonum(event)" onclick="validarSECCION()" onkeyup="validarSECCION()" onchange="validarSECCION()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left:-3px;"><span id="Seccion"></span></div>
                        </td>
                      </tr>
                      
                      <tr>
                        <td colspan="3" align="center">
                          <input type="hidden" id="validar_seccion_ajax" name="validar_seccion_ajax"/>
                          
                          <h3><div id="salidaR_SECCIONES"></div></h3>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_seccion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Sección</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modificar_seccion.php" method="post" id="mod_seccion" name="mod_seccion" onsubmit="return validarSECCIONES_M()">

                          <table width="100%">

                              <input type="hidden" name="id_seccion" id="id_seccion"/>
                            <tr>
                              <td width="33%" class="tit">
                                <label><b>PNF:</b></label><br>
                                <select name="pnf_M" id="pnf_M" title="Seleccione el PNF en que se creara la sección" onchange="validarPNF_M()">
                                  <option> </option>
                                  <option>Laboratorio</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:14px;"><span id="Pnf_M"></span></div>
                              </td>

                              <td  width="33%" class="tit">
                                <label><b>Sede:</b></label><br>
                                <select name="sede_M" id="sede_M" title="Seleccione la sede en que se creara la sección" onchange="validarSEDE_M()">
                                  <option> </option>
                                  <option>La Victoria</option>
                                  <option>Maracay</option>
                                  <option>Barabacoa</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:14px;"><span id="Sede_M"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <label><b>Año:</b></label><br>
                                <input type="text" id="anio_M" name="anio_M" size="10" placeholder="Ejemplo:2015" title="Coloque el año donde se creara la sección 'Ejemplo:2015'" onkeypress="return solonum(event)" onclick="validarANIO_M()" onkeyup="validarANIO_M()" onchange="validarANIO_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -26px;"><span id="Anio_M"></span></div>
                              </td>
                            </tr>
                            <tr>
                              
                            
                              <td width="33%" class="tit">
                                <label><b>Trayecto:</b></label><br>
                                <select name="trayecto_s_M" id="trayecto_s_M" title="Seleccione el trayecto en que se creara la sección" onchange="validarTRAYECTO_S_M()">
                                  <option> </option>
                                  <option>1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:14px;"><span id="Trayecto_s_M"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <label><b>Sección:</b></label><br>
                                <input type="text" name="seccion_M" id="seccion_M" placeholder="Ejemplo:3" size="7" maxlength="1" title="Coloque la sección 'Ejemplo:3'" onkeypress="return solonum(event)" onclick="validarSECCION_M()" onkeyup="validarSECCION_M()" onchange="validarSECCION_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left:-3px;"><span id="Seccion_M"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <input type="hidden" id="validar_seccion_ajax_M" name="validar_seccion_ajax_M"/>
                                <h3><div id="salidaM_SECCIONES"></div></h3>
                              </td>
                            </tr>
                               <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     
                          </table>  
                                      
                          <div class="modal-footer">

                            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>  
                          
                          </div>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal -->

                <div id="consulta_disponibilidad">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#">Disponibilidad de Horas</a></h4>

                  <div id="radios" style="text-align:center; margin-top:1%;">

                    <b>Seleccione el modulo que desea ver:</b>&nbsp;&nbsp;&nbsp;

                    <b>Materias:</b><input checked type="radio" name="seleccion4" id="materia4" class="materia" onclick="mostrarHorario('materia')">&nbsp;
                    <b>Secciones:</b><input type="radio" name="seleccion4" id="secciones4" class="secciones" onclick="mostrarHorario('secciones')">&nbsp;
                    <b>Horas:</b><input type="radio" name="seleccion4" id="horas4" class="horas" onclick="mostrarHorario('horas')">&nbsp;
                    <b>Disponibilidad:</b><input type="radio" name="seleccion4" id="disponibilidad4" class="disponibilidad" onclick="mostrarHorario('disponibilidad')">
                    <b>Aulas:</b><input type="radio" name="seleccion4" id="aulas4" class="" onclick="mostrarHorario('aulas')">

                  </div>
                  <br>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Disponibilidad de Horas</span>
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
                          <p id="agregar_per"><button class="btn btn-success" onclick="N_disponibilidad()">Nueva Disponibilidad &nbsp; <i class="fa fa-plus"></i></button></p>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                    </table>
                    
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example4">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Periodo</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                         $sql="SELECT d.id_personal, d.taller, d.id_periodo, p.nombres, p.apellidos, p.cargo, x.tipo
                         FROM disponibilidad_persona d, personal p, periodo x WHERE d.id_personal=p.id
                         AND d.id_periodo=x.id_periodo AND d.taller=2 AND d.estatus=1 AND p.estatus=1 GROUP BY d.id_personal,
                         d.id_periodo, d.taller, p.nombres, p.apellidos, p.cargo, x.tipo";
                         
                         $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {

                            $n=explode(' ', $array['nombres']);
                            $a=explode(' ', $array['apellidos']);

                            $nombre=$n[0].' '.$a[0];
                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $nombre;?></td>
                            <td align="center"><?php echo $array['cargo'];?></td>
                            <td align="center"><?php echo $array['tipo'];?></td>
                            <td align="center">

                            <?php
                              if ($privilegio_M=='M')
                              {
                            ?>
                              <a href="javascript:editar_disponibilidad(<?php echo $array['id_personal'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if ($privilegio_E=='E')
                              {
                            ?>
                              <a href="javascript:eliminarDisponibilidad(<?php echo $array['id_personal'].','.$array['id_periodo'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                            <?php
                              }
                            ?>

                              <a href="javascript:detalleDisponibilidad(<?php echo $array['id_personal'].','.$array['id_periodo'];?>);">
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

                <div id="registro_disponibilidad">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#" onclick="mostrarHorario('disponibilidad')">Disponibilidad</a> > <a href="#">Nueva Disponibilidad</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Disponibilidad</span>
                    </div><br>

                  <form method="post" action="registro_disponibilidad.php" id="reg_disponibilidad" onsubmit="return validarDISPONIBILIDAD()">

                    <table width="100%">
                      <tr>
                        <td width="33%" class="tit">
                          <label><b>Periodo:</b></label><br>
                          <select name="periodo" id="periodo" title="Seleccione el periodo de la disponibilidad" onchange="color_botones('cambio') , validarPERIODO()">
                            <option> </option>
                            <?php
                              date_default_timezone_set('America/Caracas');

                              $fecha=getdate();
                              
                              $con=pg_query("SELECT * FROM periodo WHERE tipo LIKE '%".$fecha['year']."%' ORDER BY tipo ASC");
                              while($val=pg_fetch_assoc($con))
                              {
                            ?>
                            <option><?php echo $val['tipo']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -8px;"><span id="Periodo"></span></div>
                        </td>

                        <td width="33%" class="tit">
                          <label><b>C.I:</b></label><br>
                          <select name="nacionalidad" id="nacionalidad" title="Seleccione la nacionalidad de la persona" onchange="color_botones('cambio'), nom_ape_disp(), validarCI()" onblur="nom_ape_disp()">
                            <option> </option>
                            <option>V-</option>
                            <option>E-</option>
                          </select>
                          <input type="text" id="ci_disp" name="ci_disp" maxlength="12" onblur="nom_ape_disp()" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona que le creara la disponibilidad 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI(), nom_ape_disp()" onkeyup="color_botones('cambio'), validarCI(), nom_ape_disp()" onchange="color_botones('cambio'), validarCI(), nom_ape_disp()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -86px;"><span id="Ci_disp"></span></div>
                        </td>
                      
                        <td width="33%" class="tit">
                          <label><b>Nombre y Apellido:</b></label><br>
                          <input disabled type="text" name="nom_ape" size="30" id="nom_ape" title="Nombre y apellido de la persona"/>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="3">
                          <table cellpadding="50px" cellspacing="50px" border="2" width="100%">
                            <tr>
                              <th width="16%" class="tit">Hora</th>
                              <th width="16%" class="tit">Lunes</th>
                              <th width="16%" class="tit">Martes</th>
                              <th width="16%" class="tit">Miercoles</th>
                              <th width="16%" class="tit">Jueves</th>
                              <th width="16%" class="tit">Viernes</th>
                            </tr>
                            <?php
                              $query=pg_query("SELECT * FROM horas WHERE taller=2 AND estatus=1 ORDER BY numero_bloque ASC");
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
                              <td align="center"><button id="lunes_<?php echo $i; ?>" name="lunes_<?php echo $i; ?>" value="0" onclick="color_botones('lunes_<?php echo $i; ?>')" class="boton_horas"></button></td>
                              <td align="center"><button id="martes_<?php echo $i; ?>" name="martes_<?php echo $i; ?>" value="0" onclick="color_botones('martes_<?php echo $i; ?>')" class="boton_horas"></button></td>
                              <td align="center"><button id="miercoles_<?php echo $i; ?>" name="miercoles_<?php echo $i; ?>" value="0" onclick="color_botones('miercoles_<?php echo $i; ?>')" class="boton_horas"></button></td>
                              <td align="center"><button id="jueves_<?php echo $i; ?>" name="jueves_<?php echo $i; ?>" value="0" onclick="color_botones('jueves_<?php echo $i; ?>')" class="boton_horas"></button></td>
                              <td align="center"><button id="viernes_<?php echo $i; ?>" name="viernes_<?php echo $i; ?>" value="0" onclick="color_botones('viernes_<?php echo $i; ?>')" class="boton_horas"></button></td>
                            </tr>
                            <?php
                              }
                            ?>
                              <input type="hidden" name="ciclo" id="ciclo" value="<?php echo $num; ?>">
                          </table>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_DISPONIBILIDAD"></div></h3>
                        </td>
                      </tr>
                         <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     
                      <tr>
                        <td class="tit" colspan="3">
                          <button class="btn btn-primary" id="boton_submit" onclick="validar_bloques(<?php echo $num; ?>)" title="Aceptar">Aceptar</button>&nbsp;
                          <input class="btn btn-danger" type="reset" value="Limpiar" onclick="bloquearSubmit()" title="Limpiar">  
                        </td>
                      </tr>

                    </table>  
                  </form>             
                  </div>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_disp" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modifica_disponibilidad.php" method="post" id="mod_disponibilidad" name="mod_disponibilidad" onsubmit="return validarDISPONIBILIDAD_M()">

                          <table width="100%">
                            <tr>
                              <td width="33%" class="tit">
                                <label><b>Periodo:</b></label><br>
                                <select name="periodo_M" id="periodo_M" title="Seleccione el periodo de la disponibilidad" onchange="color_botones_M('cambio'), validarPERIODO_M()">
                                  <option> </option>
                                  <?php
                                    date_default_timezone_set('America/Caracas');

                                    $fecha=getdate();
                                    
                                    $con=pg_query("SELECT * FROM periodo WHERE tipo LIKE '%".$fecha['year']."%' ORDER BY tipo ASC");
                                    while($val=pg_fetch_assoc($con))
                                    {
                                  ?>
                                  <option><?php echo $val['tipo']; ?></option>
                                  <?php
                                    }
                                  ?>
                                </select>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -7px;"><span id="Periodo_M"></span></div>
                              </td>

                              <td width="33%" class="tit">
                                <input type="hidden" id="id_personal_M" name="id_personal_M"/>
                                <input type="hidden" id="id_periodo_M" name="id_periodo_M"/>
                                <label><b>C.I:</b></label><br>
                                <select name="nacionalidad_M" id="nacionalidad_M" onchange="color_botones_M('cambio'), validarCI_M()" title="Seleccione la nacionalidad de la persona">
                                  <option> </option>
                                  <option>V-</option>
                                  <option>E-</option>
                                </select>
                                <input type="text" id="ci_disp_M" name="ci_disp_M" onblur="nom_ape_disp_M()" maxlength="12" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona que le modificará la disponibilidad 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI_M(), nom_ape_disp_M()" onkeyup="color_botones_M('cambio'), validarCI_M(), nom_ape_disp_M()" onchange="color_botones_M('cambio'), validarCI_M(), nom_ape_disp_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -84px;"><span id="Ci_disp_M"></span></div>
                              </td>
                            
                              <td width="33%" class="tit">
                                <label><b>Nombre y Apellido:</b></label><br>
                                <input disabled type="text" name="nom_ape_M" size="30" id="nom_ape_M" title="Nombre y apellido de la persona"/>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="3">
                                <table cellpadding="50px" cellspacing="50px" border="2" width="100%">
                                  <tr>
                                    <th width="16%" class="tit">Hora</th>
                                    <th width="16%" class="tit">Lunes</th>
                                    <th width="16%" class="tit">Martes</th>
                                    <th width="16%" class="tit">Miercoles</th>
                                    <th width="16%" class="tit">Jueves</th>
                                    <th width="16%" class="tit">Viernes</th>
                                  </tr>
                                  <?php
                                    $query=pg_query("SELECT * FROM horas WHERE taller=2 AND estatus=1 ORDER BY numero_bloque ASC");
                                    $num=pg_num_rows($query);
                                    
                                    while($array2=pg_fetch_assoc($query))
                                    {
                                      $en=explode(' ', $array2['entrada']);
                                      $sa=explode(' ', $array2['salida']);

                                      $entrada[]=$en[0];
                                      $salida[]=$sa[0];
                                      #$ids[]=$array2['id_horas'];
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
                                  <input type="hidden" id="id_disponibilidad_<?php echo $i; ?>_M" name="id_disponibilidad_<?php echo $i; ?>_M" />
                                  <input type="hidden" name="id_<?php echo $i; ?>_M" id="id_<?php echo $i; ?>_M" value="<?php echo $ids[$j]; ?>">
                                  <tr>
                                    <td align="center"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
                                    <td align="center"><button id="lunes_<?php echo $i; ?>_M" name="lunes_<?php echo $i; ?>_M" onclick="color_botones_M('lunes_<?php echo $i; ?>_M')" class="boton_horas"></button></td>
                                    <td align="center"><button id="martes_<?php echo $i; ?>_M" name="martes_<?php echo $i; ?>_M" onclick="color_botones_M('martes_<?php echo $i; ?>_M')" class="boton_horas"></button></td>
                                    <td align="center"><button id="miercoles_<?php echo $i; ?>_M" name="miercoles_<?php echo $i; ?>_M" onclick="color_botones_M('miercoles_<?php echo $i; ?>_M')" class="boton_horas"></button></td>
                                    <td align="center"><button id="jueves_<?php echo $i; ?>_M" name="jueves_<?php echo $i; ?>_M" onclick="color_botones_M('jueves_<?php echo $i; ?>_M')" class="boton_horas"></button></td>
                                    <td align="center"><button id="viernes_<?php echo $i; ?>_M" name="viernes_<?php echo $i; ?>_M" onclick="color_botones_M('viernes_<?php echo $i; ?>_M')" class="boton_horas"></button></td>
                                  </tr>
                                  <?php
                                    }
                                  ?>
                                    <input type="hidden" name="ciclo_M" id="ciclo_M" value="<?php echo $num; ?>">
                                </table>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_DISPONIBILIDAD"></div></h3>
                              </td>
                            </tr>
                               <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     
                            <tr>
                              <td class="tit" colspan="3">
                                <button class="btn btn-primary" id="boton_submit_M" onclick="validar_bloques_M(<?php echo $num; ?>)" title="Aceptar">Aceptar</button>&nbsp;
                                <button class="btn btn-danger" title="Cancelar" data-dismiss="modal">Cancelar</button>  
                              </td>
                            </tr>

                          </table>
                                              
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal -->

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_disponibilidad" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Detalle de Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <div id="detalle"></div>
                        
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End modal -->

                <div id="consulta_aulas">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#">Aulas</a></h4>

                  <div id="radios" style="text-align:center; margin-top:1%;">

                    <b>Seleccione el modulo que desea ver:</b>&nbsp;&nbsp;&nbsp;

                    <b>Materias:</b><input checked type="radio" name="seleccion5" id="materia5" class="materia" onclick="mostrarHorario('materia')">&nbsp;
                    <b>Secciones:</b><input type="radio" name="seleccion5" id="secciones5" class="secciones" onclick="mostrarHorario('secciones')">&nbsp;
                    <b>Horas:</b><input type="radio" name="seleccion5" id="horas5" class="horas" onclick="mostrarHorario('horas')">&nbsp;
                    <b>Disponibilidad:</b><input type="radio" name="seleccion5" id="disponibilidad5" class="disponibilidad" onclick="mostrarHorario('disponibilidad')">
                    <b>Aulas:</b><input type="radio" name="seleccion5" id="aulas5" class="" onclick="mostrarHorario('aulas')">

                  </div>
                  <br>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Consulta de Aulas</span>
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
                          <p id="agregar_per"><button class="btn btn-success" onclick="N_aula()">Nueva Aula &nbsp; <i class="fa fa-plus"></i></button></p>
                          <?php
                            }
                          ?>
                        </td>
                      </tr>
                    </table>
                    
                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="nueva_tabla">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th width="100%">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php

                         $sql="SELECT * FROM aulas WHERE estatus=1 AND taller=2";
                         
                         $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {

                        ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['nombre'];?></td>
                            <td align="center">
                            <?php
                              if ($privilegio_M=='M')
                              {
                            ?>
                              <a href="javascript:editar_aula(<?php echo $array['id_aulas'];?>);">
                                <button class="btn btn-default" title="Modificar">
                                  <span class="fa fa-edit"></span>
                                </button>
                              </a>
                            <?php
                              }

                              if ($privilegio_E=='E')
                              {
                            ?>
                              <a href="javascript:eliminarAula(<?php echo $array['id_aulas'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
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

                <div id="registro_aulas">

                  <h4><a href="#">Académico</a> > <a href="#">Planificación</a> > <a href="#" onclick="mostrarHorario('aulas')">Aulas</a> > <a href="#">Nueva Aula</a></h4>

                  <div class="info3">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Aulas</span>
                    </div><br>

                  <form method="post" action="registro_aula.php" id="reg_aula" onsubmit="return validarR_AULA()">

                    <table width="100%">
                      <tr>
                        <td width="33%" class="tit">
                          <input type="hidden" id="aula_ajax" name="aula_ajax">

                          <label><b>Nombre del Aula:</b></label><br>
                          <input type="text" name="nombre" id="nombre_a" maxlength="50" size="50" placeholder="Ejemplo:B2" title="Cloque el nombre del aula 'Ejemplo:B2'" onkeypress="return letra_num_aula(event)" onclick="validarAULA()" onblur="validarAULA()" onkeyup="validarAULA()" onchange="validarAULA()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -8px;"><span id="NombreAula"></span></div>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_AULAS"></div></h3>
                        </td>
                      </tr>
                         <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>     
                      <tr>
                        <td class="tit" colspan="3">
                          <input type="submit" class="btn btn-primary" id="boton_submit" value="Aceptar" title="Aceptar">&nbsp;
                          <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">  
                        </td>
                      </tr>

                    </table>  
                  </form>             
                  </div>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_aula" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Aulas</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modifica_aula.php" method="post" id="mod_aula" name="mod_aula" onsubmit="return validarM_AULA()">

                          <table width="100%">
                            <tr>
                              <td width="33%" class="tit">

                                <input type="hidden" id="id_aula" name="id_aula">
                                <input type="hidden" id="aula_ajaxM" name="aula_ajaxM">

                                <label><b>Nombre del Aula:</b></label><br>
                                <input type="text" name="nombreM" id="nombre_aM" maxlength="50" size="50" placeholder="Ejemplo:B2" title="Cloque el nombre del aula 'Ejemplo:B2'" onkeypress="return letra_num_aula(event)" onclick="validarAULA_M()" onblur="validarAULA_M()" onkeyup="validarAULA_M()" onchange="validarAULA_M()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts" style="margin-left: -8px;"><span id="NombreAulaM"></span></div>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_AULAS"></div></h3>
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
                  </div>
                </div>
                <!-- End modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="alertaDeHorasLlenas" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Este Profesor ya posee todas las horas semanales asignadas por su Dedicación!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="alertaDeHorasLlenasM" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Este Profesor ya posee todas las horas semanales asignadas por su Dedicación!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="r_n" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Aula</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Aula Ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->
                
                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_personal" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Materia</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha registrado la Materia con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_seccion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Sección</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha registrado la Sección con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->         

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="regi_horas" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha registrado el Bloque de Horas con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->  

                <!-- registro modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="regi_disp" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se ha registrado el Horario de Disponibilidad con exito!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End registro modal -->       

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_ci" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Materia</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El codigo de la Materia ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_seccion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Sección</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡La Sección ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Bloque de horas ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Bloque de horas ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_registro_anterior" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Bloque anterior al seleccionado no existe. Por favor registrelo!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_registro_anterior_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El Bloque anterior al seleccionado no existe. Por favor registrelo!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas_menor" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas_menor_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡La Hora de inicio del Bloque que esta registrando debe ser mayor a la Hora final del Bloque anterior!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas_distinta" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_horas_distinta_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Horas</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Si la Hora final del Bloque anterior es Pm No puede registrar el Bloque en Am!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_disp" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Esta Persona ya posee un Horario de Disponibilidad en el periodo colocado!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_disp_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Disponibilidad</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Esta Persona ya posee un Horario de Disponibilidad en el periodo colocado!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_seccion_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Sección</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡La Sección ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->

                <!-- error ci modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_ci_M" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificación de Materia</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡El codigo de la Materia ya existe!</h4>                            
                                      
                      </div>
                      <div class="modal-footer">
                                                
                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                              
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End error ci modal -->     

                <!-- modificacion exito modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_exito" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificación de Materia</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado la Materia con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion exito modal -->

                    <!-- modificacion exito modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_seccion" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificación de Sección</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado la Sección con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion exito modal -->

                    <!-- modificacion exito modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_horas" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificación de Horas</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado el Bloque de Horas con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion exito modal -->

                    <!-- modificacion exito modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_disponibilidad" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Disponibilidad</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado la Disponibilidad de Horas con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion exito modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_mate" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Eliminar Materia</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La Materia a sido eliminada con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_sec" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Eliminar Sección</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La Sección a sido eliminada con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_hor" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Eliminar Horas</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡El Bloque de Horas a sido eliminado con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_dis" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Eliminar Disponibilidad</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La Disponibilidad de Horas a sido eliminado con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="r_a" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Registro de Aula</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Aula Registrada con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_materia" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Materia</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar a esta Materia?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_materia">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Materia()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_disp" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Disponibilidad</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar a esta Disponibilidad de horas?</h4>
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_disponibilidad_personal">
                            <input type="hidden" id="aceptar_elim_disponibilidad_periodo">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Disponibilidad()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_seccion" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Sección</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar a esta Sección?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_seccion">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Seccion()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_horas" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Horas</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar este Bloque de Horas?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_horas">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Horas()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_aula" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Aula</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar esta Aula?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_aula">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Aula()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="e_e" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Aula</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Aula Eliminada con Exito!</h4>                            
                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                                                                                        
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="m_a_e" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Aulas</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Aula Modificada con Exito!</h4>                            
                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                                                                                        
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="m_a_n" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Aulas</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡El Aula ya existe!</h4>                            
                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                                                                                        
                            </form>
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
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
  	<script src="assets/js/zabuto_calendar.js"></script>	
  	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>

    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/lang/es.js"></script>

    <script type="text/javascript" src="funciones.js"></script>
    <script type="text/javascript" src="js/vali_planificacion.js"></script>

</body>
</html>
<?php

$registro=$_REQUEST['registro'];

  if ($registro=='materia')
  {
?>
<script type="text/javascript">
    
    $('#reg_personal').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

  if ($registro=='seccion')
  {
?>
<script type="text/javascript">

    mostrarHorario('secciones')
    
    $('#reg_seccion').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

  if ($registro=='horas')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')
    
    $('#regi_horas').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

  if ($registro=='disponibilidad')
  {
?>
<script type="text/javascript">

    mostrarHorario('disponibilidad')
    
    $('#regi_disp').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

$modificar=$_REQUEST['modificar'];

  if ($modificar=='materia')
  {
?>
<script type="text/javascript">
    
    $('#modificar_exito').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($modificar=='seccion')
  {
?>
<script type="text/javascript">

  mostrarHorario('secciones')
    
    $('#modificar_seccion').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($modificar=='horas')
  {
?>
<script type="text/javascript">
    
    mostrarHorario('horas')

    $('#modificar_horas').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($modificar=='disponibilidad')
  {
?>
<script type="text/javascript">
    
    mostrarHorario('disponibilidad')

    $('#modificar_disponibilidad').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

$error=$_REQUEST['error'];

  if ($error=='codigo')
  {
?>
<script type="text/javascript">
    
    N_materia()

    $('#error_ci').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php
  }

  if ($error=='codigo_M')
  {
?>
<script type="text/javascript">

    $('#error_ci_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='seccion')
  {
?>
<script type="text/javascript">

    mostrarHorario('secciones')

    N_seccion()

    $('#error_seccion').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='seccion_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('secciones')

    $('#error_seccion_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    N_hora()

    $('#error_horas').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    $('#error_horas_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='registro_anterior')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    N_hora()

    $('#error_registro_anterior').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='registro_anterior_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    $('#error_registro_anterior_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas_menor')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    N_hora()

    $('#error_horas_menor').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas_menor_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    $('#error_horas_menor_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas_distinta')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    N_hora()

    $('#error_horas_distinta').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='horas_distinta_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')

    $('#error_horas_distinta_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='disp')
  {
?>
<script type="text/javascript">

    mostrarHorario('disponibilidad')

    N_disponibilidad()

    $('#error_disp').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($error=='disp_M')
  {
?>
<script type="text/javascript">

    mostrarHorario('disponibilidad')

    $('#error_disp_M').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  $elim=$_REQUEST['elim_mat'];

  if ($elim=='si')
  {
?>
<script type="text/javascript">
    
    $('#elim_mate').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($elim=='seccion')
  {
?>
<script type="text/javascript">

    mostrarHorario('secciones')
    
    $('#elim_sec').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($elim=='horas')
  {
?>
<script type="text/javascript">

    mostrarHorario('horas')
    
    $('#elim_hor').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($elim=='disponibilidad')
  {
?>
<script type="text/javascript">

    mostrarHorario('disponibilidad')
    
    $('#elim_dis').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  $ra=$_REQUEST['r'];

  if ($ra=='e')
  {
?>
<script type="text/javascript">

    mostrarHorario('aulas')
    
    $('#r_a').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($ra=='n')
  {
?>
<script type="text/javascript">

    mostrarHorario('aulas')
    
    $('#r_n').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($ra=='el')
  {
?>
<script type="text/javascript">

    mostrarHorario('aulas')
    
    $('#e_e').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  $ma=$_REQUEST['m'];

  if ($ma=='e')
  {
?>
<script type="text/javascript">

    mostrarHorario('aulas')
    
    $('#m_a_e').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }

  if ($ma=='n')
  {
?>
<script type="text/javascript">

    mostrarHorario('aulas')
    
    $('#m_a_n').modal({
      show:true,
      backdrop:'static'
    });

</script>
<?php
  }
?>