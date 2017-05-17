<?php
require('seguridad.php');
require('conexion.php');
  $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 LIMIT 1";
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
  <link href="css/jquery.fancybox.css" type="text/css"  rel="stylesheet">
  <!--<script src="assets/js/chart-master/Chart.js"></script>-->
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




             <div id="consulta_maq">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="#">Control de Maquinas</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Maquinas</span>
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
                                        <a href="graficas.php" style="display: inline-block; margin-top:1%; margin-left: 40%;"><button class="btn btn-default" style=" background-color:#337ab7; color:#ffffff;" >Graficas &nbsp;  <span class="fa fa-bar-chart"></span></button></a> 
                     <?php
                        if ($privilegio_A=='A')
                        {
                      ?>
                  <p id="agregar_maq"><button class="btn btn-success"  >Nueva Maquina &nbsp; <i class="fa fa-plus"></i></button></p> 
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
                            <th>Número del Bien</th>
                            <th>Máquina</th>
                            <th>Estado</th>
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql="SELECT * FROM maquinas m, numero_bien n WHERE m.n_b=n.id_nb AND m.estatus='1'";

                          $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['codigo'];?></td>
                              <td align="center"><?php echo $array['nb'];?></td>
                              <td align="center"><?php echo $array['maquina'];?></td>
                              <td align="center"><?php echo $array['estado'];?></td>
                              <td align="center">
                               <?php
                             if ($privilegio_M=='M')
                              {
                              
                            ?>     
                                <a href="javascript:editar_maquina(<?php echo $array['id_maquina'];?>);">
                                  <button class="btn btn-default" title="Modificar">
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
                                <a href="javascript:eliminarMaquina(<?php echo $array['id_maquina'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                               <?php
                              }
                            ?>  
                                
                                <a href="javascript:detalleMaquina(<?php echo $array['id_maquina'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                                <a href="javascript:reportandoMaquina(<?php echo $array['id_maquina'];?>);">                
                                  <button class="btn btn-default" title="Reporte">
                                    <span class="fa fa-print"></span>
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
                          <h4 class="modal-title">Modificar Maquina</h4>
                        </div>
                        <div class="modal-body">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>
                          </ul>

                          <div class="tab-content">

                            <div class="tab-pane fade in active" id="tabmaquinamod">
                             <div class="panel panel-default">
                              <div class="panel-body">
                                <form action="modificar_maquina.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarmodform()" enctype="multipart/form-data">
                                  <fieldset id="mod_usuario" style="  margin-left: 10%;">

                                    <input type="hidden" id="m_id_maq" name="id_maquinas" /> <!--id de la maquina-->
                                    <input type="hidden" id="m_id_nb" name="id_nb" /> <!--id de la maquina-->
                                    <table width="100%">
                                    <tr>
                                    <td>
                                    <label><b>Codigo</b></label><br>
                                    <input type="text" name="codigo" id="m_codigo" readonly="readonly" maxlength="30" class="form-control input_size"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <span id="nom_usu"></span>
                                    </td>
                                    <td>
                              


                                    <div  style="display: table;">
                                    <label><b>Numero del bien:</b></label><br>
                                    <input type="text" readonly="readonly" id="pre_nbmod" name="pre_nb" value="NB-" size="3" class="form-control" style="width:50px; display:inline-block;" ></input>
                                    <input type="text" name="n_b" id="MNB" maxlength="5" class="form-control input_size" style="width:110px; " onkeypress="return solonum3(event)" onKeyUp="validarM_N_B()" onBlur="validarM_N_B()" onchange="validarM_N_B()"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts"> <span id="MN/BPrompt"></span></div>
                                    <span id="contrasena"></span>
                                    <input type="hidden" id="Mres" name="Mres" value="1" />
                                    </div>
                                    </td>
                                    <td>
                          
                                      <label><b>Estado:</b></label><br>
                                    <select name="estado" id="m_estado" class="form-control input_size">
                                      <option value="Operativo">Operativo</option>
                                      <option value="No Operativo">No Operativo</option>
                                    </select>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <span id="contrasena2"></span>

                                    </td>
                                    </tr>
                                    <tr>
                                    <td>
                                    <br>

                                    <label><b>Modelo:</b></label><br>
                                    <input type="text" name="modelo" id="Mmodelo" maxlength="20" class="form-control input_size" onKeyUp="validarM_Modelo()" onBlur="validarM_Modelo()" onchange="validarM_Modelo()" onkeyPress='return soloAlfa2(event);' onpaste="return false"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts"> <span id="m_modeloPrompt"></span></div>

                                    </td>
                                    <td>
                                    <br>

                                    <label><b>Maquina:</b></label><br>
                                    <input type="text" name="maquina" id="m_maquina" readonly="readonly" maxlength="30" class="form-control input_size"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <span id="contrasena2"></span>
                                    </td>
                                    <td>
                                    <br>


                                    <label><b>Marca:</b></label><br>
                                    <input type="text" name="marca" id="Mmarca" maxlength="20" class="form-control input_size" onKeyUp="validarM_Marca()" onBlur="validarM_Marca()" onchange="validarM_Marca()" onkeyPress='return soloAlfa2(event);'  onpaste="return false"/>
                                    <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                    <div class="promts"> <span id="MmarcaPrompt"></span></div>

                                    <br><br>
                            
                                    </td>
                                    </tr>
                                    <tr>

                                      <td align="center" colspan="2">
                                        <label><b>Imagen:</b></label><br>
                                          <input type="file" size="60" value="Sin imagen" name="imagen" onchange="return checkForm(this.files,this);" id="foto1">
                                          <input type="hidden" id="inputimagen" name="inputimagen">
                                      </td>
                                      <td>
                                      <div id="div_quitar_imagen">
                                      <input type="button" id="quitar_imagen" value="Quitar imagen" class="form-control input_size" />
                                      </div>
                                      </td>
                                      </tr>
                                      <tr>
                                      <td colspan="3" align="center">
                                      <br>
                                     <div id="previewcanvascontainer">
                                     <img src="" id="muestra" style="max-width: 500px;  max-height: 350px;  "/>
<canvas id="previewcanvas" style="max-width: 500px; width:500px; height:350px; max-height: 350px;  ">
</canvas>
</div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center">
                                        <h3><div id="salidaM_MAQ"></div></h3>
                                      </td>
                                    </tr>
                                        <tr>
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   

                                    </table>
                                   

                                   </fieldset>
                                  </div> </div>
                                  <!-- /.table-responsive -->
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

                <!-- eliminar modal-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maq" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" id="confirm">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Eliminar Maquina</h4>
                      </div>
                      <div class="modal-body">

                        <h4>¿Usted esta seguro que desea eliminar esta maquina?</h4>                            

                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_maquina">

                        <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Maquina()">Aceptar</button>
                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                      </fieldset>

                 
                  </div>
                </div>
              </div>
            </div>
            

            <!-- detalle Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_maquina" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Detalle de la Maquina</h4>
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
                  <h4 class="modal-title">Reporte de Maquina</h4>
                </div>
                <div class="modal-body">

                  <h4>¿Usted esta seguro de que desea generar el reporte de las maquinas?</h4>                            

                </div>
                <div class="modal-footer">

                  <input type="hidden" id="aceptar_elim_maquina">

                  <button class="btn btn-primary" title="Aceptar" onclick="reporte_Maquina()" data-dismiss="modal" >Aceptar</button>
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
              <h4 class="modal-title">Registro Maquina</h4>
            </div>
            <div class="modal-body">

              <h4>Maquina registrada correctamente</h4>    
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
            <h4 class="modal-title">Editar Maquina</h4>
          </div>
          <div class="modal-body">

            <h4>Maquina editada correctamente</h4>    
          </div>
          <div class="modal-footer">

           <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

           <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


         </div>
       </div>
     </div>
   </div>
   <!-- End eliminar modal -->  
   <!-- Modal Error registrando formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_form" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Maquinas</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Error en el registro de la Maquina: </h4> <div style="font-size:17px; color:#000000;" id="error_mensaje"></div>
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 
    <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_img" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Quitar Imagen de la Maquina</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea quitar la imagen de la maquina?</h4> 
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

   <!-- detalle Modal -->
   <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="agua_maq" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" id="confirm">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
          <h4 class="modal-title">Reporte Maquina</h4>
        </div>
        <div class="modal-body">

         <h4>¿Usted esta seguro de que desea generar el reporte de esta maquina?</h4>                            

         <input type="hidden" id="aceptar_reporte_maquina">
         <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
       </div>
       <div class="modal-footer">
        <button class="btn btn-primary" title="Aceptar" onclick="reporteMaquina()" data-dismiss="modal" >Aceptar</button>
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
        <h4 class="modal-title">Eliminar Maquina</h4>
      </div>
      <div class="modal-body">

        <h4>Maquina eliminada correctamente</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End eliminar modal -->                
</ajax>
</div>
</div>

<div id="r_maquina">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="maquinas.php">Control de Maquinas</a> <span>></span> <a href="#"> Registro</a></h4>
  <?php
  include("form_m.php");
  $centro=menu();
  echo $centro;
  ?>
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

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="btn_error_incompleto" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 
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
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/lang/es.js"></script>
    <script type="text/javascript" src="funciones.js"></script>

    <script type="text/javascript" src="js/jquery.fancybox.js"></script>

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


</script>

    <!--validar formulario-->
    <script type="text/javascript" src="js/vali_maq.js"></script>
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

    </script>
        <?php
      }

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
    if ($error=='2')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
    var mensaje="Se coloco una expresion diferente a un numero en el campo de N/B, Formulario no procesado";
    
    $("#error_mensaje").html('<br>'+mensaje);

    $('#error_form').modal({
      show:true,
      backdrop:'static'
    }).show(200);

        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }
    if ($error=='3')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
    var mensaje="Error en el campo de marca, Formulario no procesado";
    
    $("#error_mensaje").html('<br>'+mensaje);

    $('#error_form').modal({
      show:true,
      backdrop:'static'
    }).show(200);

        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    } 
    if ($error=='4')
{
  ?>
  <script type="text/javascript">

    $('#r_maquina').hide();
    $('#slideshow').hide();

    $('#consulta_maq').show();
    var mensaje="Error en el campo de modelo, Formulario no procesado";
    
    $("#error_mensaje").html('<br>'+mensaje);

    $('#error_form').modal({
      show:true,
      backdrop:'static'
    }).show(200);

        //$('#eliminado_maquina').show(200).delay(2500).hide(200);

      </script>
      <?php
    }

      ?>