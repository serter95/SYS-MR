<?php
require('seguridad.php');
require('conexion.php');

$query=pg_query("SELECT * FROM usuario u, tipo_usuario t WHERE u.id_tipo_usuario=t.id_tipo AND u.estatus=1
  AND t.estatus=1 AND u.nom_usuario='".$_SESSION['nom_usuario']."'");

$array=pg_fetch_assoc($query);

if ($array['priv_bd']=='no')
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

              <div id="miBD">
                <div class="iconoBD">    
                  <a href="#" id="respaldar">
                    <icon>
                      <i class="fa fa-long-arrow-down"></i>
                      <span class="li_data"></span> 
                      <h4>Respaldo de Base de Datos</h4>
                    </icon>
                  </a>
                </div>
                <div class="iconoBD">    
                  <a href="#" id="restaurar">
                    <icon>
                      <i class="fa fa-long-arrow-up"></i>
                      <span class="li_data"></span> 
                      <h4>Restauración de Base de Datos</h4>
                    </icon>
                  </a>
                </div>                   
              </div>

              <!-- Modal validando file error-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="confirm_respaldo" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="confirm">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Respaldo de la Base de Datos</h4>
                    </div>
                    <div class="modal-body">

                      <h4 style="color:#000;">¿Esta seguro de Respaldar la Base de datos?</h4>
                      <div style="display:none;">
                        <form id="Formbackup" name="dataForm" method="post" enctype="multipart/form-data" action="backup/example.php"> 

                          <input type="hidden" value="backup" name="actionButton" id="actionButton" > 
                        </form> 
                      </div>

                    </div>
                    <div class="modal-footer">

                     <button id="respaldo" class="btn btn-primary" title="Aceptar">Aceptar</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" title="Cerrar">Cancelar</button>



                   </div>
                 </div>
               </div>
             </div>
             <!-- End validando file error modal -->  

             <!-- Modal cargando-->
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="div_cargando" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Respaldo de la Base de Datos</h4>
                  </div>
                  <div class="modal-body">
                    <table width="100%">
                      <tr>
                        <td align="center">
                          <h4 style="color:#000;">Respaldando</h4>
                        </td>
                      </tr>
                      <tr>
                        <td align="center">
                         <div id="content">
                         </div>
                       </td>
                     </tr>
                   </table>                 
                 </div>
               </div>
             </div>
           </div>
           <!-- End cargando modal -->  
           <!-- Modal respaldo exito-->
           <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="respaldo_exito" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" id="exito">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                  <h4 class="modal-title">Respaldo de la Base de Datos</h4>
                </div>
                <div class="modal-body">
                 <h4 style="color:#000;"> Respaldo realizado con exito. </h4>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>
               </div>
             </div>
           </div>
         </div>
         <!-- End modal respaldo exito -->  
         <!-- Modal validando file error-->
         <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="restaurar_modal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Restauración de la Base de Datos</h4>
              </div>
              <div class="modal-body" style="color:#000;">
               <form id="Formrestore" name="dataForm" method="post" enctype="multipart/form-data" action="backup/example.php"  onSubmit="return validarForm()"> 
                <input type="file" name="path" id="path2" title="introduzca una archivo de base de dato formato SQL" onchange="control(this); validaFile();"/> 
                <input type="hidden" value="restore" name="actionButton" id="actionButton"> 
              </form> 
            </div>
            <div class="modal-footer">
             <button type="submit" class="btn btn-primary" title="Aceptar" id="respaldando">Aceptar</button>
             <button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" title="Cerrar">Cerrar</button>
           </div>
         </div>
       </div>
     </div>
     <!-- End validando file error modal -->  
     <!-- Modal validando file error-->
     <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_imagen" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" id="confirm">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
            <h4 class="modal-title">Restauración de la Base Datos</h4>
          </div>
          <div class="modal-body">

            <h4 style="color:#000;">Extensión no valida</h4>    
          </div>
          <div class="modal-footer">

           <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

           <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


         </div>
       </div>
     </div>
   </div>
   <!-- End validando file error modal -->  
   <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompatible" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="confirm">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
          <h4 class="modal-title">Restauración de la Base Datos</h4>
        </div>
        <div class="modal-body">

          <h4 style="color:#000;">Error archivo incompatible para esta Base de Datos</h4>    
        </div>
        <div class="modal-footer">

         <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

         <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


       </div>
     </div>
   </div>
 </div>
 <!-- End validando file error modal -->  
 <!-- End validando file error modal -->  
 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_bd" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Restauración de la Base Datos</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Error en la restauración de la Base de Datos</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>



     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

             <!-- Modal cargando-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="div_cargando2" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Restauración de la Base de Datos</h4>
                  </div>
                  <div class="modal-body">
                    <table width="100%">
                      <tr>
                      <td align="center">
                    <h4 style="color:#000;">Restaurando</h4>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                         <div id="content2">
                          </div>
                    </td>
                  </tr>
                  </table>                 
                  </div>
               </div>
             </div>
            </div>
            <!-- End cargando modal -->  
<!-- Modal respaldo exito-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="restaurar_exito" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="exito">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Restauración de la Base de Datos</h4>
      </div>
      <div class="modal-body">
       <h4 style="color:#000;"> Restauración realizada con exito. </h4>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>
     </div>
   </div>
 </div>
</div>
<!-- End modal respaldo exito -->   
<?php
 include("form_user_elim.php");
 $user_elim=form_user_elim();
 echo $user_elim;
 ?>
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

<script type="text/javascript">
    /*  $(document).ready(function() {
        
    });*/
$('#respaldar').click(function(){
 
  $('#confirm_respaldo').modal({
    show:true,
    backdrop:'static'
  }).show();
   confirm_user();
});

$('#respaldo').click(function(){
  $('#confirm_respaldo').modal('hide');
  $('#div_cargando').modal({
    show:true,
    backdrop:'static'
  }).show();
  $.ajax({
    type:"POST",
    beforeSend: function(){
      $('#content').html('<div><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>');
      document.getElementById('Formbackup').submit();

    },
    cache:false,
    url:"backup/example.php?actionButton=backup",
     // data:"actionButton="+backup,
     success: function (){

      $('#div_cargando').modal('hide');
      $('#respaldo_exito').modal({
        show:true,
        backdrop:'static'
      }).show();
    }
  });
});

$('#restaurar').click(function(){

  $('#restaurar_modal').modal({
    show:true,
    backdrop:'static'
  }).show();
  confirm_user();
});

$('#respaldando').click(function(){
  $('#div_cargando2').modal({
    show:true,
    backdrop:'static'
  }).show();
        $('#content2').html('<div><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>');

      document.getElementById('Formrestore').submit();
      //uploadAjax();
     /*var valor=document.getElementById("path2");
      var file=valor.value.split("\\");
      var filename=file[file.length-1];
      alert(filename);
  $.ajax({
    type:"POST",
    beforeSend: function(){
      $('#restaurar_modal').modal('hide');
      $('#content2').html('<div><img src="imagenes/ajax-loader.gif"/></div>');

    },
    cache:false,
    url:"backup/example.php",
     data:"actionButton=restore&path="+filename,
     success: function (valores){
       
      $('#div_cargando2').modal('hide');
    
      $('#restaurar_exito').modal({
        show:true,
        backdrop:'static'
      }).show();
      }
  });*/
});
/*
function uploadAjax(){
  //
  var file=$("#path2")[0].files[0];
  var formData = new FormData();
  formData.append('file',$('#path2')[0].files[0]);
  $.ajax({
    url:"backup/example.php?actionButton=restore",
    type:'POST',
    data:formData,
    //necesario para subir archivos via ajax
    cache:false,
    contentType:false,
    processData:false,
    //
    beforeSend:function(){
      $('#restaurar_modal').modal('hide');
      $('#content2').html('<div><img src="imagenes/ajax-loader.gif"/></div>');

    },
     success: function (valores){
       
      $('#div_cargando2').modal('hide');
    
      $('#restaurar_exito').modal({
        show:true,
        backdrop:'static'
      }).show();
    },
    error: function (){
      alert('no');
    }
  });
}*/


function control(f){
  var ext=['sql'];
  var v=f.value.split('.').pop().toLowerCase();
  for(var i=0,n; n=ext[i];i++){
    if(n.toLowerCase()==v)
      return
  }
  var t=f.cloneNode(true);
  t.value='';
  f.parentNode.replaceChild(t,f);
  //alert('extension no valida');
  $('#error_imagen').modal({
    show:true,
    backdrop:'static'
  }).show(200);
}

function validarForm()
{
 if(!validaFile){
     
  alert("no pasa");

   return false;
 } 
 return true;
}

function validaFile() {
  // body...
  var t=document.getElementById('path2').cloneNode(true);
  if (t.value==""){
    //alert("Vacio");
    return false;
  }
  else{
    return true;
  }
}

</script>

</body>
</html>

<?php

$elim=$_REQUEST['error'];

if ($elim=='si')
{
  ?>
  <script type="text/javascript">
  $('#error_bd').modal({
    show:true,
    backdrop:'static'
  }).show(200);
  </script>
  <?php
}

$elim=$_REQUEST['error'];

if ($elim=='nocompatible')
{
  ?>
  <script type="text/javascript">
  $('#error_incompatible').modal({
    show:true,
    backdrop:'static'
  }).show(200);
  </script>
  <?php
}
$realizado=$_REQUEST['realizado'];

if ($realizado=='si')
{
  ?>
  <script type="text/javascript">
  $('#restaurar_exito').modal({
    show:true,
    backdrop:'static'
  }).show(200);
  </script>
  <?php
}
?>