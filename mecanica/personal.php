<?php
  require('seguridad.php');
  require('conexion.php');

  $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_personal']);
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

            <div id="miGestionPersonal">

              <h4><a href="#">Administrativo</a> > <a href="#">Personal</a></h4>
                
              <div class="info3">
                
                <div id="text_center_title">
                  <span class="t-menu">Consulta de personal</span>
                </div><br>

                <table class="tabla_agregar_imprimir">
                  <tr>
                    <td>
                      <?php
                        if ($privilegio_I=='I')
                        {
                      ?>
                        <p id="reporte_personal"><button class="btn btn-default">Generar Reporte &nbsp; <span class="fa fa-file-text-o"></span></button></p>
                      <?php
                        }
                      ?>
                    </td>
                    <td>
                      <?php
                        if ($privilegio_A=='A')
                        {
                      ?>
                        <p id="agregar_per"> <button class="btn btn-success" onclick="N_personal()">Nuevo Personal &nbsp; <i class="fa fa-plus"></i></button></p>  
                      <?php  
                        }
                      ?>
                    </td>
                  </tr>
                </table>
                    <div id="tabla_usuario">

                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                            <tr>
                              <th>C.I</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                              <th>Cargo</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql="SELECT * FROM personal WHERE estatus='1' AND area='Mecanica'";
                              $query=pg_query($sql);

                              while ($array=pg_fetch_assoc($query))
                              {
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['ci'];?></td>
                              <td align="center"><?php echo $array['nombres'];?></td>
                              <td align="center"><?php echo $array['apellidos'];?></td>
                              <td align="center"><?php echo $array['cargo'];?></td>
                              <td align="center">
                            <?php
                             if ($privilegio_M=='M')
                              {
                              
                            ?>       
                                <a href="javascript:editar_personal(<?php echo $array['id'];?>);">
                                  <button class="btn btn-default" title="Modificar">
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
                                <a href="javascript:eliminarPersonal(<?php echo $array['id'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                            <?php
                              }
                            ?>  
                                <a href="javascript:detallePersonal(<?php echo $array['id'];?>);">                
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
                    </div>
                  </div>

              <div id="regPersonal">

                <h4><a href="#">Administrativo</a> > <a href="personal.php">Personal</a> > <a href="#">Nuevo Personal</a></h4>

                <div class="info2">
                  <form action="registro_personal.php" method="post" id="form_personal" name="form_personal" onsubmit="return validarR_PER()">

                    <div id="text_center_title">
                      <span class="t-menu">Registro de Personal</span>
                    </div>
                    
                    <fieldset id="reg_usu">

                    <table align="center" width="85%">
                      <tr>
                      
                        <td class="tit" colspan="3">
                          <label><b>Cédula de Identidad:</b></label><br>
                          <select id="nacionalidad" name="nacionalidad" title="Seleccione la nacionalidad de la persona" onchange="validarNAC()">
                            <option> </option>
                            <option>V-</option>
                            <option>E-</option>
                          </select>
                          <input type="text" name="ci_per" id="ci_per" maxlength="12" title="Coloque la cedula de identidad de la persona 'Ejemplo:12345678'" placeholder="Ejemplo:12345678" onKeyPress="return solonum(event)" onchange="validarCI()" onclick="validarCI()" onKeyUp="validarCI()"/>
                          <div class="promts" style="margin-left: -34px;"><span id="C.I_per"></span></div>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                        
                        <input type="hidden" id="validar_ci_ajax" name="validar_ci_ajax"/>

                        </td>
                      </tr>
                      <tr>
                        <td class="tit">
                          <label><b>Nombres:</b></label><br>
                          <input type="text" name="nombres_per" id="nombres_per" maxlength="31" title="Coloque los nombres de la persona 'Ejemplo:Carlos Alfonzo'" placeholder="Ejemplo:Carlos Alfonzo" onKeyPress="return soloLetras(event)" onchange="validarNOM()" onclick="validarNOM()" onKeyUp="validarNOM()"/>
                          <div class="promts"><span id="val_nombres_per"></span></div>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                        </td>
                      
                        <td class="tit">
                          <label><b>Apellidos:</b></label><br>
                          <input type="text" name="apellidos_per" id="apellidos_per" maxlength="31" title="Coloque los apellidos de la persona 'Ejemplo:Paredes Guevara'" placeholder="Ejemplo:Paredes Guevara" onKeyPress="return soloLetras(event)" onchange="validarAPE()" onclick="validarAPE()" onKeyUp="validarAPE()"/>
                          <div class="promts"><span id="val_apellidos_per"></span></div>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                        </td>
                      
                        <td class="tit">
                          <label><b>Sexo:</b></label><br>
                          <input type="radio" id="masculino" name="sexo" value="M" checked/>Masculino
                          <input type="radio" id="femenino" name="sexo" value="F"/>Femenino
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>  
                        </td>

                      </tr>
                      <tr>
                      
                        <td class="tit">
                          <label><b>Grado de Instrucción:</b></label><br>
                          <select name="grado_inst_reg_per" id="grado_inst_reg_per" onchange="validarG_I()" title="Seleccione el grado de instrucción de la persona">
                            <option> </option>
                            <option>Escolar</option>
                            <option>Bachiller</option>
                            <option>Medio Técnico</option>
                            <option>TSU</option>
                            <option>Profesor</option>
                            <option>Licenciado</option>
                            <option>Ingeniero</option>
                            <option>Diplomado</option>
                            <option>Especialización</option>
                            <option>Magister</option>
                            <option>Doctorado</option>
                            <option>Phd</option>
                          </select>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts_gi"><span id="sms_gi"></span></div>
                        </td>

                        <td class="tit">
                          <label><b>Especialidad:</b></label><br>
                          <input type="text" name="especialidad" id="especialidad" maxlength="31" title="Coloque la Especialidad de la persona 'Ejemplo:Mecánica'" placeholder="Ejemplo:Mecánica" onkeypress="return soloLetras(event)" onchange="validarESP()" onclick="validarESP()" onkeyup="validarESP()"/>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -35px;"><span id="sms_especialidad"></span></div>  
                        </td>
                      
                        <td class="tit">
                          <label><b>Cargo:</b></label><br>
                          <select name="cargo_per" id="cargo_per" onchange="validarCARGO()" title="Seleccione el cargo de la persona">
                            <option> </option>
                            <option>Profesor</option>
                            <option>Encargado</option>
                            <option>Becario</option>
                            <option>Estudiante</option>
                          </select>  
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts" style="margin-left: -20px;"><span id="cargo"></span></div>
                        </td>
                      
                      </tr>
                      <tr>
                      
                        <td class="tit">
                          <label><b>Email:</b></label><br>
                        <input type="text" name="correo" id="correo" maxlength="50" title="Coloque el Correo Electrónico de la persona 'Ejemplo:correo_e@ejemplo.com'" placeholder="Ejemplo:correo_e@ejemplo.com" onchange="validarCORREO()" onclick="validarCORREO()" onkeyup="validarCORREO()"/>
                        <div class="promts" style="margin-left: -57px;"><span id="correoE"></span></div>
                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                        
                        <input type="hidden" id="validar_correo_ajax" name="validar_correo_ajax"/>

                        </td>
                      
                        <td class="tit">
                          <label><b>Celular:</b></label><br>
                          <select name="cod_tlf" id="cod_tlf" onChange="validarTLF()" title="Seleccione el codigo del telefono celular">
                            <option> </option>
                            <option>0416-</option>
                            <option>0426-</option>
                            <option>0414-</option>
                            <option>0424-</option>
                            <option>0412-</option>
                          </select>
                          <input type="text" name="num_cont" id="num_cont" maxlength="7" size="12" placeholder="Ejemplo:1234567" title="Coloque el numero del teléfono celular 'Ejemplo:1234567'" onKeyPress="return telefono(event)" onchange="validarTLF()" onclick="validarTLF()" onkeyup="validarTLF()"/>
                          <div class="promts" style="margin-left: -54px;"><span id="num_contacto"></span></div>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                        </td>
                      
                        <td class="tit">
                          <label><b>Fecha de Nacimiento:</b></label><br>
                          <input type="text" name="fecha_nac" id="fecha_nac" maxlength="10" size="16" placeholder="Ejemplo:Dia/Mes/Año" title="Seleccione la fecha de nacimiento de la persona 'Ejemplo:10/02/1980'"  onclick="validarFECHA()" onchange="validarFECHA()" onkeyup="validarFECHA()"/>
                          <div class="promts2"><span id="fecha_nacimiento"></span></div>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                        </td>
                      
                      </tr>

                      <tr>
                        <td colspan="3" class="tit">
                          <div id="ocultarDedicacion">
                            <label><b>Dedicación:</b></label><br>
                            <select id="dedicacion" name='dedicacion' title="Seleccione la Dedicación del Profesor" onchange="validarDEDICACION()">
                              <option> </option>
                              <option>Tiempo Completo/Dedicación Exclusiva</option>
                              <option>Medio Tiempo</option>
                              <option>Tiempo Convencional</option>
                            </select>
                            <div class="promts2"><span id="Dedicacion"></span></div>
                            <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          </div>
                        </td>
                      </tr>
                      
                      <tr>
                        <td colspan="3" align="center">
                          <h3><div id="salidaR_PER"></div></h3>
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

                    </fieldset>
                  </form>
                </div>

              </div>

                  <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_personal" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Personal</h4>
                          </div>
                          <div class="modal-body">

                            <form action="modifica_personal.php" method="post" id="mod_personal" name="mod_personal" onsubmit="return validarM_PER()">

                                <table align="center" width="100%">
                                  <tr>

                                    <input type="hidden" id="id" name="id">
                                  
                                    <td class="tit" colspan="3">
                                      <label><b>Cédula de Identidad:</b></label><br>
                                      <select id="nac_perM" name="nac_perM" title="Seleccione la nacionalidad de la persona" onchange="validarNAC_M()">
                                        <option> </option>
                                        <option>V-</option>
                                        <option>E-</option>
                                      </select>
                                      <input type="text" name="ci_perM" id="ci_perM" maxlength="12" title="Coloque la cedula de identidad de la persona 'Ejemplo:12345678'" placeholder="Ejemplo:12345678" onKeyPress="return solonum(event)" onchange="validarCI_M()" onclick="validarCI_M()" onKeyUp="validarCI_M()"/>
                                      <div class="promts" style="margin-left: -35px;"><span id="C.I_perM"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                                    
                                      <input type="hidden" id="validar_ci_ajaxM" name="validar_ci_ajaxM"/>

                                    </td>

                                  </tr>
                                  <tr>

                                    <td class="tit">
                                      <label><b>Nombres:</b></label><br>
                                      <input type="text" name="nombres_perM" id="nombres_perM" maxlength="31" title="Coloque los nombres de la persona 'Ejemplo:Carlos Alfonzo'" placeholder="Ejemplo:Carlos Alfonzo" onKeyPress="return soloLetras(event)" onchange="validarNOM_M()" onclick="validarNOM_M()" onKeyUp="validarNOM_M()"/>
                                      <div class="promts"><span id="val_nombres_per_M"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                                    </td>
                                  
                                    <td class="tit">
                                      <label><b>Apellidos:</b></label><br>
                                      <input type="text" name="apellidos_perM" id="apellidos_perM" maxlength="31" title="Coloque los apellidos de la persona 'Ejemplo:Paredes Guevara'" placeholder="Ejemplo:Paredes Guevara" onKeyPress="return soloLetras(event)" onchange="validarAPE_M()" onclick="validarAPE_M()" onKeyUp="validarAPE_M()"/>
                                      <div class="promts"><span id="val_apellidos_per_M"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>&nbsp;
                                    </td>
                                  
                                    <td class="tit">
                                      <label><b>Sexo:</b></label><br>
                                      <input type="radio" id="masculino_M" name="sexo_perM" value="M"/>Masculino
                                      <input type="radio" id="femenino_M" name="sexo_perM" value="F"/>Femenino
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td class="tit">
                                      <label><b>Grado de Instrucción:</b></label><br>
                                      <select name="grado_instM" id="grado_instM" title="Seleccione el grado de instrucción de la persona" onchange="validarG_I_M()">
                                        <option> </option>
                                        <option>Escolar</option>
                                        <option>Bachiller</option>
                                        <option>Medio Técnico</option>
                                        <option>TSU</option>
                                        <option>Profesor</option>
                                        <option>Licenciado</option>
                                        <option>Ingeniero</option>
                                        <option>Diplomado</option>
                                        <option>Especialización</option>
                                        <option>Magister</option>
                                        <option>Doctorado</option>
                                        <option>Phd</option>
                                      </select>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts_gi"><span id="sms_giM"></span></div>
                                    </td>


                                      <td class="tit">
                                        <label><b>Especialidad:</b></label><br>
                                        <input type="text" name="especialidadM" title="Coloque la Especialidad de la persona 'Ejemplo:Mecánica'" id="especialidadM" maxlength="31" placeholder="Ejemplo:Mecánica" onkeypress="return soloLetras(event)" onchange="validarESP_M()" onclick="validarESP_M()" onkeyup="validarESP_M()"/>
                                        <div class="promts" style="margin-left: -35px;"><span id="sms_especialidadM"></span></div>  
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      </td>

                                    <td class="tit">
                                      <label><b>Cargo:</b></label><br>
                                      <select name="cargo_perM" id="cargo_perM" title="Seleccione el cargo de la persona" onchange="validarCARGO_M()">
                                        <option> </option>
                                        <option>Profesor</option>
                                        <option>Encargado</option>
                                        <option>Becario</option>
                                        <option>Estudiante</option>
                                      </select>
                                      <div class="promts" style="margin-left: -20px;"><span id="cargoM"></span></div>  
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    </td>
                                  
                                  </tr>
                                  <tr>
                                  
                                    <td class="tit">
                                      <label><b>Email:</b></label><br>
                                      <input type="text" name="correoM" id="correoM" maxlength="50" title="Coloque el Correo Electrónico de la persona 'Ejemplo:correo_e@ejemplo.com'" placeholder="Ejemplo:correo@ejemplo.com" onchange="validarCORREO_M()" onclick="validarCORREO_M()" onkeyup="validarCORREO_M()"/>
                                      <div class="promts"><span id="correoE_M"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    
                                    <input type="hidden" id="validar_correo_ajaxM" name="validar_correo_ajaxM"/>

                                    </td>
                                  
                                    <td class="tit">
                                      <label><b>Celular:</b></label><br>
                                      <select name="cod_tlfM" id="cod_tlfM" title="Seleccione el codigo del telefono celular" onChange="validarTLF_M()">
                                        <option> </option>
                                        <option>0416-</option>
                                        <option>0426-</option>
                                        <option>0414-</option>
                                        <option>0424-</option>
                                        <option>0412-</option>
                                      </select>
                                      <input type="text" name="num_contM" id="num_contM" maxlength="7" size="12" title="Coloque el numero del teléfono celular 'Ejemplo:1234567'" placeholder="Ejemplo:1234-1234567" onKeyPress="return telefono(event)" onchange="validarTLF_M()" onclick="validarTLF_M()" onkeyup="validarTLF_M()"/>
                                      <div class="promts"><span id="num_contactoM"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    </td>
                                    
                                    <td class="tit">
                                      <label><b>Fecha de Nacimiento:</b></label><br>
                                      <input type="text" name="fecha_nacM" id="fecha_nacM" maxlength="10" size="16" placeholder="Ejemplo:Dia/Mes/Año" title="Seleccione la fecha de nacimiento de la persona 'Ejemplo:10/02/1980'" placeholder="Ejemplo:Dia/Mes/Año" onclick="validarFECHA_M()" onchange="validarFECHA_M()" onkeyup="validarFECHA_M()"/>
                                      <div class="promts2"><span id="fecha_nacimientoM"></span></div>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    </td>
                                  
                                  </tr>

                                  <tr>
                                    <td colspan="3" class="tit">
                                      <div id="ocultarDedicacionM">
                                        <label><b>Dedicación:</b></label><br>
                                        <select id="dedicacionM" name='dedicacionM' title="Seleccione la Dedicación del Profesor" onchange="validarDEDICACION_M()">
                                          <option> </option>
                                          <option>Tiempo Completo/Dedicación Exclusiva</option>
                                          <option>Medio Tiempo</option>
                                          <option>Tiempo Convencional</option>
                                        </select>
                                        <div class="promts2"><span id="DedicacionM"></span></div>
                                        <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      </div>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td colspan="3" align="center">
                                      <h3><div id="salidaM_PER"></div></h3>
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

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_personal" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar a esta persona?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_personal">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Personal()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                              </fieldset>
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- detalle Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_persona" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Detalle de la Persona</h4>
                          </div>
                          <div class="modal-body">

                                  <div id="detalle_per"></div>
                          
                          </div>
                          <div class="modal-footer">
                                                      
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End detalle modal -->  

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_personal" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Registro de personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha registrado la persona con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->

                    <!-- modificacion exito modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_exito" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificación de personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado la persona con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion exito modal -->

                    <!-- error ci modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_ci" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Registro de personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La Cedula de Identidad ingresada ya existe!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End error ci modal -->

                    <!-- modificacion error modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_error" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La Cedula de Identidad ingresada ya existe!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End modificacion error modal -->

                    <!-- Eliminar persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_per" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Eliminar personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La persona a sido eliminada con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar persona modal -->


                    <!-- sexo modificacion modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="sexoM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="alert">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Seleccione el sexo de la persona!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End sexo modificacion modal -->


                    <!-- correo electronico modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_correo" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Registro de Personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡El correo electronico ya existe, ingrese otro correo!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End correo electronico modal -->

                    <!-- correo electronico modificacion modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_correoM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡El correo electronico ya existe, ingrese otro correo!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End correo electronico modificacion modal -->

                    <!-- reporte personal modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rep_per" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Reporte de Personal</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted está seguro que desea generar el reporte del personal?</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="reporte_Personal()" data-dismiss="modal" >Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End reporte personal modal -->
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
    <script type="text/javascript" src="js/vali_per.js"></script>

    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/lang/es.js"></script>

    <script type="text/javascript" src="funciones.js"></script>

</body>
</html>
<?php

$correo=$_REQUEST['correo'];

  if ($correo=='error')
  {
?>
<script type="text/javascript">
    
    N_personal()

    $('#error_correo').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

  $correo=$_REQUEST['correo'];

  if ($correo=='errorM')
  {
?>
<script type="text/javascript">
    
    $('#error_correoM').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }

$registro=$_REQUEST['registro'];

  if ($registro=='personal')
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

$modificacion=$_REQUEST['modificacion'];

  if ($modificacion=='si')
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

$error=$_REQUEST['error'];

  if ($error=='ci')
  {
?>
<script type="text/javascript">
    
    N_personal()

    $('#error_ci').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php
  }

  if ($error=='ciM')
  {
?>
<script type="text/javascript">
    
    $('#modificar_error').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php
  }

$elim_per=$_REQUEST['elim_per'];

  if ($elim_per=='si')
  {
?>
<script type="text/javascript">
    
    $('#elim_per').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php
  }
?>