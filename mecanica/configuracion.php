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
                <br>
                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Configuración de Cuenta</span>
                  </div><br>

                  <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover">                    
                      <thead>
                        <tr>
                          <th>Nombre de usuario</th>
                          <th>Tipo</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php


                         $query=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.estatus=1 AND t.estatus=1
                          AND u.id_tipo_usuario=t.id_tipo AND nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=1");
                         $array=pg_fetch_assoc($query);

                         $num=strlen($array['contrasena']);
                      ?>
                        <tr class="odd gradeX">
                          <td align="center"><?php echo $array['nom_usuario'];?></td>
                          <td align="center"><?php echo $array['tipo'];?></td>
                          <td align="center">
                            <a href="javascript:editar_configuracion(<?php echo $array['id_usu'];?>);">
                              <button class="btn btn-default" title="Modificar">
                                <span class="fa fa-edit"></span>
                              </button>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>C.I</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql="SELECT * FROM personal p, usuario u WHERE p.estatus=1 AND u.estatus=1 AND
                              p.id=u.id_personal AND nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=1";
                              $query=pg_query($sql);

                              while ($array=pg_fetch_assoc($query))
                              {

                                $fe=explode('-', $array['fecha_nacimiento']);
                                $fecha=$fe[2].'/'.$fe[1].'/'.$fe[0];
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['ci'];?></td>
                              <td align="center"><?php echo $array['nombres'];?></td>
                              <td align="center"><?php echo $array['apellidos'];?></td>
                              <td rowspan="3" align="center">
                                   
                                <a href="javascript:editar_configuracionPer(<?php echo $array['id'];?>);">
                                  <button style="margin-top:25%;" class="btn btn-default" title="Modificar">
                                    <span class="fa fa-edit"></span>
                                  </button>
                                </a>
                            
                              </td>
                            </tr>

                            <tr> 
                              <th>Correo</th>
                              <th>Número de contacto</th>
                              <th>Fecha de Nacimiento</th>
                            </tr>
                          
                            <tr>
                              <td align="center"><?php echo $array['correo'];?></td>
                              <td align="center"><?php echo $array['numero_contacto'];?></td>
                              <td align="center"><?php echo $fecha; ?></td>
                            </tr>
                            <?php
                              }
                            ?>
                            </tbody>
                          </table>
                  </div>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_configuracion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Cuenta</h4>
                      </div>
                      <div class="modal-body">

                        <form action="modificar_configuracion.php" method="post" id="mod_cuenta" name="mod_cuenta" onSubmit="return validarC_CUENTA()">

                          <input type="hidden" id="id_usu" name="id_usu"/> <br> <!--ID DEL USUARIO-->

                          <input type="hidden" id="validar_nom_usu_ajaxC" name="validar_nom_usu_ajaxC"/>

                          <table align="center" width="100%">   

                            <tr>        

                              <td class="tit">
                                <label><b>Nombre del usuario:</b></label><br>
                                <input type="text" name="nombre_usuarioC" id="nombre_usuarioC" maxlength="30" placeholder="Ejemplo:jorge_rodriguez87" title="Coloque el nombre del usuario" onclick="validarNOM_USU_C()" onkeypress="return nombre_usu(event)" onkeyup="validarNOM_USU_C()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts_usu"><span id="vali_nom_usu_C"></span></div>
                              </td>

                              <td class="tit">
                                <label><b>Contraseña:</b></label><br>
                                <input type="password" name="contrasena_usuarioC" id="contrasena_usuarioC" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Coloque la contraseña del usuario" onclick="validarCONTRASENA_USU_C()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU_C()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts_usu"><span id="vali_contrasena_C"></span></div>
                              </td>

                              <td class="tit">
                                <label><b>Repita Contraseña:</b></label><br>
                                <input type="password" name="contrasena2_usuarioC" id="contrasena2_usuarioC" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Repita la contraseña del usuario" onclick="validarCONTRASENA_USU2_C()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU2_C()"/>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts_usu"><span id="vali_contrasena2_C"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" class="tit">
                                <label><b>Pregunta Secreta:</b></label><br>
                                <textarea id="preguntaC" name="preguntaC" placeholder="Ejemplo:Animal favorito" onkeypress="return letraNum(event)" onclick="validarPREGUNTA_C()" onkeyup="validarPREGUNTA_C()"></textarea>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts_usu"><span id="vali_pregunta_C"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" class="tit">
                                <label><b>Respuesta Secreta:</b></label><br>
                                <textarea id="respuestaC" name="respuestaC" placeholder="Ejemplo:El terodactilo" onkeypress="return letraNum(event)" onclick="validarRESPUESTA_C()" onkeyup="validarRESPUESTA_C()"></textarea>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts_usu"><span id="vali_respuesta_C"></span></div>
                              </td>
                            </tr>

                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaC_USU"></div></h3>
                              </td>
                            </tr>
                                                            <tr>
                        <td  colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>  
                            <tr>
                              <td colspan="3" class="tit" >
                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"/>&nbsp;
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
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_configuracionPersonal" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Datos Personales</h4>
                          </div>
                          <div class="modal-body">

                            <form action="modificar_configuracion_personal.php" method="post" id="mod_c_p" name="mod_c_p" onSubmit="return validarCUENTA_PER()">

                                <input type="hidden" id="id" name="id"/> <br> <!--ID DEL USUARIO-->

                                <table align="center" width="100%">   
                                  <tr>

                                    <input type="hidden" name="validar_ci_usu_ajaxC" id="validar_ci_usu_ajaxC" onchange="validarCI_C()"/>
                                                        
                                    <td class="tit">

                                      <label><b>Cédula de Identidad:</b></label><br>
                                      <select name="nac_usuC" id="nac_usuC" title="Seleccione la nacionalidad de la persona" onChange="validarNAC_C()">
                                        <option> </option>
                                        <option>V-</option>
                                        <option>E-</option>
                                      </select>
                                      <input type="text" name="ci_usuC" id="ci_usuC" maxlength="9" size="15" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona" onkeypress="return telefono(event)" onclick="validarCI_C()" onkeyup="validarCI_C()"/>
                                       <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts_usu"><span id="ci_usu_C"></span></div>
                                    </td>
                                         
                                    <td class="tit">
                                      <label><b>Nombres:</b></label><br>
                                      <input type="text" name="nombres_usuC" id="nombres_usuC" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona" onkeypress="return soloLetras(event)" onclick="validarNOM_C()" onkeyup="validarNOM_C()"/>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts2"><span id="nombresC"></span></div>      
                                    </td>

                                    <td class="tit">
                                      <label><b>Apellidos:</b></label><br>
                                      <input type="text" name="apellidos_usuC" id="apellidos_usuC" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona" onkeypress="return soloLetras(event)" onclick="validarAPE_C()" onkeyup="validarAPE_C()"/>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts2"><span id="apellidosC"></span></div>      
                                    </td>
                                  </tr>
                                  
                                  <tr>                      
                                    <td class="tit">
                                      <label><b>Email:</b></label><br>
                                      <input type="text" name="correoC" id="correoC" maxlength="50" placeholder="Ejemplo:correo@ejemplo.com" onchange="validarCORREO_C()" onclick="validarCORREO_C()" onkeyup="validarCORREO_C()"/>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts"><span id="correoE_C"></span></div>
                                    
                                      <input type="hidden" id="validar_correo_ajaxC" name="validar_correo_ajaxC"/>

                                    </td>
                                  
                                    <td class="tit">
                                      <label><b>Celular:</b></label><br>
                                      <select name="cod_tlfC" id="cod_tlfC" onChange="validarTLF_C()">
                                        <option> </option>
                                        <option>0416-</option>
                                        <option>0426-</option>
                                        <option>0414-</option>
                                        <option>0424-</option>
                                        <option>0412-</option>
                                      </select>
                                      <input type="text" name="num_contC" id="num_contC" maxlength="7" size="12" placeholder="Ejemplo:1234-1234567" onKeyPress="return telefono(event)" onchange="validarTLF_C()" onclick="validarTLF_C()" onkeyup="validarTLF_C()"/>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts"><span id="num_contactoC"></span></div>
                                    </td>
                                    
                                    <td class="tit">
                                      <label><b>Fecha de Nacimiento:</b></label><br>
                                      <input type="text" name="fecha_nacC" id="fecha_nacC" maxlength="10" size="16" placeholder="Ejemplo:Dia/Mes/Año" onclick="validarFECHA_C()" onchange="validarFECHA_C()" onkeyup="validarFECHA_C()"/>
                                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                      <div class="promts2"><span id="fecha_nacimientoC"></span></div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="3" align="center">
                                      <h3><div id="salidaC_PER"></div></h3>
                                    </td>
                                  </tr>
                                                              <tr>
                        <td  colspan="3" align="right">
                          <div style="margin-bottom:2%; "><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                  <tr>
                                    <td colspan="3" class="tit" >
                                      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"/>&nbsp;
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

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_exito" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="cerrarSesion()" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Cuenta</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Se ha modificado su cuenta con exito. Su Sesión será finalizada por medidas de seguridad!</h4>
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar" onclick="cerrarSesion()">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_exito_no" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Cuenta</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Las contraseñas son diferentes!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_datos" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Datos Personales</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡Sus datos personales se han modificado con exito!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_datos_no" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                              <h4 class="modal-title">Modificar Datos Personales</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¡La cedula de identidad ya existe!</h4>                            
                                          
                          </div>
                          <div class="modal-footer">
                                                    
                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                  
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->
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
      <br>
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
    <script type="text/javascript" src="js/vali_per.js"></script>

</body>
</html>
<?php

$registro=$_REQUEST['exito'];

  if ($registro=='si')
  {
?>
<script type="text/javascript">
    
    $('#reg_exito').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }
  if ($registro=='no')
  {
?>
<script type="text/javascript">
    
    $('#reg_exito_no').modal({
            show:true,
            backdrop:'static'
        });
</script>    
<?php  
  }

  $datos=$_REQUEST['datos'];

  if ($datos=='si')
  {
?>
<script type="text/javascript">
    
    $('#reg_datos').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
  }
  if ($datos=='no')
  {
?>
<script type="text/javascript">
    
    $('#reg_datos_no').modal({
            show:true,
            backdrop:'static'
        });
</script>    
<?php  
  }
?>