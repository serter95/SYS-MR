<?php
  require('seguridad.php');
  require('conexion.php');

    $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=2 LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_proyectos']);
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

              <div id="consulta_tecnologico">

                <h4><a href="#">Académico</a> > <a href="proyectos.php">Proyectos</a> > <a href="#">Socio-Comunitarios</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Consulta de Socio-Comunitarios</span>
                  </div><br>

                  <table class="tabla_agregar_imprimir">
                    <tr>
                      <td>
                        
              <!--          <p id=""><button class="btn btn-default">Generar Reporte &nbsp; <span class="fa fa-file-text-o"></span></button></p> -->
                        
                      </td>
                   
                      <td>
                        <?php 
                          if ($privilegio_A=="A")
                          {
                        ?>
                        <p id="agregar_per"><button class="btn btn-success" onclick="N_tecnologico()">Nuevo Proyecto Socio-Comunitario &nbsp; <i class="fa fa-plus"></i></button></p>
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
                          <th>Periodo</th>
                          <th width="45%">Título</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                       $sql="SELECT * FROM proyectos WHERE ambito='comunitario' AND taller=2 AND estatus=1";
                       
                       $query=pg_query($sql);

                        while ($array=pg_fetch_assoc($query))
                        {
                      ?>
                        <tr class="odd gradeX">
                          <td align="center"><?php echo $array['codigo'];?></td>
                          <td align="center"><?php echo $array['periodo'];?></td>
                          <td align="center"><?php echo $array['titulo'];?></td>
                          <td align="center"><?php echo $array['estado_proyecto'];?></td>
                          <td align="center">
                          <?php
                            if($privilegio_M=="M")
                            {
                          

                           if ($array['estado_proyecto']=='En proceso')
                           {
                          ?>  
                            <a href="javascript:editar_tecnologico(<?php echo $array['id_proyecto'];?>);">
                              <button class="btn btn-default" title="Modificar">
                                <span class="fa fa-edit"></span>
                              </button>
                            </a>
                          <?php
                            }

                          }

                            if ($privilegio_E=="E")
                            {
                            
                          ?>
                            <a href="javascript:eliminarTecnologico(<?php echo $array['id_proyecto'];?>);">
                              <button class="btn btn-default" title="Eliminar">
                                <span class="fa fa-trash-o"></span>
                              </button>
                            </a>
                          <?php
                            }

                            if ($privilegio_M=='M')
                            {
                              if ($array['estado_proyecto']=='En proceso')
                              {
                          ?>         
                            <a href="javascript:estadoTecnologico(<?php echo $array['id_proyecto'];?>);">
                              <button class="btn btn-default" title="Estado">
                                <span class="fa fa-check-square-o "></span>
                              </button>
                            </a>
                          <?php
                              }
                            }
                          ?>

                            <a href="javascript:detalleTecnologico(<?php echo $array['id_proyecto'];?>);">
                              <button class="btn btn-default" title="Detalle">
                                <span class="fa fa-search-plus"></span>
                              </button>
                            </a>
                        <?php
                          if ($privilegio_I=='I')
                          {
                        ?>
                            <a href="javascript:reporteTecnologico(<?php echo $array['id_proyecto'];?>);">
                              <button class="btn btn-default" title="Detalle">
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

              <div id="registro_tecnologico">

                <h4><a href="#">Académico</a> > <a href="proyectos.php">Proyectos</a> > <a href="comunitario.php">Socio-Comunitarios</a> > <a href="#">Nuevo Proyecto Socio-Comunitario</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Registro de Proyectos Socio-Comunitario</span>
                  </div><br>

                  <form method="post" action="registro_comunitario.php" id="reg_tecnologico" onsubmit=" return validarPROYECTO()">

                    <div class="panel panel-default">
                      <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="active"><a href="#paso1" data-toggle="tab"><h4>Paso 1</h4></a></li>
                          <li><a href="#paso2" data-toggle="tab"><h4>Paso 2</h4></a></li>
                          <li><a href="#paso3" data-toggle="tab"><h4>Paso 3</h4></a></li>
                          <li><a href="#paso4" data-toggle="tab"><h4>Paso 4</h4></a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="paso1">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="table-responsive">

                                  <table width="100%">
                                    <tr>
                                      <td colspan="2" class="tit">
                                        <label><b>Título:</b></label><br>
                                        <textarea id="titulo" name="titulo" placeholder="Ejemplo:Desarrollar un..." title="Coloque el título del proyecto 'Ejemplo: Desarrollar un...'" onkeypress="return letra_num_car(event)" onclick="validarTITULO()" onkeyup="validarTITULO()" onchange="validarTITULO()"></textarea>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts"><span id="Titulo"></span></div>
                                      </td>
                                      <td class="tit">

                                        <input type="hidden" id="validar_codigo_ajax" name="validar_codigo_ajax"/>

                                        <label><b>Código:</b></label><br>
                                        <input type="text" name="codigo" id="codigo" maxlength="24" placeholder="Ejemplo:SCEPNFIV-0-00-0000" title="Coloque el código del proyecto 'Ejemplo:SCEPNFIV-0-00-0000'" onkeypress="return soloCodigo(event)" onclick="validarCODIGO()" onkeyup="validarCODIGO()" onchange="validarCODIGO()"/>      
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-52px;"><span id="Codigo"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit">
                                        <label><b>Régimen:</b></label><br>
                                        <select id="regimen" name="regimen" onchange="validarREGIMEN()" title="Seleccione el régimen de estudio">
                                          <option> </option>
                                          <option>Diurno</option>
                                          <option>Nocturno</option>
                                        </select>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-9px;"><span id="Regimen"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>Estado:</b></label><br>
                                        <select name="estado" id="estado" title="Seleccione el estado donde se realiza el proyecto" onchange="validarESTADO()">
                                          <option></option>
                                        <?php $query=pg_query("SELECT * FROM estados");
                                              while($array=pg_fetch_assoc($query))
                                              {
                                        ?>
                                          <option><?php echo $array['nombre']; ?></option>
                                        <?php
                                              }
                                        ?>
                                        </select>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-29px;"><span id="Estado"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>Municipio:</b></label><br>
                                          <select name="municipio" id="municipio" title="Coloque el municipio donde se realiza el proyecto" onclick="validarMUNICIPIO()" onchange="validarMUNICIPIO()">
                                            <option></option>
                                          </select>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-8px;"><span id="Municipio"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit">
                                        <label><b>Parroquia:</b></label><br>
                                        <input type="text" name="parroquia" id="parroquia" placeholder="Ejemplo:Villa de Cura" title="Coloque la parroquia donde se realiza el proyecto 'Ejemplo:Villa de Cura'" onkeypress="return soloLetras(event)" onclick="validarPARROQUIA()" onkeyup="validarPARROQUIA()" onchange="validarPARROQUIA()">
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-44px;"><span id="Parroquia"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>Sector:</b></label><br>
                                        <input type="text" name="sector" id="sector" placeholder="Ejemplo:Las Tablitas" title="Coloque el sector donde se realiza el proyecto 'Ejemplo:Las Tablitas'" onkeypress="return soloLetras(event)" onclick="validarSECTOR()" onkeyup="validarSECTOR()" onchange="validarSECTOR()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-55px;"><span id="Sector"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>PNF:</b></label><br>
                                        <select name="pnf" id="pnf" title="Seleccione el PNF donde se realiza el proyecto" onchange="validarPNF()">
                                          <option></option>
                                          <option>Administración</option>
                                          <option>Contaduria</option>
                                          <option>Electricidad</option>
                                          <option>Electrónica</option>
                                          <option>Informática</option>
                                          <option>Mantenimiento</option>
                                          <option>Mecánica</option>
                                          <option>Telecomunicaciones</option>
                                          <option>Calidad de Ambiente</option>
                                        </select>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-38px;"><span id="Pnf"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit">
                                        <label><b>Trayecto:</b></label><br>
                                        <select name="trayecto" id="trayecto" title="Seleccione el trayecto donde se realiza el proyecto" onchange="validarTRAYECTO()">
                                          <option></option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                        </select>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:13px;"><span id="Trayecto"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>Sección:</b></label><br>
                                        <input type="text" name="seccion" id="seccion" placeholder="Ejemplo:2" maxlength="1" title="Coloque la sección donde se realiza el proyecto 'Ejemplo:2'" onkeypress="return solonum(event)" onclick="validarSECCION()" onkeyup="validarSECCION()" onchange="validarSECCION()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="Seccion"></span></div>
                                      </td>
                                      <td class="tit">
                                        <label><b>Periodo:</b></label><br>
                                        <input type="text" name="periodo" id="periodo" placeholder="Ejemplo:2015-III" maxlength="8" title="Coloque la sección donde se realiza el proyecto 'Ejemplo:2015-III'" onkeypress="return soloPeriodo(event)" onclick="validarPERIODO()" onkeyup="validarPERIODO()" onchange="validarPERIODO()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="Periodo"></span></div>
                                      </td>
                                    </tr>
                                        <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                  </table>             
                                </div>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                          </div>
                          <!-- /.panel -->
    
                          <div class="tab-pane fade" id="paso2">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="table-responsive">

                                  <table width="100%">
                                    <tr>
                                      <td class="tit2" colspan="3"><label><h3>Integrante 1</h3></label></td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <label><b>C.I:</b></label><br>
                                        <select id="nacEst" name="nacEst" title="Seleccione la nacionalidad del primer integrante" onchange="validarCI1()">
                                          <option> </option>
                                          <option>V-</option>
                                          <option>E-</option>
                                        </select>
                                        <input type="text" name="ciEst" id="ciEst" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del primer intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI1()" onkeyup="validarCI1()" onchange="validarCI1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-86px;"><span id="Ci1"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Nombres:</b></label><br>
                                        <input type="text" name="nomEst" id="nomEst" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del primer intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM1()" onkeyup="validarNOM1()" onchange="validarNOM1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-46px;"><span id="Nom1"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Apellidos:</b></label><br>
                                        <input type="text" name="apeEst" id="apeEst" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del primer intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE1()" onkeyup="validarAPE1()" onchange="validarAPE1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-46px;"><span id="Ape1"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Telefono de Contacto:</b></label><br>
                                        <select name="codTlf" id="codTlf" title="Seleccione el código del teléfono" onchange="validarTLF1()">
                                          <option> </option>
                                          <option>0416-</option>
                                          <option>0426-</option>
                                          <option>0414-</option>
                                          <option>0424-</option>
                                          <option>0412-</option>
                                        </select>
                                        <input type="text" name="tlfEst" id="tlfEst" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del primer intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF1()" onkeyup="validarTLF1()" onchange="validarTLF1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-41px;"><span id="Tlf1"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Email:</b></label><br>
                                        <input type="text" name="correoEst" id="correoEst" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del primer intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO1()" onkeyup="validarCORREO1()" onchange="validarCORREO1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-58px;"><span id="Correo1"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Especialidad:</b></label><br>
                                        <input type="text" name="especialidad" id="especialidad" placeholder="Ejemplo:Informática" title="Coloque la especialidad del primer intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD1()" onkeyup="validarESPECIALIDAD1()" onchange="validarESPECIALIDAD1()"/>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-35px;"><span id="Especialidad1"></span></div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>
                                        <input type="checkbox" id="integrante2" onclick="habilitar(2)"/><b style="font-size:15px;">Habilitar</b>
                                      </td>

                                      <td class="tit2" style="text-align:left;" colspan="2">
                                        <label><h3>Integrante 2</h3></label>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <label><b>C.I:</b></label><br>
                                        <select disabled id="nacEst2" name="nacEst2" title="Seleccione la nacionalidad del segundo integrante" onchange="validarCI2()">
                                          <option> </option>
                                          <option>V-</option>
                                          <option>E-</option>
                                        </select>
                                        <input disabled type="text" name="ciEst2" id="ciEst2" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del segundo intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI2()" onkeyup="validarCI2()" onchange="validarCI2()"/>
                                        <div class="promts" style="margin-left:-86px;"><span id="Ci2"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Nombres:</b></label><br>
                                        <input disabled type="text" name="nomEst2" id="nomEst2" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del segundo intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM2()" onkeyup="validarNOM2()" onchange="validarNOM2()"/>
                                        <div class="promts" style="margin-left:-46px;"><span id="Nom2"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Apellidos:</b></label><br>
                                        <input disabled type="text" name="apeEst2" id="apeEst2" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del segundo intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE2()" onkeyup="validarAPE2()" onchange="validarAPE2()"/>
                                        <div class="promts" style="margin-left:-46px;"><span id="Ape2"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Telefono de Contacto:</b></label><br>
                                        <select disabled name="codTlf2" id="codTlf2" title="Seleccione el código del teléfono" onchange="validarTLF2()">
                                          <option> </option>
                                          <option>0416-</option>
                                          <option>0426-</option>
                                          <option>0414-</option>
                                          <option>0424-</option>
                                          <option>0412-</option>
                                        </select>
                                        <input disabled type="text" name="tlfEst2" id="tlfEst2" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del segundo intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF2()" onkeyup="validarTLF2()" onchange="validarTLF2()"/>
                                        <div class="promts" style="margin-left:-41px;"><span id="Tlf2"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Email:</b></label><br>
                                        <input disabled type="text" name="correoEst2" id="correoEst2" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del segundo intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO2()" onkeyup="validarCORREO2()" onchange="validarCORREO2()"/>
                                        <div class="promts" style="margin-left:-58px;"><span id="Correo2"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Especialidad:</b></label><br>
                                        <input disabled type="text" name="especialidad2" id="especialidad2" placeholder="Ejemplo:Informática" title="Coloque la especialidad del segundo intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD2()" onkeyup="validarESPECIALIDAD2()" onchange="validarESPECIALIDAD2()"/>
                                        <div class="promts" style="margin-left:-35px;"><span id="Especialidad2"></span></div>
                                      </td>
                                    </tr>
                                        <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                  </table>

                                </div>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                          </div>
                          <!-- /.panel -->

                          <div class="tab-pane fade" id="paso3">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="table-responsive">

                                  <table width="100%">      
                                    <tr>
                                      <td>
                                        <input type="checkbox" id="integrante3" onclick="habilitar(3)"/><b style="font-size:15px;">Habilitar</b>
                                      </td>
                                      <td class="tit2" style="text-align:left;" colspan="2">
                                        <label><h3>Integrante 3</h3></label>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <label><b>C.I:</b></label><br>
                                        <select disabled id="nacEst3" name="nacEst3" title="Seleccione la nacionalidad del tercer integrante" onchange="validarCI3()">
                                          <option> </option>
                                          <option>V-</option>
                                          <option>E-</option>
                                        </select>
                                        <input disabled type="text" name="ciEst3" id="ciEst3" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del tercer intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI3()" onkeyup="validarCI3()" onchange="validarCI3()"/>
                                        <div class="promts" style="margin-left:-86px;"><span id="Ci3"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Nombres:</b></label><br>
                                        <input disabled type="text" name="nomEst3" id="nomEst3" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del tercer intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM3()" onkeyup="validarNOM3()" onchange="validarNOM3()"/>
                                        <div class="promts" style="margin-left:-46px;"><span id="Nom3"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <label><b>Apellidos:</b></label><br>
                                        <input disabled type="text" name="apeEst3" id="apeEst3" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del tercer intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE3()" onkeyup="validarAPE3()" onchange="validarAPE3()"/>
                                        <div class="promts" style="margin-left:-46px;"><span id="Ape3"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Telefono de Contacto:</b></label><br>
                                        <select disabled name="codTlf3" id="codTlf3" title="Seleccione el código del teléfono" onchange="validarTLF3()">
                                          <option> </option>
                                          <option>0416-</option>
                                          <option>0426-</option>
                                          <option>0414-</option>
                                          <option>0424-</option>
                                          <option>0412-</option>
                                        </select>
                                        <input disabled type="text" name="tlfEst3" id="tlfEst3" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del tercer intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF3()" onkeyup="validarTLF3()" onchange="validarTLF3()"/>
                                        <div class="promts" style="margin-left:-41px;"><span id="Tlf3"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Email:</b></label><br>
                                        <input disabled type="text" name="correoEst3" id="correoEst3" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del tercer intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO3()" onkeyup="validarCORREO3()" onchange="validarCORREO3()"/>
                                        <div class="promts" style="margin-left:-58px;"><span id="Correo3"></span></div>
                                      </td>
                                      <td class="tit2">
                                        <br>
                                        <label><b>Especialidad:</b></label><br>
                                        <input disabled type="text" name="especialidad3" id="especialidad3" placeholder="Ejemplo:Informática" title="Coloque la especialidad del tercer intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD3()" onkeyup="validarESPECIALIDAD3()" onchange="validarESPECIALIDAD3()"/>
                                        <div class="promts" style="margin-left:-35px;"><span id="Especialidad3"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="tit">
                                        <br>
                                        <label><b>En qué consiste:</b></label><br>
                                        <textarea id="descripcion" name="descripcion" placeholder="Ejemplo:En el desarrollo de..." title="Coloque en que consiste el proyecto 'Ejemplo:En el desarrollo de...'" onkeypress="return letra_num_car(event)" onkeyup="validarDESCRIPCION()" onclick="validarDESCRIPCION()"></textarea>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="Descripcion"></span></div>
                                      </td>
                                    </tr>
                                        <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                  </table>

                                </div>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                          </div>
                          <!-- /.panel -->

                          <div class="tab-pane fade" id="paso4">
                            <div class="panel panel-default">
                              <div class="panel-body">
                                <div class="table-responsive">
                                  <table width="100%">
                                    <tr>
                                      <td colspan="3" class="tit">
                                        <label><b>Qué aportes ofrece a la Comunidad y a cuántos beneficia:</b></label><br>
                                        <textarea id="aportes" name="aportes" placeholder="Ejemplo:Ofrece a la comunidad una solucion en..." title="Coloque en que aportes ofrece a la comunidad y a cuántos beneficia el proyecto 'Ejemplo:Ofrece a la comunidad una solucion en...'" onkeypress="return letra_num_car(event)" onkeyup="validarAPORTES()" onclick="validarAPORTES()"></textarea>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="Aportes"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="tit">
                                        <label><b>Integración con la Comunidad a través de:</b></label><br>
                                        <textarea id="integracion" name="integracion" placeholder="Ejemplo:Se establecerá a traves de..." title="Coloque la integración con la comunidad del proyecto 'Ejemplo:Se establecerá a traves de...'" onkeypress="return letra_num_car(event)" onkeyup="validarINTEGRACION()" onclick="validarINTEGRACION()"></textarea>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="Integracion"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" class="tit">
                                        <label><b>Relación con el Plan Nacional vigente:</b></label><br>
                                        <textarea id="planNacional" name="planNacional" placeholder="Ejemplo:Con el punto numero..." title="Coloque la relación del proyecto con el plan nacional vigente 'Ejemplo:Con el punto numero...'" onkeypress="return letra_num_car(event)" onkeyup="validarPLANNACIONAL()" onclick="validarPLANNACIONAL()"></textarea>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        <div class="promts" style="margin-left:-50px;"><span id="PlanNacional"></span></div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center">
                                        <h3><div id="salidaR_TECNOLOGICO"></div></h3>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="tit" colspan="3">
                                        <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                        <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">  
                                      </td>
                                    </tr>
                                        <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                  </table>

                                </div>
                              </div>
                              <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                          </div>
                          <!-- /.panel -->
                        </div>
                      </div>
                    </div>

                  </form>

                </div>

              </div>

              <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <form method="post" action="modifica_comunitario.php" id="modif_planif" onsubmit="return validarPROYECTO_M()">

                          <input type="hidden" name="id" id="id"/>

                          <input type="hidden" name="idEst1" id="idEst1"/>

                          <input type="hidden" name="idEst2" id="idEst2"/>

                          <input type="hidden" name="idEst3" id="idEst3"/>

                          <div class="panel panel-default">
                          <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#pas1" data-toggle="tab"><h4>Paso 1</h4></a></li>
                              <li><a href="#pas2" data-toggle="tab"><h4>Paso 2</h4></a></li>
                              <li><a href="#pas3" data-toggle="tab"><h4>Paso 3</h4></a></li>
                              <li><a href="#pas4" data-toggle="tab"><h4>Paso 4</h4></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="pas1">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">

                                      <table width="100%">
                                        <tr>
                                          <td colspan="2" class="tit">
                                            <label><b>Título:</b></label><br>
                                            <textarea id="tituloM" name="tituloM" placeholder="Ejemplo:Desarrollar un..." title="Coloque el título del proyecto 'Ejemplo:Desarrollar un...'" onkeypress="return letra_num_car(event)" onclick="validarTITULO_M()" onkeyup="validarTITULO_M()" onchange="validarTITULO()_M"></textarea>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts"><span id="TituloM"></span></div>
                                          </td>

                                          <input type="hidden" id="validar_codigo_ajaxM" name="validar_codigo_ajaxM"/>

                                          <td class="tit">
                                            <label><b>Código:</b></label><br>
                                            <input type="text" name="codigoM" id="codigoM" maxlength="24" placeholder="Ejemplo:SCEPNFIV-0-00-0000" title="Código del proyecto 'Ejemplo:SCEPNFIV-0-00-0000'" title="Coloque el código del proyecto" onkeypress="return soloCodigo(event)" onclick="validarCODIGO_M()" onkeyup="validarCODIGO_M()" onchange="validarCODIGO_M()"/>      
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-52px;"><span id="CodigoM"></span></div>      
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit">
                                            <label><b>Régimen:</b></label><br>
                                            <select id="regimenM" name="regimenM" onchange="validarREGIMEN_M()" title="Seleccione el régimen de estudio">
                                              <option> </option>
                                              <option>Diurno</option>
                                              <option>Nocturno</option>
                                            </select>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-9px;"><span id="RegimenM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>Estado:</b></label><br>
                                            <select name="estadoM" id="estadoM" title="Seleccione el estado donde se realiza el proyecto" onchange="validarESTADO_M()">
                                              <option></option>
                                            <?php $query=pg_query("SELECT * FROM estados");
                                                  while($array=pg_fetch_assoc($query))
                                                  {
                                            ?>
                                              <option><?php echo $array['nombre']; ?></option>
                                            <?php
                                                  }
                                            ?>
                                            </select>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-29px;"><span id="EstadoM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>Municipio:</b></label><br>
                                            <select name="municipioM" id="municipioM" title="Seleccione el municipio donde se realiza el proyecto" onclick="validarMUNICIPIO_M()" onchange="validarMUNICIPIO_M()">
                                              <option></option>
                                            </select>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-8px;"><span id="MunicipioM"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit">
                                            <label><b>Parroquia:</b></label><br>
                                            <input type="text" name="parroquiaM" id="parroquiaM" maxlength="30" placeholder="Ejemplo:Villa de Cura" title="Coloque la parroquia donde se realiza el proyecto 'Ejemplo:Villa de Cura'" onkeypress="return soloLetras(event)" onclick="validarPARROQUIA_M()" onkeyup="validarPARROQUIA_M()" onchange="validarPARROQUIA_M()">
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-44px;"><span id="ParroquiaM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>Sector:</b></label><br>
                                            <input type="text" name="sectorM" id="sectorM" maxlength="30" placeholder="Ejemplo:Las Tablitas" title="Coloque el sector donde se realiza el proyecto 'Ejemplo:Las Tablitas'" onkeypress="return soloLetras(event)" onclick="validarSECTOR_M()" onkeyup="validarSECTOR_M()" onchange="validarSECTOR_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-54px;"><span id="SectorM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>PNF:</b></label><br>
                                            <select name="pnfM" id="pnfM" title="Seleccione el PNF donde se realiza el proyecto" onchange="validarPNF_M()">
                                              <option></option>
                                              <option>Administración</option>
                                              <option>Contaduria</option>
                                              <option>Electricidad</option>
                                              <option>Electrónica</option>
                                              <option>Informática</option>
                                              <option>Mantenimiento</option>
                                              <option>Mecánica</option>
                                              <option>Telecomunicaciones</option>
                                              <option>Calidad de Ambiente</option>
                                            </select>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-38px;"><span id="PnfM"></span></div>

                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit">
                                            <label><b>Trayecto:</b></label><br>
                                            <select name="trayectoM" id="trayectoM" title="Seleccione el trayecto donde se realiza el proyecto" onchange="validarTRAYECTO_M()">
                                              <option></option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                            </select>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:13px;"><span id="TrayectoM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>Sección:</b></label><br>
                                            <input type="text" name="seccionM" id="seccionM" placeholder="Ejemplo:2" maxlength="1" title="Coloque la sección donde se realiza el proyecto 'Ejemplo:2'" onkeypress="return solonum(event)" onclick="validarSECCION_M()" onkeyup="validarSECCION_M()" onchange="validarSECCION_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="SeccionM"></span></div>
                                          </td>
                                          <td class="tit">
                                            <label><b>Periodo:</b></label><br>
                                            <input type="text" name="periodoM" id="periodoM" placeholder="Ejemplo:2015-III" maxlength="8" title="Coloque la sección donde se realiza el proyecto 'Ejemplo:2015-III'" onkeypress="return soloPeriodo(event)" onclick="validarPERIODO_M()" onkeyup="validarPERIODO_M()" onchange="validarPERIODO_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="PeriodoM"></span></div>
                                          </td>
                                        </tr>
                                            <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                      </table>              
                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->
        
                              <div class="tab-pane fade" id="pas2">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">

                                      <table width="100%">
                                        <tr>
                                          <td class="tit2" colspan="3"><label><h3>Integrante 1</h3></label></td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <label><b>C.I:</b></label><br>
                                            <select id="nacEstM" name="nacEstM" title="Seleccione la nacionalidad del primer integrante" onchange="validarCI1_M()">
                                              <option> </option>
                                              <option>V-</option>
                                              <option>E-</option>
                                            </select>
                                            <input type="text" name="ciEstM" id="ciEstM" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del primer intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI1_M()" onkeyup="validarCI1_M()" onchange="validarCI1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-86px;"><span id="Ci1M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Nombres:</b></label><br>
                                            <input type="text" name="nomEstM" id="nomEstM" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del primer intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM1_M()" onkeyup="validarNOM1_M()" onchange="validarNOM1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-47px;"><span id="Nom1M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Apellidos:</b></label><br>
                                            <input type="text" name="apeEstM" id="apeEstM" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del primer intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE1_M()" onkeyup="validarAPE1_M()" onchange="validarAPE1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-47px;"><span id="Ape1M"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Telefono de Contacto:</b></label><br>
                                            <select name="codTlfM" id="codTlfM" title="Seleccione el código del teléfono" onchange="validarTLF1_M()">
                                              <option> </option>
                                              <option>0416-</option>
                                              <option>0426-</option>
                                              <option>0414-</option>
                                              <option>0424-</option>
                                              <option>0412-</option>
                                            </select>
                                            <input type="text" name="tlfEstM" id="tlfEstM" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del primer intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF1_M()" onkeyup="validarTLF1_M()" onchange="validarTLF1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-41px;"><span id="Tlf1M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Email:</b></label><br>
                                            <input type="text" name="correoEstM" id="correoEstM" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del primer intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO1_M()" onkeyup="validarCORREO1_M()" onchange="validarCORREO1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-57px;"><span id="Correo1M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Especialidad:</b></label><br>
                                            <input type="text" name="especialidadM" id="especialidadM" placeholder="Ejemplo:Informática" title="Coloque la especialidad del primer intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD1_M()" onkeyup="validarESPECIALIDAD1_M()" onchange="validarESPECIALIDAD1_M()"/>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-36px;"><span id="Especialidad1M"></span></div>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>
                                            <input type="checkbox" id="integrante2M" onclick="habilitarM(2)"/><b style="font-size:15px;">Habilitar</b>
                                          </td>

                                          <td class="tit2" style="text-align:left;" colspan="2">
                                            <label><h3>Integrante 2</h3></label>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <label><b>C.I:</b></label><br>
                                            <select id="nacEst2M" name="nacEst2M" title="Seleccione la nacionalidad del segundo integrante" onchange="validarCI2_M()">
                                              <option> </option>
                                              <option>V-</option>
                                              <option>E-</option>
                                            </select>
                                            <input type="text" name="ciEst2M" id="ciEst2M" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del segundo intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI2_M()" onkeyup="validarCI2_M()" onchange="validarCI2_M()"/>
                                            <div class="promts" style="margin-left:-86px;"><span id="Ci2M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Nombres:</b></label><br>
                                            <input type="text" name="nomEst2M" id="nomEst2M" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del segundo intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM2_M()" onkeyup="validarNOM2_M()" onchange="validarNOM2_M()"/>
                                            <div class="promts" style="margin-left:-47px;"><span id="Nom2M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Apellidos:</b></label><br>
                                            <input type="text" name="apeEst2M" id="apeEst2M" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del segundo intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE2_M()" onkeyup="validarAPE2_M()" onchange="validarAPE2_M()"/>
                                            <div class="promts" style="margin-left:-47px;"><span id="Ape2M"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Telefono de Contacto:</b></label><br>
                                            <select name="codTlf2M" id="codTlf2M" title="Seleccione el código del teléfono" onchange="validarTLF2_M()">
                                              <option> </option>
                                              <option>0416-</option>
                                              <option>0426-</option>
                                              <option>0414-</option>
                                              <option>0424-</option>
                                              <option>0412-</option>
                                            </select>
                                            <input type="text" name="tlfEst2M" id="tlfEst2M" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del segundo intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF2_M()" onkeyup="validarTLF2_M()" onchange="validarTLF2_M()"/>
                                            <div class="promts" style="margin-left:-41px;"><span id="Tlf2M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Email:</b></label><br>
                                            <input type="text" name="correoEst2M" id="correoEst2M" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del segundo intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO2_M()" onkeyup="validarCORREO2_M()" onchange="validarCORREO2_M()"/>
                                            <div class="promts" style="margin-left:-57px;"><span id="Correo2M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Especialidad:</b></label><br>
                                            <input type="text" name="especialidad2M" id="especialidad2M" placeholder="Ejemplo:Informática" title="Coloque la especialidad del segundo intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD2_M()" onkeyup="validarESPECIALIDAD2_M()" onchange="validarESPECIALIDAD2_M()"/>
                                            <div class="promts" style="margin-left:-36px;"><span id="Especialidad2M"></span></div>
                                          </td>
                                        </tr>
                                            <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                      </table>

                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->

                              <div class="tab-pane fade" id="pas3">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">

                                      <table width="100%">      
                                        <tr>
                                          <td>
                                            <input type="checkbox" id="integrante3M" onclick="habilitarM(3)"/><b style="font-size:15px;">Habilitar</b>
                                          </td>
                                          <td class="tit2" style="text-align:left;" colspan="2">
                                            <label><h3>Integrante 3</h3></label>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <label><b>C.I:</b></label><br>
                                            <select id="nacEst3M" name="nacEst3M" title="Seleccione la nacionalidad del tercer integrante" onchange="validarCI3_M()">
                                              <option> </option>
                                              <option>V-</option>
                                              <option>E-</option>
                                            </select>
                                            <input type="text" name="ciEst3M" id="ciEst3M" placeholder="Ejemplo:12345678" maxlength="12" title="Coloque la cedula del tercer intengrante del proyecto 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI3_M()" onkeyup="validarCI3_M()" onchange="validarCI3_M()"/>
                                            <div class="promts" style="margin-left:-86px;"><span id="Ci3M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Nombres:</b></label><br>
                                            <input type="text" name="nomEst3M" id="nomEst3M" placeholder="Ejemplo:Pedro José" maxlength="50" title="Coloque los nombres del tercer intengrante del proyecto 'Ejemplo:Pedro José'" onkeypress="return soloLetras(event)" onclick="validarNOM3_M()" onkeyup="validarNOM3_M()" onchange="validarNOM3_M()"/>
                                            <div class="promts" style="margin-left:-47px;"><span id="Nom3M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <label><b>Apellidos:</b></label><br>
                                            <input type="text" name="apeEst3M" id="apeEst3M" placeholder="Ejemplo:Perez Díaz" maxlength="50" title="Coloque los apellidos del tercer intengrante del proyecto 'Ejemplo:Perez Díaz'" onkeypress="return soloLetras(event)" onclick="validarAPE3_M()" onkeyup="validarAPE3_M()" onchange="validarAPE3_M()"/>
                                            <div class="promts" style="margin-left:-47px;"><span id="Ape3M"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Telefono de Contacto:</b></label><br>
                                            <select name="codTlf3M" id="codTlf3M" title="Seleccione el código del teléfono" onchange="validarTLF3_M()">
                                              <option> </option>
                                              <option>0416-</option>
                                              <option>0426-</option>
                                              <option>0414-</option>
                                              <option>0424-</option>
                                              <option>0412-</option>
                                            </select>
                                            <input type="text" name="tlfEst3M" id="tlfEst3M" placeholder="Ejemplo:1234567" maxlength="7" title="Coloque el teléfono del tercer intengrante del proyecto 'Ejemplo:1234567'" onkeypress="return solonum(event)" onclick="validarTLF3_M()" onkeyup="validarTLF3_M()" onchange="validarTLF3_M()"/>
                                            <div class="promts" style="margin-left:-41px;"><span id="Tlf3M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Email:</b></label><br>
                                            <input type="text" name="correoEst3M" id="correoEst3M" placeholder="Ejemplo:ej@examp.com" title="Coloque el correo del tercer intengrante del proyecto 'Ejemplo:ej@examp.com'" onclick="validarCORREO3_M()" onkeyup="validarCORREO3_M()" onchange="validarCORREO3_M()"/>
                                            <div class="promts" style="margin-left:-57px;"><span id="Correo3M"></span></div>
                                          </td>
                                          <td class="tit2">
                                            <br>
                                            <label><b>Especialidad:</b></label><br>
                                            <input type="text" name="especialidad3M" id="especialidad3M" placeholder="Ejemplo:Informática" title="Coloque la especialidad del tercer intengrante del proyecto 'Ejemplo:Informática'" onkeypress="return soloLetras(event)" onclick="validarESPECIALIDAD3_M()" onkeyup="validarESPECIALIDAD3_M()" onchange="validarESPECIALIDAD3_M()"/>
                                           <div class="promts" style="margin-left:-36px;"><span id="Especialidad3M"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" class="tit">
                                            <br>
                                            <label><b>En qué consiste:</b></label><br>
                                            <textarea id="descripcionM" name="descripcionM" placeholder="Ejemplo:En el desarrollo de..." title="Coloque en que consiste el proyecto 'Ejemplo:En el desarrollo de...'" onkeypress="return letra_num_car(event)" onkeyup="validarDESCRIPCION_M()" onclick="validarDESCRIPCION_M()"></textarea>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="DescripcionM"></span></div>
                                          </td>
                                        </tr>
                                            <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                      </table>

                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->

                              <div class="tab-pane fade" id="pas4">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">
                                      <table width="100%">
                                        <tr>
                                          <td colspan="3" class="tit">
                                            <label><b>Qué aportes ofrece a la Comunidad y a cuántos beneficia:</b></label><br>
                                            <textarea id="aportesM" name="aportesM" placeholder="Ejemplo:Ofrece a la comunidad una solucion en..." title="Coloque en que aportes ofrece a la comunidad y a cuántos beneficia el proyecto 'Ejemplo:Ofrece a la comunidad una solucion en...'" onkeypress="return letra_num_car(event)" onkeyup="validarAPORTES_M()" onclick="validarAPORTES_M()"></textarea>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="AportesM"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" class="tit">
                                            <label><b>Integración con la Comunidad a través de:</b></label><br>
                                            <textarea id="integracionM" name="integracionM" placeholder="Ejemplo:Se establecerá a traves de..." title="Coloque la integración con la comunidad del proyecto 'Ejemplo:Se establecerá a traves de...'" onkeypress="return letra_num_car(event)" onkeyup="validarINTEGRACION_M()" onclick="validarINTEGRACION_M()"></textarea>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="IntegracionM"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" class="tit">
                                            <label><b>Relación con el Plan Nacional vigente:</b></label><br>
                                            <textarea id="planNacionalM" name="planNacionalM" placeholder="Ejemplo:Con el punto numero..." title="Coloque la relación del proyecto con el plan nacional vigente 'Ejemplo:Con el punto numero...'" onkeypress="return letra_num_car(event)" onkeyup="validarPLANNACIONAL_M()" onclick="validarPLANNACIONAL_M()"></textarea>
                                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                            <div class="promts" style="margin-left:-50px;"><span id="PlanNacionalM"></span></div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center">
                                            <h3><div id="salidaM_TECNOLOGICO"></div></h3>
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
                                            <button class="btn btn-danger" title="Cancelar" data-dismiss="modal">Cancelar</button>  
                                          </td>
                                        </tr>
                                      </table>

                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->
                            </div>
                          </div>
                        </div>
                          
                        </form>
                            
                      </div>                    
                    </div>
                  </div>
                </div>
              <!-- End modal -->

  <!--///////////////////////////////////////////////////////////////////////////////////////////////////////-->

              <!-- estado Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="estado_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado del Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <form method="post" action="estado_tecnologico.php" id="estado_tecnologico">

                          <input type="hidden" name="id_tec" id="id_tec"/>

                          <input type="hidden" name="comunitario" id="comunitario" value="comunitario"/>

                          <table width="100%">
                            <tr>
                              <td class="tit">
                                <label><b>Concluido:</b></label>
                                <input type="radio" name="estado" value="Concluido" id="concluido_t" onclick="verif_estadoC()" data-dismiss="modal"/>
                              </td>
                              <td class="tit">
                                <label><b>En proceso:</b></label>
                                <input type="radio" name="estado" value="En proceso" id="en_proceso_t"/>
                              </td>
                              <td class="tit">
                                <label><b>Abandonado:</b></label>
                                <input type="radio" name="estado" value="Abandonado" id="abandonado" onclick="verif_estadoA()" data-dismiss="modal"/>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="verif_estadoC" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado del Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¿Usted esta seguro que desea cambiar el estado del Proyecto a "Concluido"?
                          <br><br>¡Si acepta realizar este cambio después no podrá realizar ninguna modificación ni eliminar el Proyecto seleccinado!</h4>                            
                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" onclick="aceptar_concluido()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar modal -->

              <!-- eliminar modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="verif_estadoA" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado del Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¿Usted esta seguro que desea cambiar el estado del Proyecto a "Abandonado"?
                          <br><br>¡Si acepta realizar este cambio después no podrá realizar ninguna modificación ni eliminar el Proyecto seleccinado!</h4>                            
                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" onclick="aceptar_abandonado()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar modal -->

                              <!-- detalle Modal -->
                 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reporte_proyecto_indv" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Reporte Proyecto</h4>
                      </div>
                      <div class="modal-body">

                       <h4>¿Usted esta seguro de que desea generar el reporte de este proyecto?</h4>                            

                       <input type="hidden" id="aceptar_reporte_proyecto">
                     </div>
                     <div class="modal-footer">
                      <button class="btn btn-primary" title="Aceptar" onclick="reportandoTecnologico()" data-dismiss="modal" >Aceptar</button>
                      <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                  </div>
                </div>
              </div>
              </div>
              <!-- End detalle modal --> 

              <!-- detalle Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_tecnologico" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Detalle del Proyecto</h4>
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminar_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Eliminar Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¿Usted esta seguro que desea eliminar este Proyecto?</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_tec">
                                                    
                        <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Tecnologico()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar modal -->

              <!-- registro planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registro_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Proyecto registrado con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End registro planificacion modal -->

              <!-- registro planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Proyecto Modificado con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End registro planificacion modal -->


              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! El codigo del Proyecto ya esta registrado</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_tecM" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! El codigo del Proyecto ya esta registrado</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_est1" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! El Integrante 1 ya posee un proyecto en el trayecto <?php echo $_REQUEST['trayecto'];?> </h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_est2" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! El Integrante 2 ya posee un proyecto en el trayecto <?php echo $_REQUEST['trayecto'];?></h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_est3" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Proyecto Socio-Comunitario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! El Integrante 3 ya posee un proyecto en el trayecto <?php echo $_REQUEST['trayecto'];?></h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- eliminar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminacion_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Eliminar Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Proyecto eliminado con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End eliminar planificacion modal -->

              <!-- estado planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="exito_estado_tec" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Estado del Proyecto</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Se cambio el estado del Proyecto con exito!</h4>                            
                                          
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
    <script type="text/javascript" src="funciones.js"></script>
    <script type="text/javascript" src="js/vali_comunitario.js"></script>

</body>
</html>
<?php

  $registro=$_REQUEST['registro'];

  if ($registro=='exito')
  {
?>
<script type="text/javascript">
    
    $('#registro_tec').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

###########vvvvvvvvv###########
  $modificar=$_REQUEST['modificar'];

  if ($modificar=='exito')
  {
?>
<script type="text/javascript">
    
    $('#modificar_tec').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

############^^^^^^^^^^#############

  $error=$_REQUEST['error'];

  if ($error=='si')
  {
?>
<script type="text/javascript">
    
    $('#error_tec').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  if ($error=='siM')
  {
?>
<script type="text/javascript">
    
    $('#error_tecM').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  if ($error=='est1')
  {
?>
<script type="text/javascript">
    
    $('#error_est1').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  if ($error=='est2')
  {
?>
<script type="text/javascript">
    
    $('#error_est2').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  if ($error=='est3')
  {
?>
<script type="text/javascript">
    
    $('#error_est3').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

##########vvvvvvvvvv##############
  $elim=$_REQUEST['elim'];

  if ($elim=='si')
  {
?>
<script type="text/javascript">
    
    $('#eliminacion_tec').modal({
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
    
    $('#exito_estado_tec').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }
?>
