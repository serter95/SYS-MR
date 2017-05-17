<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id_maq'];

	$sql="SELECT * FROM maquinas m, numero_bien n WHERE m.id_maquina=".$id." AND m.n_b=n.id_nb LIMIT 1";
	$query=pg_query($sql);

?>

	<div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabmaquina" data-toggle="tab">Maquina</a></li>
                                <li><a href="#tabpreventivo" data-toggle="tab">Preventivo</a></li>
                 

                        </ul>
        <!--<div class="panel-heading">
  	      Datos:
        </div>-->
        <!-- /.panel-heading -->

              <div class="tab-content">

                 <div class="tab-pane fade in active" id="tabmaquina">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Número del Bien</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Maquina</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
	while ($array=pg_fetch_assoc($query))
	{
?>
	                    <tr>
                            <td align="center"><?php echo $array['codigo']; ?></td>
                            <td align="center"><?php echo $array['nb']; ?></td>
                            <td align="center"><?php echo $array['marca']; ?></td>
                            <td align="center"><?php echo $array['modelo']; ?></td>
                            <td align="center"><?php echo $array['maquina']; ?></td>
                            <td align="center"><?php echo $array['estado']; ?></td>
                        </tr>

                        
                        <tr>
                            <td colspan="6" align="center">
                               <a class="fancybox" href="<?php echo $array['imagen']; ?>" data-fancybox-group="gallery"><img src="<?php echo $array['imagen']; ?>" alt="Sin imagen" width="100px" height="100px"></img></a></td>
                        </tr>

<?php
	}
?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
</div>


        <!-- /.panel-body -->

        <div class="tab-pane fade" id="tabpreventivo">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Encargado</th>
                            <th>Ultm. Revisión</th>
                            <th>Nivel de Aceite</th>
                            
                        </tr>

                    </thead>
                    <tbody>
<?php




    $sql2="SELECT * FROM mant_preventivo p , personal s WHERE maquina_id=".$id." AND p.id_personal=s.id AND p.estatus=1 AND s.estatus=1 AND p.estado<>'en proceso' ORDER BY p.fecha_ejecucion DESC LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {

          $fecha_r=explode('-', $arrays['fecha_ejecucion']);
                            $anor=$fecha_r[0];
                            $mesr=$fecha_r[1].'/';
                            $diar=$fecha_r[2].'/';

                            $fechar=$diar.$mesr.$anor;

        $fechanext=explode('-', $arrays['fecha_siguiente']);
        $fechanext = $fechanext[2]."/".$fechanext[1]."/".$fechanext[0];

                            $nombre_per=explode(' ', $arrays['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $arrays['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
?>
                        <tr>
                            <td align="center"><?php echo $encargado_mant; ?></td>
                            <td align="center"><?php if($arrays['fecha']==""){echo "No";}else{ echo $fechar; }?></td>
                            <td align="center"><?php echo $arrays['nivel_aceite']; ?></td>
                                       
                        </tr>
                        <tr>
                            <th>Luces de tablero</th>
                            <th>Parada de Emergencia</th>
                            <th>Pulsadores</th>
                            
                        </tr>
                        <tr>
                            <td align="center"><?php echo $arrays['luces_tablero']; ?></td>
                            <td align="center"><?php echo $arrays['parada_emergencia'];?></td>
                            <td align="center"><?php echo $arrays['pulsadores']; ?></td>
                                       
                        </tr>
                               <tr>
                               <th colspan="2" align="center">Obsevaciones</th>
                               <th>Fecha del proximo Mantenimiento</th>
                               </tr>
                               

                          <tr>
                            <td colspan="2" align="center"><?php  echo $arrays['observaciones']; ?></td>
                             <td align="center"><?php echo $fechanext; ?></td>

                        </tr>
                        
                    
<?php
    }
?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
</div>
        <!-- /.panel-body -->
    </div>
    </div>


   
    <!-- /.panel -->