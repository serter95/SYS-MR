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
       <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">  
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
<style type="text/css">
 #form_contenedor{
  color: #333;
}
</style>
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

          <div class="desc">

                    <div class="container">
</div>
                      
                      <div class="info2">
  <div id="text_center_title"> 
  <!--para la parte de titulo-->

          <div align="center">Insumos</div>
        </div>
      <div id="form_contenedor">
        <form action="registro_insumos.php" method="post" id="reg_maquina" name="reg_maquina">
          <fieldset id="reg_insu">
          
            
            <label>Nombre</label>
            <input type="text" required pattern="[a-zA-Z]*"
              title="Se debe escribir solo Letras"data-toggle="tooltip" data-placement="right"  name="nombre"  id="nombre" size="" maxlength="15" 
            placeholder="Ejemplo:jose" onKeyPress="return soloLetras(event)" onKeyUp="validar()" >
            <span id="Prompt" class="container" ></span>
            
            

            <label>Medida</label>
            <input type="text"   required pattern="[0-9,./-']*" title="Se debe escribir solo numeros y caracteres"  name="medida" id="medida" size="" maxlength="10" placeholder="Ejemplo:1,2,3" onKeyPress="return solocarater(event)" onKeyUp="validar()">
            <span id="Prompt"></span>
            
           
            
            <label>Cantidad</label>
            <input type="text"  required pattern="[0-9]*" name="cantidad" title="Se debe escribir numeros" id="cantidad" size="" maxlength="10" placeholder="Ejemplo:1,2,3,4" onKeyPress="return solonum(event)" onKeyUp="validar()" />

            <label>Buenas</label>
              <input type="number"  required pattern name="buenas" title="Se debe escribir numeros"  id="buenas" size="" maxlength="10" placeholder="" onKeyPress="return solonum(event)" onKeyUp="validar()">
              <span id="Prompt"></span>
            
            <label>Dañadas</label>
            <input type="number" required pattern  name="danadas" title="Se debe escribir numeros" id="danadas" size="" maxlength="10" placeholder="" onKeyPress="return solonum(event)"onKeyUp="validar()">
              <span id="Prompt"></span>
              
              
              <span id="Prompt"></span>
            
           <br></br>

            <input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" onClick=""> 
            <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar"> 
            
          </fieldset>
            <br>
        </form></div></div>
                        

                   
          </div>
     
            
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

    <!--script src="assets/js/jquery.js"></script-->
    <!--script src="assets/js/jquery-1.8.3.min.js"></script-->
    
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


    <!--validar formulario-->
    <script type="text/javascript" src="js/vali.js"></script>
    <!--script type="text/javascript">
      $(document).ready(function() {
        
      });
    </script-->

</body>
</html>
