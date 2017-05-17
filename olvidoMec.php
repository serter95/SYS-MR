<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SYS-M&R</title>
<link rel="stylesheet" type="text/css" href="css/Nuevo2.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.js"></script>
<script type="text/javascript" src="js/hideshow.js"></script>
<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
<script type="text/javascript" src="funciones.js"></script>
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
				<table width="75%">
					<tr>
						<td>
							<h1 align="center">¿Que ha olvidado?</h1>
						</td>
					</tr>
					<tr>
						<td>
							<h3 align="left">
								<a style="color:#1F38B0;" href="correoMec.php?pagina=<?php echo $_REQUEST['pagina'];?>&buscar=contrasena">La Contraseña</a>
							</h3>
						</td>
					</tr>
					<tr>
						<td>
							<h3 align="left">
								<a style="color:#1F38B0;" href="correoMec.php?pagina=<?php echo $_REQUEST['pagina'];?>&buscar=usuario">El Nombre de Usuario</a>
							</h3>
						</td>
					</tr>
					<tr>
						<td>
							<h3 align="left">
								<a style="color:#1F38B0;" href="correoMec.php?pagina=<?php echo $_REQUEST['pagina'];?>&buscar=ambas">La Contraseña y Nombre de Usuario</a>
							</h3>
						</td>
					</tr>
					<tr>
						<td>
							<b><p>Seleccione una de las tres opciones colocadas para poder continuar con la recuperacion de sus datos</p></b>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div id="footer">
		</div>	
	</div>
</body>
</html>