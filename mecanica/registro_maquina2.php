<?php
require('seguridad.php');
include('conexion.php');

$contacto=$_POST['contacto'];
if($contacto=="0"){
	$caso=0;
}
else if($contacto=="otro"){
	$caso=1;
}
else{
	$caso=2;
}

switch($caso){
	case "0":
	$modelo="0";
	break;
	case "2":
#	$modelo='
	?>
	<div class="info2">
		<div id="text_center_title"> <!--para la parte de titulo--> 
			<span class="t-menu">Registro de Maquina </span>
		</div>
		<div id="form_contenedor" style="margin-left:10%;">
			<form action="registrando_maq.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm()" enctype="multipart/form-data" >
				<fieldset id="regmaq">
					
					<input type="hidden" value="<?php echo $contacto; ?>" name="maquina">
					<table width="100%">
						<tr>
							<td width="33%">
								<label style="display:inline-block;">Código:</label> <div style="display:inline-block;" id="resultado"></div>
								<div  style="display: table;">

									<input type="text" name="codigo" id="codigo" readonly="readonly" size="15" maxlength="4" placeholder="Ejemplo: 3458" onKeyUp="validarCodigo()">
									<p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>

								</div>
							</td>
							<td width="33%">
								<div  style="display: table;">
									<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
									<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
									<input type="text" name="n_b" title="Introduzca el número del bien" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)" onchange="validarN_B()" onKeyUp="validarN_B()" onBlur="validarN_B()"  >
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
								<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="20" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa2(event);'>
								<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
							</td>
							<td>
								<label>Modelo:</label>
								<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="20" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa2(event);'>
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
             <td colspan="3" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
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
			case "1":
#	$modelo='

			$sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario
			AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 AND usuario.estatus=1 AND tipo_usuario.estatus=1 LIMIT 1";
			$query2=pg_query($sql2);
			$array2=pg_fetch_assoc($query2);

			$priv=explode('-', $array2['priv_maquinas']);
			$privilegio_A=$priv[0];
			$privilegio_E=$priv[1];
			$privilegio_M=$priv[2];
			$privilegio_I=$priv[3];
			?>


			<div class="info2">

				<div id="text_center_title"> <!--para la parte de titulo--> 
					<span class="t-menu" id="consult1">Consulta de los tipos de Máquina </span>
					<span class="t-menu" id="consult2" style="display:none;">Registro de tipo de Máquina </span>

				</div>
				
				<div id="form_contenedor" style="">
					

					<fieldset id="regmaq">

						<!--<input type="hidden" name="maquina" value="Esmeril">-->
						<table width="95%">
							<tr>
								<td>
									<?php
									if ($privilegio_A=='A')
									{
										?>
										<p id="agregar_maq"><button class="btn btn-success" type="button"  onclick="agregar_maq_n();">Nuevo Tipo &nbsp; <i class="fa fa-plus"></i></button></p> 
										<script type="text/javascript">
										function agregar_maq_n(){
                  	//document.getElementById('form_contenedor').display=false;
                  	$('#form_contenedor').hide();
                  	$('#regis_tipo_div').show();
                  	$('#consult1').hide();
                  	$('#consult2').show();
                  }

                  </script>
                  <?php  
              }
              ?>
          </td>

      </tr>
      <tr>
      	<td width="100%" align="center">

      		<div class="dataTable_wrapper">
      			<table class="table table-striped table-bordered table-hover" >
      				<thead>
      					<tr>
      						<th>Código</th>
      						<!--  <th>Numero del Bien</th>-->
      						<th>Nombre</th>
      						<!--<th>Existencia</th>-->
      						<th>Acciónes</th>
      					</tr>
      				</thead>
      				<tbody>
      					<?php

      					$sql="SELECT * FROM tipo_maquina WHERE estatus=1";

      					$query=pg_query($sql);

      					while ($array=pg_fetch_assoc($query))
      					{
                           /* $fecha_a=explode('-', $array['fecha']);
                            $ano=$fecha_a[0];
                            $mes=$fecha_a[1].'-';
                            $dia=$fecha_a[2].'-';
                            $fecha=$dia.$mes.$ano;

                            $nombre_per=explode(' ', $array['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $array['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;*/
                            ?>
                            <tr class="odd gradeX">
                            	<td align="center"><?php echo $array['codigo'];?></td>
                            	<!--<td align="center"><?php echo $array['nb'];?></td>-->
                            	<td align="center"><?php echo    $array['nombre']; ?></td>
                            	<!--<td align="center"><?php echo $array['existencia']?></td>-->
                            	<td align="center">
                            		<?php
                            		if ($privilegio_M=='M')
                            		{

                            			?>    
                            			<!--
                            			<a href="javascript:editar_insumos(<?php echo $array['id_tipom'];?>);">

                            				<button class="btn btn-default" title="Modificar" id="Modificar">
                            					<span class="fa fa-edit"></span>
                            				</button>
                            			</a>
                            		-->
                            			<?php
                            		}
                            		?>
                            		<?php
                            		if ($privilegio_E=='E')
                            		{
                            			?>
                            			<a href="javascript:eliminarMaquinaT(<?php echo $array['id_tipom'];?>);">
                            				<button class="btn btn-default" title="Eliminar">
                            					<span class="fa fa-trash-o"></span>
                            				</button>
                            			
                            			<?php
                            		}
                            		?>

                              <!--  <a href="javascript:detalleInsumo(<?php echo $array['id_insumos'];?>);">                
                                  <button class="btn btn-default" title="Ver">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                              </a>-->
                              
                          </td>
                      </tr>
                      <?php
                  }
                  ?>
              </tbody>
          </table>
      </div>
										<!--	<label style="display:inline-block;">Código:</label> <div id="resultado_es" style="display:inline-block;"></div>
										
<div style="display: table;">
																					<input type="text" name="codigo" id="codi"  size="15" maxlength="4" placeholder="Ejemplo: Cod" onKeyPress="return soloLetras2(event)" onKeyUp="">
											<div class="promts"><span id="nom_maqPromt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
										</div>
									-->
								</td>
							<!--		<td width="33%">
										<div  style="display: table;">
											<label>Número del Bien:</label><div style="display:inline-block;" id="xxx"></div>
											<input type="text" readonly="readonly" id="pre_nb" name="pre_nb" value="NB-" size="3" ></input>
											<input type="text" name="n_b" title="Introduzca el número del bien jajaja" id="NB" size="" maxlength="5" placeholder="0978656" onKeyPress="return solonum3(event)"  onKeyUp="validarN_B()" onBlur="validarN_B()" onchange="validarN_B()" >
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
									</td>-->
									<!--<td>
										<label>Nombre de la Máquina</label>
										<input type="text" name="maquina" id="nom_maq">
										<div class="promts"><span id="nom_maqPromt"></span></div><p style="display:inline-block; font-size: 30px; position:absolute; color:red;">*</p>
									
									</td>-->
								</tr>



							</table>
						</fieldset>

					</div>
					<div id="regis_tipo_div" style="display:none;     margin-left: 10%;      margin-bottom: 2%;">
						<form action="registrando_maq_nueva.php" method="post" id="reg_maquina" name="reg_maquina" onSubmit="return validarForm_TM()" enctype="multipart/form-data">
							<table width="100%">
								<tr>
									<td width="50%" align="center">
										<label>Código:</label>
										<div  style="display: table;">

											<input type="text" name="codigo" id="codeT"  size="15" maxlength="4" placeholder="Ejemplo: To" onKeyPress="return soloLetras2(event)" style="text-transform: capitalize;" onKeyUp="validarCodigoT(); validarCodigoTipoM();">
											<div class="promts "> <span id="codeTPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
											<input type="hidden" id="vali_codeT">

										</div>
									</td>
									<td width="50%">
										<label>Nombre de la Máquina</label>
										<input type="text" name="nombre" id="nombreT"  size="15" maxlength="15" placeholder="Ejemplo: Fresadora" onKeyPress="return soloLetras(event)" style="text-transform: capitalize;" onKeyUp="validarNombreT()">
										<div class="promts " style="margin-left:1%;"> <span id="nombreTPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
									</td>
								</tr>
								<tr>
										<td colspan="2" align="center">
											<h3><div id="tipo_maqE"></div></h3>
										</td>
									</tr>
									    <tr>
             <td colspan="2" align="right">
              <div border="1"><span style="margin-right:5%; width:20%; color:red; border:1px solid #ccc; border-radius: 4px;   background-color: #fff; padding: 6px 12px; font-size: 14px;">* Campos Requeridos</span></div>
            </td>
          </tr>   
								<tr>
												<td colspan="2" align="center">


													<div style="margin-left:-10%;">
													<br>

													<input class="btn btn-primary" type="submit" value="Aceptar" title="Aceptar" > 
													<input class="btn btn-danger" type="reset" value="Limpiar" title="Limpiar">
													<br><br>
												</div>
												</td>
											</tr>

							</table>
							<br>

						</div> 
					</form>
					<br>
				</div>
				    <!-- eliminar modal-->
                  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="elim_maqT" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header" id="confirm">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar">&times;</button>
                          <h4 class="modal-title">Eliminar Tipo de Máquina</h4>
                        </div>
                        <div class="modal-body">

                          <h4>¿Usted esta seguro que desea eliminar este tipo de máquina?</h4>                            

                        </div>
                        <div class="modal-footer">

                          <input type="hidden" id="aceptar_elim_maquinaT">

                          <button class="btn btn-primary" title="Aceptar" onclick="eliminar_MaquinaT()">Aceptar</button>
                          <button class="btn btn-danger" data-dismiss="modal" title="Cancelar">Cancelar</button>

                        </fieldset>


                      </div>
                    </div>
                  </div>
                </div>
				'
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
											<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="12" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
											<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
										</td>
										<td>
											<label>Modelo:</label>
											<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="12" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
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
													<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="12" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
													<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
												</td>
												<td>
													<label>Modelo:</label>
													<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="12" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
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
															<input type="text" name="marca" title="Introduzca la marca de la maquina" id="marca" size="" maxlength="12" placeholder="C.M.E" onKeyUp="validarMarca()" onkeyPress='return soloAlfa(event);'>
															<div class="promts "><span id="marcaPrompt"></span></div><p style="display:inline-block; font-size:30px; position:absolute; color:red;">*</p>
														</td>
														<td>
															<label>Modelo:</label>
															<input type="text" name="modelo" title="Introduzca el modelo de la maquina" id="modelo" size="" maxlength="12" placeholder="FU-2" onKeyUp="validarModelo()" onkeyPress='return soloAlfa(event);'>
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