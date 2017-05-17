<?php
	require('conexion.php');

	$id=$_POST['id'];

	$sql="SELECT * FROM proyectos WHERE id_proyecto='$id'";
	$query=pg_query($sql);
    $array=pg_fetch_assoc($query);

?>
                          <div class="panel panel-default">
                          <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#pa1" data-toggle="tab"><h4>Datos 1</h4></a></li>
                              <li><a href="#pa2" data-toggle="tab"><h4>Datos 2</h4></a></li>
                              <li><a href="#pa3" data-toggle="tab"><h4>Datos 3</h4></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="pa1">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">
                                        <h3 align="center"><?php echo $array['estado_proyecto']; ?></h3>
                                      
                                    <!-- /.panel-heading -->
                                    <!--div class="panel-body"-->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Título</th>
                                                        <th>Código</th>
                                                        <th>Regimen</th>
                                                        <th>Estado</th>
                                                        <th>Municipio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['titulo']; ?></td>
                                                        <td align="center"><?php echo $array['codigo']; ?></td>
                                                        <td align="center"><?php echo $array['regimen']; ?></td>
                                                        <td align="center"><?php echo $array['estado']; ?></td>
                                                        <td align="center"><?php echo $array['municipio']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    <!--/div-->
                                    <!-- /.panel-body -->

                                    <!-- /.panel-heading -->
                                    <!--div class="panel-body"-->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Parroquia</th>
                                                        <th>Sector</th>
                                                        <th>PNF</th>
                                                        <th>Trayecto</th>
                                                        <th>Sección</th>
                                                        <th>Periodo Academico</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['parroquia']; ?></td>
                                                        <td align="center"><?php echo $array['sector']; ?></td>
                                                        <td align="center"><?php echo $array['pnf']; ?></td>
                                                        <td align="center"><?php echo $array['trayecto']; ?></td>
                                                        <td align="center"><?php echo $array['seccion']; ?></td>
                                                        <td align="center"><?php echo $array['periodo']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    <!--/div-->
                                    <!-- /.panel-body -->

                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->
        
                              <div class="tab-pane fade" id="pa2">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">

                                    <!--div class="panel-body"-->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>C.I</th>
                                                        <th>Integrante</th>
                                                        <th>Teléfono</th>
                                                        <th>Correo</th>
                                                        <th>Especialidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $con=pg_query("SELECT * FROM estudiantes WHERE codpro='$id' AND estatus=1");
                                                    
                                                    while($result=pg_fetch_assoc($con))
                                                    {
                                                        $nom=explode(' ', $result['nombres']);
                                                        $ape=explode(' ', $result['apellidos']);
                                                        $nombre=$nom[0].' '.$ape[0];
                                                ?>    
                                                    <tr>
                                                        <td align="center"><?php echo $result['ci']; ?></td>
                                                        <td align="center"><?php echo $nombre; ?></td>
                                                        <td align="center"><?php echo $result['telefono']; ?></td>
                                                        <td align="center"><?php echo $result['correo']; ?></td>
                                                        <td align="center"><?php echo $result['especialidad']; ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>

                                                </tbody>
                                            </table>

                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>En que consiste:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['descripcion']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    <!--/div-->

                                    <!-- /.panel-body -->
                                    </div>
                                  </div>
                                  <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                              </div>
                              <!-- /.panel -->

                              <div class="tab-pane fade" id="pa3">
                                <div class="panel panel-default">
                                  <div class="panel-body">
                                    <div class="table-responsive">

                                    <!-- /.panel-heading -->
                                    <!--div class="panel-body"-->
                                        <div class="table-responsive">

                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Que aportes ofrece a la Comunidad y a cuantos beneficia:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['aportes']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Integración con la Comunidad a traves de:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['integracion']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Relación con el Plan Nacional Vigente:</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td align="center"><?php echo $array['plan_nacional']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    <!--/div-->
                                    <!-- /.panel-body -->
        

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
                          