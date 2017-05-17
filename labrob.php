<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ROBÓTICA</title>

<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="css/Nuevo2.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>

<link href="css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-table.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">


<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.js"></script>
<script type="text/javascript" src="js/hideshow.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript" src="js/vali.js"></script>

</head>
<body>
	<div id="wrapper">
		<div id="header_container">
			<?php
				include("header.php");
				$head=cabecera();
				echo $head;
			?>
		</div>
		<div id="center">
			<div id="menu">
				<div id="columnaizquierda">
					<?php
					include("menu.php");
					$menu=menu();
					echo $menu;
					?>
				</div>
				<div id="calendario">
					<div id="datepicker"></div>
				</div>
			</div>
			<div id="areadetrabajo" align="center">
				<div id="slideshow">
					<img src="imagenes/IMG_20150416_095740.jpg">
					<img src="imagenes/IMG_20150416_095748.jpg">
					<img src="imagenes/IMG_20150416_095828.jpg">
					<img src="imagenes/IMG_20150416_095917.jpg">
				</div>	

				<div id="div_convenios" class="dataTable_wrapper" style="margin-left:-5%; display:none;">
					<?php include("conexion.php"); ?>
						<?php 
						$query=pg_query("SELECT * FROM convenios WHERE estatus=1 AND taller=2");
						$num=pg_num_rows($query); 
							?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example" width="90%" style="background:#fff;">
                        <thead>
                          <tr>
                            <th width="300" style="background:#0028DC; color:#fff; font-weight:normal;">Titulo</th>
                            <th width="200" style="background:#0028DC; color:#fff; font-weight:normal;">Primer Ente</th>
                            <th width="200" style="background:#0028DC; color:#fff; font-weight:normal;">Segundo Ente</th>
                          <th width="100" style="background:#0028DC; color:#fff; font-weight:normal;">Estado</th>
                            <th width="100" style="background:#0028DC; color:#fff; font-weight:normal;">Duración</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                        
                          while ($array=pg_fetch_assoc($query))
                          {

                           
							$f1=explode("-", $array["fecha_inicio"]);
							$anio1=$f1[0];
							$mes1=$f1[1];
							$dia1=$f1[2];

							$f2=explode("-", $array["fecha_final"]);
							$anio2=$f2[0];
							$mes2=$f2[1];
							$dia2=$f2[2];
							//calculo timestamp de las dos fechas
							$timestamp1=mktime(0,0,0,$mes1,$dia1,$anio1);
							$timestamp2=mktime(0,0,0,$mes2,$dia2,$anio2);

							//resta las fechas
							$segundos_diferencia=$timestamp1-$timestamp2;
							//convierto segundos en días
							$dias_diferencias=$segundos_diferencia/(60*60*24);

							//obtengo el valor absoluto de los días(quito el posible signo negativo)
							$dias_diferencias=abs($dias_diferencias);

							//quito decimales a los dias de diferencia
							$dias_diferencias=floor($dias_diferencias);
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['titulo'];?></td>
                              <td align="center"><?php echo $array['ente1'];?></td>
                              <td align="center"><?php echo  $array['ente2']; ?></td>
                              <td align="center"> <?php echo  $array['estado']; ?>   </td>
                          	   <td align="center"> <?php echo  $dias_diferencias.' Días'; ?>   </td>

                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
						<br>
						<?php 
						
						?>
				</div>

				<div id="div_proyectos" class="dataTable_wrapper" style="margin-left:-5%; display:none;">
					<?php include("conexion.php"); 
						
						$query=pg_query("SELECT * FROM proyectos WHERE estatus=1 AND taller=2 ORDER BY codigo ASC"); 
					?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example2" width="95%" style="background:#fff;">
                        <thead>
                          <tr>
                            <th width="10%" style="background:#0028DC; color:#fff; font-weight:normal;">Código</th>
                            <th width="10%" style="background:#0028DC; color:#fff; font-weight:normal;">Periodo</th>
                            <th width="35%" style="background:#0028DC; color:#fff; font-weight:normal;">Titulo</th>
                            <th width="20%" style="background:#0028DC; color:#fff; font-weight:normal;">Ambito</th>
                          <th width="20%" style="background:#0028DC; color:#fff; font-weight:normal;">Estado</th>
                            <th width="5%" style="background:#0028DC; color:#fff; font-weight:normal;">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                        
                          while ($array=pg_fetch_assoc($query))
                          {
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['codigo'];?></td>
                              <td align="center"><?php echo $array['periodo'];?></td>
                              <td align="center"><?php echo  $array['titulo']; ?></td>
                              <td align="center">
                            <?php
                            	if ($array['ambito']=='tecnologico')
                            	{
                              		echo "Tecnológico";
                             	}
                             	if ($array['ambito']=='comunitario')
                             	{
                             		echo "Comunitario";
                             	}
                            ?>   
                          	  </td>
                              <td align="center"> <?php echo  $array['estado_proyecto']; ?>   </td>
                             <td align="center">

                             	<a href="javascript:detalleProyecto(<?php echo $array['id_proyecto'];?>);">
	                              <button class="btn btn-default" title="Detalle">
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

				<!-- detalle Modal -->
	            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="detalle_tecnologico" class="modal fade">
	              <div class="modal-dialog">
	                <div class="modal-content">
	                  <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
	                    <h4 class="modal-title">Detalle del Proyecto</h4>
	                  </div>
	                  <div class="modal-body">

	                    <div id="detalle"></div>

	                  </div>
	                  <div class="modal-footer">

	                </div>
	              </div>
	            </div><form></form>
	          </div>
	          <!-- End detalle modal -->

	          
	        	<div id="div_horario" class="icono" style="display:none; margin-top:16%;">
	          	
	          		<div id="profesores" style="display:inline-block; margin-left:-33px; margin-right:100px;">
	          			<span class="glyphicon glyphicon-calendar"></span>
	          			<h4>Horarios de Profesores</h4>
	          		</div>
	          		
	          		<div id="secciones" style="display:inline-block">
	          			<span class="fa fa-table"></span>
	          			<h4>Horarios de Secciones</h4>
	          		</div>
	          	</div>
	          

	          <div id="div_horarios" class="dataTable_wrapper" style="margin-left:-5%; display:none;">
					<?php include("conexion.php"); 
						
						$sql_mio="SELECT hc.id_seccion, s.id_seccion, p.id_periodo, s.seccion, s.trayecto, p.tipo, s.sede, s.pnf FROM horario_clase hc, horas h, secciones s, periodo p WHERE hc.id_seccion=s.id_seccion AND hc.id_horas=h.id_horas AND hc.id_periodo=p.id_periodo AND hc.taller=2 AND h.taller=2 AND s.taller=2 AND hc.estatus=1 AND h.estatus=1 AND s.estatus=1 GROUP BY s.id_seccion, hc.id_seccion, p.id_periodo ORDER BY s.trayecto, s.seccion ASC";

						$sql_servidor="SELECT hc.id_seccion, s.id_seccion, p.id_periodo, s.seccion, s.trayecto, p.tipo, s.sede, s.pnf FROM horario_clase hc, horas h, secciones s, periodo p WHERE hc.id_seccion=s.id_seccion AND hc.id_horas=h.id_horas AND hc.id_periodo=p.id_periodo AND hc.taller=2 AND h.taller=2 AND s.taller=2 AND hc.estatus=1 AND h.estatus=1 AND s.estatus=1 GROUP BY s.pnf, s.sede, p.tipo, s.trayecto, s.seccion, s.id_seccion, hc.id_seccion, p.id_periodo ORDER BY s.trayecto, s.seccion ASC";

						$query=pg_query($sql_servidor);
					?>
						<table class="table table-striped table-bordered table-hover" id="dataTables-example3" width="95%" style="background:#fff;">
                        <thead>
                          <tr>
                            <th width="" style="background:#0028DC; color:#fff; font-weight:normal;">Trayecto</th>
                            <th width="" style="background:#0028DC; color:#fff; font-weight:normal;">Sección</th>
                            <th width="" style="background:#0028DC; color:#fff; font-weight:normal;">Periodo</th>
                            <th width="" style="background:#0028DC; color:#fff; font-weight:normal;">Sede</th>
                          <th width="" style="background:#0028DC; color:#fff; font-weight:normal;">PNF</th>
                            <th width="5%" style="background:#0028DC; color:#fff; font-weight:normal;">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                        
                          while ($array=pg_fetch_assoc($query))
                          {
                            ?>
                            <tr class="odd gradeX">
                              <td align="center"><?php echo $array['trayecto'];?></td>
                              <td align="center"><?php echo $array['seccion'];?></td>
                              <td align="center"><?php echo $array['tipo']; ?></td>
                              <td align="center"><?php echo $array['sede']; ?></td>
                              <td align="center"> <?php echo $array['pnf']; ?> </td>
                             <td align="center">

                              <a href="javascript:reportando_Horario(<?php echo $array['id_seccion'].','.$array['id_periodo'].',2';?>);">
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

				<div id="div_profesor" class="dataTable_wrapper" style="margin-left:-7%; margin-top:10%; display:none;">
					<?php
						include("conexion.php"); 
					?>

					<div style="display:inline-block;">
	                   <table width="400px">
						<tr>
							<td>
								<label>Nombre del profesor:</label><br>
		                    	<select id="ced_p" name="ced_p" size="" title="Seleccione el nombre del profesor">
		                      
		                      	<option></option>
		                      <?php
		                        $query=pg_query("SELECT * FROM personal WHERE area='Robotica' AND cargo='Profesor' AND estatus=1");

		                        while($array=pg_fetch_assoc($query))
		                        {
		                      ?>
		                      	<option value="<?php echo $array['id']; ?>"><?php echo $array['nombres']." ".$array['apellidos'] ; ?></option>
		                      <?php
		                        }
		                      ?>
		                    	</select>
		                    	&nbsp;&nbsp;&nbsp;
		                    </td>
		                    
							<td>
								&nbsp;&nbsp;&nbsp;
								<label>Periodo:</label><br>
			                    <select id="periodo" name="periodo" size="" title="Seleccione el periodo">
			                      
			                      <option></option>
			                      <?php
			                        $query=pg_query("SELECT * FROM periodo");

			                        while($array=pg_fetch_assoc($query))
			                        {
			                      ?>
			                      <option value="<?php echo $array['id_periodo'];?>"><?php echo $array['tipo'];?></option>
			                      <?php
			                        }
			                      ?>
			                    </select>
							</td>
						</tr>
					</table>

	                    <div class="icono">
	                    	<span onclick="rep_prof('2')" id="prof" class="fa fa-print"></span>
	                    	<h4>Ver Reporte</h4>
	                    </div>
	                </div>

	                <div id="error" style="display:none; color:red;">
	                    <h3>Seleccione el profesor y el periodo</h3>
	                </div> 

				</div>

			</div>
		</div>

		<div id="footer">
			<table width="100%">
				<tr>
					<td align="center" style="color:#FFF;"><br>
						&copy; Copyright - Derechos Reservados - 2015 - TSU Nelson Soto, TSU Sergei Ter&aacute;n y TSU Vicente Cifuentes
					</td>
				</tr>
			</table>
		</div>	
	
	</div>
</body>
</html>

<script type="text/javascript">
$('#convenios').click(function(){
   $('#slideshow').hide();
   $('#div_proyectos').hide();
   $('#div_horarios').hide();
   $('#div_horario').hide()
   $('#div_profesor').hide();
   $('#div_convenios').show();
    
  });

$('#proyectos').click( function(){
		$('#div_convenios').hide();
		$('#slideshow').hide();
		$('#div_horarios').hide();
		$('#div_horario').hide();
		$('#div_profesor').hide();
		$('#div_proyectos').show();
	});

$('#horario').click( function(){
		$('#div_convenios').hide();
		$('#slideshow').hide();		
		$('#div_proyectos').hide();
		$('#div_horarios').hide();
		$('#div_profesor').hide();
		$('#div_horario').show();
	});

$('#secciones').click( function(){
		$('#div_convenios').hide();
		$('#slideshow').hide();		
		$('#div_proyectos').hide();
		$('#div_horario').hide()
		$('#div_profesor').hide();
		$('#div_horarios').show();
	});

$('#profesores').click( function(){
		$('#div_convenios').hide();
		$('#slideshow').hide();		
		$('#div_proyectos').hide();
		$('#div_horario').hide()
		$('#div_horarios').hide();

		$('#div_profesor').show();
	});


 $('#dataTables-example').DataTable({
              responsive: true
        });

 $('#dataTables-example2').DataTable({
              responsive: true
        });

 $('#dataTables-example3').DataTable({
              responsive: true
        });

</script>

<?php
$error=$_REQUEST['error'];

if ($error=='i')
	{
?>
		<script type="text/javascript">
		swal({
			title:"ERROR! <br> Ya se ha iniciado sesion con este usuario",
			text:"Verifique si es usted! alguien puede estar utilizando su cuenta",
			type:"error",
			timer:7000,
			html: true
		});
			//alert("usuario y contrase\u00f1a INCORRECTA! Si desea registrarse comuniquese con el administrador del sistema"); // MENSAJE DE ALERTA
		</script>
<?php
	}

	if ($error==1)
	{
?>
		<script type="text/javascript">
		swal({
			title:"ERROR! <br> Usuario o contrase\u00f1a INCORRECTA",
			text:"Si desea registrarse comuniquese con el administrador del sistema",
			type:"error",
			timer:5000,
			html: true
		});
			//alert("usuario y contrase\u00f1a INCORRECTA! Si desea registrarse comuniquese con el administrador del sistema"); // MENSAJE DE ALERTA
		</script>
<?php
	}
	?>