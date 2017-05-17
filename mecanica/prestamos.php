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


             <div id="mensaje"></div>

             <div id="centro_principal"></div>





             <div id="consulta_salida_insu">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="herramientas.php">Herramientas</a> <span>></span> <a href="#">Prestamos</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Prestamos de Herramientas</span>
                </div>

                <ajax>
                  <table width="100%">
                    <tr>
                      <td>

                      </td>
                      <td align="right">
                        <p id="agregar_salida_insu" style="margin-top: 1%; margin-right: 1%; margin-bottom: 1%; display: inline-block;">
                          <button class="btn btn-success"  >Nuevo Prestamo  &nbsp; <i class="fa fa-plus"></i></button>
                        </p>
                      </td>
                    </tr>
                  </table> 

                  <div  id="tabla_usuario">
                  <br>
                      <div id="tabla_prestamos">
                      <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                            <tr>
                              <th>Código</th>
                              <th>Nombre</th>
                              <th>Estado del Prestamo</th>
                              <th>Realizado</th>
                              <th>Responsable</th>
                              <th>Acciónes</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql="SELECT * FROM herramientas h, prestamo p WHERE h.id_herramienta=p.id_herramienta AND h.estatus=1 AND p.estatus=1 AND h.taller=1";

                            $query=pg_query($sql);

                            while ($array=pg_fetch_assoc($query))
                            {
                           // $fecha=explode(' ', $array['realizado']);
                           

                            $fecha_a=explode('-',  $array['realizado']);
                           //$fecha_a2=explode('-', $array2['realizado']);
                           $ano=$fecha_a[0];
                           $mes=$fecha_a[1].'/';
                           $dia=$fecha_a[2].'/';
                           $fecha=$dia.$mes.$ano;

                           $time_a=explode(':', $time);
                           $hora=$time_a[0].':';
                           $minutos=$time_a[1];

                           $time=$hora.$minutos;

                           $fechac=$fecha." ".$time." ".$meridiano;
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['codigo_herramienta'];?></td>
                               <td align="center" width="150px"><?php echo  $array['nombre']; ?></td>
                              <td align="center"><?php echo  $array['estado_prestamo']; ?></td>
                              <td align="center"><?php echo $fecha; ?></td>
                              <td align="center"><?php echo $array['responsable']?></td>
                              <td align="center">
                                <?php if($array['estado_prestamo']!="Concluido"){
                                  ?>
                                <a href="javascript:editar_prestamo(<?php echo $array['id_prestamo'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
                                    <span class="fa fa-edit"></span>
                                  </button>
                                </a>
                                
                                <a href="javascript:eliminarPrestamo(<?php echo $array['id_prestamo'];?>,<?php echo $array['id_herramienta'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                                <?php 
                                }
                                ?>
                                <a href="javascript:detallePrestamo(<?php echo $array['id_prestamo'];?>,<?php echo $array['id_herramienta'];?>);">                
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
                  <!--Fin consulta salida-->

                 
                </div>
                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modif_maquina" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                        <h4 class="modal-title">Modificar Prestamo</h4>
                      </div>
                      <div class="modal-body">
                        <ul class="nav nav-tabs">
                          <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                          <li class="active"><a href="#tabpreventivomod" data-toggle="tab">Prestamo</a></li>
                          <!--<li><a href="#tabpreventivomodx" data-toggle="tab">Preventivo II</a></li>-->

                        </ul>

                        <div class="tab-content">

                          <div class="tab-pane fade in active" id="tabpreventivomod">
                           <div class="panel panel-default">
                             <div class="panel-body">
                               <form action="modificar_prestamo.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarForm_Pmod()">

                               
                               
                                <fieldset id="regmaq">

                                  <input type="hidden" id="m_id_prev" name="id" /> <!--id de la maquina-->

                                  <input type="hidden" id="ids_mant_mod" name="ids" />
                                  <input type="hidden" id="idmod" name="id" />
                                  <input type="hidden" id="id_herramod" name="id_herra" />
                                  <input type="hidden" id="nbmod" name="nbmod" />
                                  <input type="hidden" name="tipo" value="externo">
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
                                        <input disabled type="text" readonly="readonly" name="fecha" id="fechamod" class="form-control" style="width:160px; display:inline-block;" size="" maxlength="10" placeholder="00/00/0000">
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
                                        <select name="estado" id="estadomod" style="width:170px; display:inline-block;" class="form-control" title="Estado del prestamo" onclick="select_estado();">
                                          <option value="Activo">Activo</option>
                                          <option value="Concluido">Concluido</option>
                                        </select>
                                      </td>
                                      <td align="center">
                                      <div id="divdevolucion">
                                       
                                         <label><b>Fecha de la devolucion:</b></label><br>
                                        <input type="text" name="devolucion" id="devolucion" class="form-control" style="width:160px; display:inline-block;" size="" maxlength="10" placeholder="00-00-0000" onclick="validarDevolucion()" onblur="validarDevolucion()" onchange="validarDevolucion()" onkeyup="validarDevolucion()">
                                        <div class="promts" style="margin-left:-3px;"> <span id="devolucionPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                                          
                                      </div>
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

            <!-- eliminar modal-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_ent" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="alert">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Eliminar Entrada</h4>
                  </div>
                  <div class="modal-body">

                    <h4>¿Usted esta seguro que desea eliminar esta entrada?</h4>                            

                  </div>
f                  <div class="modal-footer">

                    <input type="hidden" id="aceptar_elim_entrada">

                    <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Entrada()">Aceptar</button>
                    <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                  </fieldset>


                </div>
              </div>
            </div>
          </div>

          <!-- eliminar modal-->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_pre" class="modal fade">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" id="confirm">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                    <h4 class="modal-title">Eliminar Prestamos</h4>
                  </div>
                  <div class="modal-body">

                    <h4>¿Usted esta seguro que desea eliminar este Prestamo?</h4>                            

                  </div>
                  <div class="modal-footer">

                    <input type="hidden" id="aceptar_elim_prestamo">
                    <input type="hidden" id="aceptar_elim_prestamo2">
                    <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Prestamo()">Aceptar</button>
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
                <h4 class="modal-title">Registro de Prestamo</h4>
              </div>
              <div class="modal-body">

                <h4>Datos registrados correctamente</h4>    
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
              <h4 class="modal-title">Editar Prestamo</h4>
            </div>
            <div class="modal-body">

              <h4>Datos editados correctamente</h4>    
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
            <h4 class="modal-title">Reporte Maquina</h4>
          </div>
          <div class="modal-body">

           <h4>¿Usted esta seguro de que desea generar el reporte de esta maquina?</h4>                            

           <input type="hidden" id="aceptar_reporte_preventivo">
           <input type="hidden" id="aceptar_reporte_preventivo2">
           <input type="hidden" id="user_report" value="<?php echo $_SESSION['nom_usuario']?>">
         </div>
         <div class="modal-footer">
          <button class="btn btn-primary" title="Aceptar" onclick="reportePreventivo()" data-dismiss="modal" >Aceptar</button>
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
          <h4 class="modal-title">Eliminar Prestamo</h4>
        </div>
        <div class="modal-body">

          <h4>Registro eliminado correctamente</h4>    
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

<!-- Registro de Salida -->
<div id="r_salida_insu">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="inventario.php">Inventario</a> <span>></span> <a href="herramientas.php">Herramientas</a> <span>></span> <a href="prestamos.php">Prestamos</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Registro de Prestamo</span>
    </div>
    <div id="form_contenedor">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
       

        <!--Registro de entrada-->
      
       <!-- Registro de Salida -->
       <div>
        <form action="registrando_prestamo.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_P()" enctype="multipart/form-data" >
        
         <fieldset id="regmaq" style="color:#000;">
            <input type="hidden" name="tipo" value="externo">
           <input type="hidden" name="id_herra" id="id_herra">
           <input type="hidden" name="id_per" id="id_per">
           <input type="hidden" name="res" id="res">
           <input type="hidden" name="resS" id="resS">

           <table width="100%">
           <tr>
           <td>
            <label><b>Codigo de la herramienta:</b></label>
           <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo" onclick="existeNB(), buscar_herramienta()" onchange="existeNB(), buscar_herramienta()" onblur="existeNB(), buscar_herramienta()"  maxlength="30" placeholder="Ejemplo:To-00" title="Código de la herramienta"/>
           <div class="promts" style="margin-left:0px;" > <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute;  color:red;">*</p>

           </td>
           <td>
            <div  style="display: table;">
            <label><b>Numero del bien:</b></label>
            <input readonly="readonly" type="text" name="n_b" id="NB" maxlength="6" style="width:110px; "   onKeyPress="return solonum3(event)" title="Número del bien" />
            <input type="hidden" id="Mres" name="Mres" value="1" />
            </div>
               </td>
           <td>
           <label><b>Nombre:</b></label>  
           <input readonly="readonly" type="text" name="nombre" id="nombre">
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
                  <input type="text" name="ci_usu" id="ci_usu" onblur="personal_herra(); validarCI();" maxlength="9" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona" onKeyUp="validarCI()" onchange="validarCI()"/>
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
                  <div class="promts" style="margin-left:-20px;"> <span id="fechaPrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                </td>

               <td>
                  <label>Fecha Tentativa<br> de Devolución:</label>
                  <input type="text" name="fecha2" id="fecha2" style="width:140px;" size="" maxlength="10" placeholder="00-00-0000" onclick="validarFecha2()" onchange="validarFecha2()" onblur="validarFecha2()">
                  <div class="promts" style="margin-left:-50px;"> <span id="fecha2Prompt"></span></div><p style="display:inline-block; font-size:30px;  color:red;">*</p>
                </td>
          <td>

                  <input type="hidden" name="resultado_fecha" id="resultado_fecha">

                  <label>Responsable:</label>
                  <textarea name="responsable" style="display:inline-block;" id="responsable" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsable();" onblur="validarResponsable();" onKeyPress="return soloAlfa(event)"></textarea>
                  <div class="promts" > <span id="responsablePrompt"></span></div><p style="display:inline-block; font-size:30px;  color:red; ">*</p>

          </td>
          </tr>
          <tr>
          <td colspan="3" align="center">
           <br><br>

           <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" id="aceptar2" style="margin-left:-50px;"> 
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

<!--Fin registro insumos salida-->

<!-- Modal Error registrando formulario incompleto-->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_form" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Registro Prestamo</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Error en el registro prestamo: </h4> <div style="font-size:17px; color:#000000;" id="error_mensaje"></div>
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
        <h4 class="modal-title">Registro Prestamo</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Debe completar el formulario</h4>    
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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="error_incompletomod" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" id="confirm">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
        <h4 class="modal-title">Modificar Prestamo</h4>
      </div>
      <div class="modal-body">

        <h4 style="color:#000;">Debe completar el formulario</h4>    
      </div>
      <div class="modal-footer">

       <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

       <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


     </div>
   </div>
 </div>
</div>
<!-- End validando file error modal --> 

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

    <?php //--------------------------ARREGLADO
    /*
    date_default_timezone_set('America/Caracas');
$hoy=date('d/m/Y');
$otro="30/06/2015";
$sqlxx="SELECT * FROM mant_preventivo WHERE fecha_siguiente='".$otro."' AND estatus='1'";

                          $queryxx=pg_query($sqlxx);
                          $hoy_event=pg_num_rows($queryxx);
                          $fila=pg_fetch_assoc($queryxx);

                          
                          if($hoy_event!=0)
                          {

                            $agua=$fila['maquina_id'];

                            $sqlxx2="SELECT * FROM maquinas WHERE id_maquina='".$agua."' AND estatus='1'";
                            $queryxx2=pg_query($sqlxx2);

while($dato=pg_fetch_assoc($queryxx2))
{
?>
<script type="text/javascript">$(document).ready(function () {
    var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Bienvenido a SYS-M&R!',
            // (string | mandatory) the text inside the notification
            // no pulsar la tecla enter porque si no se daña
            text: 'Hacerle mantenimiento a: <br><?php echo $dato["codigo"];?><br>',
            // (string | optional) the image to display on the left
            image: 'imagenes/upta.png',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

    return false;
});</script>
  <?php                        
}




?>

<?php } ------------------------------------------------------------------------*/?>

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
  $(document).ready(function(){
    $(".fancybox").fancybox();
  });
  $('#dataTables-example2').DataTable({
          responsive: true
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

     var mensaje="Error en el campo devolucion, Formulario no procesado";
    
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
    ?>
