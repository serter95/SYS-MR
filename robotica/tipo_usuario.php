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

                <div id="consulta_tipo_usuario">

                    <h4><a>Configuración</a> > <a href="usuarios.php">Usuarios</a> > <a href="tipo_usuario.php">Tipo de Usuarios</a></h4>

                      <div class="info3">
                        <div id="text_center_title">
                            <span class="t-menu">Consulta de Tipo de Usuarios</span>
                        </div><br>

                          <p id="agregar_usu"><button class="btn btn-success" onclick="N_tipo_usuario()">Nuevo Tipo &nbsp; <i class="fa fa-plus"></i></button></p> 

                            <div id="tabla_usuario">

                              <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                  <thead>
                                    <tr>
                                      <th>Nombre del tipo de usuario</th>
                                      <th>Acciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                    $sql="SELECT * FROM tipo_usuario WHERE area In ('Robotica') AND estatus=1 AND visible=1";
                                    $query=pg_query($sql);

                                    while ($array=pg_fetch_assoc($query))
                                    {
                                  ?>
                                    <tr class="odd gradeX">
                                      <td align="center"><?php echo $array['tipo'];?></td>
                                      <td align="center">
                                        
                                        <a href="javascript:editar_tipo_usuario(<?php echo $array['id_tipo'];?>);">
                                          <button class="btn btn-default" title="Modificar">
                                            <span class="fa fa-edit"></span>
                                          </button>
                                        </a>

                                        <?php
                                            $con=pg_query("SELECT * FROM usuario WHERE id_tipo_usuario='".$array['id_tipo']."' AND estatus=1 AND taller=2");
                                            $num=pg_num_rows($con);

                                            if ($num==0)
                                            {
                                        ?>
                                              <a href="javascript:eliminar_tipo(<?php echo $array['id_tipo'];?>);">
                                                <button class="btn btn-default" title="Eliminar">
                                                  <span class="fa fa-trash-o"></span>
                                                </button>
                                              </a>
                                        <?php
                                            }
                                        ?>
                                        
                                        <a href="javascript:detalleTipoUsuario(<?php echo $array['id_tipo'];?>);">                
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
                
                <div id="registro_tipo_usu">

                  <h4><a>Configuración</a> > <a href="usuarios.php">Usuarios</a> > <a href="tipo_usuario.php">Tipo de Usuarios</a> > <a href="#">Nuevo Tipo</a></h4>

                  <div class="info2">
                    <div id="text_center_title">
                      <span class="t-menu">Registro de Tipo de Usuario</span>
                    </div>

                    <form action="registro_tipo_usu.php" method="POST" id="reg_tipo_usu" name="reg_tipo_usu" onsubmit="return validarR_TIPO()">

                      <div class="panel panel-default">
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#datos1" data-toggle="tab"><h4>Académico</h4></a></li>
                                <li><a href="#datos2" data-toggle="tab"><h4>Administrativo</h4></a></li>
                                <li><a href="#datos3" data-toggle="tab"><h4>Configuración</h4></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="datos1">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                
                                              <table width="100%">
                                                <tr>  
                                                  <td class="tit">

                                                    <input type="hidden" id="validar_nom_tipo_usu" name="validar_nom_tipo_usu"/>

                                                    <br>
                                                    <label><b>Nombre del tipo de usuario:</b></label>
                                                    <input type="text" id="nombre_tipo" name="nombre_tipo" maxlength="30" placeholder="Ejemplo:Becario1" title="Ingrese el nombre del tipo de usuario Ejemplo:Becario1" onkeypress="return letra_num(event)" onclick="validarNOM_TIPO_USUARIO()" onkeyup="validarNOM_TIPO_USUARIO()"/>
                                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                                    <div class="promts_usu"><span id="nombre_tipo_usu"></span></div>
                                                  </td>
                                                </tr>
                                              </table>
                                              <br>
                                                  <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                      <h4 align="center">Privilegios Académicos:</h4>
                                                    </div>
                                                    <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                        <div class="table-responsive">
                                                          <table class="table table-hover">
                                                            <thead>
                                                              <tr>
                                                                <th>Sub-Modulo</th>
                                                                <th>Agregar</th>
                                                                <th>Eliminar</th>
                                                                <th>Modificar</th>
                                                                <th>Imprimir</th>
                                                                <th>Todos</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                <td>Horarios</td>
                                                                <td><input id="pach1" type="checkbox" name="pach1" value="A"/></td>
                                                                <td><input id="pach2" type="checkbox" name="pach2" value="E"/></td>
                                                                <td><input id="pach3" type="checkbox" name="pach3" value="M"/></td>
                                                                <td><input id="pach4" type="checkbox" name="pach4" value="I"/></td>
                                                                <td><input id="pach5" type="checkbox" name="pach5" value="T" /></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Proyectos</td>
                                                                <td><input id="pacp1" type="checkbox" name="pacp1" value="A"/></td>
                                                                <td><input id="pacp2" type="checkbox" name="pacp2" value="E"/></td>
                                                                <td><input id="pacp3" type="checkbox" name="pacp3" value="M"/></td>
                                                                <td><input id="pacp4" type="checkbox" name="pacp4" value="I"/></td>
                                                                <td><input id="pacp5" type="checkbox" name="pacp5" value="T" /></td>
                                                              </tr>
                                                              <tr>
                                                                <td>Convenios</td>
                                                                <td><input id="paconv1" type="checkbox" name="paconv1" value="A"/></td>
                                                                <td><input id="paconv2" type="checkbox" name="paconv2" value="E"/></td>
                                                                <td><input id="paconv3" type="checkbox" name="paconv3" value="M"/></td>
                                                                <td><input id="paconv4" type="checkbox" name="paconv4" value="I"/></td>
                                                                <td><input id="paconv5" type="checkbox" name="paconv5" value="T" /></td>
                                                              </tr>
                                                            </tbody>
                                                             <tr>
                        <td  colspan="6" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                                          </table>
                                                        </div>
                                                        <!-- /.table-responsive -->
                                                      </div>
                                                      <!-- /.panel-body -->
                                                    </div>
                                                    <!-- /.panel -->

                                            </div>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                                <div class="tab-pane fade" id="datos2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                
                                              <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 align="center">Privilegios Administrativos:</h4>
                                        </div>
                                        <!-- /.panel-heading -->
                                          <div class="panel-body">
                                            <div class="table-responsive">
                                              <table class="table table-hover">
                                                <thead>
                                                  <tr>
                                                    <th>Sub-Modulo</th>
                                                    <th>Agregar</th>
                                                    <th>Eliminar</th>
                                                    <th>Modificar</th>
                                                    <th>Imprimir</th>
                                                    <th>Todos</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>Inventario</td>
                                                    <td><input id="padi1" type="checkbox" name="padi1" value="A"/></td>
                                                    <td><input id="padi2" type="checkbox" name="padi2" value="E"/></td>
                                                    <td><input id="padi3" type="checkbox" name="padi3" value="M"/></td>
                                                    <td><input id="padi4" type="checkbox" name="padi4" value="I"/></td>
                                                    <td><input id="padi5" type="checkbox" name="padi5" value="T"/></td>
                                                  </tr>
                                                  
                                                  <tr>
                                                    <td>Personal</td>
                                                    <td><input id="padp1" type="checkbox" name="padp1" value="A"/></td>
                                                    <td><input id="padp2" type="checkbox" name="padp2" value="E"/></td>
                                                    <td><input id="padp3" type="checkbox" name="padp3" value="M"/></td>
                                                    <td><input id="padp4" type="checkbox" name="padp4" value="I"/></td>
                                                    <td><input id="padp5" type="checkbox" name="padp5" value="T"/></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                          </div>
                                          <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->

                                      </div>
                                      <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                  </div>
                                  <!-- /.panel -->
                                </div>
                                        <div class="tab-pane fade" id="datos3">
                                          <div class="panel panel-default">
                                              <div class="panel-body">
                                                  <div class="table-responsive">
                                                      
                                                    <div class="panel panel-default">
                                                      <div class="panel-heading">
                                                        <h4 align="center">Privilegios de Configuración:</h4>
                                                      </div>
                                                      <!-- /.panel-heading -->
                                                       <div class="panel-body">
                                                        <div class="table-responsive">
                                                          <table class="table table-hover">
                                                            <thead>
                                                              <tr>
                                                                <th>Sub-Modulo</th>
                                                                <th>Si</th>
                                                                <th>No</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                <td>Usuarios</td>
                                                                <td><input id="pconusi" type="radio" name="pconu" value="si"/></td>
                                                                <td><input id="pconuno" type="radio" name="pconu" value="no" checked="cheked"/></td>
                                                              </tr>
                                                              
                                                              <tr>
                                                                <td>Auditoría</td>
                                                                <td><input id="auditoriasi" type="radio" name="auditoria" value="si"/></td>
                                                                <td><input id="auditoriano" type="radio" name="auditoria" value="no" checked="checked"/></td>
                                                              </tr>
                                                              <tr>
                                                                <td colspan="3" align="center">
                                                                  <h3><div id="salidaR_TIPO"></div></h3>
                                                                </td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                          <table width="100%">
                                                            <tr>
                                                              <td class="tit" >
                                                                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"/>&nbsp;
                                                                <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar"/>
                                                              </td>
                                                            </tr>
                                                          </table>
                                                        </div>
                                                        <!-- /.table-responsive -->
                                                      </div>
                                                      <!-- /.panel-body -->
                                                    </div>
                                                    <!-- /.panel -->
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
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_tipo_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Modificar Tipo de Usuario</h4>
                          </div>
                          <div class="modal-body">

                            <form action="modifica_tipo_usuario.php" method="post" id="mod_usuM" name="mod_usuM" onSubmit="return validarM_TIPO_USU()">

                                <input type="hidden" id="id" name="id"/> <br> <!--ID DEL USUARIO-->

                                <div class="panel panel-default">
                                  <div class="panel-body">
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs">
                                          <li class="active"><a href="#paso1" data-toggle="tab"><h4>Académico</h4></a></li>
                                          <li><a href="#paso2" data-toggle="tab"><h4>Administrativo</h4></a></li>
                                          <li><a href="#paso3" data-toggle="tab"><h4>Configuración</h4></a></li>
                                      </ul>

                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                          <div class="tab-pane fade in active" id="paso1">
                                              <div class="panel panel-default">
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          
                                                        <table width="100%">
                                                          <tr>  
                                                            <td class="tit">

                                                              <input type="hidden" id="validar_nom_tipo_usuM" name="validar_nom_tipo_usuM"/>

                                                              <br>
                                                              <label><b>Nombre del tipo de usuario:</b></label>
                                                              <input type="text" id="nombre_tipoM" name="nombre_tipoM" maxlength="30" placeholder="Ejemplo:Becario1" title="Ingrese el nombre del tipo de usuario Ejemplo:Becario1" onkeypress="return letra_num(event)" onclick="validarNOM_TIPO_USUARIO_M()" onkeyup="validarNOM_TIPO_USUARIO_M()"/>
                                                              <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                                              <div class="promts_usu"><span id="nombre_tipo_usuM"></span></div>
                                                            </td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                            <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 align="center">Privilegios Académicos:</h4>
                                                              </div>
                                                              <!-- /.panel-heading -->
                                                                <div class="panel-body">
                                                                  <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                      <thead>
                                                                        <tr>
                                                                          <th>Sub-Modulo</th>
                                                                          <th>Agregar</th>
                                                                          <th>Eliminar</th>
                                                                          <th>Modificar</th>
                                                                          <th>Imprimir</th>
                                                                          <th>Todos</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>Horarios</td>
                                                                          <td><input id="pach1M" type="checkbox" name="pach1M" value="A"/></td>
                                                                          <td><input id="pach2M" type="checkbox" name="pach2M" value="E"/></td>
                                                                          <td><input id="pach3M" type="checkbox" name="pach3M" value="M"/></td>
                                                                          <td><input id="pach4M" type="checkbox" name="pach4M" value="I"/></td>
                                                                          <td><input id="pach5M" type="checkbox" name="pach5M" value="T" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>Proyectos</td>
                                                                          <td><input id="pacp1M" type="checkbox" name="pacp1M" value="A"/></td>
                                                                          <td><input id="pacp2M" type="checkbox" name="pacp2M" value="E"/></td>
                                                                          <td><input id="pacp3M" type="checkbox" name="pacp3M" value="M"/></td>
                                                                          <td><input id="pacp4M" type="checkbox" name="pacp4M" value="I"/></td>
                                                                          <td><input id="pacp5M" type="checkbox" name="pacp5M" value="T" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>Convenios</td>
                                                                          <td><input id="paconv1M" type="checkbox" name="paconv1M" value="A"/></td>
                                                                          <td><input id="paconv2M" type="checkbox" name="paconv2M" value="E"/></td>
                                                                          <td><input id="paconv3M" type="checkbox" name="paconv3M" value="M"/></td>
                                                                          <td><input id="paconv4M" type="checkbox" name="paconv4M" value="I"/></td>
                                                                          <td><input id="paconv5M" type="checkbox" name="paconv5M" value="T" /></td>
                                                                        </tr>
                                                                      </tbody>
                                                                       <tr>
                        <td  colspan="6" align="right">
                          <div style="margin-bottom:2%; margin-top:5%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                                                                    </table>
                                                                  </div>
                                                                  <!-- /.table-responsive -->
                                                                </div>
                                                                <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->

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
                                                          
                                                        <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                    <h4 align="center">Privilegios Administrativos:</h4>
                                                  </div>
                                                  <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                        <table class="table table-hover">
                                                          <thead>
                                                            <tr>
                                                              <th>Sub-Modulo</th>
                                                              <th>Agregar</th>
                                                              <th>Eliminar</th>
                                                              <th>Modificar</th>
                                                              <th>Imprimir</th>
                                                              <th>Todos</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <td>Inventario</td>
                                                              <td><input id="padi1M" type="checkbox" name="padi1M" value="A"/></td>
                                                              <td><input id="padi2M" type="checkbox" name="padi2M" value="E"/></td>
                                                              <td><input id="padi3M" type="checkbox" name="padi3M" value="M"/></td>
                                                              <td><input id="padi4M" type="checkbox" name="padi4M" value="I"/></td>
                                                              <td><input id="padi5M" type="checkbox" name="padi5M" value="T"/></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                              <td>Personal</td>
                                                              <td><input id="padp1M" type="checkbox" name="padp1M" value="A"/></td>
                                                              <td><input id="padp2M" type="checkbox" name="padp2M" value="E"/></td>
                                                              <td><input id="padp3M" type="checkbox" name="padp3M" value="M"/></td>
                                                              <td><input id="padp4M" type="checkbox" name="padp4M" value="I"/></td>
                                                              <td><input id="padp5M" type="checkbox" name="padp5M" value="T"/></td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                    </div>
                                                    <!-- /.panel-body -->
                                                  </div>
                                                  <!-- /.panel -->

                                                </div>
                                                <!-- /.table-responsive -->
                                              </div>
                                              <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
                                          </div>
                                                  <div class="tab-pane fade" id="paso3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <h4 align="center">Privilegios de Configuración:</h4>
                                                                </div>
                                                                <!-- /.panel-heading -->
                                                                 <div class="panel-body">
                                                                  <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                      <thead>
                                                                        <tr>
                                                                          <th>Sub-Modulo</th>
                                                                          <th>Si</th>
                                                                          <th>No</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>Usuarios</td>
                                                                          <td><input id="pconusiM" type="radio" name="pconuM" value="si"/></td>
                                                                          <td><input id="pconunoM" type="radio" name="pconuM" value="no" checked="cheked"/></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                          <td>Auditoría</td>
                                                                          <td><input id="auditoriasiM" type="radio" name="auditoriaM" value="si"/></td>
                                                                          <td><input id="auditorianoM" type="radio" name="auditoriaM" value="no" checked="checked"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td colspan="3" align="center">
                                                                            <h3><div id="salidaM_TIPO"></div></h3>
                                                                          </td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                    <table width="100%">
                                                                      <tr>
                                                                        <td class="tit" >
                                                                          <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"/>&nbsp;
                                                                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar"/>Cancelar</button>
                                                                        </td>
                                                                      </tr>
                                                                    </table>
                                                                  </div>
                                                                  <!-- /.table-responsive -->
                                                                </div>
                                                                <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
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

                    <!-- editar Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_tipo_usuario" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                            <h4 class="modal-title">Detalle de Tipo de Usuario</h4>
                          </div>
                          <div class="modal-body">

                                <div class="panel panel-default">
                                  <div class="panel-body">
                                      <!-- Nav tabs -->
                                      <ul class="nav nav-tabs">
                                          <li class="active"><a href="#pasoD1" data-toggle="tab"><h4>Académico</h4></a></li>
                                          <li><a href="#pasoD2" data-toggle="tab"><h4>Administrativo</h4></a></li>
                                          <li><a href="#pasoD3" data-toggle="tab"><h4>Configuración</h4></a></li>
                                      </ul>

                                      <!-- Tab panes -->
                                      <div class="tab-content">
                                          <div class="tab-pane fade in active" id="pasoD1">
                                              <div class="panel panel-default">
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          
                                                        <table width="100%">
                                                          <tr>  
                                                            <td class="tit">

                                                              <br>
                                                              <label><b>Nombre del tipo de usuario:</b></label>
                                                              <input type="text" id="nombre_tipoD" title="Nombre del tipo de usuario" disabled/>
                                                              </td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                            <div class="panel panel-default">
                                                              <div class="panel-heading">
                                                                <h4 align="center">Privilegios Académicos:</h4>
                                                              </div>
                                                              <!-- /.panel-heading -->
                                                                <div class="panel-body">
                                                                  <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                      <thead>
                                                                        <tr>
                                                                          <th>Sub-Modulo</th>
                                                                          <th>Agregar</th>
                                                                          <th>Eliminar</th>
                                                                          <th>Modificar</th>
                                                                          <th>Imprimir</th>
                                                                          <th>Todos</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>Horarios</td>
                                                                          <td><input disabled id="pach1D" type="checkbox"/></td>
                                                                          <td><input disabled id="pach2D" type="checkbox"/></td>
                                                                          <td><input disabled id="pach3D" type="checkbox"/></td>
                                                                          <td><input disabled id="pach4D" type="checkbox"/></td>
                                                                          <td><input disabled id="pach5D" type="checkbox"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>Proyectos</td>
                                                                          <td><input disabled id="pacp1D" type="checkbox"/></td>
                                                                          <td><input disabled id="pacp2D" type="checkbox"/></td>
                                                                          <td><input disabled id="pacp3D" type="checkbox"/></td>
                                                                          <td><input disabled id="pacp4D" type="checkbox"/></td>
                                                                          <td><input disabled id="pacp5D" type="checkbox"/></td>
                                                                        </tr>
                                                                        <tr>
                                                                          <td>Convenios</td>
                                                                          <td><input disabled id="paconv1D" type="checkbox"/></td>
                                                                          <td><input disabled id="paconv2D" type="checkbox"/></td>
                                                                          <td><input disabled id="paconv3D" type="checkbox"/></td>
                                                                          <td><input disabled id="paconv4D" type="checkbox"/></td>
                                                                          <td><input disabled id="paconv5D" type="checkbox"/></td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </div>
                                                                  <!-- /.table-responsive -->
                                                                </div>
                                                                <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->

                                                      </div>
                                                  </div>
                                                  <!-- /.table-responsive -->
                                              </div>
                                              <!-- /.panel-body -->
                                          </div>
                                          <!-- /.panel -->
                                          <div class="tab-pane fade" id="pasoD2">
                                              <div class="panel panel-default">
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          
                                                        <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                    <h4 align="center">Privilegios Administrativos:</h4>
                                                  </div>
                                                  <!-- /.panel-heading -->
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                        <table class="table table-hover">
                                                          <thead>
                                                            <tr>
                                                              <th>Sub-Modulo</th>
                                                              <th>Agregar</th>
                                                              <th>Eliminar</th>
                                                              <th>Modificar</th>
                                                              <th>Imprimir</th>
                                                              <th>Todos</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>
                                                            <tr>
                                                              <td>Inventario</td>
                                                              <td><input disabled id="padi1D" type="checkbox"/></td>
                                                              <td><input disabled id="padi2D" type="checkbox"/></td>
                                                              <td><input disabled id="padi3D" type="checkbox"/></td>
                                                              <td><input disabled id="padi4D" type="checkbox"/></td>
                                                              <td><input disabled id="padi5D" type="checkbox"/></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                              <td>Personal</td>
                                                              <td><input disabled id="padp1D" type="checkbox"/></td>
                                                              <td><input disabled id="padp2D" type="checkbox"/></td>
                                                              <td><input disabled id="padp3D" type="checkbox"/></td>
                                                              <td><input disabled id="padp4D" type="checkbox"/></td>
                                                              <td><input disabled id="padp5D" type="checkbox"/></td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                    </div>
                                                    <!-- /.panel-body -->
                                                  </div>
                                                  <!-- /.panel -->

                                                </div>
                                                <!-- /.table-responsive -->
                                              </div>
                                              <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
                                          </div>
                                                  <div class="tab-pane fade" id="pasoD3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-body">
                                                            <div class="table-responsive">
                                                                
                                                              <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                  <h4 align="center">Privilegios de Configuración:</h4>
                                                                </div>
                                                                <!-- /.panel-heading -->
                                                                 <div class="panel-body">
                                                                  <div class="table-responsive">
                                                                    <table class="table table-hover">
                                                                      <thead>
                                                                        <tr>
                                                                          <th>Sub-Modulo</th>
                                                                          <th>Si</th>
                                                                          <th>No</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                        <tr>
                                                                          <td>Usuarios</td>
                                                                          <td><input disabled id="pconusiD" type="radio"/></td>
                                                                          <td><input disabled id="pconunoD" type="radio"/></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                          <td>Auditoría</td>
                                                                          <td><input disabled id="auditoriasiD" type="radio"/></td>
                                                                          <td><input disabled id="auditorianoD" type="radio"/></td>
                                                                        </tr>
                                                                      </tbody>
                                                                    </table>
                                                                  </div>
                                                                  <!-- /.table-responsive -->
                                                                </div>
                                                                <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
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
                          </div>                    
                        </div>
                      </div>
                    </div>
                    <!-- End editar modal -->

                <!-- Registro tipo usuario modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="reg_tipo_usuario" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Registro de Tipo de Usuario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">!Tipo de Usuario registrado con exito¡</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- End Registro tipo usuario modal -->

                <!-- Registro tipo usuario modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_tipo_usuario" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Tipo de Usuario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">!Tipo de Usuario modificado con exito¡</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- End Registro tipo usuario modal -->

                  <!-- Registro tipo usuario modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminar_tipo" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Tipo de Usuario</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">!Tipo de Usuario eliminado con exito¡</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <button class="btn btn-primary" data-dismiss="modal" title="Aceptar">Aceptar</button>
                                                    
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- End Registro tipo usuario modal -->

                  <!-- Registro tipo usuario modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confir_t_u" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Tipo de Usuario</h4>
                      </div>
                      <div class="modal-body">

                        <input type="hidden" id="id_t_u"/>

                        <h4 align="center">¿Usted está seguro que desea eliminar el tipo de usuario?</h4>                            
                          
                      </div>
                      <div class="modal-footer">

                        <button class="btn btn-primary"  title="Aceptar" onclick="E_T_U()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                                    
                      </div>
                    </div>
                  </div>
                  </div>
                  <!-- End Registro tipo usuario modal -->
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
    <script type="text/javascript" src="js/vali_usuario.js"></script>

</body>
</html>
<?php
  $registro=$_REQUEST['registro'];

  if ($registro=='tipo_usuario')
  {
?>
  <script type="text/javascript">
    
    $('#reg_tipo_usuario').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php  
  }

  $modificar=$_REQUEST['modificar'];

  if ($modificar=='tipo_usuario')
  {
?>
  <script type="text/javascript">
    
    $('#modificar_tipo_usuario').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php  
  }

  $eliminar=$_REQUEST['eliminar'];

  if ($eliminar=='si')
  {
?>
  <script type="text/javascript">
    
    $('#eliminar_tipo').modal({
      show:true,
      backdrop:'static'
    });
  
  </script>
<?php  
  }
?>