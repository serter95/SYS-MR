<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id_usu'];

	$sql="SELECT * FROM tipo_usuario INNER JOIN (usuario INNER JOIN personal ON usuario.id_personal = personal.id 
        AND id_usu='$id') ON tipo_usuario.id_tipo = usuario.id_tipo_usuario ";
	$query=pg_query($sql);

?>
	<div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre de usuario</th>
                            <th>Contraseña</th>
                            <th>Tipo</th>
                            <th>C.I</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
	while ($array=pg_fetch_assoc($query))
	{
        $num=strlen($array['contrasena']);
?>
	                    <tr>
                            <td align="center"><?php echo $array['nom_usuario']; ?></td>
                            <td align="center"><?php for($i=0;$i<$num;$i++){echo "*";} ?></td>
                            <td align="center"><?php echo $array['tipo']; ?></td>
                            <td align="center"><?php echo $array['ci']; ?></td>
                            <td align="center"><?php echo $array['nombres']; ?></td>
                            <td align="center"><?php echo $array['apellidos']; ?></td>
                        </tr>
<?php
	}
?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->