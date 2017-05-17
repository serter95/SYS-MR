<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id_pre'];
    $id2=$_POST['id_herra'];
    $sql="SELECT * FROM herramientas h, numero_bien n WHERE h.id_herramienta=".$id2." AND h.n_b=n.id_nb LIMIT 1";
    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Herramienta</a></li>
                                <li><a href="#tabinsumos2" data-toggle="tab">Prestamo</a></li>
                 

                        </ul>
        <!--<div class="panel-heading">
          Datos:
        </div>-->
        <!-- /.panel-heading -->

              <div class="tab-content">

                 <div class="tab-pane fade in active" id="tabinsumos">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Número del Bien</th>
                            <th>Nombre</th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
    while ($array=pg_fetch_assoc($query))
    {
?>
                        <tr>
                            <td align="center"><?php echo $array['codigo_herramienta']; ?></td>
                            <td align="center"><?php echo $array['nb']; ?></td>
                            <td align="center"><?php echo $array['nombre']; ?></td>
                           
                        </tr>

                        <tr>
                              <th>Serial</th>
                            <th>Marca</th>
                            <th>Estado</th>
                          

                        </tr>

                        
                        <tr>
                            <td align="center"><?php echo $array['serial']; ?></td>
                            <td align="center"><?php echo $array['marca']; ?></td>
                            <td align="center"><?php echo $array['estado']; ?></td>
                   
                        </tr>
                             <tr><th colspan="3" align="center">Ubicación</th></tr>
                          <tr>
                            <td align="center" colspan="3"><?php echo $array['ubicacion']; ?></td>
                        </tr>
                          <tr>
                            <td colspan="3" align="center">
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

        <div class="tab-pane fade" id="tabinsumos2">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Estado del Prestamo</th>
                            <th>Encargado</th>
                            <th>Fecha del Prestamo</th>
                        </tr>


                    </thead>
                    <tbody>
<?php



    $sql2="SELECT * FROM prestamo p, personal s WHERE id_prestamo=".$id." AND p.id_personal=s.id LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {
$fecha=explode('-', $arrays['realizado']);
                            $ano=$fecha[0];
                            $mes=$fecha[1].'/';
                            $dia=$fecha[2].'/';
                            $fechac=$dia.$mes.$ano;

$fecha2=explode('-', $arrays['devolucion']);
                            $ano2=$fecha2[0];
                            $mes2=$fecha2[1].'/';
                            $dia2=$fecha2[2].'/';
                            $fechac2=$dia2.$mes2.$ano2;

                            $nombre_per=explode(' ', $arrays['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $arrays['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado=$pri_nom.' '.$prim_ape;
        
?>
                        <tr>
                            <td align="center"><?php echo $arrays['estado_prestamo']; ?></td>
                            <td align="center"><?php echo $encargado; ?></td>
                            <td align="center"><?php echo $fechac;?></td>


                        </tr>
                        <tr>
                            <th colspan="2">Responsable</th>
                            <th>Fecha de Devolucion</th>
                          
                            
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><?php echo $arrays['responsable']; ?></td>
                            <td align="center"><?php echo $fechac2;?></td>
                            
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