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


             <div id="mensaje"></div>

             <div id="centro_principal"></div>





             <div id="consulta_prev">

              <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="mantenimiento.php">Mantenimiento</a> <span>></span> <a href="#">Mantenimiento Preventivo</a></h4>
              <div class="info3">
                <div id="text_center_title">
                  <span class="t-menu">Consulta de Mantenimiento Preventivo</span>
                </div>

                <ajax>
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
                  <p id="agregar_man" style="  margin-top: 1%;
                  margin-left: 52%;
                  margin-bottom: 1%;
                  display: inline-block;"><button class="btn btn-success"  >Nuevo Mant. Preventivo &nbsp; <i class="fa fa-plus"></i></button></p> 
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
                            <th>N°</th>
                            <th width="80">Código de la Maquina</th>
                            <th>Servicio</th>
                            <th>Encargado</th>
                            <th>Fecha de Solicitud</th>
                            <th>Estado</th>
                            <th>Acciónes</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql="SELECT * FROM maquinas m, mant_preventivo p, personal s WHERE m.id_maquina=p.maquina_id AND p.id_personal=s.id  AND m.estatus='1' AND p.estatus='1' ORDER BY fecha DESC";

                          $query=pg_query($sql);

                          while ($array=pg_fetch_assoc($query))
                          {
                            $fecha_a=explode('-', $array['fecha']);
                            $ano=$fecha_a[0];
                            $mes=$fecha_a[1].'/';
                            $dia=$fecha_a[2].'/';
                            $fecha=$dia.$mes.$ano;

                            $nombre_per=explode(' ', $array['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['id_preventivo']; ?></td>
                              <td  width="80" align="center"><?php echo $array['codigo'];?></td>
                              <td align="center"><?php echo $array['tipo_servicio'];?></td>
                              <td align="center"><?php echo    $encargado_mant; ?></td>
                              <td align="center"><?php echo $fecha ?></td>
                              <td align="center"><?php echo $array['estado'];?></td>
                              <td align="center">
                               <?php
                             if ($privilegio_M=='M')
                              {
                              
                            ?>    
                                <a href="javascript:editar_solicitud_preventivo(<?php echo $array['id_preventivo'];?>);">

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
                                <a href="javascript:eliminarPreventivo(<?php echo $array['id_preventivo'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                               <?php
                                    }
                            ?>  
                                <a href="javascript:detallePreventivo(<?php echo $array['id_maquina'];?>,<?php echo $array['id_preventivo'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>
                                <a href="javascript:reportandoPreventivo(<?php echo $array['id_maquina'];?>,<?php echo $array['id_preventivo'];?>);">                
                                  <button class="btn btn-default" title="Reporte">
                                    <span class="fa fa-print"></span>
                                  </button>
                                </a>
                                <?php if ($array["estado"]!='concluido'){
                                  ?>
                                  <a href="javascript:ejecutarPreventivo(<?php echo $array['id_preventivo'];?>);">                
                                  <button class="btn btn-default" title="Ejecutar">
                                    <span class="fa fa-share-square-o"></span>
                                  </button>
                                </a>
                                <?php
                                }
                                ?>
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
                          <h4 class="modal-title">Modificar Mantenimiento Preventivo</h4>
                        </div>
                        <div class="modal-body">
                          <ul class="nav nav-tabs">
                            <!--<li ><a href="#tabmaquinamod" data-toggle="tab">Maquina</a></li>-->
                            <li class="active"><a href="#tabpreventivomod" data-toggle="tab">Preventivo I</a></li>

                          </ul>

                          <div class="tab-content">

                                <div class="tab-pane fade in active" id="tabpreventivomod">
                                 <div class="panel panel-default">
                                   <div class="panel-body">
                                     <form action="modificar_solicitud.php" method="post" id="modif_maqs" name="modif_maqs" onSubmit="return validarForm_SE()">

                                       <div style="margin-left:40%;">
                                        <label>Interno</label>
                                        <input type="radio" name="tipo_servicio" id="tipo_servicio_intmod" value="interno">
                                        <label style="margin-left:5%;">Externo</label>
                                        <input type="radio" name="tipo_servicio" id="tipo_servicio_extmod" value="externo">
                                      </div>

                                      <fieldset id="regmaq" style="margin-left: 10%;">

                                        <input type="hidden" id="m_id_prev" name="id" />   <!--id de la maquina-->
                                        <input type="hidden" name="tipo" value="preventivo">
                                        <input type="hidden" id="ids_mant_mod" name="ids" />
                                        <input type="hidden" id="fechanextmod" name="fechanext"/>
                                        <input type="hidden" id="nbmod" name="nbmod" />
                                        <table width="100%">
                                          <tr>
                                            <td colspan="2" align="center">
                                              <label  style="margin-left:-50px;"><b>Supervisor:</b></label><br>
                                              <input  readonly="readonly" type="text" name="rev_maquina" id="rev_maquinamod" class="form-control" style="width:160px; margin-left:-50px" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="mostrarCapa()" onblur="personal()" >
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <label><b>Responsable:</b></label><br>
                                              <textarea name="responsable" id="responsablemod"  class="form-control" style="display:inline-block; width:90%;" size="" maxlength="125" placeholder="Se daño ..." onKeyUp="validarResponsablemod();" onblur="validarResponsablemod();" onKeyPress="return soloAlfa(event)"></textarea>
                                              <div class="promts" style="margin-left: -64px;"> <span id="responsablemodPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                              <br>
                                            </td>
                                          
                                            <td>
                                              <div id="proveedor_ext">

                                              <label><b>Proveedor:</b></label><br>
                                                <textarea name="proveedor" id="provedormod"  class="form-control" style="display:inline-block; width:90%;" size="" maxlength="125" placeholder="Jose Hernandez" onKeyUp="validarProveedormod();" onblur="validarProveedormod();" onKeyPress="return soloAlfa(event)"></textarea>
                                                <p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                                                <div class="promts" style="margin-left: -50px;"> <span id="proveedormodPrompt"></span></div>
                                              </div>
                                            </td>
                                          </tr>


                                          <input type="hidden" name="colocada" id="colocada">
                                          <input type="hidden" name="resultado_fechamod" id="resultado_fechamod" value="valido">
                                          <tr>
                                            <td colspan="2" align="center">
                                              <label><b>Fecha de la Solicitud:</b></label><br>
                                              <input type="text" name="fecha" id="fechamod" class="form-control" style="width:180px;" size="" maxlength="10" placeholder="00-00-0000" disabled>
                                              <div class="promts" style=" margin-top: -60px;  margin-left: 156px;"> <span id="fechamodPrompt"></span></div>
                                            </td>
                                           
                                          </tr>
                                             <tr>
                                      <td colspan="3" align="center">
                                        <h3><div id="salidaM_PRE"></div></h3>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="3" align="center">
                                        <input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar">&nbsp;
                                        <!-- <input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">-->
                                        <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>
                                      </td>
                                    </tr>
                                        </table>

                                      </fieldset>
                                       </form>
                                    </div> 
                                  </div>

                                </div>
                                                          
                            </div>

                          </div>
                          
                       
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
                          <h4 class="modal-title">Eliminar Mantenimiento Preventivo</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar este mantenimineto preventivo?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_preventivo">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_Preventivo()">Aceptar</button>
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
                        <h4 class="modal-title">Reporte de Mantenimiento Preventivo</h4>
                      </div>
                      <div class="modal-body">

                        <h4>¿Usted esta seguro de que desea generar el reporte de los mantenimientos preventivos?</h4>                            

                      </div>
                      <div class="modal-footer">

                        <input type="hidden" id="aceptar_elim_maquina">

                        <button class="btn btn-primary" title="Aceptar" onclick="reporte_Preventivo()" data-dismiss="modal" >Aceptar</button>
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
                      <h4 class="modal-title">Registro Mantenimento Preventivo</h4>
                    </div>
                    <div class="modal-body">

                      <h4>Mantenimiento Preventivo registrado correctamente</h4>    
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
                    <h4 class="modal-title">Editar Mantenimiento Preventivo</h4>
                  </div>
                  <div class="modal-body">

                    <h4>Mantenimiento Preventivo editado correctamente</h4>    
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
                <h4 class="modal-title">Eliminar Mantenimiento Preventivo</h4>
              </div>
              <div class="modal-body">

                <h4>Mantenimiento Preventivo eliminado correctamente</h4>    
              </div>
              <div class="modal-footer">

               <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true" title="Cerrar">Aceptar</button>

               <!-- <button id="cerrar_dialog_eli"class="btn btn-primary" title="Aceptar">Aceptar</button>-->


             </div>
           </div>
         </div>
       </div>
       <!-- End eliminar modal -->   

        <!-- eliminar modal-->
       
             
     </ajax>
   </div>
 </div>

 <div id="r_mant_prev">
  <h4 class="sitio_maq"><a href="#">Administrativo</a> <span>></span> <a href="mantenimiento.php">Mantenimiento</a> <span>></span> <a href="mant_preventivo.php">Mantenimiento Preventivo</a> <span>></span> <a href="#"> Registro</a></h4>
  <div class="info2">
    <div id="text_center_title"> <!--para la parte de titulo--> 
      <span class="t-menu">Solicitud de Mantenimiento Preventivo</span>
    </div>
    <div id="form_contenedor" style="margin-left:4%;">
      <!--<div class="panel panel-default">
      <div class="panel-body">-->
        <br>
        <div style="color:#000; aling-text:center; margin-left:40%;" >

          <label style="font-weight:bold;">Interno</label> <input type="radio" name="service" id="service_interno">
          <label style="margin-left:5%; font-weight:bold;">Externo</label> <input type="radio" name="service" id="service_externo"> 

        </div>
        <div id="interno">
          <form action="registrando_preventivo.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >

           <fieldset id="regmaq" style="color:#000;">

            <input type="hidden" name="id_maq" id="id_maq">
            <input type="hidden" name="id_per" id="id_per">
            <input type="hidden" name="res" id="res">
            <input type="hidden" name="tipo_servicio" value="interno"> 


            <table width="100%">
              <tr> 
              <td colspan="3" align="center" >

                  <?php $numeroI=pg_query("SELECT id_preventivo FROM mant_preventivo ORDER BY id_preventivo DESC");
                        $numeroI=pg_fetch_assoc($numeroI);
                        $numeroI=$numeroI["id_preventivo"]+1;
                  ?>
                  <label><b>N° del mantenimiento:</b></label>
                  <input type="text" readonly="readonly" value="<?php echo $numeroI; ?>" name="numero_mant" id="numero_mantI" style="text-align:center;"  maxlength="30" title="Número del Mantenimiento"/>

              </td>
              </tr>
              <tr>
                <td>

                  <label><b>Código de la Máquina:</b></label>

                  <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo" onkeyup="existeCodigo()" onblur="codemaquinas(); existeCodigo();" onkeypress="soloAlfa3(event);" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina"/>

                  <!--<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>-->
                  <!--<input type="text" name="n_b" id="NB" onblur="maquinas(); validarN_B();" maxlength="5" placeholder="Ejemplo:12345678" title="Introduzca el número del bien"  onKeyUp="validarN_B()"  onchange="validarN_B()"/>-->
                  <div class="promts" style="margin-left: -17px;"> <span id="CodePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
                </td>
                <td colspan="2">
                  <label>Número del Bien:</label>  
                  <input readonly="readonly" type="text" name="n_b" id="NB">

                </td>
              </tr>

              <span id="nombres"></span>  

              <tr>
                <td>


                  <input type="hidden" name="validar_ci_ajax" id="validar_ci_ajax" >

                  <label><b>C.I. del Encargado:</b></label>
                  <select id="nac_usu" name="nac_usu" title="Seleccione la nacionalidad de la persona">
                    <option></option>
                    <option>V-</option>
                    <option>E-</option>
                  </select>
                  <input type="text" name="ci_usu" id="ci_usu" onblur="personal_mant(); validarCI();" maxlength="9" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona" onkeypress="return solonum4(event)" onKeyUp="validarCI()" onchange="validarCI()"/>
                  <div class="promts" style="margin-left: -69px;"> <span id="C.I_per"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
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
                <td colspan="2">

                  <label>Responsable:</label>
                  <textarea name="responsable" id="responsable" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsable();" onblur="validarResponsable();" onKeyPress="return soloAlfa(event)"></textarea>
                   <div class="promts" style="margin-left: 84px; margin-top: -90px;"> <span id="responsablePrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red; margin-left: 250px; margin-top: -40px;">*</p>

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
      <div id="externo">
        <form action="registrando_preventivo.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm2()" enctype="multipart/form-data" >

         <fieldset id="regmaq" style="color:#000;">

           <input type="hidden" name="tipo_servicio" value="externo">
           <input type="hidden" name="id_per" id="id_per2"> 
           <input type="hidden" name="id_maq" id="id_maq2">
           <input type="hidden" name="res" id="res2">
           <table width="100%">
            <tr>

                   <td colspan="3" align="center" >
                  <label><b>N° del mantenimiento:</b></label>
                  <input type="text" readonly="readonly" value="<?php echo $numeroI; ?>" style="text-align:center;" name="numero_mant" id="numero_mantE"  maxlength="30" title="Número del Mantenimiento"/>

              </td>
              </tr>
              <tr>
              <td>


               <label><b>Código de la Máquina:</b></label>

               <input type="text" style="text-transform:capitalize;" name="codigo" id="codigo2" onblur="codemaquinas(); existeCodigo2();" onkeyup="existeCodigo2()" onkeypress="return soloAlfa2(event)" maxlength="30" placeholder="Ejemplo:To-00" title="Código de la máquina"/>

               <!--<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>-->
               <!--<input type="text" name="n_b" id="NB" onblur="maquinas(); validarN_B();" maxlength="5" placeholder="Ejemplo:12345678" title="Introduzca el número del bien"  onKeyUp="validarN_B()"  onchange="validarN_B()"/>-->
               <div class="promts" style="margin-left: -16px;"> <span id="Code2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
             </td>
             <td colspan="2">
               <label>Número del Bien:</label>  
               <input readonly="readonly" type="text" name="n_b" id="NB2">

               <span id="nombres"></span>  
             </td>
           </tr>
           <tr>
             <td>
               <input type="hidden" name="validar_ci_ajax" id="validar_ci_ajax2" >

               <label><b>C.I. del Encargado:</b></label>
               <select id="nac_usu2" name="nac_usu" title="Seleccione la nacionalidad de la persona">
                <option></option>
                <option>V-</option>
                <option>E-</option>
              </select>
              <input type="text" name="ci_usu" id="ci_usu2" onblur="personal_mant(); validarCI2();" onkeypress="return solonum3(event)" maxlength="9" placeholder="Ejemplo:12345678" title="Coloque la cedula de identidad de la persona" onKeyUp="validarCI2()" onchange="validarCI2()"/>
              <div class="promts" style="margin-left: -67px;"> <span id="C.I_per2"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
            </td>

            <td>
              <label><b>Nombres:</b></label>
              <input readonly="readonly" type="text" name="nombres_usu" id="nombres_usu2" maxlength="30" placeholder="Ejemplo:Jorge Antonio" title="Nombres de la persona"/>
              <span id="nombres"></span>      
            </td>

            <td>
              <label><b>Apellidos:</b></label>
              <input readonly="readonly" type="text" name="apellidos_usu" id="apellidos_usu2" maxlength="30" placeholder="Ejemplo:Rodríguez Torres" title="Apellidos de la persona"/>
              <span id="apellidos"></span>   
            </td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="resultado_fecha2" id="resultado_fecha2">

              <label>Proveedor:</label>
              <textarea name="provedor" id="provedor" size="" maxlength="125" placeholder="Jose Hernandez" onKeyUp="validarProveedor();" onblur="validarProveedor();" onKeyPress="return soloAlfa(event)"></textarea>
              <div class="promts" style="margin-left: 150px; margin-top: -90px;"> <span id="proveedorPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red; margin-left: 250px; margin-top: -40px;">*</p>

            </td>
            <td >
              <label>Responsable:</label>
              <textarea name="responsable" id="responsable2" size="" maxlength="125" placeholder="Jose Perez, Juan Perozo ..." onKeyUp="validarResponsable2();" onblur="validarResponsable2();" onKeyPress="return soloAlfa(event)"></textarea>
              <div class="promts" style="margin-left: 150px; margin-top: -90px;"> <span id="responsable2Prompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red; margin-left: 250px; margin-top: -40px;">*</p>

            </td>
              
          </tr>
         
          
          <tr>
            <td colspan="4" align="center">
              <h3><div id="salidaR_PRE2"></div></h3>
            </td>
          </tr>
          <tr>
            <td colspan="4" align="center">
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
<script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/lang/es.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(".fancybox").fancybox();
  });
</script>

<script type="text/javascript">
   //  AUTOCOMPLETADO
    $(function() {
       $('#codigo').autocomplete({
           source:'maquina_bus.php',
           minLength: 1
        });
    });
     //  AUTOCOMPLETADO
    $(function() {
       $('#codigo2').autocomplete({
           source:'maquina_bus.php',
           minLength: 1
        });
    });

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
