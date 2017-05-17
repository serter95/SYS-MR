<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id'];
    $id2=$_POST['id2'];
$sql="SELECT * FROM herramientas h, numero_bien n WHERE h.id_herramienta=".$id." AND h.n_b=n.id_nb LIMIT 1";

    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Herramientas I</a></li>
                                <li><a href="#tabinsumos2" data-toggle="tab">Herramientas II</a></li>
                                <li><a href="#tabentrada" data-toggle="tab">Entrada</a></li>


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
                            <th>Número del Bien Viejo</th>
                            <th>Número del Bien Nuevo</th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
    while ($array=pg_fetch_assoc($query))
    {
?>
                        <tr>
                            <td align="center"><?php echo $array['codigo_herramienta']; ?></td>
                            <td align="center"><?php echo $array['n_bv']; ?></td>
                            <td align="center"><?php echo $array['nb']; ?></td>
                           
                        </tr>

                        <tr>
                            <th>Nombre</th>
                            <th>Serial</th>
                            <th>Marca</th>

                        <tr>

                        
                        <tr>
                            <td align="center"><?php echo $array['nombre']; ?></td>
                            <td align="center"><?php echo $array['serial']; ?></td>
                            <td align="center"><?php echo $array['marca']; ?></td>
                   
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
                            <th>Estado</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                                                     
                        </tr>

                    </thead>
                    <tbody>
<?php



    $sql2="SELECT * FROM herramientas WHERE id_herramienta=".$id." LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {

        
?>
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
        </div>
    </div>
</div>
        
        <!-- /.panel-body -->

 <div class="tab-pane fade" id="tabentrada">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Responsable</th>
                                                   
                        </tr>

                    </thead>
                    <tbody>
<?php



    $sqle="SELECT * FROM entrada WHERE id_entrada=".$id2." LIMIT 1";
    $querye=pg_query($sqle);

    while ($arraye=pg_fetch_assoc($querye))
    {

        
?>
                        <tr>
                            <td align="center"><?php echo $arraye['cantidad']; ?></td>
                            <td align="center"><?php echo $arraye['responsable']; ?></td>
                            
                        </tr>
                               <tr><th colspan="2" align="center">Realizado</th></tr>
                          <tr>
                            <td align="center" colspan="2"><?php echo $arraye['realizado']; ?></td>
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