<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="author" content="Ing. Sergei Terán, Ing. Nelson Soto, Ing. Vicente Cifuentes">
<meta name="robots" content="Index, Follow">
<meta name="generator" content="SublimeText">
<meta name="description" content="Demo de la aplicación web para el control y gestion académica y administrativa para el taller de metalmecánica y laboratorio de robótica de UPT-Aragua 'Federico Brito Figueroa'">

<title>SYS-M&R</title>
<link rel="stylesheet" type="text/css" href="css/Nuevo2.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="css/sweetalert.css"/>
<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/jquery.fancybox.css" type="text/css"  rel="stylesheet">


<!--script src="js/bootstrap.min.js"></script-->
<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/hideshow.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="funciones.js"></script>
<script type="text/javascript" src="js/sweetalert.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/jquery.fancybox.js"></script>
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
			<?php
				$pagina=$_REQUEST['pagina'];
				
				if ($pagina==0)
				{
				
			?>			<div id="slideshow">
							<img src="imagenes/ut.jpg">
							<img src="imagenes/li.png">
							<img src="imagenes/be.jpg-large">
							<img src="imagenes/foto2.gif">
							<img src="imagenes/UP.jpg">
						</div>	
			<?php		
				}
				if ($pagina==1)
				{
			?>
						<div id="slideshow">
							<img src="imagenes/IMG_20150416_094136.jpg">
							<img src="imagenes/IMG_20150416_093335.jpg">
							<img src="imagenes/IMG_20150416_093054.jpg">
							<img src="imagenes/IMG_20150416_093139.jpg">
							<img src="imagenes/IMG_20150416_093420.jpg">
							<img src="imagenes/IMG_20150416_093156.jpg">
						</div>
			?>
			<?php
				}
				if ($pagina==2)
				{		
			?>			<div id="slideshow">
							<img src="imagenes/IMG_20150416_095740.jpg">
							<img src="imagenes/IMG_20150416_095748.jpg">
							<img src="imagenes/IMG_20150416_095828.jpg">
							<img src="imagenes/IMG_20150416_095917.jpg">
						</div>
			<?php	
				}
			?>	

			<div id="PnfElectronica" style="display:none; margin-right:3%;" align="justify">
				
				<div class="panel panel-default">
		            <div class="panel-body">
		                <!-- Nav tabs -->
		                <ul class="nav nav-tabs">
		                    <li class="active"><a href="#datosR1" data-toggle="tab">Robótica</a></li>
		                    <li><a href="#datosR2" data-toggle="tab">Misión</a></li>
		                    <li><a href="#datosR3" data-toggle="tab">Visión</a></li>
		                </ul>

		                <!-- Tab panes -->
		                <div class="tab-content">
		                    <div class="tab-pane fade in active" id="datosR1">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">

		                                    <p>
		                                    	El Laboratorio de Robótica se enfoca en la investigación, diseño y desarrollo de prototipos robotizados, con la ayuda de los tesistas de los distintos PNF que se dictan en la universidad, como por ejemplo: Informática, Mecánica, Electricidad, Electrónica e Instrumentación y Control. Esto es con el objetivo de descubrir nuevas tecnologias que se puedan utilizar en las areas laborales, para contribuir con el desarrollo del pais a nivel educacional e industrial.
		                                	</p>

		                                </div>
		                            </div>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
		                    <!-- /.panel -->
		                    
		                    <div class="tab-pane fade" id="datosR2">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">
		                                    
		                                	<p>
		                                	    MISIÓN:

												Contribuir al desarrollo de la investigación científica en la UPT-Aragua a través de la generación de proyectos que apoyen los programas de formación de los estudiantes de grado y posgrados, así como la vinculación con el sector público y privado,  para impulsar la generación del conocimiento y desarrollo de la comunidad científica de la provincia, región y el país.
		                                	</p>

		                                </div>
		                            </div>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
		                    <!-- /.panel -->

		                    <div class="tab-pane fade" id="datosR3">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">

		                                	<p>
						                    	VISIÓN:

												Ser una Dirección de excelencia en la promoción y gestión de la investigación, desarrollo e innovación, para posicionar a la Universidad Politécnica Territorial de Aragua como una institución líder en el contexto regional, nacional e internacional.
						                	</p>

										</div>
				                    </div>
				                    <!-- /.table-responsive -->
				                </div>
				                <!-- /.panel-body -->
				            </div>
				            <!-- /.panel -->

		                </div>
		            </div>
		        </div>

			</div>


			<div id="PnfMecanica" style="display:none; margin-right:3%;" align="justify">
				
				<div class="panel panel-default">
		            <div class="panel-body">
		                <!-- Nav tabs -->
		                <ul class="nav nav-tabs">
		                    <li class="active"><a href="#datosM1" data-toggle="tab">Mecánica</a></li>
		                    <li><a href="#datosM2" data-toggle="tab">Misión</a></li>
		                    <li><a href="#datosM3" data-toggle="tab">Visión</a></li>
		                </ul>

		                <!-- Tab panes -->
		                <div class="tab-content">
		                    <div class="tab-pane fade in active" id="datosM1">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">

		                                    <p>
		                                    	El PNF en Mecánica está dirigido a la formación de un profesional con pertinencia social,consciente del colectivo, respetuoso y solidario, con actitud proactiva hacia el aprendizaje, el mejoramiento continuo y la innovacion,comprometido con los planes de desarrollo económico y social de la nación, que conoce la disponibilidad de los recursos del país, con formación integral, socio-humanista, tecnológica y científica para identificar,abordar y resolver problemas relacionados con el análisis, diseño, construcción, montaje puesta en marcha, operación, mantenimiento, desincorporación y desecho de equipos e instalaciones industriales;donde se utilicen maquinarias para convertir, transportar y utilizar energía, igualmente en la transformación de materias primas en productos manufacturados, asumiendo una actitud responsable, ética honesta, sensibilizado a la conservación del ambiente asi como tambien al uso eficiente del talento humano de los recursos materiales, financieros y energéticos.
		                                	</p>

		                                </div>
		                            </div>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
		                    <!-- /.panel -->
		                    
		                    <div class="tab-pane fade" id="datosM2">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">
		                                    
		                                	<p>
		                                	    MISIÓN:
							
												Formar ciudadanos y ciudadanas integrales con principios y valores éticos, humanísticos, ecológicos y sensibilidad social, con dominio en lo científico y tecnológico para la coordinación, planeación, programación, ejecución, dirección, control y supervisión de los recursos humanos, financieros y materiales durante la gestión profesional de los activos de los sistemas productivos, con eficiencia en beneficio de toda la sociedad y la recomposición de las fuerzas sociales, mejorando la calidad de vida de las comunidades, ajustándose a la transformación derivada de la innovación en el aprendizaje, en el marco del proyecto país contenido en el Plan de Desarrollo Económico y Social de la Nación 2007 – 2013.
		                                	</p>

		                                </div>
		                            </div>
		                            <!-- /.table-responsive -->
		                        </div>
		                        <!-- /.panel-body -->
		                    </div>
		                    <!-- /.panel -->

		                    <div class="tab-pane fade" id="datosM3">
		                        <div class="panel panel-default">
		                            <div class="panel-body">
		                                <div class="table-responsive">

		                                	<p>
						                    	VISIÓN:

						                    	Ser el programa de formación académica de referencia nacional e internacional, en el área Mecánica, que contribuya con el desarrollo endógeno sustentable del país consolidando los diversos sectores productivos y de servicios a través de la formación de seres humanos integrales, con valores y principios de la sociedad socialista del siglo XXI, ajustándose a la transformación derivada de la innovación en el aprendizaje, en el marco del proyecto país en procura de la suprema felicidad social.
						                	</p>

										</div>
				                    </div>
				                    <!-- /.table-responsive -->
				                </div>
				                <!-- /.panel-body -->
				            </div>
				            <!-- /.panel -->

		                </div>
		            </div>
		        </div>
			
			</div>

			<div id="divarea" style="display:none; margin-right:3%; background-color:#fff; text-align:center;" align="justify">
				 <h3>Sede Tradicional - UPT-Aragua</h3>
	 <a class="fancybox" href="imagenes/sede_tra.png" data-fancybox-group="gallery"><img src="imagenes/sede_tra.png" alt="Sede Tradicional" title="Presione clic derecho y seleccione ver o abrir imagén para mejor visualización" width="800px" height="420px"></img></a><br>
	 <h4>Presione la imagén para ampliarla</h4>
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



$('#IdMecanica').click(function(){
	$('#slideshow').hide();
	$('#PnfElectronica').hide();
	$('#PnfMecanica').show();
		$('#divarea').hide();

});

$('#IdRobotica').click(function(){
	$('#slideshow').hide();
	$('#PnfElectronica').show();
	$('#PnfMecanica').hide();
		$('#divarea').hide();

});

$('#IdArea').click(function(){
	$('#slideshow').hide();
	$('#divarea').show();
	$('#PnfMecanica').hide();
	$('#PnfElectronica').hide();
});

 $(document).ready(function(){
      $(".fancybox").fancybox();
    });


</script>
<?php

	# se toman las variables enviadas por la url desde 'vericar_usuario.php'
	
	$error=$_REQUEST['error']; # VARIABLE PARA ERROR DE USUARIO Y CONTRASEÑA
	$error_area=$_REQUEST['error_area']; # VARIABLE DE ERROR SI EL USUARIO EXISTE Y NO ES DEL AREA DE TRABAJO CORRECTA
	
	# si la variable $error es uno
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

	if ($error==2)
	{
?>
		<script type="text/javascript">
		swal({
			title:"Su Cuenta de Usuario ha sido Bloqueada",
			text:"Contacte al Administrador del sistema",
			type:"error",
			timer:5000,
			html: true,
			showConfirmButton: false
		});
			//alert("usuario y contrase\u00f1a INCORRECTA! Si desea registrarse comuniquese con el administrador del sistema"); // MENSAJE DE ALERTA
		</script>
<?php
	}
	
	# si la variable $error_area es uno

	if ($error_area==1)
	{
?>
	<script type="text/javascript">
	swal({
			title:"ERROR! <br> Este Usuario no es de Mec\u00e1nica",
			text:"Intente en Robotica",
			type:"error",
			timer:5000,
			html: true
		});
		//alert('Este usuario no es de Mec\u00e1nica, intente en Robotica');	// MENSAJE DE ALERTA
	</script>
<?php
	}

	# si la variable $error_area es dos

	elseif ($error_area==2)
	{
?>
		<script type="text/javascript">
		swal({
			title:"ERROR! <br> Este Usuario no es de Robotica",
			text:"Intente en Mec\u00e1nica",
			type:"error",
			timer:5000,
			html:true
		});
			//alert('Este usuario no es de Robotica, intente en Mec\u00e1nica');	// MENSAJE DE ALERTA
		</script>
<?php
	}
?>