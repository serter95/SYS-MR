<!DOCTYPE html>
<html>
<head>
<title>Prototipo1</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="css/Nuevo2.css"/>
<link href="css/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.metadata.js"></script>
<script type="text/javascript" src="js/hideshow.js"></script>
<script type="text/javascript" src="js/vali.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$('#dialogo').button();

	//Damos formato a la ventana de dialogo
	$('#dialogoformulario').dialog({
		//indica que la ventana se abre de forma automatica
		autoOpen: false,
		//indica si la venta es modal es decir que no permite tocar lo que esta atras
		modal:true,
		//largo
		width: 400,
		//alto
		height: 'auto',
	
		
	});
		$('#dialogoformulario').fadeOut();

	$('#dialogo').click(function(){
		$('#dialogoformulario').fadeIn(2000).dialog('open');
	
	});
	//validacion del formulario con javascript

	$('#formajax').validate({
		
			event: "blur",
	rules: {
		'user_name': "required",
		'password': "required"
	},
	messages:{
		'user_name': "por favor introduzca un nombre",
		'password': "por favor introduzca su clave"
			},
			
		errorPlacement:function(error,element){
			error.appendTo(element.prev("span").append());
		},
		

	});

});

</script>

</head>
<body>
	<div id="wrapper">
			<div id="header_container">
			<div id="header">
							<img align="left" src="img/uptalogo.png"></img>
			</div>
				<div id="topmenu_container">
					<div id="topmenu">
						<a class="nav-title" href="#">Taller de  Mecanica</a>
						<div id="box_login">
							<div id="dialogoformulario" title="Inicio de Sesi&oacute;n" style="display:none;">
							 <form action="acceder.php" method="post"  id="formajax">
							 	<fieldset id="formulario_container">
							 	<label style="font-weight:bold;">Nombre</label>
							 	<span></span>
							 	<input type="text" id="user_name" name="user_name" maxlength="20" class="{required:true}"/>
							 	<label style="font-weight:bold;">Contrase&ntilde;a</label>
							 	<span></span>
							 	<input type="password" id="password" name="password" maxlength="20" class="{required:true}"/>
							 	</fieldset>
							 	<fieldset id="botoneria">
							 	<input id="enviar" class="boton" type="submit" value="Confirmar" title="Confirmar" name="Confirmar">
							 	<input id="borrar" class="boton" type="reset" value="Borrar" name="Borrar" title="Borrar">
							 </fieldset>
							</form>
							</div>
							

							<div id="dialogo" title="Iniciar sesi&oacute;n" >
								<span>Iniciar Sesi&oacute;n</span>
		
	</div>
						</div>
					</div>
				</div>
			</div>
	
<div id="center">
	<div id="columnaizquierda">
		<div  class="aside1" >
			<div class="accordion">
    			<div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-1">Taller de  Mecanica</a>
         
        <div id="accordion-1" class="accordion-section-content">
        	<ul>
 				<li><a href="#">Quienes somos</a></li>
				<li><a href="#">PNF. Mec&aacute;nica</a></li>
				<li><a href="#">Proyecto Socio T&eacute;cnologico</a></li>
				<li><a href="#">Convenios</a></li>
			</ul>
        </div><!--end .accordion-section-content-->
   				 </div><!--end .accordion-section-->
			</div><!--end .accordion-->
			
		</div>
				
		<div class="aside1">
			<div class="accordion">
    			<div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-2">Horarios</a>
         
        <div id="accordion-2" class="accordion-section-content">
        	<ul >
				<li><a href="#">Horarios de disponibilidad</a></li>
			</ul>
        </div><!--end .accordion-section-content-->
   				</div><!--end .accordion-section-->
			</div><!--end .accordion-->
			
		</div>
		<div class="aside1">
			<div class="accordion">
   				 <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-3">Intranet</a>
         
        <div id="accordion-3" class="accordion-section-content">
        	<ul>
				<li><a href="#">Sistema DACE</a></li>
				<li><a href="#">Visita Virtual</a></li>
			</ul>
        </div><!--end .accordion-section-content-->
    			</div><!--end .accordion-section-->
			</div><!--end .accordion-->
			
		</div>
		<div class="aside1">
			<div class="accordion">
   				 <div class="accordion-section">
        <a class="accordion-section-title" href="#accordion-4">Universidad FBF</a>
         
        <div id="accordion-4" class="accordion-section-content">
        	<ul>
				<li><a href="#">Upta FBF</a></li>
				<li><a href="#">Aula Virtual</a></li>
			</ul>
        </div><!--end .accordion-section-content-->
    			</div><!--end .accordion-section-->
			</div><!--end .accordion-->
			
		</div>
	
	</div>

	<div id="areadetrabajo"><!--Capa para colocar texto dentro del centro-->
		
		<div id="text_center_title"> <!--para la parte de titulo--> 
		 	<span>REGISTRO | USUARIOS </span>
		</div>
			<form action="nosedo.html" method="post" id="user_form" name="user_form" onSubmit="return validarForm()">
		 		<fieldset> 
				 	<label>Usuario</label>
				 	<input type="text" name="user" id="user" size="30" maxlength="10" placeholder="NS212" onKeyUp="validarUser()">
				 	<span id="userPrompt"></span>

				 	<label>Contraseña</label>
				 	<input type="password" name="password" id="password" size="30" maxlength="10" placeholder="******" onKeyUp="validarPass()"><span id="passPrompt"></span>
				 
				 	<label>Repita Contraseña</label>
				 	<input type="password" name="password_c" id="password_c" size="30" maxlength="10" placeholder="******" onKeyUp="validarPass2()"> <span id="pass2Prompt"></span>
				 	
				 	<label>C&eacute;dula de Identidad</label>
				 	<select name="nacionalidad">
				 		<option>V-</option>
				 		<option>E-</option>
				 	</select>
				  	<input type="text" name="cedula_user" id="cedula_user" size="30" maxlength="8" placeholder="22132132" onKeyPress="return solonum(event)" onKeyUp="validarCedula()"><span id="cedulaPrompt"></span>
				 	
				 	<label>Apellidos</label>
				 	<input type="text" name="apellido_user" id="apellido_user" size="50" maxlength="30" placeholder="Perez Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()"> <span id="apellidoPrompt"></span>
				 	
				 	<label>Nombres</label>
				 	<input type="text" name="nombre_user" id="nombre_user" size="50" maxlength="30" placeholder="Carlos Eduardo" onKeyPress="return soloLetras(event)"  onKeyUp="validarNombre()"> <span id="nombrePrompt"></span>
				 	
				 	<label>Fecha de Nacimiento</label>
				 	<input type="date" name="fecha_user" required>
				 	
				 	<label>Direcci&oacute;n</label>
				 	<textarea name="direccion" id="direccion" maxlength="125" placeholder="La Victoria - Edo. Aragua" onKeyUp="validarDireccion()"></textarea> <span id="direccionPrompt"></span>
				 	<br>
				 	
				 	<input class="botonform" type="submit" value="Enviar" title="Enviar" onClick="return validar_clave()"> 
				 	<input class="botonform" type="reset" value="Limpiar" title="Limpiar"> 
			 	</fieldset>
		 </form>

	</div>
</div>
	<div id="footer">
	</div>	
	</div>
</body>
</html>