<?php
require('seguridad.php');
require('conexion.php');

$sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario    AND nom_usuario='".$_SESSION['nom_usuario']."' LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_maquinas']);
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
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>Prototipo con boostrap</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    

  <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/style-responsive.css" rel="stylesheet">
  <link href="css/nuestro.css" rel="stylesheet">
  <link href="css/nuevo2.css" rel="stylesheet">
  <link href="css/jquery.fancybox.css" type="text/css"  rel="stylesheet">
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
             <div id="mensaje"></div>

             <div id="centro_principal"></div>





             <div id="r_mant_prev">
         
 </div>

 <div id="consulta_prev">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="mantenimiento.php">Mantenimiento</a> <span>></span> <a href="reposicion.php"> Reposición</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Reposición de Repuestos</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div style="color:#000; aling-text:center; margin-left:25%;" >

          <label style="font-weight:bold;">Mantenimiento Preventivo</label> <input type="radio" name="service" id="service_preventivo">
          <label style="margin-left:5%; font-weight:bold;">Mantenimiento Correctivo</label> <input type="radio" name="service" id="service_correctivo"> 

        </div>
        <div id="interno">
          <form action="registrando_reposicion.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >

           <fieldset id="regmaq" style="color:#000;">

            <input type="hidden" name="id_maq" id="id_maq">
            <input type="hidden" name="id_per" id="id_per">
            <input type="hidden" name="res" id="res">
            <input type="hidden" name="tipo_servicio" value="" id="tipo_mant_R"> 


            <table width="100%">
                  <tr>
                <td colspan="3" align="center">
                  <input type="hidden" id="validaNP">
                  <label><b>Número del Mantenimiento:</b></label>
                  <input type="text" name="numero_mant" id="numero_mantP" onkeypress="return solonum3(event);" maxlength="6" onblur="buscaNumeroMantP();" value="<?php echo $_REQUEST['numeros_mant']; ?>">
                  <div class="promts" style="margin-left: -1px;"> <span id="numeroPPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                  <input type="hidden" id='maquina_id' >
                </td>
              </tr>
              <tr>
                <td  align="center">
                  <label  style="margin-left:-50px;"><b>Supervisor:</b></label><br>
                  <input  readonly="readonly" type="text" name="rev_maquina" id="rev_maquina" class="form-control" style="width:160px; margin-left:-50px" size="" maxlength="30" placeholder="" onKeyPress="return soloLetras(event)" >
                </td>
                
                <td >
                  <label><b>Responsable:</b></label><br>
                  <textarea  readonly="readonly" name="responsable" id="responsable"  class="form-control" style="display:inline-block; width:160px;" size="" maxlength="125" placeholder="" onKeyUp="validarResponsablemod();" onblur="validarResponsablemod();"></textarea>
                  <br>
                </td>
                <td>
              <div id="proveedor_ext">

              <label><b>Proveedor:</b></label><br>
                <textarea  readonly="readonly" name="proveedor" id="provedorP"  class="form-control" style="display:inline-block; width:90%;" size="" maxlength="125" placeholder="No posee proveedor" onKeyUp="validarProveedormod();" onblur="validarProveedormod();" onKeyPress="return soloAlfa(event)"></textarea>
              </div>
            </td>
                
              </tr>
              </table>
              <table width="100%">
              <tr>
                <td align="center">

                  <label><b>Código de la Máquina:</b></label>

                  <input readonly="" type="text" class="form-control" style="text-transform:capitalize; display:inline-block; width:160px;" name="codigo" id="codigo" onkeyup="existeCodigo()" onblur="codemaquinas(); existeCodigo();" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina"/>

                  <!--<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>-->
                  <!--<input type="text" name="n_b" id="NB" onblur="maquinas(); validarN_B();" maxlength="5" placeholder="Ejemplo:12345678" title="Introduzca el número del bien"  onKeyUp="validarN_B()"  onchange="validarN_B()"/>-->
                </td>
                <td align="center">
                  <label>Número del Bien:</label>  
                  <input readonly="readonly" class="form-control" style="display:inline-block; width:160px;" type="text" name="n_b" id="NB">

                </td>
              </tr>
              </table>
              <table width="100%">
              <tr ><td colspan="3"> <hr></td></tr>
              <tr><td style="font-size:20px;" colspan="3" align="center"><b>Repuesto Utilizados en el Mantenimiento</b></td></tr>
              <tr>
              <td align="center">
                <label>Nombre del Repuesto:</label> 
                 <select  id="repuestoPB" name="repuesto" title="Repuesto encontrados" onchange="busca_cantidadP(); validarRepuestoPB();">
                <option></option>
          
              </select>
            <div class="promts" style="margin-left: 7px;"> <span id="repuestoPBPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

              </td>
              <td >
                <label>Cantidad Salida:</label> 
              <input readonly="readonly" id="repuestoPC" name="cantidad" title="Cantidad de salida">
               
              </td>
             
              <td >
                <label>Cantidad a Devolver:</label> 
              <input id="repuestoPS" name="cantidad" maxlength="2" title="Cantidad a devolver" onkeyup="validarDevolverP();" onblur="validarDevolverP();" onkeypress="return solonum3(event);" >
              <div class="promts" style="margin-left: -17px;"> <span id="devolverPPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

              </td>
              </tr>
           

            
           
           
          
          <tr>
                <td colspan="4" align="center">
                  <h3><div id="salidaR_PRE"></div></h3>
                </td>
              </tr>

              <tr>
                <td align="center" colspan="4">
                  <br><br>

                  <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
                  <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
                  <br><br>
                </td>
              </tr>
        </table>


             
    
          </fieldset>
        </form>
      </div>
      
</div>                 
</div>
</div>

<!-- Modal validando file error-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_imagen" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Maquina</h4>
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

<!-- Modal Error formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompleto" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Maquina</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Debe completar el formulario</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar" id="btn_error_incompleto">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 


 <!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registrado_maquina" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Reposición de repuestos</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Reposición realizada correctamente</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->      
    
                      
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
<script type="text/javascript" src="funciones.js"></script>

<script type="text/javascript" src="js/jquery.fancybox.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".fancybox").fancybox();
  });
</script>

<script type="text/javascript">
  function DameDatos(){
    $.ajax({
      type:"POST",
      url:"ajax/registro_maquina2.php",
      data:"contacto="+document.getElementById("contacto").value,

      success: function(respuesta){
    /*  Como era

    if(respuesta.modelo!="0") document.getElementById('informacion').innerHTML='<br>'+respuesta.modelo;
        else document.getElementById('informacion').innerHTML='<br><div class="info"><p>Seleccione una maquina por favor</p></div>';
        */
        if (respuesta!=0)
        {
          $('#informacion').html('<br>'+respuesta);
        }  
        else
        {
          $('#informacion').html('<br><div class="info"><p>Seleccione una máquina por favor</p></div>');
        }
      }

    });

    $.ajax({
      type:"POST",
      url:"ajax/consultando_maquina.php",
      data:"contacto="+document.getElementById("contacto").value,
      dataType:"json",
      success: function(valores){
       var datos=eval(valores);
       if(valores.modelo=!0){
         $('#codigo').val(datos[1]);
       }


       else {
        $('#codigo').val(valores.modelo);
      }
    }
  });

  }
</script>

<!--validar formulario-->
<script type="text/javascript" src="js/vali_prev.js"></script>
</body>
</html>


<?php
#ELIMINAR MAQUINA
$elim_maq=$_REQUEST['elim_maq'];

if ($elim_maq=='si')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
    $('#eliminado_maquina').modal({
      show:true,
      backdrop:'static'
    }).show(200);


        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }
# ERRORES MODIFICACION

    if ($error=='usuarioM')
    {
      ?>  
      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#miGestionUsuario').show();
        $('#mensaje').addClass('mal').html("¡..El usuario ya existe..!").show(200).delay(2500).hide(200);

      </script>
      <?php
    }
    $regis_maq=$_REQUEST['registrado_maq'];
    if ($regis_maq=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#registrado_maquina').modal({
          show:true,
          backdrop:'static'
        }).show(200);

     /*   $('#r_maquina').hide();
        $('#slideshow').hide();
        $('#consulta_maq').show();
        $('#mensaje').addClass('bien').html("¡..Edición de usuario exitosa..!").show(200).delay(2500).hide(200);*/
      </script>
      <?php
    }
    $edicion_maq=$_REQUEST['editado_maq'];
    if ($edicion_maq=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#editado_maquina').modal({
          show:true,
          backdrop:'static'
        }).show(200);

     /*   $('#r_maquina').hide();
        $('#slideshow').hide();
        $('#consulta_maq').show();
        $('#mensaje').addClass('bien').html("¡..Edición de usuario exitosa..!").show(200).delay(2500).hide(200);*/
      </script>
      <?php
    }
    ?>
