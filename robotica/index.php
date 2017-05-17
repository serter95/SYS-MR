<?php
  require('seguridad.php');
  require('conexion.php');

  date_default_timezone_set('America/Caracas');

  $fecha=getdate();

  #print_r($fecha);

  if($fecha['mon']<=4)
  {
    $periodo=$fecha['year']."-I";
  }
  if($fecha['mon']>4 && $fecha['mon']<=7)
  {
    $periodo=$fecha['year']."-II";
  }
  if($fecha['mon']>7)
  {
    $periodo=$fecha['year']."-III";
  }

  $query=pg_query("SELECT * FROM periodo WHERE tipo='$periodo'");
  $num=pg_num_rows($query);

  if ($num==0)
  {
    $query=pg_query("INSERT INTO periodo (tipo)VALUES('$periodo')");
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

              <?php
                include("menu.php");
                $centro=menu();
                echo $centro;
              ?>
             <?php
                $query2=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.id_tipo_usuario=t.id_tipo AND u.estatus=1
                AND t.estatus=1 AND u.nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=2");

                $array2=pg_fetch_assoc($query2);
              ?>

              <div id="midiv">
                <div class="row mtbox">
                  <?php
                   if ($array2['priv_horarios']!='0' || $array2['priv_proyectos']!='0' || $array2['priv_convenios']!='0')
                  {
                    ?>
                  <a >
                    <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                      <div class="box1">
                        <span class="li_vallet"></span>
                        <h5>Academico</h5>
                      </div>
                      <p>Cree, Actualice y Consulte:<br>-Horarios<br>-Proyectos<br>-Convenios</p>
                    </div>
                  </a>
                  <?php
                }
                 if ($array2['priv_inventario']!='0' || $array2['priv_maquinas']!='0' || $array2['priv_actividades']!='0' || $array2['priv_personal']!='0')
                  {
                ?>
                
                  <a>
                    <div class="col-md-2 col-sm-2 box0">
                      <div class="box1">
                        <span class="li_display"></span>
                        <h5>Administrativo</h5>
                      </div>
                      <p>Gestione y Controle:<br>-Inventario<br>-Actividades<br>-Personal</p>
                    </div>
                  </a>
                  <?php 
                }
                 if ($array2['priv_usuarios']=='si' || $array2['priv_bd']=='si' || $array2['priv_auditoria']=='si')
                  {
                ?>

                  <a >
                    <div class="col-md-2 col-sm-2 box0">
                      <div class="box1" >
                        <span class="li_settings"></span>
                        <h5>Configuraci&oacute;n</h5>
                      </div>
                      <p>Gestione y administre:<br>-Usuarios</p>
                    </div>
                  </a>
                  <?php
                   }
                  ?>
                </div><!-- /row mt -->                        
              </div><!-- end midiv -->

              <ajax>

              <!-- estado planificacion modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="permiso" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Permisos</h4>
                      </div>
                      <div class="modal-body">

                        <h4 align="center">¡Usted no tiene permiso para entrar al modulo!</h4>                            
                                          
                      </div>
                      <div class="modal-footer">
                                                    
                        <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>
                                  
                      </div>
                    </div>
                  </div>
                </div>
              <!-- End estado planificacion modal -->
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
    <script type="text/javascript" src="funciones.js"></script>

</body>
</html>
<?php

  $registro=$_REQUEST['permiso'];

  if ($registro=='negativo')
  {
?>
<script type="text/javascript">
    
    $('#permiso').modal({
      show:true,
      backdrop:'static'
    });
    
</script>
<?php    
  }
?>