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

              <div id="consulta_registroDiario">

                <h4><a href="#">Administrativo</a> > <a href="actividades.php">Actividades</a> > <a href="#">Registro Diario</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Consulta de Registros Diarios</span>
                  </div><br>

                  <table class="tabla_agregar_imprimir">
                    <tr>
                      <td>
                      </td>
                   
                      <td>
                      <?php

                        date_default_timezone_set('America/Caracas');
                        $hoy=date('d/m/Y');

                        $query=pg_query("SELECT * FROM personal INNER JOIN usuario
                          ON personal.id=usuario.id_personal AND personal.estatus=1 AND usuario.estatus=1
                          AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1" );
                        $array=pg_fetch_assoc($query);

                        $query2=pg_query("SELECT * FROM registro_diario WHERE id_personal='".$array['id']."'");
                        while ($array2=pg_fetch_assoc($query2))
                        {
                          $fecha=explode(' ', $array2['fecha']);
                          
                          if ($hoy==$fecha[0])
                          {
                            $registro="si";
                          }
                        }
                      ?>
                        <p id="agregar_per"><button class="btn btn-success"
                        <?php 
                          if ($registro!="si")
                          {
                        ?>
                          onclick="N_diario()"
                        <?php
                          }
                          else
                          {
                        ?>
                          title="Usted ya realizo su Registro Diario de Hoy"
                        <?php
                          }
                        ?>
                        >Nuevo Registro Diario &nbsp;<i class="fa fa-plus"></i></button></p>
                      
                      </td>
                    </tr>
                  </table>
                  
                  <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>Fecha</th>
                          <th>Hora</th>
                      <?php
                        if ($_SESSION['tipo']=='Administrador')
                        {
                      ?>
                          <th>Encargado</th>
                      <?php
                        }
                      ?>  
                          <th width='50%'>Observaciones</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php

                        if ($_SESSION['tipo']=='Administrador')
                        {
                          $sql="SELECT * FROM registro_diario INNER JOIN personal
                          ON registro_diario.id_personal = personal.id AND registro_diario.estatus=1
                          AND personal.estatus=1 AND area='Mecanica'";
                        }
                        else
                        {
                          $sql="SELECT * FROM registro_diario INNER JOIN (personal INNER JOIN usuario ON personal.id=usuario.id_personal AND nom_usuario='".$_SESSION['nom_usuario']."' AND personal.estatus=1 AND usuario.estatus=1) ON registro_diario.id_personal=personal.id AND registro_diario.estatus=1 AND personal.estatus=1 AND area='Mecanica'";
                        }
                      
                       $query=pg_query($sql);

                        while ($array=pg_fetch_assoc($query))
                        {

                          $nom=explode(' ', $array['nombres']);
                          $ape=explode(' ', $array['apellidos']);

                          $encargado=$nom[0]." ".$ape[0];

                          $fech=explode(' ', $array['fecha']);
                          $fecha=$fech[0];
                          $hora=$fech[1];
                      ?>
                        <tr class="odd gradeX">
                          <td align="center"><?php echo $fecha;?></td>
                          <td align="center"><?php echo $hora;?></td>
                      <?php
                        if ($_SESSION['tipo']=='Administrador')
                        {
                      ?>
                          <td align="center"><?php echo $encargado;?></td>
                      <?php
                        }
                      ?>
                          <td align="center"><?php echo $array['observaciones'];?></td>
                          <td align="center">
                          <?php
                            
                            $fecha=explode(' ', $array['fecha']);

                          ?>
                            <a 
                          <?php
                            if ($fecha[0]==$hoy)
                            {
                          ?>
                            href="javascript:editar_registro(<?php echo $array['id_reg'];?>);"
                          <?php
                            }
                          ?> 
                            >
                              <button class="btn btn-default"
                          <?php
                            if ($fecha[0]==$hoy)
                            {
                          ?>
                           title="Modificar"
                          <?php
                            }
                            else
                            {
                          ?>
                              title="No puede modificar este registro ya que no es de hoy"
                          <?php  
                            }
                          ?>
                           >
                                <span class="fa fa-edit"></span>
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

              <div id="registro_registroDiario">

                <h4><a href="#">Administrativo</a> > <a href="actividades.php">Actividades</a> > <a href="registro_diario.php">Registro Diario</a> > <a href="#">Nuevo Registro Diario</a></h4>

                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Registro de las Observaciones</span>
                  </div><br>

                  <form method="post" action="registroDiario.php" id="reg_diario" onsubmit="return validarR_REGISTRO()">

                    <table width="100%">
                      <tr>
                        <td class="tit">
                          <label><b>Observaciones:</b></label><br>
                          <textarea id="observaciones" name="observaciones" placeholder="Ejemplo:Se realizaron las actividades de..." title="Escriba el registro diario de de hoy, Aqui se colocan las actividades que usted realizo hoy" onkeypress="return letra_num_car(event)" onkeyup="validarREGISTRO()" onclick="validarREGISTRO()"></textarea>
                          <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                          <div class="promts"><span id="obs"></span></div>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">
                          <h3><div id="salidaR_DIARIO"></div></h3>
                        </td>
                      </tr>
                         <tr>
                        <td align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
                      <tr>
                        <td class="tit">
                          <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                          <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">  
                        </td>
                      </tr>
                    </table>               

                  </form>

                </div>

              </div>

              <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_observaciones" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Observación</h4>
                      </div>
                      <div class="modal-body">

                        <form method="post" action="modifica_registro.php" id="modif_observacion" onsubmit="return validarM_REGISTRO()">

                          <input type="hidden" name="id" id="id"/>

                          <input type="hidden" name="id_per" id="id_per"/>

                          <table width="100%">
                            <tr>
                              <td class="tit">
                                <label><b>Observaciones:</b></label><br>
                                <textarea id="observaciones_M" name="observaciones_M" placeholder="Ejemplo:Se realizaron las actividades de..." title="Escriba el registro diario del dia de hoy, Aqui se colocan las actividades que usted realizo hoy" onkeypress="return letra_num_car(event)" onkeyup="validarREGISTRO_M()" onclick="validarREGISTRO_M()"></textarea>
                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                <div class="promts"><span id="obsM"></span></div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3" align="center">
                                <h3><div id="salidaM_DIARIO"></div></h3>
                              </td>
                            </tr>
                            <tr>
                                 <tr>
                        <td colspan="3" align="right">
                          <div style="margin-bottom:2%;"><span style="margin-right:5%;  width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                        </td>
                      </tr>
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

              <!-- detalle Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_observaciones" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Detalle de la Observación</h4>
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

              <!-- registro planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registro_diario" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Observaciones</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Observación registradas con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End registro planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modificar_observacion" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="exito">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Observación</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Observación modificada con exito!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- modificar planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_observaciones" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Observación</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! La Observación ya se registro hoy</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End modificar planificacion modal -->

              <!-- registro doble planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_observacionesR" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Registro de Observaciones</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Ya existe! La Observación ya se registro hoy</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal" >Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End registro doble planificacion modal -->
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
    <script type="text/javascript" src="js/vali_actividades.js"></script>

</body>
</html>
<?php

  $registro=$_REQUEST['registro'];

  if ($registro=='exito')
  {
?>
<script type="text/javascript">
    
    $('#registro_diario').modal({
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
    
    $('#modificar_observacion').modal({
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
    
    $('#error_observaciones').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }

  if ($error=='siR')
  {
?>
<script type="text/javascript">
    
    $('#error_observacionesR').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }
?>
