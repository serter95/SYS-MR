<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id'];
    $sql="SELECT * FROM graficas WHERE id_grafica='$id' LIMIT 1";


    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Gráfica</a></li>
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
                            <th>Fecha</th>
                            <th>Hora</th>
                            
                        </tr>
                    </thead>
                    <tbody>
<?php
    while ($array=pg_fetch_assoc($query))
    {
         $fecha=$array['fecha'];
    $f=explode('-', $fecha);
    $fecha=$f[2].'/'.$f[1].'/'.$f[0];
?>  

                        <tr>
                             <td align="center"><?php echo $fecha; ?></td>
                            <td align="center"><?php echo $array['hora']; ?></td>     
                            <tr><th>Total Operativas</th><th>Total Inoprativas</th></tr>
                            <tr><td align="center"><?php echo $array['operativo']; ?></td>
                                <td align="center"><?php echo $array['inoperativo']; ?></td>
                            </tr>
                            <tr>
                            <td colspan="2" align="center">
                               <img src="<?php echo $array['ubicacion'].'?xas='.rand(0,99999); ?>" alt="Sin imagen" width="700px" height="300px"></img></td>
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