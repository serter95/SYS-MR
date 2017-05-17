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
			</div><br><br><br>
			<div id="areadetrabajo" align="center">

				<?php
					if ($_REQUEST['error']=='c')
					{
				?>
				<p style="display:inline-block; font-size:20px; text-align:center; color:red;">
					¡El Correo Electrónico colocado no existe!
				</p>
				<?php
					}
				?>

				<form method="post" action="buscarCuentaMec.php">
					<?php
						$buscar=$_REQUEST['buscar'];

						if ($buscar=='contrasena')
						{
					?>
						<input type="hidden" name="buscar" value="contrasena">
					<?php
						}
						if ($buscar=='usuario')
						{
					?>
						<input type="hidden" name="buscar" value="usuario">
					<?php
						}
						if ($buscar=='ambas')
						{
					?>
						<input type="hidden" name="buscar" value="ambas">
					<?php
						}
					?>

						<input type="hidden" name="pagina" value="<?php echo $_REQUEST['pagina']; ?>">

				<table width="75%">
					<tr>
						<td>
							<h1 align="center">Coloque su dirección de Correo Electrónico</h1>
						</td>
					</tr>
					<tr>
						<td align="center">
							<input type="text" id="correo" name="correo" placeholder="Ejemplo:correo_e@ejemplo.com">
						</td>
					</tr>
					<tr>
						<td align="center">	
							<input type="submit" value="Confirmar">
							<input type="reset" value="Borrar">
						</td>
					</tr>
					<tr>
						<td align="center">
							<b><p>Oprima Confirmar Cuando haya colocado su Correo Electrónico</p></b>
						</td>
					</tr>
				</table>
				</form>
			</div>
		</div>
		<div id="footer">
		</div>	
	</div>
</body>
</html>