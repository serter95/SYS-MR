<?php

$contacto=$_POST['contacto'];
switch($contacto){
	case "0":
	$modelo="0";
	break;
	case "1":
#	$modelo='
	?>
	<div class="info2">
		<div id="text_center_title"> <!--para la parte de titulo--> 
			<span class="t-menu">Registro de Maquina </span>
		</div>
		<div id="form_contenedor" style="margin-left:10%;">
			<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
				<fieldset id="regmaq">
					
					<input type="hidden" name="maquina" value="Torno">
					<table width="100%">
						<tr>
							<td width="33%">
								<label style="display:inline-block;">Código:</label> <div style="display:inline-block;" id="resultado"></div>
								<div  style="display: table;">

									<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3458" onKeyPress="return solonum(event)" onKeyUp="validarCodigo()">
									<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

								</div>
							</td>
							<td width="33%">
								<div  style="display: table;">
									<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
									<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
									<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
									<div class="promts "> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
								</div>
							</td>
							<td align="center">
								<input type="hidden" id="res" name="res"/>

								<label>Estado:</label>


								<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
								<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
								<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
							</td>
						</tr>
						<tr>
							<td width="33%">
								<label>Marca:</label>
								<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="11" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
								<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
							</td>
							<td>
								<label>Modelo:</label>
								<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="11" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
								<div class="promts "><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
							</td>
							<td>
								<label>Imagen:</label>
								<input type="file" size="60" value="Sin imagen" name="imagen" title="Puede introducir una imagen en formato JPG, PNG, y JPEG" onchange="control(this)">
							</td>
						</tr>

						<tr>
	                      <td colspan="3" align="center">
	                        <h3><div id="salidaR_MAQ"></div></h3>
	                      </td>
	                    </tr>

						<tr>
							<td align="center" colspan="3">

								<br>

								<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
								<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
								<br><br>
							</td>
						</tr>
					</table>
				</fieldset>
			</form></div></div>
			<?php
			break;
			case "2":
#	$modelo='
			?>
			<div class="info2">
				<div id="text_center_title"> <!--para la parte de titulo--> 
					<span class="t-menu">Registro de Maquina </span>
				</div>
				<div id="form_contenedor" style="margin-left:10%">
					<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data">
						<fieldset id="regmaq">

							<input type="hidden" name="maquina" value="Esmeril">
							<table width="100%">
								<tr>
									<td width="33%">
										<label style="display:inline-block;">Código:</label> <div id="resultado_es" style="display:inline-block;"></div>
										<div style="display: table;">

											<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3456" onKeyPress="return solonum(event)" onKeyUp="validarCodigoEsmeril()">
											<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
										</div>
									</td>
									<td width="33%">
										<div  style="display: table;">
											<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
											<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
											<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
											<div class="promts "> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
										</div>
									</td>
									<td align="center">
										<input type="hidden" id="res" name="res"/>

										<label>Estado:</label>


										<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
										<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
										<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
									</td>
								</tr>
								<tr>
									<td>
										<label>Marca:</label>
										<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="11" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
										<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
									</td>
									<td>
										<label>Modelo:</label>
										<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="11" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
										<div class="promts "><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
									</td>
									<td>
										<label>Imagen:</label>
										<input type="file" size="60" value="Sin imagen" name="imagen" title="Puede introducir una imagen en formato JPG, PNG, y JPEG" onchange="control(this)">
									</td>
								</tr>

								<tr>
			                      <td colspan="3" align="center">
			                        <h3><div id="salidaR_MAQ"></div></h3>
			                      </td>
			                    </tr>

								<tr>
									<td colspan="3" align="center">				 	
										<br>
										<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
										<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
										<br><br>
									</td>
								</tr>
							</table>
						</fieldset>

					</form></div></div>'
					<?php
					break;
					case "3":
#	$modelo='
					?>
					<div class="info2">
						<div id="text_center_title"> <!--para la parte de titulo--> 
							<span class="t-menu">Registro de Maquina </span>
						</div>
						<div id="form_contenedor" style="margin-left:10%;">
							<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
								<fieldset id="regmaq">


									<input type="hidden" name="maquina" value="Limadora">
									<table width="100%">
										<tr>
											<td width="33%">			 	

												<label style="display:inline-block;">Código:</label> <div id="resultado_li" style="display:inline-block;"></div>
												<div  style="display: table;">

													<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoLimadora()">
													<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
												</div>
											</td>
											<td width="33%">
												<div style="display: table;">
													<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
													<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
													<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
													<div class="promts "> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
												</div>
												<input type="hidden" id="res" name="res"/>
											</td>
											<td align="center">
												<label>Estado:</label>


												<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
												<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
												<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
											</td>
										</tr>
										<tr>
											<td>
												<label>Marca:</label>
												<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="11" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
												<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
											</td>
											<td>
												<label>Modelo:</label>
												<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="11" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
												<div class="promts "><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
											</td>
											<td>

												<label>Imagen:</label>
												<input type="file" size="60" value="Sin imagen" name="imagen" title="Puede introducir una imagen en formato JPG, PNG, y JPEG" onchange="control(this)">
											</td>
										</tr>
										<tr>
					                      <td colspan="3" align="center">
					                        <h3><div id="salidaR_MAQ"></div></h3>
					                      </td>
					                    </tr>
										<tr>
											<td colspan="3" align="center">




												<br>

												<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
												<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
												<br><br>

											</td>
										</tr>
									</table>
								</fieldset>
							</form></div></div>
							<?php
							break;
							case "4":
#	$modelo='
							?>
							<div class="info2">
								<div id="text_center_title"> <!--para la parte de titulo--> 
									<span class="t-menu">Registro de Maquina </span>
								</div>
								<div id="form_contenedor" style="margin-left:10%;">
									<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data"  >
										<fieldset id="regmaq">


											<input type="hidden" name="maquina" value="Fresadora">
											<table width="100%">
												<tr>
													<td width="33%">	


														<label style="display:inline-block;">Código:</label> <div id="resultado_fre" style="display:inline-block;"></div>
														<div  style="display: table;">

															<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoFresadora()">
															<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
														</div>
													</td>
													<td width="33%">

														<div  style="display: table;">
															<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
															<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
															<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
															<div class="promts "> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
														</div>
														<input type="hidden" id="res" name="res"/>
													</td>
													<td align="center">
														<label>Estado:</label>


														<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
														<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
														<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
													</td>
												</tr>
												<tr>
													<td>
														<label>Marca:</label>
														<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="11" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
														<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
													</td>
													<td>
														<label>Modelo:</label>
														<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="11" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
														<div class="promts "><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
													</td>
													<td>
														<label>Imagen:</label>
														<input type="file" size="60" value="Sin imagen" name="imagen" title="Puede introducir una imagen en formato JPG, PNG, y JPEG" onchange="control(this)">
													</td>
												</tr>
												<tr>
							                      <td colspan="3" align="center">
							                        <h3><div id="salidaR_MAQ"></div></h3>
							                      </td>
							                    </tr>
												<tr>
													<td colspan="3" align="center">



														<br>

														<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
														<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
														<br><br>
													</td>
												</tr>
											</table>
										</fieldset>
									</form></div></div>
									<?php
									break;
									case "5":
#	$modelo='
									?>
									<div class="info2">
										<div id="text_center_title"> <!--para la parte de titulo--> 
											<span class="t-menu">Registro de Maquina </span>
										</div>
										<div id="form_contenedor" style="margin-left:10%;">
											<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
												<fieldset id="regmaq">
													

													<input type="hidden" name="maquina" value="Taladro">
													<table width="100%">
														<tr>
															<td width="33%">	
																


																<label style="display:inline-block;">Código:</label> <div id="resultado_ta" style="display:inline-block;"></div>
																<div style="display: table;">

																	<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3548" onKeyPress="return solonum(event)" onKeyUp="validarCodigoTaladro()">
																	<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
																</div>
															</td>
															<td width="33%">
																<div  style="display: table;">
																	<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
																	<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
																	<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
																	<div class="promts "> <span id="N/BPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
																</div>
															</td>
															<td align="center">
																<input type="hidden" id="res" name="res"/>

																<label>Estado:</label>
																<input type="radio" name="estado" value="Operativo" id="estado" size="30" checked />Operativo
																<input type="radio" name="estado" value="No Operativo" id="estado2" size="30" />No Operativo
																<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
															</td>
														</tr>
														<tr>
															<td>
																<label>Marca:</label>
																<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="11" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
																<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
															</td>
															<td>
																<label>Modelo:</label>
																<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="11" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
																<div class="promts "><span id="modeloPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
															</td>
															<td>
																<label>Imagen:</label>
																<input type="file" size="60" value="Sin imagen" name="imagen" title="Puede introducir una imagen en formato JPG, PNG, y JPEG" onchange="control(this)">
															</td>
														</tr>
														<tr>
									                      <td colspan="3" align="center">
									                        <h3><div id="salidaR_MAQ"></div></h3>
									                      </td>
									                    </tr>
														<tr>
															<td colspan="3" align="center">
																


																<br>

																<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
																<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
																<br><br>
															</td>
														</tr>
													</table>
												</fieldset>
											</form></div></div>
											<?php
											break;
										}

$informacion=$modelo;      #array("modelo"=>$modelo);

echo $informacion;          #json_encode($informacion);
?>