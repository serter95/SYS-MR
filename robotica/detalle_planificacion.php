<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id'];

	$sql="SELECT * FROM planificacion_semanal WHERE id_planif='$id'";
	$query=pg_query($sql);
    $array=pg_fetch_assoc($query);

    $fecha=explode('-', $array['fecha']);
    $fecha_planif=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    $con=pg_query("SELECT * FROM personal WHERE id='".$array['id_personal']."'");
    $result=pg_fetch_assoc($con);

    $nom=explode(' ', $result['nombres']);
    $ape=explode(' ', $result['apellidos']);
    $nombre=$nom[0].' '.$ape[0];

?>
    <div class="panel panel-default">
        <div class="panel-heading">
          Datos:
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo $array['actividad']; ?></td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>C.I</th>
                            <th>Encargado</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center"><?php echo $fecha_planif; ?></td>
                            <td align="center"><?php echo $result['ci']; ?></td>
                            <td align="center"><?php echo $nombre; ?></td>
                            <td align="center"><?php echo $array['estado']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->