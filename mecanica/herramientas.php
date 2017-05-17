<?php
require('seguridad.php');
require('conexion.php');

$sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 LIMIT 1";
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
  <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">

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

                     <div id="carga"><h3>Cargando por favor espere...</h3><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>




               <div id="consulta_herra">

                <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="#">Herramientas</a></h4>
                <div class="info3">
                  <div id="text_center_title">
                    <span class="t-menu">Consulta de Herramientas</span>
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
                        <!--<a href="herramientas_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
                       <!-- <a href="prestamos.php" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Prestamos &nbsp;  <span class="fa fa-exchange"></span></button></a> -->


                        <p id="agregar_herra" style="  margin-top: 1%;
                        margin-left: 56%;
                        margin-bottom: 1%;
                        display: inline-block;"><button class="btn btn-success"  >Nueva Herramienta &nbsp; <i class="fa fa-plus"></i></button></p> 
                        <?php  
                      }
                      ?>
                    </td>
                  </tr>
                </table>
                <div align="center">

                <?php
                $estante="SELECT estante FROM herramientas WHERE estatus=1 AND taller=1 GROUP BY estante ORDER BY estante ASC";
                $querye=pg_query($estante);
                ?>
                <label>Estante</label>
                <select id="estanteSelect" onchange="mostrarHerramientas();"  class="form-control" style="width:12%;">
                <option value="0"></option>
                <?php
                while ($array=pg_fetch_assoc($querye)) {
                	?>
                	<option value="<?php echo $array['estante']; ?>"><?php echo $array['estante']; ?></option>
                	<?php
                }
                ?>
                </select>

                <br><br>
                 <div id="content">
                 </div>


                </div>
                <div  id="tabla_usuario">

                   <div class="dataTable_wrapper" id="dataTable_wrapper2">
                  <!-- <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                          <th>Código</th>
                          <th>Numero del Bien</th>
                          <th>Nombre</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                     
                        <?php
                     /*   $sql="SELECT * FROM herramientas h, numero_bien n WHERE h.n_b=n.id_nb AND h.estatus=1 AND h.taller=1";



                        $query=pg_query($sql);

                        while ($array=pg_fetch_assoc($query))
                        { 
                          $var=$array['estado'];
                          ?>
                          <tr class="odd gradeX">
                            <td align="center"><?php echo $array['codigo_herramienta'];?></td>
                            <td align="center"><?php echo $array['nb'];?></td>
                            <td align="center"><?php echo $array['nombre']; ?></td>
                            <td align="center"><?php echo $array['estado']?></td>
                            <td align="center">
                              <?php
                              if ($privilegio_M=='M')
                              {

                                ?>    
                                <a  <?php if ($var=='En prestamo')
                                {
                                  ?> href="#"
                                  <?php 
                                }
                                else
                                {
                                  ?>
                                  href="javascript:editar_herramientas(<?php echo $array['id_herramienta'];?>);"    
                                  <?php    
                                }
                                ?>
                                >
                                <button class="btn btn-default"
                                <?php if ($var=='En prestamo')
                                {
                                  ?> title="No se puede modificar la herramienta mientras este en prestamo"
                                  <?php 
                                }
                                else
                                {
                                  ?>
                                  title="Modificar"
                                  <?php    
                                }
                                ?>
                                id="Modificar">
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
                            <?php
                            if ($var=='En prestamo')
                            {
                              ?>
                              <a href="#">
                                <button class="btn btn-default" title="No se puede eliminar la herramienta mientras este en prestamo">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                              <?php
                            }
                            else
                            {
                              ?>
                              <a href="javascript:eliminarHerramienta(<?php echo $array['id_herramienta'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                              <?php
                            }
                            ?>

                            <?php
                          }
                          ?>
                          <a href="javascript:detalleHerramienta(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Ver">
                              <span class="fa fa-search-plus"></span>
                            </button>
                          </a>

                          <a href="javascript:reportandoHerramienta(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Reporte">
                              <span class="fa fa-print"></span>
                            </button>
                          </a>
                          <?php
                          if ($array['cantidad']!=$array['cantidad_p'])
                          {
                            ?>
                            <a href="javascript:Prestamo(<?php echo $array['id_herramienta'];?>);">                
                              <button class="btn btn-default" title="Prestar Herramienta">
                                <span class="fa fa-hand-o-up"></span>
                              </button>
                            </a>
                            <?php
                            if ($array['cantidad_p']=='1'){

                             ?>
                            <a href="javascript:Devolucion(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php
                            }
                            else if($array['cantidad_p']>'1'){
                                ?>
                            <a href="javascript:DevolucionV(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php

                            }
                          }
                          else{
                            if ($array['cantidad_p']=="1"){
                            ?>
                            <a href="javascript:Devolucion(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php
                            }
                             else if ($array['cantidad']=="0"){
                            ?>
                           

                            <?php
                            }
                            else{
                            ?>
                           <a href="javascript:DevolucionV(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php
                            }
                          }
                          ?>
                        </td>
                      </tr>
                      <?php
                    }
                    */?>
                  </tbody>
                                  </table> -->
              </div>

            </div>
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Modificar Herramienta</h4>
                  </div>
                  <div class="modal-body">
                    <ul class="nav nav-tabs">
                      <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                      <li class="active"><a href="#tabherramientamod" data-toggle="tab">Herramienta I</a></li>
                      <li><a href="#tabherramientamodx" data-toggle="tab">Herramienta II</a></li>

                    </ul>

                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="tabherramientamod">
                       <div class="panel panel-default">
                         <div class="panel-body">
                           <form action="modificar_herramientas.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarmodform()" enctype="multipart/form-data">


                             <fieldset id="regmaq">

                              <input type="hidden" id="idmod" name="id" /> <!--id de la herramienta-->
                              <input type="hidden" name="tipo" id="Mtipo" value="modificacion">
                              <input type="hidden" name="Mresn" id="Mresn" value="1">
                              <input type="hidden" name="resMC" id="resMC" value="1">
                              <input type="hidden" name="resMS" id="resMS" value="1">
                              <input type="hidden" id="ids_mant_mod" name="ids" />
                              <input type="hidden" id="m_id_nb" name="id_nb" /> <!--id del znb-->

                              <table width="100%">
                                <tr>

                                  <td align="center" colspan="2">
                                    <label><b>Ubicación:</b></label><br> 
                                    <select name="ubicacion" id="ubicacionmod" class="form-control" style="width:500px; display:inline-block;"  title="Ingrese la ubicacion de la herramienta" onclick="validarM_Ubicacion()" onblur="validarM_Ubicacion()" onKeyPress="return soloAlfa(event)">
                                      <option></option>
                                      <option>Almacén De Maquina y de Herramienta</option>
                                      <option>Almacén De Soldadura</option>
                                      <option>Almacén De Suministros y Accesorio de Maquinas</option>
                                    </select>
                                    <div class="promts"> <span id="ubicacionmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      
                                    <br><br>
                                  </td>


                                </tr>
                               <!-- <tr>

                                  <td colspan="2" align="center">
                                    <br> 
                                    <label><b>Codigo de la herramientas:</b></label><br>
                                    <input type="text" style="text-transform:capitalize; " class="form-control input_size" name="codigo" id="codigomod"  maxlength="10" placeholder="Ejemplo:To-00" title="Código de la herramienta" onkeypress="return soloAlfa(event)" onblur="existeCodigo2()" onkeyup="existeCodigo2()" />
                                    <div class="promts" style="margin-left:0px;"> <span id="CodemodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <br><br>
                                  </td>
                                </tr>-->
                                <tr>
                                  <td align="center">
                                    <label><b>Nombre:</b></label> <br> 

                                    <textarea type="text" name="nombre" id="nombremod" class="form-control input_size" style="resize:none; height:80px; width:80%; display:inline-block; " maxlength="100" onkeyup="validarM_Nombre()" onblur="validarM_Nombre()" onKeyPress="return soloAlfa(event)"></textarea> 
                                    <div class="promts" > <span id="nombremodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

                                  </td>
                                  <td align="center">

                                    <div  style="display: table;">
                                      <label><b>Numero del bien:</b></label><br>
                                      <select id="pre_nbmod" name="pre_nb" class="form-control" style="width:100px; display:inline-block;" onclick="validar_Select_NBmod();">
                                        <option>NB-</option>
                                        <option>S/NB</option>
                                      </select>
                                      <input type="text" name="n_b" id="MNB" maxlength="6" class="form-control input_size" style="width:110px; " onKeyUp="validarM_N_B()" onBlur="validarM_N_B()" onchange="validarM_N_B()" onKeyPress="return solonum3(event)"/>
                                      <div class="promts" style="z-index:1; margin-left: -27px;" id="promptNBM"> <span id="MN/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      
                                      <span id="contrasena"></span>
                                      <input type="hidden" id="Mres" name="Mres" value="1" />
                                    </div>
                                    <br>
                                  </td>
                                </tr>
                                <tr>
                                <td align="center">
                                  <br><br>
                  <label><b>Estante:</b></label>  
                  <input type="text" name="estante" id="estantemod" class="form-control" maxlength="2" style="width:100px; display:inline-block;" onKeyUp="validarEstantemod()" onblur="validarEstantemod()"  onKeyPress="return solonum2(event)">
                  <div class="promts"> <span id="EstantemodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                </td>
                                

                                 <td align="center" >
                                  <label><b>Imagen:</b></label>
                                  <input type="file" size="60" value="Sin imagen" name="imagen" onchange="return checkForm(this.files,this);" id="foto1">
                                  <input type="hidden" id="inputimagen" name="inputimagen">
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center"><br>
                                  <div id="div_quitar_imagen">
                                    <input type="button" id="quitar_imagen" value="Quitar imagen" class="form-control input_size" />
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center">
                                  <br>
                                  <div id="previewcanvascontainer">
                                   <img src="" id="muestra" style="max-width: 500px;  max-height: 350px;  "/>
                                   <canvas id="previewcanvas" style="max-width: 500px; width:500px; height:350px; max-height: 350px;  ">
                                   </canvas>
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
                   <div class="tab-pane fade" id="tabherramientamodx">
                     <div class="panel panel-default">
                       <div class="panel-body">
                         <fieldset >

                           <table width="100%">
                             <tr>
                              <td align="center">
                                <label><b>Serial:</b></label>  <br> 
                    <select name="pre_serial"  class="form-control" style="width:120px; display:inline-block;" id="pre_serialmod" onclick="validar_Select_Serialmod();" onchange="validar_Select_Serialmod();">
                      <option>Serial</option>
                      <option>S/Serial</option>
                    </select>
                                <input type="text" name="serial" id="serialmod" class="form-control input_size" maxlength="15" onKeyUp="existeSerial2()" onblur="existeSerial2()"  onKeyPress="return solonum3(event)">
                                <div class="promts" style="margin-left:-22px;" id="promptSerialmod"> <span id="SerialmodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      


                              </td>
                              <td align="center">
                                <label><b>Marca:</b></label>  <br> 
                                <input type="text" name="marca" id="marcamod" maxlength="15" class="form-control input_size" onKeyUp="validarM_Marca()" onblur="validarM_Marca()"  onKeyPress="return soloAlfa(event)" >
                                <div class="promts"> <span id="marcamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                              </td>
                              <td align="center">
                                <label><b>Estado</b></label>  <br> 
                                <select name="estado" id="estadomod" class="form-control  input_size" >
                                  <option value="Operativo">Operativo</option>
                                  <option value="No Operativo">No Operativo</option>
                                  <option value="Completo">Completo</option>
                                  <option value="Incompleto">Incompleto</option>
                                  <option value="Usado">Usado</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                                        <td align="center">
                                        
                                       <br>   <label><b>Tipo de Medida</b></label>    <br>
                                        <select name="tipo_medida" id="tipo_medidamod" style="width:170px; display:inline-block;" class="form-control" title="Tipo de medida">
                                          <option value="Milimetros">Milimetros</option>
                                          <option value="Pulgadas">Pulgadas</option>
                                        </select>

                                       



                                        </td>
                                        <td align="center">
                                       
                                        
                                   

                                        <div id="div_medidaM1">
                                       <br>  <label><b>Medida</b></label>    <br>

                                        <input type="text" name="medida" id="medidamod" size="10" maxlength="20" style="width:120px; display:inline-block;" class="form-control" onKeyUp="validarMedidamod()" onBlur="validarMedidamod()"  onKeyPress="return soloAlfa2(event)" title="Tamaño medida">
                                        <div class="promts" style="margin-left: -13px;"> <span id="medidamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                        </div>
                                            </td>
                                              <td>

          <br>   <label><b>Cantidad:</b></label>   <br>
            <input type="text" name="existencia" id="existenciamod" size="" maxlength="10" placeholder="" onblur="validarExistencia2()" onkeyup="validarExistencia2()" style="width:160px; display:inline-block;" class="form-control" onkeypress="return solonum3(event)" title="Cantidad" >
            <div class="promts"> <span id="existenciamodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
              <br>
              </td>
                                            </tr>  
                                              <tr>
               <td colspan="3" align="center">
                <h3><div id="salidaM_INS"></div></h3>
              </td>
            </tr>  
              <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>                  

                            <tr>
                              <td class="tit" colspan="3"><br>
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

      <!-- eliminar modal-->
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maq" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" id="confirm">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
              <h4 class="modal-title">Eliminar Herramienta</h4>
            </div>
            <div class="modal-body">

              <h4>¿Usted esta seguro que desea eliminar esta Herramienta?</h4>                            

            </div>
            <div class="modal-footer">

              <input type="hidden" id="aceptar_elim_herramienta">

              <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Herramienta()">Aceptar</button>
              <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

            </fieldset>


          </div>
        </div>
      </div>
    </div>

  


            


    <!-- eliminar modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_img" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" id="alert">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
            <h4 class="modal-title">Quitar Imagen de la Herramienta</h4>
          </div>
          <div class="modal-body">

            <h4>¿Usted esta seguro que desea quitar la imagen de la herramienta?</h4> 
            <br>                           
            <h4>Si así lo desea pulse aceptar y guarde los cambios, de lo contrario pulse cancelar</h4> 
          </div>
          <div class="modal-footer">


            <button class="btn btn-primary" title="Aceptar" id="aceptar_imagen" data-dismiss="modal">Aceptar</button>
            <button class="btn btn-danger" data-dismiss="modal" title="Cancelar" id="cancelar_imagen">Cancelar</button>




          </div>
        </div>
      </div>
    </div>
    <!-- fin eliminr imagen-->

    <!-- eliminar modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="blockeo_mod" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" id="alert">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
            <h4 class="modal-title">Modificar Herramienta</h4>
          </div>
          <div class="modal-body">

            <h4>La herramienta se encuentra en estado de prestamo</h4> 
            <br>                           
            <h4>Para cambiar el estado, dirijase al módulo de prestamo de la herramienta</h4> 
          </div>
          <div class="modal-footer">


            <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>



          </div>
        </div>
      </div>
    </div>
    <!-- fin eliminr imagen-->

    <!-- eliminar modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="blockeo_elim" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" id="alert">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
            <h4 class="modal-title">Eliminar Herramienta</h4>
          </div>
          <div class="modal-body">

            <h4>La herramienta se encuentra en estado de prestamo</h4> 
            <br>                           
            <h4>Para cambiar el estado, dirijase al módulo de prestamo de la herramienta</h4> 
          </div>
          <div class="modal-footer">


            <button class="btn btn-primary" title="Aceptar" data-dismiss="modal">Aceptar</button>



          </div>
        </div>
      </div>
    </div>
    <!-- fin eliminr imagen-->

    <!-- eliminar modal-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="prestamo_modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
            <h4 class="modal-title">Agregar Prestamo</h4>
          </div>
          <div class="modal-body">


            <!-- Registro de prestamo -->
            <div id="r_prestamo">

              <div id="form_contenedor">

               <div>
                <form action="registrando_prestamo.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_PInterno()" enctype="multipart/form-data" >

                 <fieldset id="regmaq" style="color:#000;">


                  <input type="hidden" name="tipo" value="interno">
                   <input type="hidden" name="id_herra" id="idH">
                   <input type="hidden" name="id_per" id="id_per">
                   <input type="hidden" name="res" id="res">
                   <input type="hidden" name="resS" id="resS">

                   <table width="100%">
                     <tr>
                     <!--  <td>
                        <label><b>Codigo de la herramienta:</b></label>
                        <input readonly="readonly" type="text" style="text-transform:capitalize;" name="codigo" id="codigoP" maxlength="10" placeholder="Ejemplo:To-00" title="Código de la herramienta"  />

                      </td>-->
                      <td>
                        <div  style="display: table;">
                          <label><b>Numero del bien:</b></label>
                          <input readonly="readonly" type="text" name="n_b" id="NBP" maxlength="6" style="width:110px; "   onKeyPress="return solonum3(event)" title="Número del bien" />
                          <input type="hidden" id="Mres" name="Mres" value="1" />
                        </div>
                      </td>
                      <td colspan="2">
                       <label><b>Nombre:</b></label>  
                       <input readonly="readonly" type="text" name="nombre" id="nombreP" style="width:400px">
                     </td>
                   </tr>
                   <tr>
                     <td>
                      <input type="hidden" name="validar_ci_ajax" id="validar_ci_ajax" >

                      <label><b>C.I. Encargado:</b></label>
                      <select id="nac_usu" name="nac_usu" title="Seleccione la nacionalidad de la persona">
                        <option></option>
                        <option>V-</option>
                        <option>E-</option>
                      </select>
                      <input type="text" name="ci_usu" id="ci_usu" onblur="personal_herra(); validarCI();" maxlength="9" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona" onKeyUp="validarCI()" onchange="validarCI()" onKeyPress="return solonum3(event)"/>
                      <div class="promts" style="margin-left:-70px;"> <span id="C.I_per"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>

                    </td>
                    <td>
                      <label><b>Nombres:</b></label>
                      <input readonly="readonly" type="text" name="nombres_usu" id="nombres_usu" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>
                      <span id="nombres"></span>   
                    </td>
                    <td>
                      <label><b>Apellidos:</b></label>
                      <input readonly="readonly" type="text" name="apellidos_usu" id="apellidos_usu" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
                      <span id="apellidos"></span>  
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label>Fecha del prestamo:</label>
                      <input type="text" name="fecha" id="fecha" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" onclick="validarFecha()" onchange="validarFecha(); validarFecha2();" onblur="validarFecha()">
                      <div class="promts" style="margin-left:-20px; z-index:2;"> <span id="fechaPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                    </td>

                    <td>
                      <label>Fecha Tentativa<br> de Devolución:</label>
                      <input type="text" name="fecha2" id="fecha2" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" onclick="validarFecha2()" onchange="validarFecha2()" onblur="validarFecha2()">
                      <div class="promts" style="margin-left:-50px;"> <span id="fecha2Prompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                    </td>
                    <td>

                      <input type="hidden" name="resultado_fecha" id="resultado_fecha">

                      <label>Responsable:</label>
                      <input type="text" name="responsable" style="display:inline-block;" id="responsable" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsable();" onblur="validarResponsable();" onKeyPress="return soloAlfa(event)">
                      <div class="promts" > <span id="responsablePrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>

                       <label>C.I. Responsable:</label>
                       <select id="nac_res" name="nac_res" title="Seleccione la nacionalidad de la persona">
                        <option></option>
                        <option>V-</option>
                        <option>E-</option>
                      </select>
                      <input type="text" name="ci_res" style="display:inline-block;" id="ci_res" size="" maxlength="9" placeholder="00000000" onKeyUp="validarCIResponsable();" onblur="validarCIResponsable();" onKeyPress="return solonum3(event)">
                      <div class="promts" > <span id="ciresponsablePrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>

                    

                    </td>
                  </tr>
                        <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   
                  <tr>
                    <td colspan="3" align="center">
                      <h3><div id="control_herra_P"></div></h3>
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


     <!--Fin registro prestamo-->

   </div>
   <div class="modal-footer">





   </div>
 </div>
</div>
</div>
<!-- fin eliminr imagen-->



<!-- detalle Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_herramientas" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Detalle de la Herramienta</h4>
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
        <h4 class="modal-title">Reporte de Herramienta</h4>
      </div>
              <form action="pdf/tcpdf/herramientas/reporte_herramientas.php" method="get" target="_blank">

      <div class="modal-body">

        <h4>¿Usted esta seguro que desea generar el reporte de las herramienta?</h4>                            
          <?php
                $estante="SELECT estante FROM herramientas WHERE estatus=1 AND taller=1 GROUP BY estante ORDER BY estante ASC";
                $querye=pg_query($estante);
                ?>
                <div align="center">
                <label>Estante</label>
                <select name="estante"  class="form-control" style="width:12%;">
                <?php
                while ($array=pg_fetch_assoc($querye)) {
                	?>
                	<option value="<?php echo $array['estante']; ?>"><?php echo $array['estante']; ?></option>
                	<?php
                }
                ?>
                </select>
                </div>
      </div>
      <div class="modal-footer">

        <input type="hidden" id="aceptar_elim_maquina">

        <input class="btn btn-primary" title="Aceptar" value="Aceptar" type="submit">
        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
         
    </div>
     </form>

  </div>
</div>
</div>

<!-- Modal Maquina con exito-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="registrado_maquina" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="exito">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Herramienta</h4>
      </div>
      <div class="modal-body">

        <h4>Herramienta registrada correctamente</h4>    
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
        <h4 class="modal-title">Editar Herramientas</h4>
      </div>
      <div class="modal-body">

        <h4>Herramienta editada correctamente</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End eliminar modal -->  

<!-- Modal Editado con exito-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="devuelta_herra" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="exito">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Devolución Herramientas</h4>
      </div>
      <div class="modal-body">

        <h4>Herramienta devuelta correctamente</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End eliminar modal -->  

<!-- Modal Editado con exito-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="prestada_herra" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="exito">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Prestamo Herramientas</h4>
      </div>
      <div class="modal-body">

        <h4>Herramienta prestada correctamente</h4>    
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
        <h4 class="modal-title">Reporte Herramienta</h4>
      </div>
      <div class="modal-body">

       <h4>¿Usted esta seguro de que desea generar el reporte de esta Herramienta?</h4>                            

       <input type="hidden" id="aceptar_reporte_herramienta">
     </div>
     <div class="modal-footer">
      <button class="btn btn-primary" title="Aceptar" onclick="reporteHerramienta()" data-dismiss="modal" >Aceptar</button>
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
        <h4 class="modal-title">Eliminar Herramienta</h4>
      </div>
      <div class="modal-body">

        <h4>Herramienta eliminada correctamente</h4>    
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

<div id="r_herramientas">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="herramientas.php">Herramientas</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Herramientas</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div id="herramientas">
          <form action="registrando_herramienta.php" method="post" id="reg_maquina" name="reg_maquina"  enctype="multipart/form-data" onSubmit="return validarForm()" >
           <!--fieldset id="regmaq" style="color:#000;->
           <div class="table-responsive"-->
             <input type="hidden" name="tipo" id="tipo" value="registro">
             <input type="hidden" name="id_maq" id="id_maq">
             <input type="hidden" name="id_per" id="id_per">
             <input type="hidden" name="res" id="res">
             <input type="hidden" name="res2" id="res2">
             <input type="hidden" name="resS" id="resS">     
             <input type="hidden" name="resn" id="resn">
             <table width="100%">
              <tr>
                <td  align="center" colspan="3">

                  <label>Ubicación:</label>
                  <select name="ubicacion" id="ubicacion" class="form-control" style="width:500px; display:inline-block;"  title="Ingrese la ubicacion de la herramienta" onclick="validarUbicacion()" onblur="validarUbicacion()" onKeyPress="return soloAlfa(event)">
                    <option></option>
                    <option>Almacén De Maquina y de Herramienta</option>
                    <option>Almacén De Soldadura</option>
                    <option>Almacén De Suministros y Accesorio de Maquinas</option>
                  </select>
                  <div class="promts"  style="margin-left:0px;" > <span id="ubicacionPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                </td>
              </tr>
              <tr>
               <!-- <td width="33%"  align="center">

                  <label><b>Codigo de la herramientas:</b></label>
                  <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo"  maxlength="10" placeholder="Ejemplo:To-00" title="Código de la herramienta" onKeyUp="existeCodigo()" onblur="existeCodigo()" onKeyPress="return soloAlfa(event)"/>
                  <div class="promts" style="margin-left:5px;"> <span id="CodePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

                </td>-->
                <td colspan="" align="center">
                  <label><b>Nombre:</b></label>  
                  <textarea type="text" name="nombre" id="nombre" style="resize:none; height:40px" maxlength="100" onkeyup="validarNombre()" onblur="validarNombre()" onKeyPress="return soloAlfa(event)"></textarea> 
                  <div class="promts" style="margin-left: 100px; margin-top: -70px;"> <span id="nombrePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red; margin-left: 130px; margin-top: -40px;">*</p>

                </td>

              
                <td  align="center" colspan="2">
                  <div  style="display: table;">
                    <label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
                    <select name="pre_nb" style="display:inline-block;" id="pre_nb" onclick="validar_Select_NB();" onchange="validar_Select_NB();">
                      <option>NB-</option>
                      <option>S/NB</option>
                    </select>
                    <input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="16" maxlength="6" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onclick="validarN_B()" onchange="validarN_B()" >
                    <div class="promts" style="margin-left:-22px;" id="promptNB"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                  </div>
                </td>
                </tr>

              <tr>
                <td width="33%" align="center">

                  <label><b>Serial:</b></label>  
                   <select name="pre_serial" style="display:inline-block;" id="pre_serial" onclick="validar_Select_Serial();" onchange="validar_Select_Serial();">
                      <option>Serial</option>
                      <option>S/Serial</option>
                    </select>
                  <input type="text" name="serial" id="serial" maxlength="15" onKeyUp="existeSerial()" onblur="existeSerial()"  onKeyPress="return solonum3(event)">
                  <div class="promts" style="margin-left:-22px;" id="promptSerial"> <span id="SerialPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                </td>
                <td  width="33%" align="center">

                  <label><b>Marca:</b></label>  
                  <input type="text" name="marca" id="marca" onKeyUp="validarMarca()" maxlength="15" onblur="validarMarca()" onKeyPress="return soloAlfa(event)">
                  <div class="promts"  style="z-index:1;"> <span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                </td>
              </tr>
              <tr>
                <td  align="center">
                  <label><b>Estado</b></label>  
                  <select name="estado" id="estado">
                    <option value="Operativo">Operativo</option>
                    <option value="No Operativo">No Operativo</option>
                     <option value="Completo">Completo</option>
                    <option value="Incompleto">Incompleto</option>
                    <option value="Usado">Usado</option>
                  </select>
                </td>
                <td width="33%" align="center">

                  <label><b>Estante:</b></label>  
                  <input type="text" name="estante" id="estante" maxlength="2" onKeyUp="validarEstante()" onblur="validarEstante()"  onKeyPress="return solonum2(event)">
                  <div class="promts"> <span id="EstantePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>      

                </td>
                <td  align="center">
                  <label>Imagen:</label>
                  <input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

                </td>
              </tr>
              <tr>
             
             <td align="center">

            <label><b>Tipo de Medida</b></label> 
            <select name="tipo_medida" id="tipo_medida" class="form-control" style="width:170px" onclick="select_medida()" title="Tipo de medida">
              <option value="Milimetros">Milimetros</option>
              <option value="Pulgadas">Pulgadas</option>
            </select>
            </td>
            <td align="center">
           
             <div id="medida1" style="display: table;">
             
            <label><b>Medida</b></label>  
            <input type="text" name="medida" id="medida_mil" size="" maxlength="20" onkeypress="return soloAlfa2(event)" onkeyup="validarMedida()" onblur="validarMedida()" title="Tamaño de la medida"> 
           <div class="promts"> <span id="medidaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
          
           </div>
           


             <div id="medida2" style="display: table;">
             
            <label><b>Medida</b></label>  
            <input type="text" name="medida1" id="medida_pul" size="8" maxlength="2" onkeypress="return solonum3(event)"  onkeyup="validarMedida()" onblur="validarMedida()" title="Tamaño de la medida"> /
            <input type="text" name="medida2" id="medida2_pul" size="8" maxlength="2" onkeypress="return solonum3(event)">

           <div class="promts"> <span id="medida1Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
           
           </div>
           </td>
              <td width="33%" align="center">

            <label>Cantidad:</label>
            <input type="text" name="existencia" id="existencia"  size="" maxlength="10" placeholder="" onblur="calculo_importe(); calculo_danada(); validarExistencia();" onkeyup="validarExistencia()" onkeypress="return solonum3(event)" title="Cantidad">
            <div class="promts" style="z-index:1;"> <span id="existenciaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            
            </td>
              </tr>

               <tr>
             <td colspan="3" align="center">
              <h3><div id="salidaR_INS"></div></h3>
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

                 <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar"> 
                 <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
               </td>
             </tr>
           </table>

           <br><br>
             <!--/div>
           </fieldset-->

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
        <h4 class="modal-title">Registro Herramienta</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Extensión no valida</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar" id="btn_error_imagen">Aceptar</button>

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
        <h4 class="modal-title">Registro Herramienta</h4>
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
        <h4 class="modal-title">Registro Herramienta</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Error en el registro de la herramienta: </h4> <div style="font-size:17px; color:#000000;" id="error_mensaje"></div>
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

  <div id="c_herra">
     <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="herramientas.php">Herramientas</a> <span>></span> <a href="#"> Prestamos </a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Prestamos</span>
                </div>

                 <!-- <p id="reporte_clau" style="display: inline-block; margin-top: 1%; margin-left: 2%; margin-bottom: 1%;"><button class="btn btn-default"  >Generar Reporte &nbsp;  <span class="fa fa-file-text-o"></span></button></p> -->

               <!-- <a href="insumos_e&s.php" id="insumo_entrada_salida" style="display: inline-block;  margin-left: 30%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Entrada/Salida &nbsp;  <span class="fa fa-exchange"></span></button></a> -->
               
                  <div  id="tabla_usuario">

                    <div class="dataTable_wrapper">

                      <table class="table table-striped table-bordered table-hover" id="dataTables-exampleClausulas">
                        <thead>
                          <tr>
                            <th width="20">N°</th>
                            <th width="200">Encargado</th>
                            <th width="200">Responsable</th>
                            <th width="50">Realizado</th>
                        
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody id="tbody_consultaClau">
                        
                        </tbody>
                      </table>
                    </div>

                  </div>
  </div>
  </div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_prestamo" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Devolver Herramienta</h4>
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
          <li class="active"><a href="#tabpreventivomod" data-toggle="tab">Devolución</a></li>
          <!--<li><a href="#tabpreventivomodx" data-toggle="tab">Preventivo II</a></li>-->

        </ul>

        <div class="tab-content">

          <div class="tab-pane fade in active" id="tabpreventivomod">
           <div class="panel panel-default">
             <div class="panel-body">
               <form action="modificar_prestamo.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarForm_PmodInterno()">



                <fieldset id="regmaq">

                  <input type="hidden" id="idP" name="id" />
                  <input type="hidden" id="id_herramod" name="id_herra" />
                  <input type="hidden" name="tipo" value="interno">
                  <table width="100%">
                    <tr>
                      <td colspan="3" align="center">
                        <label>Encargado:</label><br>
                        <input type="text" readonly="readonly" name="encargado" id="encargadomod" class="form-control" style="width:160px; display:inline-block;" size="" maxlength="10">

                      </td>
                    </tr>
                    <tr>
                      <td align="center">
                        <label>Fecha del prestamo:</label><br>
                        <input type="text" disabled readonly="readonly" name="fecha" id="fechaprestamomod" class="form-control" style="width:160px; display:inline-block;" size="" maxlength="10" placeholder="00/00/0000">
                      </td>
                      <td colspan="2" align="center">

                        <input type="hidden" name="resultado_fecha" id="resultado_fecha">

                        <label>Responsable:</label><br>
                        <textarea readonly="readonly" name="responsable" style="display:inline-block; resize:none;" class="form-control" id="responsablemod" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsable();" onblur="validarResponsable();" onKeyPress="return soloAlfa(event)"></textarea>

                      </td>
                    </tr>
                    <tr>

                      <td colspan="2" align="center">
                        <label><b>Estado</b></label>    <br>
                        <select name="estado" id="estadomodP" style="width:170px; display:inline-block;" class="form-control" title="Estado del prestamo" onclick="select_estado2();">
                          <option value="Activo">Activo</option>
                          <option value="Concluido">Concluido</option>
                        </select>
                      </td>
                      <td align="center">
                        <div id="divdevolucion">

                         <label><b>Fecha de la devolucion:</b></label><br>
                         <input type="text" name="devolucion" id="devolucion" class="form-control" style="width:160px; display:inline-block;" size="" maxlength="10" placeholder="00-00-0000">

                       </div>
                     </td>
                   </tr>
                   <tr>
                    <td colspan="3" align="center">
                      <h3><div id="control_herra_D"></div></h3>
                    </td>
                  </tr>
                </table>

              </fieldset>
            </div> 
          </div>

        </div>

      </div>

    </div>
    <div class="modal-footer">

      <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
      <!-- <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">-->
      <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>               


    </div>
  </form>
</div>
</div>
</div>
<!-- End modal -->

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
<script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="js/lang/es.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
   <script type="text/javascript">

      </script>
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
<script type="text/javascript">
  function ShowImagePreview( files , f)
  {


    $('#previewcanvas').show();
    $('#div_quitar_imagen').show();

    if( !( window.File && window.FileReader && window.FileList && window.Blob ) )
    {
      alert('The File APIs are not fully supported in this browser.');
      return false;
    }

    if( typeof FileReader === "undefined" )
    {
      alert( "Filereader undefined!" );
      return false;
    }

    var file = files[0];

    if( !( /image/i ).test( file.type ) )
    {
      //  alert( "File is not an image." );

      var ext=['jpg','jpeg','png'];
      var v=f.value.split('.').pop().toLowerCase();
      for(var i=0,n; n=ext[i];i++){
        if(n.toLowerCase()==v)
          return
      }
      var t=f.cloneNode(true);
      t.value='';
      f.parentNode.replaceChild(t,f);
      $('#previewcanvas').hide();
      $('#div_quitar_imagen').hide();
  //alert('extension no valida');
  $('#error_imagen').modal({
    show:true,
    backdrop:'static'
  }).show(200);

  return false;
}
$('#muestra').attr("src","");
reader = new FileReader();
reader.onload = function(event) 
{ var img = new Image; 
  img.onload = UpdatePreviewCanvas; 
  img.src = event.target.result;  }
  reader.readAsDataURL( file );
}

function UpdatePreviewCanvas()
{
  var img = this;
  var canvas = document.getElementById( 'previewcanvas' );

  if( typeof canvas === "undefined" 
    || typeof canvas.getContext === "undefined" )
    return;

  var context = canvas.getContext( '2d' );

  var world = new Object();
  world.width = canvas.offsetWidth;
  world.height = canvas.offsetHeight;

  canvas.width = world.width;
  canvas.height = world.height;

  if( typeof img === "undefined" )
    return;

  var WidthDif = img.width - world.width;
  var HeightDif = img.height - world.height;

  var Scale = 0.0;
  if( WidthDif > HeightDif )
  {
    Scale = world.width / img.width;
  }
  else
  {
    Scale = world.height / img.height;
  }
  if( Scale > 1 )
    Scale = 1;

  var UseWidth = Math.floor( img.width * Scale );
  var UseHeight = Math.floor( img.height * Scale );

  var x = Math.floor( ( world.width - UseWidth ) / 2 );
  var y = Math.floor( ( world.height - UseHeight ) / 2 );

  context.drawImage( img, x, y, UseWidth, UseHeight );  
}



function checkForm(files,f){ 
  return ShowImagePreview(files,f); 
} 

function mostrarHerramientas(){
	var num=document.getElementById("estanteSelect").value;
	if (num=="0"){
		 $('#dataTable_wrapper2').html("Seleccione un estante por favor");
	}
	else{
	  $.ajax({
            type:'POST',
            url:'buscar_herramientas.php',
            data:'num='+num,
             beforeSend: function(){
             	  $('#content').show();
		      $('#content').html('<div><h3>Cargando por favor espere...</h3><img alt="imagen de cargando" src="imagenes/ajax-loader.gif"/></div>');

		    },
		    cache:false,
            success: function(valores){     
              $('#content').hide();        
                $('#dataTable_wrapper2').html(valores);
                 $('#dataTables-example').DataTable({
              responsive: true
        });
            }
        });
	  }
}

</script>

<!--validar formulario-->
<script type="text/javascript" src="js/vali_herra.js"></script>

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

     /*   $('#r_maquina').hide();
        $('#slideshow').hide();
        $('#consulta_maq').show();
        $('#mensaje').addClass('bien').html("¡..Edición de usuario exitosa..!").show(200).delay(2500).hide(200);*/
      </script>
      <?php
    }
     $dev_herra=$_REQUEST['devolucion_herra'];
    if ($dev_herra=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#devuelta_herra').modal({
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
    $pres_herra=$_REQUEST['prestamo_herra'];
    if ($pres_herra=='si')
    {
      ?>

      <script type="text/javascript">
        $('#r_maquina').hide();
        $('#slideshow').hide();

        $('#consulta_maq').show();
        $('#prestada_herra').modal({
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
