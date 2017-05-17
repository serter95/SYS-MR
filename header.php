<?php 
	function cabecera()
	{

	$pagina=$_REQUEST['pagina'];
?>

			<div id="header">
				<div class="img_head">
					<img src="imagenes/upta.png" width="10%" height="90%" align="left">
				</div>

				<div style="margin-right:10%;">
					<h3>Universidad Politécnica Territorial del Estado Aragua</h3>
				
					<h3>"Federico Brito Figueroa"</h3>
				</div>

				<?php
					if ($pagina==null || $pagina==0) 
					{
				?>		
						<div class="img_head_izq">
							<div id="slideshow2">
								<img src="imagenes/Robotica_logo.png" style="margin-left: 25%;">
								<img src="imagenes/mecanica.png">
							</div>
						</div>
				<?php
					}

					if ($pagina==1) 
					{
				?>		
						<div class="img_head_izq">
							<img src="imagenes/mecanica.png" width="100%" height="100%">
						</div>
				<?php
					}
					
					if ($pagina==2) 
					{
				?>		
						<div class="img_head_izq">
							<img src="imagenes/Robotica_logo.png" width="80%" height="100%">
						</div>
				<?php
					}
				?>	
			</div>
				<div id="topmenu_container">
					<div id="topmenu">
						<a class="nav-title"
						<?php if ($pagina==0) { ?> style="background:#E2E2E2; color:#002BD2;" <?php } ?>
						href="index.php?pagina=0">Inicio</a>
						
						<a class="nav-title"
						<?php if ($pagina==1) { ?> style="background:#E2E2E2; color:#002BD2;" <?php } ?>
						href="tallermec.php?pagina=1">Taller de Metalmec&aacute;nica</a>
						
						<a class="nav-title"
						<?php if ($pagina==2) { ?> style="background:#E2E2E2; color:#002BD2;" <?php } ?>
						href="labrob.php?pagina=2">Laboratorio de Robotica</a>
						
						<div id="box_login">
							<div id="dialogoformulario" title="Inicio de Sesi&oacute;n de <?php if ($pagina==1){ echo 'Metalmec&aacute;nica'; } else {echo 'Robotica';}?>" style="display:none;">
								<form action="mecanica/validacion_usuario.php" method="get" id="formajax" name="formajax">
									<fieldset id="formulario_container">
								 	<label style="font-weight:bold;">Nombre</label>
								 	<span></span>
								 	<input type="text" id="user_name" name="user_name" maxlength="20" onkeypress="return nombre_usu(event)"/>
								 	<label style="font-weight:bold;">Contrase&ntilde;a</label>
								 	<span></span>
								 	<input type="password" id="password" name="password" maxlength="20" onkeypress="return contrasena(event)"/>
								 	<input type="hidden" value="<?php if ($pagina==1){ echo 1;} else {echo 2;}?>" name="area" /><br>
								 	<a style="color:#1F38B0;" href="olvidoMec.php?pagina=<?php echo $pagina; ?>">¿Ha olvidado su contraseña?</a>
								 	</fieldset>
								 	<fieldset id="botoneria">
								 	<input id="enviar" class="boton" type="submit" value="Confirmar" title="Confirmar">
								 	<input id="borrar" class="boton" type="reset" value="Borrar" name="Borrar" title="Borrar">
								 	</fieldset>
								</form>
							</div>
					<?php if ($pagina!=0)
						{
					?>
							<div id="dialogo" class="login" title="Iniciar sesi&oacute;n" >
								<span>Iniciar Sesi&oacute;n</span>
							</div>
					<?php
						}
					?>	
						</div>
					</div>
				</div>
<?php
	}
?>