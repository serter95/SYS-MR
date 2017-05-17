<?php
$contacto=$_POST['contacto'];
switch($contacto){
	case "0":
	$modelo="0";
	break;
	case "1":
	$modelo='<div class="info2">
	<div id="text_center_title"> <!--para la parte de titulo--> 
		 			<span>REGISTRO | MÁQUINA </span>
				</div>
			<div id="form_contenedor">
				<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
					<fieldset id="regmaq">
					<legend>Información de la máquina</legend> 

					 	<input type="hidden" name="maquina" value="Torno">
					 	
					 	<label style="display:inline-block;"> Código: </label> <div style="display:inline-block;" id="resultado"></div>
					 	<div  style="display: table;">
                            
                            <input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3458" onKeyPress="return solonum(event)" onKeyUp="validarCodigo()">
					 		<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

                                        </div>
					 	
					 	<label>N/B</label>
					 	<input type="text" name="n_b" id="N/B" size="" maxlength="10" placeholder="0978656" onKeyPress="return solonum(event)" onKeyUp="validarN_B()">
					 	<div class="promts"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 

					 	
					 	<label>Estado</label>
					 	 

					 	<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
					 	<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Marca</label>
					  	<input type="text" name="marca" id="marca" size="" maxlength="8" placeholder="C.M.E" onKeyUp="validarMarca()">
					  	<div class="promts"><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	
					 	<label>Modelo</label>
					  	<input type="text" name="modelo" id="modelo" size="" maxlength="8" placeholder="FU-2" onKeyUp="validarModelo()">
					 	<div class="promts"><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Imagen</label>
					 	<input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

					 	<label>Posee Mantenimiento Preventivo</label>
					 	<input type="radio" name="mantenimiento_p" value="No" size="30" onClick="ocultaCapa()" checked />No
						<input type="radio" name="mantenimiento_p" value="Si" size="30" onClick="mostrarCapa()" />Si
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>					 	
					  	</fieldset>
					 	
					 	<div id="man" style="display:none;">
					 	<fieldset id="regmaq">
					 	<legend>Mantenimiento Preventivo</legend>

					 	<label>Revision de maquina a cargo de</label>
					 	<input type="text" name="rev_maquina" id="rev_maquina" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()">
					 	<span id="apellidoPrompt"></span>

					 	<label>Fecha</label>
					 	<input type="date" name="fecha" id="fecha" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="validar()">
					 	<span id="Prompt"></span>

					 	<label>Nivel de aceite</label>
					 	<select name="niv_aceite">
					 		<option></option>
					 		<option>Bajo</option>
					 		<option>Medio</option>
					 		<option>Alto</option>
					 	</select>
					 		
					 	
						<label>Observaciones</label>
					 	<textarea name="observaciones" id="observaciones" size="" maxlength="125" placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
					 	<span id="Prompt"></span>
					 	</div>
					 	<br>

					 	<input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" > 
					 	<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
					 	<br></br>
				 	</fieldset>
				</form></div></div>';
	break;
	case "2":
	$modelo='<div class="info2">
	<div id="text_center_title"> <!--para la parte de titulo--> 
		 			<span>REGISTRO | MÁQUINA </span>
				</div>
			<div id="form_contenedor">
				<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data">
					<fieldset id="regmaq">
					<legend>Información de la máquina</legend> 

					 	<input type="hidden" name="maquina" value="Esmeril">
					 	<label style="display:inline-block;">Código:</label> <div id="resultado_es" style="display:inline-block;"></div>
					 	<div style="display: table;">
                        
					 	<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3456" onKeyPress="return solonum(event)" onKeyUp="validarCodigoEsmeril()">
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	</div>
					 	<label>N/B</label>
					 	<input type="text" name="n_b" id="N/B" size="" maxlength="10" placeholder="0978656" onKeyPress="return solonum(event)" onKeyUp="validarN_B()">
					 	<div class="promts"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 

					 	
					 	<label>Estado</label>
					 	 

					 	<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
					 	<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Marca</label>
					  	<input type="text" name="marca" id="marca" size="" maxlength="8" placeholder="C.M.E" onKeyUp="validarMarca()">
					  	<div class="promts"><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	
					 	<label>Modelo</label>
					  	<input type="text" name="modelo" id="modelo" size="" maxlength="8" placeholder="FU-2" onKeyUp="validarModelo()">
					 	<div class="promts"><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

						<label>Imagen</label>
					 	<input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

					 	<label>Posee Mantenimiento Preventivo</label>
					 	<input type="radio" name="mantenimiento_p" value="No" size="30" onClick="ocultaCapa()" checked />No
						<input type="radio" name="mantenimiento_p" value="Si" size="30" onClick="mostrarCapa()" />Si
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>					 	
					  	</fieldset>
					 	
					 	<div id="man" style="display:none;">
					 	<fieldset id="regmaq">
					 	<legend>Mantenimiento Preventivo</legend>

					 	<label>Revision de maquina a cargo de</label>
					 	<input type="text" name="rev_maquina" id="rev_maquina" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()">
					 	<span id="apellidoPrompt"></span>

					 	<label>Fecha</label>
					 	<input type="date" name="fecha" id="fecha" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="validar()">
					 	<span id="Prompt"></span>

					 	<label>Nivel de aceite</label>
					 	<select name="niv_aceite">
					 		<option></option>
					 		<option>Bajo</option>
					 		<option>Medio</option>
					 		<option>Alto</option>
					 	</select>
					 		
					 	
						<label>Observaciones</label>
					 	<textarea name="observaciones" id="observaciones" size="" maxlength="125" placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
					 	<span id="Prompt"></span>
					 	</div>
					 	<br>

					 	<input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" > 
					 	<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
					 	<br></br>
				 	</fieldset>
				</form></div></div>';
	break;
	case "3":
	$modelo='<div class="info2">
	<div id="text_center_title"> <!--para la parte de titulo--> 
		 			<span>REGISTRO | MÁQUINA </span>
				</div>
			<div id="form_contenedor">
				<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
					<fieldset id="regmaq">
					<legend>Información de la máquina</legend> 

					 	<input type="hidden" name="maquina" value="Limadora">
						
					 	
					 	
					 	<label style="display:inline-block;">Código: </label> <div id="resultado_li" style="display:inline-block;"></div>
					 	<div  style="display: table;">
                        
					 	<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoLimadora()">
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
						</div>

					 	<label>N/B</label>
					 	<input type="text" name="n_b" id="N/B" size="" maxlength="10" placeholder="0978656" onKeyPress="return solonum(event)" onKeyUp="validarN_B()">
					 	<div class="promts"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 

					 	
					 	<label>Estado</label>
					 	 

					 	<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
					 	<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Marca</label>
					  	<input type="text" name="marca" id="marca" size="" maxlength="8" placeholder="C.M.E" onKeyUp="validarMarca()">
					  	<div class="promts"><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	
					 	<label>Modelo</label>
					  	<input type="text" name="modelo" id="modelo" size="" maxlength="8" placeholder="FU-2" onKeyUp="validarModelo()">
					 	<div class="promts"><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>


						<label>Imagen</label>
					 	<input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

					 	<label>Posee Mantenimiento Preventivo</label>
					 	<input type="radio" name="mantenimiento_p" value="No" size="30" onClick="ocultaCapa()" checked />No
						<input type="radio" name="mantenimiento_p" value="Si" size="30" onClick="mostrarCapa()" />Si
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>					 	
					  	</fieldset>
					 	
					 	<div id="man" style="display:none;">
					 	<fieldset id="regmaq">
					 	<legend>Mantenimiento Preventivo</legend>

					 	<label>Revision de maquina a cargo de</label>
					 	<input type="text" name="rev_maquina" id="rev_maquina" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()">
					 	<span id="apellidoPrompt"></span>

					 	<label>Fecha</label>
					 	<input type="date" name="fecha" id="fecha" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="validar()">
					 	<span id="Prompt"></span>

					 	<label>Nivel de aceite</label>
					 	<select name="niv_aceite">
					 		<option></option>
					 		<option>Bajo</option>
					 		<option>Medio</option>
					 		<option>Alto</option>
					 	</select>
					 		
					 	
						<label>Observaciones</label>
					 	<textarea name="observaciones" id="observaciones" size="" maxlength="125" placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
					 	<span id="Prompt"></span>
					 	</div>
					 	<br>

					 	<input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" > 
					 	<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
					 	<br></br>
				 	</fieldset>
				</form></div></div>';
	break;
	case "4":
	$modelo='<div class="info2">
	<div id="text_center_title"> <!--para la parte de titulo--> 
		 			<span>REGISTRO | MÁQUINA </span>
				</div>
			<div id="form_contenedor">
				<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data"  >
					<fieldset id="regmaq">
					<legend>Información de la máquina</legend> 

					 	<input type="hidden" name="maquina" value="Fresadora">
						
					 
					 	
					 	<label style="display:inline-block;">Código: </label> <div id="resultado_fre" style="display:inline-block;"></div>
					 	<div  style="display: table;">
                        
					 	<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoFresadora()">
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	</div>

					 	<label>N/B</label>
					 	<input type="text" name="n_b" id="N/B" size="" maxlength="10" placeholder="0978656" onKeyPress="return solonum(event)" onKeyUp="validarN_B()">
					 	<div class="promts"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 

					 	
					 	<label>Estado</label>
					 	 

					 	<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
					 	<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Marca</label>
					  	<input type="text" name="marca" id="marca" size="" maxlength="8" placeholder="C.M.E" onKeyUp="validarMarca()">
					  	<div class="promts"><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	
					 	<label>Modelo</label>
					  	<input type="text" name="modelo" id="modelo" size="" maxlength="8" placeholder="FU-2" onKeyUp="validarModelo()">
					 	<div class="promts"><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

						<label>Imagen</label>
					 	<input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

					 	<label>Posee Mantenimiento Preventivo</label>
					 	<input type="radio" name="mantenimiento_p" value="No" size="30" onClick="ocultaCapa()" checked />No
						<input type="radio" name="mantenimiento_p" value="Si" size="30" onClick="mostrarCapa()" />Si
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>					 	
					  	</fieldset>
					 	
					 	<div id="man" style="display:none;">
					 	<fieldset id="regmaq">
					 	<legend>Mantenimiento Preventivo</legend>

					 	<label>Revision de maquina a cargo de</label>
					 	<input type="text" name="rev_maquina" id="rev_maquina" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()">
					 	<span id="apellidoPrompt"></span>

					 	<label>Fecha</label>
					 	<input type="date" name="fecha" id="fecha" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="validar()">
					 	<span id="Prompt"></span>

					 	<label>Nivel de aceite</label>
					 	<select name="niv_aceite">
					 		<option></option>
					 		<option>Bajo</option>
					 		<option>Medio</option>
					 		<option>Alto</option>
					 	</select>
					 		
					 	
						<label>Observaciones</label>
					 	<textarea name="observaciones" id="observaciones" size="" maxlength="125" placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
					 	<span id="Prompt"></span>
					 	</div>
					 	<br>

					 	<input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" > 
					 	<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
					 	<br></br>
				 	</fieldset>
				</form></div></div>';
	break;
	case "5":
	$modelo='<div class="info2">
	<div id="text_center_title"> <!--para la parte de titulo--> 
		 			<span>REGISTRO | MÁQUINA </span>
				</div>
			<div id="form_contenedor">
				<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
					<fieldset id="regmaq">
					<legend>Información de la máquina</legend> 

					 	<input type="hidden" name="maquina" value="Taladro">
						

					 	<label style="display:inline-block;">Código: </label> <div id="resultado_ta" style="display:inline-block;"></div>
					 	<div style="display: table;">
	                        
						  	<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoTaladro()">
						 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	</div>

					 	<label>N/B</label>
					 	<input type="text" name="n_b" id="N/B" size="" maxlength="10" placeholder="0978656" onKeyPress="return solonum(event)" onKeyUp="validarN_B()">
					 	<div class="promts"> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 

					 	
					 	<label>Estado</label>
					 	<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
					 	<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Marca</label>
					  	<input type="text" name="marca" id="marca" size="" maxlength="8" placeholder="C.M.E" onKeyUp="validarMarca()">
					  	<div class="promts"><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
					 	
					 	<label>Modelo</label>
					  	<input type="text" name="modelo" id="modelo" size="" maxlength="8" placeholder="FU-2" onKeyUp="validarModelo()">
					 	<div class="promts"><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

					 	<label>Imagen</label>
					 	<input type="file" size="60" value="Sin imagen" name="imagen" onchange="control(this)">

					 	<label>Posee Mantenimiento Preventivo</label>
					 	<input type="radio" name="mantenimiento_p" value="No" size="30" onClick="ocultaCapa()" checked />No
						<input type="radio" name="mantenimiento_p" value="Si" size="30" onClick="mostrarCapa()" />Si
					 	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>					 	
					  	</fieldset>
					 	
					 	<div id="man" style="display:none;">
					 	<fieldset id="regmaq">
					 	<legend>Mantenimiento Preventivo</legend>

					 	<label>Revision de maquina a cargo de</label>
					 	<input type="text" name="rev_maquina" id="rev_maquina" size="" maxlength="30" placeholder="José Alcantara" onKeyPress="return soloLetras(event)" onKeyUp="validarApellido()">
					 	<span id="apellidoPrompt"></span>

					 	<label>Fecha</label>
					 	<input type="date" name="fecha" id="fecha" size="" maxlength="10" placeholder="00-00-0000" onKeyUp="validar()">
					 	<span id="Prompt"></span>

					 	<label>Nivel de aceite</label>
					 	<select name="niv_aceite">
					 		<option></option>
					 		<option>Bajo</option>
					 		<option>Medio</option>
					 		<option>Alto</option>
					 	</select>
					 		
					 	
						<label>Observaciones</label>
					 	<textarea name="observaciones" id="observaciones" size="" maxlength="125" placeholder="La máquina requiere de: ..." onKeyUp="validar()"></textarea>
					 	<span id="Prompt"></span>
					 	</div>
					 	<br>

					 	<input class="btn btn-primary" type="submit" value="Enviar" title="Enviar" > 
					 	<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
					 	<br></br>
				 	</fieldset>
				</form></div></div>';
	break;
}

$informacion=array("modelo"=>$modelo);

echo json_encode($informacion);
?>