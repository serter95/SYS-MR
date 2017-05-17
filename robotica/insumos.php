<?php
require('seguridad.php');
require('conexion.php');

$sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=2 LIMIT 1";
  $query2=pg_query($sql2);
  $array2=pg_fetch_assoc($query2);

  $priv=explode('-', $array2['priv_inventario']);
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
  <link href="css/fancybox/jquery.fancybox.css" type="text/css"  rel="stylesheet">
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


                                               <div id="carga"><h3>Cargando por favor espere...</h3><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>



             <div id="consulta_insu">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="#">Insumos</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Insumos</span>
                </div>

                   <table class="tabla_agregar_imprimir">
                  <tr>
                    <td>
                <?php
                        if ($privilegio_I=='I')
                        {
                      ?>
                  <p id="reporte_maq"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p> 
                        <?php
                        }
                      ?>
                      </td>
                    <td>
                     <?php
                        if ($privilegio_A=='A')
                        {
                      ?>
               <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a>


                  <p id="agregar_insu" style="  margin-top: 1%;
                  margin-left: 10%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Nuevo insumo &nbsp; <i class="fa fa-plus"></i></button></p> 
                       <?php  
                        }
                      ?>
                    </td>
                  </tr>
                </table>
                  <div  id="tabla_usuario">

                    <div class="dataTable_wrapper">
                      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                          <tr>
                            <th>Código</th>
                            <th>Numero del Bien</th>
                            <th>Nombre</th>
                            <th>Existencia</th>
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $sql="SELECT * FROM insumos i, numero_bien n WHERE i.n_b=n.id_nb AND i.estatus='1' AND i.taller=2";

                          $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                           /* $fecha_a=explode('-', $array['fecha']);
                            $ano=$fecha_a[0];
                            $mes=$fecha_a[1].'-';
                            $dia=$fecha_a[2].'-';
                            $fecha=$dia.$mes.$ano;

                            $nombre_per=explode(' ', $array['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;*/
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['codigo_insumo'];?></td>
                              <td align="center"><?php echo $array['nb'];?></td>
                              <td align="center"><?php echo    $array['nombre']; ?></td>
                              <td align="center"><?php echo $array['existencia']?></td>
                              <td align="center">
                                  <?php
                             if ($privilegio_M=='M')
                              {
                              
                            ?>    
                                <a href="javascript:editar_insumos(<?php echo $array['id_insumos'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
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
                                <a href="javascript:eliminarInsumo(<?php echo $array['id_insumos'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                                <?php
                                    }
                            ?>
                                
                                <a href="javascript:detalleInsumo(<?php echo $array['id_insumos'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                                <a href="javascript:reportandoInsumo(<?php echo $array['id_insumos'];?>);">                
                                  <button class="btn btn-default" title="Reporte">
                                    <span class="fa fa-print"></span>
                                  </button>
                                </a>
                                <a href="javascript:Entrada_Salida(<?php echo $array['id_insumos'];?>);">                
                                  <button class="btn btn-default" title="Entrada y Salida">
                                    <span class="fa fa-exchange"></span>
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
                  <!-- Modal -->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Modificar Insumos</h4>
                        </div>
                        <div class="modal-body">
                          <ul class="nav nav-tabs">
                            <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                            <li class="active"><a href="#tabinsumosmod" data-toggle="tab">Insumos I</a></li>
                            <li><a href="#tabinsumosmodx" data-toggle="tab">Insumos II</a></li>

                          </ul>

                          <div class="tab-content">

                                <div class="tab-pane fade in active" id="tabinsumosmod">
                                 <div class="panel panel-default">
                                   <div class="panel-body">
                                     <form action="modificar_insumos.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarmodform()">

                                     
                                       <fieldset id="regmaq">

                                        <input type="hidden" name="id" id="idmod">
                                        <input type="hidden" name="id_per" id="id_per">
                                        <input type="hidden" name="tipo" id="Mtipo" value="modificacion">
                                         <input type="hidden" name="Mresn" id="Mresn" value="1">
                                        <input type="hidden" name="res" id="res">
                                        <input type="hidden" name="resMC" id="resMC" value="1">
                                        <input type="hidden" id="m_id_nb" name="id_nb" /> <!--id del nb-->

                                       <table width="100%">
                                        <tr>
                                         <td align="center" colspan="3">
                                      <label><b>Ubicación:</b></label><br> 
                                                <select name="ubicacion" id="ubicacionmod" class="form-control" style="width:500px; display:inline-block;"  title="Ingrese la ubicacion del insumo" onclick="validarUbicacion2()" onblur="validarUbicacion2()" onKeyPress="return soloAlfa(event)">
                                                  <option></option>
                                                  <option>Almacén 1</option>
                                                  <option>Almacén 2</option>
                                                </select>
                                      <div class="promts"> <span id="ubicacionmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                                      </td>
                                        </tr>
                                        <tr>
                                        <td align="center">
                                                    <br>
                                        <label><b>Codigo del insumo:</b></label>  <br>
                                        <input type="text" style="text-transform:capitalize; width:160px; display:inline-block;" name="codigo" id="codigomod" class="form-control" maxlength="10" placeholder="Ejemplo:To-00" title="Código del insumo" onKeyUp="existeCodigo2();" onblur="existeCodigo2();" onkeypress="return soloAlfa2(event)"/>
                                       <div class="promts" style="margin-left: -22px;"> <span id="CodemodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                          <br><br>
                                        </td>
                                        <td align="center">
                                                    <br>
                                        <label><b>Nombre:</b></label>   <br>
                                         <textarea type="text" name="nombre" id="nombremod" class="form-control input_size" maxlength="100" onkeyup="validarM_Nombre()" onblur="validarM_Nombre()" onKeyPress="return soloAlfa(event)" title="Nombre del insumo"></textarea> 
                                     <div class="promts"> <span id="Nombre2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
  
                                        <br>
                                        </td>
                                        <td align="center">
                                                    <br>
                                       <div  style="display: table;">
                                        <label><b>Numero del bien:</b></label><br>
                                      <select id="pre_nbmod" name="pre_nb" class="form-control" style="width:100px; display:inline-block;" onclick="validar_Select_NBmod();">
                                      <option>NB-</option>
                                      <option>S/NB</option>
                                      </select>                                        <input type="text" name="n_b" id="MNB" maxlength="6" class="form-control input_size" style="width:110px; " onKeyUp="validarM_N_B()" onBlur="validarM_N_B()" onchange="validarM_N_B()" onKeyPress="return solonum3(event)" title="Número del bien" />
                                        <div class="promts" style="margin-left: -28px; " id="promptNBM"><span id="MN/BPrompt"></span></div>
                                        <span id="contrasena"></span>
                                        <input type="hidden" id="Mres" name="Mres" value="1" />
                                        </div>
                                         <br>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td align="center">
                                        
                                         <label><b>Tipo de Medida</b></label>    <br>
                                        <select name="tipo_medida" id="tipo_medidamod" style="width:170px; display:inline-block;" class="form-control" title="Tipo de medida del insumo" onChange="opciontipomedidamod();">
                                          <option value="Milimetros">Milimetros</option>
                                          <option value="Pulgadas">Pulgadas</option>
                                          <option value="No aplica">No aplica</option>
                                        </select>

                                       



                                        <br><br>
                                        </td>
                                        <td colspan="2" align="center">
                                       
                                         <!--div id="medidamod3" style="display: table;">
             
                                          <label><b>Tipo de Maquina</b></label> <br> 
                                          <select  name="medida" id="medida_maquinamod" size="" onclick="validarMedidamod()" onblur="validarMedidamod()" title="Tipo de maquina" class="form-control" style="width:170px;  display:inline-block;"> 
                                          <option value="Torno">Torno</option>
                                          <option value="Esmeril">Esmeril</option>
                                          <option value="Limadora">Limadora</option>
                                          <option value="Fresadora">Fresadora</option>
                                          <option value="Taladro">Taladro</option>
                                        </select>
                                        <div class="promts" style="margin-left: -32px;">
                                          <span id="medidamod3Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        </div--> 
                                   

                                        <div id="div_medidaM1">
                                        <label><b>Medida</b></label>    <br>

                                        <input type="text" name="medida" id="medidamod" size="10" maxlength="5" style="width:80px; display:inline-block;" class="form-control" onKeyUp="opciontipomedidamod()" onBlur="opciontipomedidamod()"  onKeyPress="return solonum4(event)" title="Tamaño medida del insumo">
                                        <div class="promts" style="margin-left: -13px;"> <span id="medidamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        </div>

                                         <div id="div_medidaM2" style="display: table;">
             
                                          <label><b>Medida</b></label>  
                                          <input type="text" name="medida1" id="medida_pul_mod" size="8" maxlength="2" onkeypress="return solonum3(event)"  onkeyup="opciontipomedidamod()" onblur="opciontipomedidamod()" title="Tamaño de la medida del insumo"> /
                                          <input type="text" name="medida2" id="medida2_pul_mod" size="8" maxlength="2" onkeypress="return solonum3(event)" onkeyup="opciontipomedidamod()" onblur="opciontipomedidamod()">

                                         <div class="promts"> <span id="medida2Prompt_mod"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                         
                                         </div>

                                            </td>
                                            </tr> 
                                             <tr>
                                             <td colspan="3" align="right">
                                              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
                                            </td>
                                          </tr>                  

                                          </table>
                                          </fieldset>
                                      </div> 
                                    </div>

                                  </div>
                                  <div class="tab-pane fade" id="tabinsumosmodx">
                                   <div class="panel panel-default">
                                     <div class="panel-body">
                                       <fieldset >

<?php 


?>
                      <table width="100%">
                      <tr>
                      <td>
                                       <div  style="display: table;">
            <label><b>Precio Unitario:</b></label>   <br>
            <input type="text" name="precio" id="preciomod"  size="" maxlength="10" placeholder="" onblur="calculo_importe2(); validarPrecio2();" onkeyup="validarPrecio2();" style="width:160px; display:inline-block;" class="form-control" onkeypress="return solonum3(event)" title="Precio del insumo">
            <input type="text" readonly="readonly" name="moneda" value="Bs" size="3" style="width:50px; display:inline-block;" class="form-control">
            <div class="promts"> <span id="preciomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </div>
              <br>
              </td>
              <td>

            <label><b>Existencia:</b></label>   <br>
            <input type="text" name="existencia" id="existenciamod" size="" maxlength="10" placeholder="" onblur="calculo_importe2(); calculo_danada2(); validarExistencia2()" onkeyup="validarExistencia2()" style="width:160px; display:inline-block;" class="form-control" onkeypress="return solonum3(event)" title="Existencia del insumo" >
            <div class="promts"> <span id="existenciamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
              <br>
              </td>
              <td>

            <label><b>Buenas</b></label>   <br>
            <input type="text" name="buenas" id="buenasmod" maxlength="10" onblur="calculo_danada2(); validarBuenas2();" onkeyup="validarBuenas2();" style="width:160px; display:inline-block;" class="form-control" title="Cantidad de insumos buenos" onkeypress="return solonum3(event)">
            <div class="promts" style="z-index:1;"> <span id="buenasmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             <br>
             </td>
             </tr>
             <tr>
             <td>
            <label><b>Dañadas</b></label> <br>
            <input readonly="readonly" type="text" name="danadas" id="danadasmod" style="width:160px; display:inline-block;" class="form-control" title="Cantidad de insumos dañados">
             <div class="promts"> <span id="danadasmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

              <br><br>
              </td>
              <td>

             <label><b>Minimo Stock:</b></label>   <br>
            <input type="text" name="minimo" id="minimomod" style="width:160px; display:inline-block;" class="form-control" size="" maxlength="10" placeholder="" onchange="min_stockmod();" onkeyup="min_stockmod();" onkeypress="return solonum3(event)" title="Stock Minimo">
            <div class="promts"> <span id="minimomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
              <br><br>
              </td>
                <td>
            <label><b>Stock Maximo:</b></label> <br>
             <input type="text" name="maximo" id="maximomod" style="width:160px; display:inline-block;" class="form-control"  size="" maxlength="10" placeholder="" onchange="max_stockmod();" onclick="max_stockmod();" onkeyup="max_stockmod();" onKeyPress="return solonum2(event)" title="Stock Maximo">
            <div class="promts" style="z-index:2;"> <span id="maximomodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </td>
             
             </tr>
             <tr>
           
             <td colspan="3" align="center">

         
            <div  style="display: table;">
           <label><b>Importe:</b></label>   <br>
            <input readonly="readonly" type="text" name="importe" id="importemod" style="width:160px; display:inline-block;" class="form-control" size="" maxlength="10" placeholder="00-00-0000" title="Precio total en existencia">
            <input type="text" readonly="readonly" name="moneda" value="Bs" size="3" style="width:50px; display:inline-block;" class="form-control">            
            <!--<div class="promts"> <span id="aceitePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>-->
            </div>
             <br>
             </td>
            
            </tr>
             <br>
              <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>
            <tr>
               <td colspan="3" align="center">
                <h3><div id="salidaM_INS"></div></h3>
              </td>
            </tr>
            <tr>
              <td align="center" colspan="3"><br>
                <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
              </td>
            </tr>
             </table>
                                    </fieldset>

                                   
                                   </div>                                 
                                 </div>
                               </div>                            
                             </div>

                           </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End modal -->
                   <!-- Entrada y salida modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="entradasalidamodal" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Entrada y Salida</h4>
                        </div>
                        <div class="modal-body">
                          <!-- Registro de Salida -->
<div id="r_salida">
    <div id="form_contenedor">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div style="color:#000; aling-text:center; margin-left:35%;" >

          <label style="font-weight:bold;">Entrada</label> <input type="radio" name="entrada_salida" id="service_entrada">
          <label style="margin-left:5%; font-weight:bold;">Salida</label> <input type="radio" name="entrada_salida" id="service_salida"> 

        </div>

        <!--Registro de entrada-->
        <div id="entrada">
          <form action="registrando_insumos_e&s.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_EInterno();" enctype="multipart/form-data">
      
           <fieldset id="regmaq" style="color:#000;">
             <input type="hidden" name="tipo_registro" value="entrada"> 
             <input type="hidden" name="insumo" value="insumo" id="tipo">
             <input type="hidden" name="id_insu" id="idE">
             <input type="hidden" name="id_per" id="id_per">
             <input type="hidden" name="res" id="res">
               <input type="hidden" name="resE" id="resE">
                 
             <table width="100%;">
             <tr>
             <td>
             <label><b>Codigo del insumo:</b></label>
             <input readonly="readonly" type="text" style="text-transform:capitalize;" name="codigo" id="codigoE"  maxlength="15" placeholder="Ejemplo:To-00" title="Código del insumo"  />
             </td>
             <td>
             <label><b>Número del Bien:</b></label>  
             <input readonly="readonly"  type="text" name="n_b" id="NBE">
              </td>
              <td>
             <label><b>Nombre:</b></label>  
             <input readonly="readonly" type="text" name="descripcion" id="descripcionE">
             </td>
             </tr>
             <tr>
             <td>
             <label>Existencia:</label>
             <input type="text" readonly="readonly" name="existencia"  id="existenciaE" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" onblur="calculo_importe(); calculo_danada();">
             </td>
             <td>

             <label><b>Buenas:</b></label>
             <input type="text" readonly="readonly" name="buenas" id="buenasE" onblur="calculo_danada();">
            </td>
            <td>

            <label><b>Dañadas:</b></label>
            <input type="text" readonly="readonly" name="danadas" id="danadasE">
            </td>
            </tr>
            <tr>
            <td colspan="2">
            <label><b>Stock Minino:</b></label>
            <input type="text" readonly="readonly" name="minimo" id="minimoE">
            </td>
            <td>
            <label><b>Stock Máximo:</b></label>
            <input type="text" readonly="readonly" name="maximo" id="maximoE">
            </td>
            </tr>
            <tr>
            <td colspan="3" align="center">
               <hr>
            </td>
            </tr>

            <tr>
            <td>
             <label><b>Entrada</b></label>
             <input type="text" name="entrada" id="entrada_existencia" maxlength="10" onblur="calculo_danada_entradaInterna(); validarExistenciaEntradaInterna();" onkeyup="validarExistenciaEntradaInterna();" onKeyPress="return solonum(event)">
              <div class="promts" style="z-index:2; margin-left: -100px;"> <span id="existenciaEPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td >
             <label><b>Entrada de Buenas</b></label>
             <input type="text" name="entrada_buenas" id="entrada_buenas" maxlength="10" onblur="calculo_danada_entradaInterna(); validarBuenasEntrada(); validarEntradaDanadas();" onkeyup="validarBuenasEntrada(); validarEntradaDanadas();" onKeyPress="return solonum(event)">
             <div class="promts" style="margin-left: -35px;"> <span id="buenas1Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Entrada de Dañadas</b></label>
             <input readonly="readonly" type="text" name="entrada_danadas" id="entrada_danadas" style="margin-left:-50px;" >
              <div class="promts" style="z-index:1; margin-left: -39px;"> <span id="danadas1Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

               </td>
             </tr>
             <tr>
               <td colspan="3" align="center">
                <h3><div id="salidaR_INS_E"></div></h3>
              </td>
            </tr>
             <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>
             <tr>
             <td colspan="3" align="center">
             <br><br>
             <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" id="aceptar1" style="margin-left:-50px;"> 
              <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
             <br><br>
             </td>
             </tr>
             </table>
           </fieldset>
         </form>
       </div>

       <!-- Fin registro de entrada-->
       <!-- Registro de Salida -->
       <div id="salida">
        <form action="registrando_insumos_e&s.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_SInterno()" enctype="multipart/form-data" >
        
         <fieldset id="regmaq" style="color:#000;">
           <input type="hidden" name="tipo_registro" value="salida">
          
           <input type="hidden" name="id_insu" id="idS">
           <input type="hidden" name="id_per" id="id_per">
           <input type="hidden" name="res" id="res">
           <input type="hidden" name="resS" id="resS">

           <table width="100%">
           <tr>
           <td>
           <label><b>Codigo del insumo:</b></label>
           <input readonly="readonly" type="text" style="text-transform:capitalize;" name="codigo" id="codigoS"  maxlength="30" placeholder="Ejemplo:To-00" title="Código del insumo" />
           </td>
           <td>
           <label><b>Número del Bien:</b></label>  
           <input readonly="readonly" type="text" name="n_b" id="NBS">
           </td>
           <td>
           <label><b>Nombre:</b></label>  
           <input readonly="readonly" type="text" name="descripcion" id="descripcionS">
           </td>
           </tr>
           <tr>
           <td>
           <label>Existencia:</label>
           <input type="text" readonly="readonly" name="existencia" id="existencia2" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000">
           </td>
           <td>
           <label><b>Buenas:</b></label>
           <input type="text" readonly="readonly" name="buenas" id="buenas2" onblur="calculo_danada();">
          </td>
          <td>

          <label><b>Dañadas:</b></label>
          <input type="text" name="danadas" id="danadas2" readonly="readonly">
          
          </td>
          </tr>
          <tr>
            <td colspan="2">
            <label><b>Stock Minino:</b></label>
            <input type="text" readonly="readonly" name="minimo" id="minimoS">
            </td>
            <td>
            <label><b>Stock Máximo:</b></label>
            <input type="text" readonly="readonly" name="maximo" id="maximoS">
            </td>
            </tr>
           <tr>
            <td colspan="3" align="center">
               <hr>
            </td>
            </tr>
          <tr>
          <td>
              <label><b>Salida</b></label>
             <input type="text" name="salida" id="salida_existencia" maxlength="10" onblur="calculo_danada_salida(); validarExistenciaSalida();" onkeyup="validarExistenciaSalida();"   onKeyPress="return solonum3(event)">
            <div class="promts" style="z-index:3; margin-left: -79px;"> <span id="existencia2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Salida de Buenas</b></label>
             <input type="text" name="salida_buenas" id="salida_buenas" maxlength="10" onblur="calculo_danada_salida(); validarBuenasSalida(); validarSalidaDanadas();" onkeyup="validarBuenasSalida(); validarSalidaDanadas();"style="margin-left:-50px;" onKeyPress="return solonum3(event)">
             <div class="promts" style="z-index:2; margin-left: -48px;"> <span id="buenas2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

             </td>
              <td align="center">
             <label style="margin-left:-50px;"><b>Salida de Dañadas</b></label>
             <input readonly="readonly" type="text" name="salida_danadas" id="salida_danadas" style="margin-left:-50px;" >
              <div class="promts" style="z-index:1;"> <span id="danadas2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

          </td>
          </tr>
          <tr>
            <td colspan="3" align="center">
              <h3><div id="salidaR_INS_S"></div></h3>
            </td>
          </tr>
           <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>
          <tr>
          <td colspan="3" align="center">
           <br><br>

           <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" id="aceptar2" style="margin-left:-50px;"> 
            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
           <br><br>
           </td>
           </tr>
           </table>
         </fieldset>
       </form>
     </div>
     

     
   </div>                 
</div>

<!--Fin registro insumos salida-->

                        </div>
                        <div class="modal-footer">

                         


                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>

                  <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maq" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Insumo</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar este insumo?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_insumo">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Insumo()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>


                <!-- detalle Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_insumos" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Detalle del Insumo</h4>
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

                <!--Reporte de maquina-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="rep_maq" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Reporte de Insumos</h4>
                      </div>
                      <div class="modal-body">

                        <h4>¿Usted esta seguro de que desea generar el reporte de los insumos?</h4>                            

                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_maquina">

                        <button class="btn btn-primary" title="Aceptar" onclick="reporte_Insumo()" data-dismiss="modal" >Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                      </fieldset>

                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal Maquina con exito-->
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registrado_maquina" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header" id="exito">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                      <h4 class="modal-title">Registro de Insumos</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Insumo registrado correctamente</h4>    
                    </div>
                    <div class="modal-footer">

                     <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                     <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                   </div>
                 </div>
               </div>
             </div>
             <!-- End modal registro exito -->        

             <!-- Modal Editado con exito-->
             <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="editado_maquina" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="exito">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Editar Insumo</h4>
                  </div>
                  <div class="modal-body">

                    <h4>Insumo editado correctamente</h4>    
                  </div>
                  <div class="modal-footer">

                   <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

                   <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


                 </div>
               </div>
             </div>
           </div>
           <!-- End eliminar modal -->  
           
           <!-- detalle Modal -->
           <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="agua_maq" class="modal fade">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header" id="confirm">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                  <h4 class="modal-title">Reporte Insumo</h4>
                </div>
                <div class="modal-body">

                 <h4>¿Usted esta seguro de que desea generar el reporte de este insumo?</h4>                            

                 <input type="hidden" id="aceptar_reporte_insumo">
                 <input type="hidden" id="aceptar_reporte_preventivo2">
                 <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
               </div>
               <div class="modal-footer">
                <button class="btn btn-primary" title="Aceptar" onclick="reporteInsumo()" data-dismiss="modal" >Aceptar</button>
                <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

              </div>
            </div>
          </div>
        </div>
        <!-- End detalle modal --> 

        <!-- Modal Eliminado con exito-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="eliminado_maquina" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="exito">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Eliminar Insumo</h4>
              </div>
              <div class="modal-body">

                <h4>Insumo eliminado correctamente</h4>    
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

               <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


             </div>
           </div>
         </div>
       </div>
       <!-- End eliminar modal -->                

   </div>
 </div>

 <div id="r_insumos">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="">Insumos</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Insumos</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
         <div id="insumos">
          <form action="registrando_insumo.php" method="post" id="reg_maquina" name="reg_maquina" enctype="multipart/form-data" onSubmit="return validarForm()" >
                    
         <input type="hidden" name="tipo" id="tipo" value="registro">

            <input type="hidden" name="id_maq" id="id_maq">
            <input type="hidden" name="id_per" id="id_per">
            <input type="hidden" name="res" id="res">
            <input type="hidden" name="res2" id="res2">
                 <input type="hidden" name="resn" id="resn">
              
            <table width="100%">
            <tr>
             <td  align="center" colspan="3">
                
            <label>Ubicación:</label>
            <select name="ubicacion" id="ubicacion" class="form-control" style="width:500px; display:inline-block;"  title="Ingrese la ubicacion del insumo" onclick="validarUbicacion()" onblur="validarUbicacion()" onKeyPress="return soloAlfa(event)">
              <option></option>
              <option>Almacén 1</option>
              <option>Almacén 2</option>
            </select>
            <div class="promts"  style="margin-left:0px;" > <span id="ubicacionPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

        </td>
            </tr>
            <tr>
            <td colspan="2" align="center">

            <label><b>Codigo del insumo:</b></label>
            <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo"  maxlength="10" placeholder="Ejemplo:To-00" title="Código del insumo" onkeypress="return soloAlfa2(event)" onKeyup="existeCodigo();" onblur="existeCodigo();" />
           <div class="promts" style="margin-left: -15px;"> <span id="CodePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           </td>
              <td width="33%">
            <label><b>Nombre:</b></label>  
            <textarea type="text" name="nombre" id="nombre" placeholder="Tornillos" style="display:inline-block; resize:none; height:40px; width:140px;" title="Nombre del insumo" maxlength="100" onkeypress="return soloAlfa(event)" onkeyup="validarNombre()" onblur="validarNombre()"></textarea> 
            <div class="promts"> <span id="nombrePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </td>
           </tr>

           <tr>
        
            <td width="33%" align="center">
            <div  style="display: table;">
              <label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
                 <select name="pre_nb"  class="form-control" style="width:70px; padding:1px; height:23px; display:inline-block;" id="pre_nb" onclick="validar_Select_NB();" onchange="validar_Select_NB();">
                      <option>NB-</option>
                      <option>S/NB</option>
                    </select>
                <input type="text" name="n_b" title="Número del bien" id="NB" size="16" maxlength="6" placeholder="0978656" onKeyPress="return solonum(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
              <div class="promts" style="z-index:1;" id="promptNB"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
             </div>
             </td>
           
             <td width="33%">

            <label><b>Tipo de Medida</b></label> 
            <select name="tipo_medida" id="tipo_medida" class="form-control" style="width:170px" onclick="select_medida()" title="Tipo de medida del insumo">
              <option value="Milimetros">Milimetros</option>
              <option value="Pulgadas">Pulgadas</option>
              <option value="No aplica">No aplica</option>
            </select>
            </td>
            <td>
           
             <div id="medida1" style="display: table;">
             
            <label><b>Medida</b></label>  
            <input type="text" name="medida" id="medida_mil" size="" maxlength="5" onkeypress="return validarcoma(event,this)" onkeyup="validarMedida()" onblur="validarMedida()" title="Tamaño de la medida del insumo"> 
           <div class="promts"> <span id="medidaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          
           </div>
           


             <div id="medida2" style="display: table;">
             
            <label><b>Medida</b></label>  
            <input type="text" name="medida1" id="medida_pul" size="8" maxlength="2" onkeypress="return solonum3(event)"  onkeyup="validarMedida()" onblur="validarMedida()" title="Tamaño de la medida del insumo"> /
            <input type="text" name="medida2" id="medida2_pul" size="8" maxlength="2" onkeypress="return solonum3(event)">

           <div class="promts"> <span id="medida1Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           
           </div>

             <!--div id="medida3" style="display: table;">
             
            <label><b>Tipo de Maquina</b></label>  
            <select  name="medida" id="medida_maquina" size="" onclick="validarMedida()" onblur="validarMedida()" title="Tipo de maquina" class="form-control" style="width:170px;  display:inline-block;"> 
            <option value="Torno">Torno</option>
            <option value="Esmeril">Esmeril</option>
            <option value="Limadora">Limadora</option>
            <option value="Fresadora">Fresadora</option>
            <option value="Taladro">Taladro</option>
          </select>
          <div class="promts" > <span id="medida3Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           </div-->
           </td>
              </tr>
             <tr>
                       
              <td>  
             <div  style="display: table;">
            <label>Precio Unitario:</label>
            <input type="text" name="precio" id="precio" style="width:140px;" size="" maxlength="10" onblur="calculo_importe(); validarPrecio();" onkeyup="validarPrecio();" onkeypress="return solonum3(event,this)" title="Precio del insumo">
            <input type="text" readonly="readonly" name="moneda" value="Bs" size="3">
            <div class="promts" style="margin-left: -75px;"> <span id="precioPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </div>
            </td>
            
            <td>

            <label>Existencia:</label>
            <input type="text" name="existencia" id="existencia"  size="" maxlength="10" placeholder="" onblur="calculo_importe(); calculo_danada(); validarExistencia();" onkeyup="validarExistencia()" onkeypress="return solonum3(event)" title="Existencia del insumo">
            <div class="promts" style="z-index:1;"> <span id="existenciaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </td>
            
            
            <td>
            <label><b>Buenas</b></label>
            <input type="text" name="buenas" id="buenas" maxlength="10" onblur="calculo_danada(); validarBuenas();" onkeyup="validarBuenas()" onkeypress="return solonum3(event)" title="Cantidad de insumos buenos">
             <div class="promts"> <span id="buenasPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

            </td>
            </tr>
            <tr>
            <td>
            <label><b>Dañadas</b></label>
            <input type="text" name="danadas" id="danadas" readonly="readonly" title="Cantidad de insumos dañados">
           <div class="promts"> <span id="danadasPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

            </td>
       
            <td>

             <label>Stock Minimo:</label>
            <input type="text" name="minimo" id="minimo"  size="" maxlength="10" placeholder="" onblur="min_stock();" onkeyup="min_stock();" onKeyPress="return solonum3(event)" title="Stock Minimo">
            <div class="promts"> <span id="minimoPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          </td>
           <td>
            <label>Stock Maximo:</label>
             <input type="text" name="maximo" id="maximo"  size="" maxlength="10" placeholder="" onblur="max_stock();" onkeyup="max_stock();" onKeyPress="return solonum3(event)" title="Stock Maximo">
            <div class="promts" style="z-index:1;"> <span id="maximoPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </td>
            </tr>
            <tr>
           

          <!--<td>
            <label>Recambio:</label>
            <input type="text" name="recambio" id="recambio"  size="" maxlength="10" placeholder="" onkeypress="return solonum3(event)" onblur="min_recambio();" title="Aviso para el reabastecimiento el insumo">
            <div class="promts"> <span id="recambioPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          </td>-->
           <td colspan="3" align="center">

         
            <div  style="display: table;">
           <label>Importe:</label>
            <input readonly="readonly" type="text" name="importe" id="importe" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" title="precio total en existencia">
            <input type="text" readonly="readonly" name="moneda" value="Bs" size="3">            
            <div class="promts"> <span id="importePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </div>
            </td>
             
          </tr>
           <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>
          <tr>
             <td colspan="3" align="center">
              <h3><div id="salidaR_INS"></div></h3>
            </td>
          </tr>
           <tr>
            <td colspan="3" align="center">
            <br><br>

            <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" style="margin-left:-50px;"> 
            <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
            <br></br>
            </td>
            </tr>
          
          </table>
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
        <h4 class="modal-title">Registro Insumos</h4>
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

<!-- Modal Error formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompletomod" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Modificar Insumos</h4>
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

<!-- Modal Error registrando formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_form" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Insumos</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Error en el registro del Insumo: </h4> <div style="font-size:17px; color:#000000;" id="error_mensaje"></div>
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

<!-- Modal Existencia <=Stock min-->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="control_min_stock" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header" id="confirm">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                <h4 class="modal-title">Control de Insumos</h4>
              </div>
              <div class="modal-body">
              <h4>Insumos que han llegado al punto de Stock Minimo:</h4><br>
                <div class="dataTable_wrapper">
              <table class="table table-striped table-bordered table-hover" >
                <thead>
                          <tr>
                            <th>Código</th>
                            <th>Numero del Bien</th>
                            <th>Nombre</th>
                          </tr>
                          <tr class="odd gradeX" style="color:#000;">
                          </tr>
                        </thead>
                        <tbody   id="control_min_mensaje" >
                          
                        </tbody>
              </table>
              </div>
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

             </div>
           </div>
         </div>
       </div>
       <!-- End Existencia <= Stock min modal -->
       
     </ajax>
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
<script type="text/javascript" src="js/vali_insu.js"></script>
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

</body>
</html>


<?php
#ELIMINAR MAQUINA
$error=$_REQUEST['form_error'];

if ($error=='1')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
     var mensaje="El Numero del bien ya existe, Formulario no procesado";
    
    $("#error_mensaje").html('<br>'+mensaje);

    $('#error_form').modal({
      show:true,
      backdrop:'static'
    }).show(200);
   
        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }

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
      </script>
      <?php
    }

$sqlmin="SELECT * FROM insumos i, numero_bien n WHERE i.n_b=n.id_nb AND i.existencia <= i.min_stock  AND i.estatus=1 AND i.taller=2";

$querymin=pg_query($sqlmin);

while($encontrado2=pg_fetch_assoc($querymin)){
$insumo2=$insumo2."<tr><td>".$encontrado2["codigo_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
}
$verifica2=pg_num_rows($querymin);

if($verifica2 > 0){
?>
<script type="text/javascript">
  var codigo2="<?php echo $insumo2; ?>";
$('#control_min_mensaje').html(codigo2);

 $('#control_min_stock').modal({
            show:true,
            backdrop:'static'
        });

</script>
<?php
}
?>