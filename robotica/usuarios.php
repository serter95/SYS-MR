<?php
  require('seguridad.php');
  require('conexion.php');

  $query=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.id_tipo_usuario=t.id_tipo AND u.estatus=1
    AND t.estatus=1 AND u.nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=2");
    
  $array=pg_fetch_assoc($query);

  if ($array['priv_usuarios']=='no')
  {
    header('Location:index.php?permiso=negativo');
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

    </script>
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

            <div id="miGestionUsuario">

                  <h4><a href="#">Configuración</a> > <a href="#">Usuarios</a></h4>
                    
                  <div class="info3">
                    <div id="text_center_title">
                        <span class="t-menu">Consulta de usuarios</span>
                    </div><br>

                      <p id="agregar_usu"><button class="btn btn-success" onclick="N_usuario()">Nuevo Usuario &nbsp; <i class="fa fa-plus"></i></button></p> 

                        <div  id="tabla_usuario">

                          <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                <tr>
                                  <th>Nombre de usuario</th>
                                  <th>Tipo</th>
                                  <th>Cuenta</th>
                                  <th>Acciones</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                        $sql="SELECT * FROM tipo_usuario INNER JOIN (usuario INNER JOIN personal
                                          ON usuario.id_personal = personal.id AND area='Robotica' AND personal.estatus=1) 
                                          ON tipo_usuario.id_tipo = usuario.id_tipo_usuario AND tipo_usuario.visible=1 AND
                                          tipo_usuario.estatus = 1 AND usuario.estatus = 1";
                                        $query=pg_query($sql);

                                        while ($array=pg_fetch_assoc($query))
                                        {
                                          if ($array['bloqueo']==0)
                                          {
                                            $cuenta='Activa';
                                          }
                                          else
                                          {
                                            $cuenta='Bloqueada';
                                          }
                                ?>
                                <tr class="odd gradeX">
                                  <td align="center"><?php echo $array['nom_usuario'];?></td>
                                  <td align="center"><?php echo $array['tipo'];?></td>
                                  <td align="center"><?php echo $cuenta;?></td>
                                  <td align="center">
                                    <a href="javascript:editar_usuario(<?php echo $array['id_usu'];?>);">
                                      <button class="btn btn-default" title="Modificar">
                                        <span class="fa fa-edit"></span>
                                      </button>
                                    </a>

                                    <a href="javascript:eliminarUsuario(<?php echo $array['id_usu'];?>);">
                                      <button class="btn btn-default" title="Eliminar">
                                        <span class="fa fa-trash-o"></span>
                                      </button>
                                    </a>
                                    
                                    <a href="javascript:detalleUsuario(<?php echo $array['id_usu'];?>);">                
                                      <button class="btn btn-default" title="Ver">
                                        <span class="fa fa-search-plus"></span>
                                      </button>
                                    </a>

                                    <?php
                                      if ($cuenta=='Bloqueada')
                                      {
                                    ?>
                                      <a href="javascript:desbloquearUsuario(<?php echo $array['id_usu'];?>);">                
                                        <button class="btn btn-default" title="Desbloquear">
                                          <span class="fa fa-unlock"></span>
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
                    </div>

            <div id="ru">

              <h4><a>Configuración</a> > <a href="usuarios.php">Usuarios</a> > <a href="#">Nuevo Usuario</a></h4>

              <div class="info2">
                <form action="registro_usuario.php" method="post" id="reg_usu" name="reg_usu" onSubmit="return validarR_USU()">

                <div id="text_center_title">
                  <span class="t-menu">Registro del Usuario</span>
                </div>
                
                <table align="center" width="100%">   
                  <tr>
                    <td class="tit" colspan="3">

                      <input type="hidden" name="validar_ci_usu_ajax" id="validar_ci_usu_ajax" onchange="validarCI_USU()"/>

                      <label><b>Cédula de Identidad:</b></label><br>
                      <select id="nac_usu" name="nac_usu" title="Seleccione la nacionalidad de la persona" onChange="validarNAC_USU()">
                        <option></option>
                        <option>V-</option>
                        <option>E-</option>
                      </select>
                      <input type="text" name="ci_usu" id="ci_usu" maxlength="9" size="15" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona 'Ejemplo:12345678'" onkeypress="return solonum(event)" onclick="validarCI_USU(), personal()" onkeyup="validarCI_USU(), personal()" onchange="validarCI_USU(), personal()"/>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="C.I_usuario"></span></div>
                
                    </td>              
                  </tr>  
                         
                  <tr>
                    <td class="tit">
                      <label><b>Nombres:</b></label><br>
                      <input readonly="readonly" type="text" name="nombres_usu" id="nombres_usu" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>      
                    </td>

                    <td class="tit">
                      <label><b>Apellidos:</b></label><br>
                      <input readonly="readonly" type="text" name="apellidos_usu" id="apellidos_usu" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
                    </td>

                    <input type="hidden" name="validar_nom_usu_ajax" id="validar_nom_usu_ajax"/>

                    <td class="tit">
                      <label><b>Nombre del usuario:</b></label><br>
                      <input type="text" name="nombre_usuario" id="nombre_usuario" maxlength="15" placeholder="Ejemplo:jorge_rodriguez87" title="Coloque el nombre del usuario 'Ejemplo:jorge_rodriguez87'" onclick="validarNOM_USU()" onkeypress="return nombre_usu(event)" onkeyup="validarNOM_USU()"/>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_nom_usu"></span></div>
                    </td>
                               
                  </tr>
                                        
                  <tr>
                    <td class="tit">
                      <label><b>Contraseña:</b></label><br>
                      <input type="password" name="contrasena_usuario" id="contrasena_usuario" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Coloque la contraseña del usuario 'Ejemplo:jrodriguez87'" onclick="validarCONTRASENA_USU()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU()"/>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_contrasena"></span></div>
                    </td>

                    <td class="tit">
                      <label><b>Repita Contraseña:</b></label><br>
                      <input type="password" name="contrasena2_usuario" id="contrasena2_usuario" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Repita la contraseña del usuario 'Ejemplo:jrodriguez87'" onclick="validarCONTRASENA_USU2()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU2()"/>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_contrasena2"></span></div>
                    </td>
                                        
                    <td class="tit">        
                      <label><b>Tipo:</b></label><br>
                      <select id="tipo" name="tipo" title="Seleccione el tipo de usuario" onchange="validarTIPO()">
                        <option> </option>
                        <?php
                          $sqll="SELECT * FROM tipo_usuario WHERE area In ('Robotica' , 'Doble') AND estatus=1 AND visible=1";
                          $queryy=pg_query($sqll);

                          while ($arrayy=pg_fetch_assoc($queryy))
                          {
                        ?>
                            <option><?php echo $arrayy['tipo'];?></option>
                        <?php    
                          }
                        ?>
                        <option>Otro...</option>
                      </select>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_tipo"></span></div>
                    </td>
                                
                  </tr>

                  <tr>
                    <td colspan="3" class="tit">
                      <label><b>Pregunta Secreta:</b></label><br>
                      <textarea id="pregunta" name="pregunta" placeholder="Ejemplo:Animal favorito" title="Coloque la Pregunta Secreta para recuperar sus datos 'Ejemplo:Animal favorito'" onkeypress="return letra_num(event)" onclick="validarPREGUNTA()" onkeyup="validarPREGUNTA()"></textarea>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_pregunta"></span></div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" class="tit">
                      <label><b>Respuesta Secreta:</b></label><br>
                      <textarea id="respuesta" name="respuesta" placeholder="Ejemplo:El terodactilo" title="Coloque la Respuesta Secreta para recuperar sus datos 'Ejemplo:El Terodactilo'" onkeypress="return letra_num(event)" onclick="validarRESPUESTA()" onkeyup="validarRESPUESTA()"></textarea>
                      <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                      <div class="promts_usu"><span id="vali_respuesta"></span></div>
                    </td>
                  </tr>

                  <tr>
                    <td colspan="3" align="center">
                      <h3><div id="salidaR_USU"></div></h3>
                    </td>
                  </tr>
                          <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                               
                  <tr>
                    <td colspan="3" class="tit" >
                      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"/>&nbsp;
                      <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar"/>
                    </td>
                  </tr>
                              
                </table>
              </form>
            </div>
            <!--info2-->
            </div>
                
                    <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <form action="modifica_usuario.php" method="post" id="mod_usu" name="mod_usu" onSubmit="return validarM_USU()">

                              <input type="hidden" id="id" name="id"/> <br> <!--ID DEL USUARIO-->

                              <table align="center" width="100%">   
                                <tr>

                                  <input type="hidden" name="validar_ci_usu_ajaxM" id="validar_ci_usu_ajaxM" onchange="validarCI_USU_M()"/>
                                        
                                  <td colspan="3" class="tit">

                                    <input type="hidden" name="nac_usuM" id="nac_usuM2">

                                    <label><b>Cédula de Identidad:</b></label><br>
                                    <select disabled id="nac_usuM" onChange="validarNAC_USU_M()">
                                      <option> </option>
                                      <option>V-</option>
                                      <option>E-</option>
                                    </select>
                                    <input readonly type="text" name="ci_usuM" id="ci_usuM" onblur="personalM()" maxlength="9" size="15" placeholder="Ejemplo:12345678" onkeypress="return solonum(event)" onclick="validarCI_USU_M()" onkeyup="validarCI_USU_M()" onchange="validarCI_USU_M()"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="C.I_usuario_M"></span></div>
                                  </td>
                                </tr>

                                <tr>        
                                  <td class="tit">
                                    <label><b>Nombres:</b></label><br>
                                    <input readonly="readonly" type="text" name="nombres_usuM" id="nombres_usuM" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>
                                    <span id="nombres"></span>      
                                  </td>

                                  <td class="tit">
                                    <label><b>Apellidos:</b></label><br>
                                    <input readonly="readonly" type="text" name="apellidos_usuM" id="apellidos_usuM" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
                                    <span id="apellidos"></span>      
                                  </td>

                                  <input type="hidden" name="validar_nom_usu_ajax" id="validar_nom_usu_ajaxM"/>

                                  <td class="tit">
                                    <label><b>Nombre del usuario:</b></label><br>
                                    <input type="text" name="nombre_usuarioM" id="nombre_usuarioM" maxlength="30" placeholder="Ejemplo:jorge_rodriguez87" title="Coloque el nombre del usuario 'Ejemplo:jorge_rodriguez87'" onclick="validarNOM_USU_M()" onkeypress="return nombre_usu(event)" onkeyup="validarNOM_USU_M()"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="vali_nom_usu_M"></span></div>
                                  </td>

                                </tr>
                                        
                                <tr>

                                  <td class="tit">
                                    <label><b>Contraseña:</b></label><br>
                                    <input type="password" name="contrasena_usuarioM" id="contrasena_usuarioM" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Coloque la contraseña del usuario 'Ejemplo:jrodriguez87'" onclick="validarCONTRASENA_USU_M()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU_M()"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="vali_contrasena_M"></span></div>
                                  </td>

                                  <td class="tit">
                                    <label><b>Repita Contraseña:</b></label><br>
                                    <input type="password" name="contrasena2_usuarioM" id="contrasena2_usuarioM" maxlength="21" placeholder="Ejemplo:jrodriguez87" title="Repita la contraseña del usuario 'Ejemplo:jrodriguez87'" onclick="validarCONTRASENA_USU2_M()" onkeypress="return contrasena(event)" onkeyup="validarCONTRASENA_USU2_M()"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="vali_contrasena2_M"></span></div>
                                  </td>
                                        
                                  <td class="tit">        
                                    <label><b>Tipo:</b></label><br>
                                    <select id="tipoM" name="tipoM" title="Seleccione el tipo de usuario" onchange="validarTIPO_M()">
                                      <option> </option>
                                      <?php
                                        $sqll="SELECT * FROM tipo_usuario WHERE area In ('Robotica' , 'Doble') AND estatus=1 AND visible=1";
                                        $queryy=pg_query($sqll);

                                        while ($arrayy=pg_fetch_assoc($queryy))
                                        {
                                      ?>
                                          <option><?php echo $arrayy['tipo'];?></option>
                                      <?php    
                                        }
                                      ?>
                                      <option>Otro...</option>
                                    </select>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p> 
                                    <div class="promts_usu"><span id="vali_tipoM"></span></div>
                                  </td>

                                </tr>

                                <tr>
                                  <td colspan="3" class="tit">
                                    <label><b>Pregunta Secreta:</b></label><br>
                                    <textarea id="preguntaM" name="preguntaM" placeholder="Ejemplo:Animal favorito" title="Coloque la Pregunta Secreta para recuperar sus datos 'Ejemplo:Animal favorito'" onkeypress="return letra_num(event)" onclick="validarPREGUNTA_M()" onkeyup="validarPREGUNTA_M()"></textarea>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="vali_preguntaM"></span></div>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="3" class="tit">
                                    <label><b>Respuesta Secreta:</b></label><br>
                                    <textarea id="respuestaM" name="respuestaM" placeholder="Ejemplo:El terodactilo" title="Coloque la Respuesta Secreta para recuperar sus datos 'Ejemplo:El Terodactilo'" onkeypress="return letra_num(event)" onclick="validarRESPUESTA_M()" onkeyup="validarRESPUESTA_M()"></textarea>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts_usu"><span id="vali_respuestaM"></span></div>
                                  </td>
                                </tr>

                                <tr>
                                  <td colspan="3" align="center">
                                    <h3><div id="salidaM_USU"></div></h3>
                                  </td>
                                </tr>
                                        <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
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

                    <!-- eliminar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea eliminar este usuario?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_elim_usuario">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Usuario()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End eliminar modal -->

                    <!-- desbloquear modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="desbloq_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">¿Usted esta seguro que desea desbloquear este usuario?</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <input type="hidden" id="aceptar_desbloq_usuario">
                                                    
                            <button class="btn btn-primary" title="Aceptar" onclick="desbloquear_Usuario()">Aceptar</button>
                            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End desbloquear modal -->

                    <!-- detalle Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Detalle del Usuario</h4>
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

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Registro del Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Usuario registrado con exito¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->

                    <!-- registro modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="desbloq_usu" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Desbloquear Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Usuario Desbloqueado con exito¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modal -->    

                    <!-- nom_usuario modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mal_nom_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Registro del Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!El nombre de usuario ya existe¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End nom_usuario modal -->

                    <!-- id_persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="id_persona" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Registro del Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Esta persona ya posee una cuenta de usuario¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End id_persona modal -->                    

                    <!-- mala contraseña modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mala_contrasena" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Registro del Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Las contraseñas del usuario no coinciden¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End mala contraseña modal -->

                    <!-- mala contraseña modificar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mala_contrasenaM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Las contraseñas del usuario no coinciden¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End mala contraseña modificar modal -->

                    <!-- registro modificar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_usuarioM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Usuario editado con exito¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End registro modificar modal -->

                    <!-- nom_usuario modificar modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="mal_nom_usuarioM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!El nombre de usuario ya existe¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End nom_usuario modificar modal -->

                    <!-- id_persona modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="id_personaM" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="confirm">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Registro del Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Esta persona ya posee una cuenta de usuario¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End id_persona modal -->

                    <!-- Eliminar usuario modal-->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_usu" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header" id="exito">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Eliminar Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <h4 align="center">!Usuario eliminado con exito¡</h4>                            
                          
                          </div>
                          <div class="modal-footer">

                            <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Eliminar usuario modal -->
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
    
    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

    <script src="js/jquery-ui.js"></script>

    <!--script src="assets/js/jquery-1.8.3.min.js"></script-->
    
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
    <script type="text/javascript" src="js/vali_usuario.js"></script>

</body>
</html>
<?php
  $registro=$_REQUEST['registro'];

  if ($registro=='usuario')
  {
?>
  <script type="text/javascript">
    
    $('#reg_usuario').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php 
  }

  if ($registro=='usuarioM')
  {
?>
  <script type="text/javascript">
    
    $('#reg_usuarioM').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php 
  }

  $error=$_REQUEST['error'];
 
  if ($error=='nom_usuario')
  {
?>
  <script type="text/javascript">
    
    $('#mal_nom_usuario').modal({
      show:true,
      backdrop:'static'
    });

    N_usuario()
  
  </script>
<?php 
  }

  if ($error=='nom_usuarioM')
  {
?>
  <script type="text/javascript">
    
    $('#mal_nom_usuarioM').modal({
      show:true,
      backdrop:'static'
    });

  </script>
<?php 
  }

  if ($error=='id_persona')
  {
?>
  <script type="text/javascript">
    
    $('#id_persona').modal({
      show:true,
      backdrop:'static'
    });

    N_usuario()
  
  </script>
<?php 
  }

   if ($error=='id_personaM')
  {
?>
  <script type="text/javascript">
    
    $('#id_personaM').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php 
  }

  if ($error=='contrasena')
  {
?>
  <script type="text/javascript">
    
    $('#mala_contrasena').modal({
      show:true,
      backdrop:'static'
    });

    N_usuario()
  
  </script>
<?php 
  }

  if ($error=='contrasenaM')
  {
?>
  <script type="text/javascript">
    
    $('#mala_contrasenaM').modal({
      show:true,
      backdrop:'static'
    });

  </script>
<?php 
  }

  $elim_usu=$_REQUEST['elim_usu'];

  if ($elim_usu=='si')
  {
?>
  <script type="text/javascript">
    
    $('#elim_usu').modal({
      show:true,
      backdrop:'static'
    });

  </script>
<?php 
  }

    if ($_REQUEST['desbloq_usu']=='si')
  {
?>
  <script type="text/javascript">
    
    $('#desbloq_usu').modal({
      show:true,
      backdrop:'static'
    });

  </script>
<?php 
  }  
?>