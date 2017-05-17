<?php
    require('seguridad.php');
    require('conexion.php');

    $id=$_POST['id_convenio'];
    $sql="SELECT * FROM convenios WHERE id_convenio=".$id." LIMIT 1";
    $query=pg_query($sql);

?>

    <div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabinsumos" data-toggle="tab">Detalle del Convenio</a></li>
                                <li><a href="#tabinsumos2" data-toggle="tab">Cláusulas</a></li>
                 

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

                    <th colspan="2" align="center">Titulo</th>

                    </thead>
                    <tbody>

                       
                    
<?php
    while ($array=pg_fetch_assoc($query))
    {
?>
                        <tr>
                            <td align="center" colspan="2"><?php echo $array['titulo']; ?></td>
                          
                           
                        </tr>
                         <tr>
                            
                            <th>Primer Ente Actuante</th>
                            <th>Segundo Ente Actuante</th>
                            
                        </tr>
                        <tr>
                          <td align="center"><?php echo $array['ente1']; ?></td>
                            <td align="center"><?php echo $array['ente2']; ?></td>
                        </tr>
                   

                        <tr>
                            <th>Primer Representante</th>
                            <th>Segundo Representante</th>                       

                        </tr>

                        <?php 

                        $fecha=explode('-', $array['fecha_inicio']);
                            $ano=$fecha[0];
                            $mes=$fecha[1].'/';
                            $dia=$fecha[2].'/';
                            $fechac=$dia.$mes.$ano;

$fecha2=explode('-', $array['fecha_final']);
                            $ano2=$fecha2[0];
                            $mes2=$fecha2[1].'/';
                            $dia2=$fecha2[2].'/';
                            $fechac2=$dia2.$mes2.$ano2;




                        ?>
                        <tr>
                            <td align="center"><?php echo $array['contratante']; ?></td>
                            <td align="center"><?php echo $array['contratado']; ?></td>
                            
                   
                        </tr>
                         <tr>
                              <th>Fecha de Inicio</th>
                            <th>Fecha Final</th>                       

                        </tr>

                        
                        <tr>
                            <td align="center"><?php echo $fechac; ?></td>
                            <td align="center"><?php echo $fechac2; ?></td>
                            
                   
                        </tr>
                        <tr>
                            <th colspan="2" align="center">Estado</th>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><?php echo ucwords($array['estado']); ?></td>
                        </tr>
                        <?php if ($array['estado']=="no concluido"){
                            ?>
                             <tr>
                            <th colspan="2" align="center">Razón</th>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><?php echo ucwords($array['razon']); ?></td>
                        </tr>

                            <?php
                        }
                            
                            ?>
                            
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
                            <th colspan="3">Cláusulas</th>
                         </tr>


                    </thead>
                    <tbody>
                    <tr>
                    <td>N°
                    </td>
                    <td>Contenido</td>
                    <td>Seguimiento</td>
                    </tbody>
<?php



    $sql2="SELECT * FROM clausulas WHERE id_convenio=".$id." AND estatus=1 ORDER BY id_clausula ASC";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {
        $contando+=1;
?>
 <?php $clausula=$arrays['contenido'];
       $clausula=nl2br($clausula);
       ?>
                        <tr>
                            <td width="40" align="center"><?php echo $contando; ?> </td>
                            <td align="center" >
                            <p style="text-align:justify;"><?php echo $clausula; ?> </p></td>
                            <td width="100" align="center" ><?php echo $arrays['seguimiento']." %"; ?></td> 

                        </tr>
                       
                        
                    
<?php
    }
?>
                  
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