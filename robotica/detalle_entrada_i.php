<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id'];
    $id2=$_POST['id2'];

    $sql="SELECT * FROM insumos i, numero_bien n WHERE i.id_insumos=".$id." AND i.n_b=n.id_nb LIMIT 1";
    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Insumos I</a></li>
                                <li><a href="#tabinsumos2" data-toggle="tab">Insumos II</a></li>
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
                            <td align="center"><?php echo $array['codigo_insumo']; ?></td>
                            <td align="center"><?php echo $array['nb']; ?></td>
                            <td align="center"><?php echo $array['nombre']; ?></td>
                           
                        </tr>

                        <tr>
                            <th>Tipo Medida</th>
                            <th colspan="2">Medida</th>
                          

                        <tr>

                        
                        <tr>
                            <td align="center"><?php echo $array['tipo_medida']; ?></td>
                            <td align="center" colspan="2"><?php echo $array['medida']; ?></td>
                   
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
                            <th>Precio Unit.</th>
                            <th>Existencia</th>
                            <th>Buenas</th>
                            <th>Dañadas</th>                            
                        </tr>

                    </thead>
                    <tbody>
<?php



    $sql2="SELECT * FROM insumos WHERE id_insumos=".$id." LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {

        
?>
                        <tr>
                            <td align="center"><?php echo $arrays['precio_unitario']; ?></td>
                            <td align="center"><?php echo $arrays['existencia']; ?></td>
                            <td align="center"><?php echo $arrays['buenas']; ?></td>
                            <td align="center"><?php echo $arrays['danadas']; ?></td>


                        </tr>
                        <tr>
                            <th>Min. Stock</th>
                            <th>Max. Stock</th>
                            <th>Recambio</th>
                            <th>Importe</th>
                            
                        </tr>
                        <tr>
                            <td align="center"><?php echo $arrays['min_stock']; ?></td>
                            <td align="center"><?php echo $arrays['max_stock'];?></td>
                            <td align="center"><?php echo $arrays['recambio'];?></td>
                            <td align="center"><?php echo $arrays['importe']; ?></td>

                        </tr>
                               <tr><th colspan="4" align="center">Ubicación</th></tr>
                          <tr>
                            <td align="center" colspan="4"><?php echo $arrays['ubicacion']; ?></td>
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

        $f=explode(' ', $arraye['realizado']);

        $fe=explode('-', $f[0]);
        $fecha=$fe[2]."/".$fe[1]."/".$fe[0]." ".$f[1]." ".$f[2];
?>
                        <tr>
                            <td align="center"><?php echo $arraye['cantidad']; ?></td>
                            <td align="center"><?php echo $arraye['responsable']; ?></td>
                            
                        </tr>
                               <tr><th colspan="2" align="center">Realizado</th></tr>
                          <tr>
                            <td align="center" colspan="2"><?php echo $fecha; ?></td>
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