<?php
	require('conexion.php');

	$correo=$_REQUEST['correo'];
	$pagina=$_REQUEST['pagina'];

	$query2=pg_query("SELECT * FROM personal p, usuario u WHERE p.id=u.id_personal AND u.taller='$pagina'
	AND p.estatus=1	AND u.estatus=1");
	
	while($array2=pg_fetch_assoc($query2))
	{
		#echo $array2['correo'];
		if ($correo==$array2['correo'])
		{
			$existe='si';

			if ($array2['bloqueo']==1)
			{
				$bloqueo='si';
			}
		}
	}

	if ($existe!='si')
	{
		header('Location:correoMec.php?pagina='.$pagina.'&error=c&buscar='.$_REQUEST['buscar']);
	}
	else
	{

	$query=pg_query("SELECT * FROM usuario u, personal p WHERE u.id_personal=p.id AND u.taller='$pagina'
	AND u.estatus=1 AND p.estatus=1 AND p.correo='$correo'");
	$array=pg_fetch_assoc($query);
?>
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
					if ($bloqueo!='si')
					{
				?>
					<form method="post" action="respuestaMec.php">
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
						
							<input type="hidden" name="correo" value="<?php echo $correo; ?>">
					<table width="75%">
						<tr>
							<td>
								<h1 align="center">Pregunta de seguridad</h1>
							</td>
						</tr>
						<tr>
							<td align="center">
								<?php echo "¿".$array['pregunta']."?"; ?>
							</td>
						</tr>
						<tr>
							<td align="center">
								Respuesta: &nbsp;<input type="text" id="respuesta" name="respuesta">
							</td>
						</tr>
						<tr>
							<td align="center">
								<h3>Intento <?php if ($_REQUEST['intento']==0)
												{
													echo "1/3";
												}
												else
												{
													echo $_REQUEST['intento']."/3";
												}
											?>
								</h3>
								<input type="hidden" name="intento" value="<?php echo $_REQUEST['intento'];?>">
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
								<b><p>Oprima Confirmar Cuando haya colocado la respuesta a la pregunta</p></b>
							</td>
						</tr>
					</table>
					</form>
				<?php
					}
					else
					{
				?>
					<table>
						<tr>
							<td align="center">
								<h1 style="color:red;">¡Su Cuenta a sido Bloqueada!</h1>
								<h3>Contacte al Administrador del sistema</h3>
							</td>
						</tr>
					</table>
				<?php
					}
				?>
				</div>
			</div>
			<div id="footer">
			</div>	
		</div>
	</body>
	</html>
<?php
	}
?>