<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];

	$sql="SELECT * FROM personal WHERE id=".$id." LIMIT 1";
	$query=pg_query($sql);


	while ($array=pg_fetch_assoc($query))
	{
?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#datos1" data-toggle="tab">Datos 1</a></li>
                                <li><a href="#datos2" data-toggle="tab">Datos 2</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="datos1">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">

                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>C.I</th>
                                                            <th>Nombres</th>
                                                            <th>Apellidos</th>
                                                            <th>Sexo</th>
                                                            <th>Grado de instrucción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td align="center"><?php echo $array['ci']; ?></td>
                                                            <td align="center"><?php echo $array['nombres']; ?></td>
                                                            <td align="center"><?php echo $array['apellidos']; ?></td>
                                                            <td align="center"><?php echo $array['sexo']; ?></td>
                                                            <td align="center"><?php echo $array['grado_instruccion']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            
                                            </div>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                                <div class="tab-pane fade" id="datos2">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Especialidad</th>
                                                            <th>Cargo</th>
                                                            <th>Correo Electrónico</th>
                                                            <th>Numero de Contacto</th>
                                                            <th>Fecha de Nacimiento</th>
                                                            <th>Dedicación</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td align="center"><?php echo $array['especialidad']; ?></td>
                                                            <td align="center"><?php echo $array['cargo']; ?></td>
                                                            <td align="center"><?php echo $array['correo']; ?></td>
                                                            <td align="center"><?php echo $array['numero_contacto']; ?></td>
                                                            <?php
                                                                $fecha=explode('-', $array['fecha_nacimiento']);
                                                                $fecha_nac=$fecha[2]."/".$fecha[1]."/".$fecha[0];
                                                            ?>
                                                            <td align="center"><?php echo $fecha_nac;?></td>
                                                            <td align="center"><?php echo $array['dedicacion'];?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
<?php
	}
?>