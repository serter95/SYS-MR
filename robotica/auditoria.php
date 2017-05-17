<?php
  require('seguridad.php');
  require('conexion.php');

  $query=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.id_tipo_usuario=t.id_tipo AND u.estatus=1
    AND t.estatus=1 AND u.nom_usuario='".$_SESSION['nom_usuario']."' AND u.taller=2");
    
  $array=pg_fetch_assoc($query);

  if ($array['priv_auditoria']=='no')
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
              
            <div id="miGestionUsuario">

                  <h4><a href="#">Configuración</a> > <a href="#">Auditoría</a></h4>
                    
                  <div class="info3">
                    <div id="text_center_title">
                        <span class="t-menu">Consulta de Auditoría</span>
                    </div><br>

                        <div  id="tabla_usuario">

                          <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                <tr>
                                  <th>Fecha</th>
                                  <th>Acción Realizada</th>
                                  <th>Modulo</th>
                                  <th>Nombre de Usuario</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                        $sql="SELECT * FROM auditoria WHERE taller=2";
                                        $query=pg_query($sql);

                                        while ($array=pg_fetch_assoc($query))
                                        {

                                          $f=explode(' ', $array['fecha']);
                                          $fe=explode('-', $f[0]);

                                          $fecha=$fe[2].'/'.$fe[1].'/'.$fe[0];
                                ?>
                                <tr class="odd gradeX">
                                  <td align="center"><?php echo $fecha." ".$f[1];?></td>
                                  <td align="center"><?php echo $array['accion_realizada'];?></td>
                                  <td align="center"><?php echo $array['modulo'];?></td>
                                  <td align="center"><?php echo $array['nom_usuario'];?></td>
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