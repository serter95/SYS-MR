<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id'];
    $sql="SELECT * FROM herramientas h, numero_bien n WHERE h.id_herramienta=".$id." AND h.n_b=n.id_nb LIMIT 1";


    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Herramientas I</a></li>
                                <!--<li><a href="#tabinsumos2" data-toggle="tab">Herramientas II</a></li>-->
                 

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
                            <th>Número del Bien</th>
                            <th colspan="2">Nombre</th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
    while ($array=pg_fetch_assoc($query))
    {
        $cantidad_actual=(int)$array["cantidad"]-(int)$array["cantidad_p"];
?>
                        <tr>
                            <td align="center"><?php echo $array['nb']; ?></td>
                            <td align="center" colspan="2"><?php echo $array['nombre']; ?></td>
                           
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
                        <tr>
                        <th>Estante</th>
                         <th>Tipo de Medida</th>
                            <th>Tamaño de la Medida</th>
                            

                      
                        </tr>
                        <tr>
                            <td align="center"><?php echo $array['estante']; ?></td>
                            <td align="center"><?php echo $array['tipo_medida']; ?></td>
                            <td align="center"><?php echo $array['medida']; ?></td>
                        </tr>
                        <tr>
                            <th>Cantidad en Almacén</th>
                            <th>Cantidad en prestamo</th>
                            <th>Cantidad Total</th>
                        </tr>
                        <tr>
                            <td align="center"><?php echo $cantidad_actual; ?></td>
                            <td align="center"><?php echo $array['cantidad_p']; ?></td>
                            <td align="center"><?php echo $array['cantidad']; ?></td>
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
<!--
        <div class="tab-pane fade" id="tabinsumos2">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                                                     
                        </tr>

                    </thead>
                    <tbody> -->
<?php

/*

    $sql2="SELECT * FROM herramientas WHERE id_herramienta=".$id." LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {

        
?>
<!--
                        <tr>
                            <td align="center"><?php echo $arrays['estado']; ?></td>
                            <td align="center"><?php echo $arrays['precio_unitario']; ?></td>
                            <td align="center"><?php echo $arrays['existencia']; ?></td>


                        </tr>
                        <tr>
                            <th>Min. Stock</th>
                            <th colspan="2">Recambio</th>
                            
                        </tr>
                        <tr>
                            <td align="center"><?php echo $arrays['min_stock']; ?></td>
                            <td align="center" colspan="2"><?php echo $arrays['recambio'];?></td>

                        </tr>
                               <tr><th colspan="3" align="center">Ubicación</th></tr>
                          <tr>
                            <td align="center" colspan="3"><?php echo $arrays['ubicacion']; ?></td>
                        </tr>
                        
                    
<?php
    }
?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
   <!--     </div>
    </div>
</div>
-->
<?php
*/
?>
        <!-- /.panel-body -->
    </div>
    </div>


   
    <!-- /.panel -->