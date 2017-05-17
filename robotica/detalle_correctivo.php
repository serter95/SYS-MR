<?php
	require('seguridad.php');
	require('conexion.php');

	$id=$_POST['id_maq'];

    $sql="SELECT * FROM maquinas m, numero_bien n WHERE m.id_maquina=".$id." AND m.n_b=n.id_nb LIMIT 1";
	$query=pg_query($sql);

    $id=$_POST['id'];

    $sql2="SELECT * FROM mant_correctivo p, personal s WHERE id_correctivo=".$id." AND p.id_personal=s.id AND p.estatus=1 ORDER BY fecha_falla DESC LIMIT 1";
    $query2=pg_query($sql2);
    $selector=pg_fetch_assoc($query2)
?>

	<div class="panel panel-default">
              <ul class="nav nav-tabs">
                                <li class="active"><a href="#tabmaquina" data-toggle="tab">Maquina</a></li>
                                <li><a href="#tabpreventivo" data-toggle="tab">Correctivo I</a></li>
    <?php if($selector["estado"]!='en proceso'){ ?>  <li><a href="#tabpreventivo2" data-toggle="tab">Correctivo II</a></li> <?php } ?>

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
                            <th>Supervisor</th>
                            <th colspan="2">Fecha de la Solicitud</th>
                            
                        </tr>

                    </thead>
                    <tbody>
<?php


    $id=$_POST['id'];

    $sql2="SELECT * FROM mant_correctivo p, personal s WHERE id_correctivo=".$id." AND p.id_personal=s.id AND p.estatus=1 ORDER BY fecha_falla DESC LIMIT 1";
    $query2=pg_query($sql2);

    while ($arrays=pg_fetch_assoc($query2))
    {
        if($arrays['tipo_servicio']=='interno'){
          $fecha_r=explode('-', $arrays['fecha_falla']);
                            $anor=$fecha_r[0];
                            $mesr=$fecha_r[1].'/';
                            $diar=$fecha_r[2].'/';
                            $fechar=$diar.$mesr.$anor;

                            $nombre_per=explode(' ', $arrays['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $arrays['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
        $fecha_s=explode('-', $arrays['fecha']);
                            $anos=$fecha_s[0];
                            $mess=$fecha_s[1].'/';
                            $dias=$fecha_s[2].'/';
                            $fechas=$dias.$mess.$anos;

                             $fecha2=explode('-', $arrays['fecha_ejecucion']);
                             $fecha2= $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
?>
                        <tr>
                            <td align="center"><?php echo $encargado_mant; ?></td>
                            <td align="center" colspan="2"><?php echo $fechas; ?></td>
                        </tr>
                        <tr>
                            <th>Tipo de Servicio</th>
                            <th colspan="2">Responsable</th>
                          
                            
                        </tr>
                        <tr>
                   
                            <td align="center"><?php echo $arrays['tipo_servicio']; ?></td>
                            <td align="center" colspan="2"><?php echo $arrays['responsable']; ?></td>
                                       
                        </tr>
                              
                        </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
</div>
<div class="tab-pane fade" id="tabpreventivo2">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    
                    <th>Fecha de la Falla</th>
                    <th>Hora de la Falla</th>
                     <th>Fecha de la Ejecución</th>

                    </thead>             
                    <tbody>
                     <tr>

                    <td align="center"><?php if($arrays['fecha_falla']==""){echo "No";}else{ echo $fechar; }?></td>
                    <td align="center"><?php echo $arrays['hora_falla']; ?></td>
                    <td align="center"><?php echo $fecha2; ?></td>

                    </tr>  
                    
                       
                         <tr>
                            <th colspan="2">Hora del Arranque</th>
                            <th>Horas Hombre</th>
                            
                            
                            
                        </tr>
                        <tr>
                            
                            <td align="center" colspan="2"><?php echo $arrays['horas_arranque'];?></td>
                            <td align="center"><?php echo $arrays['horas_hombre']; ?></td>
                                
                        </tr>
                         <tr>
                            <th colspan="3">Costo</th>
                        </tr>
                         <tr>
                            <td align="center"  colspan="3"><?php  echo $arrays['costo']; ?></td> 
                        </tr>
                            <tr>
                            <th colspan="3">Observaciones</th>
                        </tr>
                         <tr>
                           <td align="center"  colspan="3"><?php echo $arrays['observaciones']; ?></td>
                        </tr>
                       

                    
<?php
     }
     else if($arrays['tipo_servicio']=='externo') {

$fecha_r=explode('-', $arrays['fecha_falla']);
                            $anor=$fecha_r[0];
                            $mesr=$fecha_r[1].'/';
                            $diar=$fecha_r[2].'/';
                            $fechar=$diar.$mesr.$anor;

                            $nombre_per=explode(' ', $arrays['nombres']); 
                            $pri_nom=$nombre_per[0];

                            $apellido_per=explode(' ', $arrays['apellidos']);
                            $prim_ape=$apellido_per[0];

                            $encargado_mant=$pri_nom.' '.$prim_ape;
         $fecha_s=explode('-', $arrays['fecha']);
                            $anos=$fecha_s[0];
                            $mess=$fecha_s[1].'/';
                            $dias=$fecha_s[2].'/';
                            $fechas=$dias.$mess.$anos;

                             $fecha2=explode('-', $arrays['fecha_ejecucion']);
                             $fecha2= $fecha2[2]."/".$fecha2[1]."/".$fecha2[0];
?>
                        <tr>
                            <td align="center"><?php echo $encargado_mant; ?></td>
                            <td align="center" colspan="2"><?php echo $fechas; ?></td>
                            
                        </tr>
                        <tr>
                            <th>Tipo de Servicio</th>
                            <th colspan="2">Responsable</th>
                          
                            
                        </tr>
                        <tr>
                             <td align="center"><?php echo $arrays['tipo_servicio']; ?></td>
                           
                          
                            <td align="center" colspan="2"><?php echo $arrays['responsable']; ?></td>
                                       
                        </tr>
                               <tr><th colspan="3" align="center">Proveedor</th></tr>
                          <tr>
                            <td colspan="3" align="center"><?php  echo $arrays['proveedor']; ?></td>
                        </tr>
                        
                        </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
</div>
<div class="tab-pane fade" id="tabpreventivo2">
                  <div class="panel panel-default">
                    <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>

                       
                         <tr>
                            <th>Fecha de la Falla</th>
                            <th>Hora de la Falla</th>
                            <th>Fecha de la Ejecución</th>
                            
                        </tr>
                        

                    </thead>
                    <tbody>
                    <tr>
                    <td align="center"><?php if($arrays['fecha_falla']==""){echo "No";}else{ echo $fechar; }?></td>
                    <td align="center"><?php echo $arrays['hora_falla']; ?></td>
                    <td align="center"><?php echo $fecha2; ?></td>
                   
                                       
                    </tr>
                     <tr>
                            <th colspan="3">Proveedor</th>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><?php  echo $arrays['proveedor']; ?></td>
                        </tr>
                        
                    <tr>
                            <th>Hora del Arranque</th>
                            <th>Horas Hombre</th>
                            <th>Costo</th>

                        </tr>
                     <tr>
                            <td align="center"><?php echo $arrays['horas_arranque'];?></td>
                            <td align="center"><?php echo $arrays['horas_hombre']; ?></td>
                            <td align="center"><?php  echo $arrays['costo']; ?></td>

                        </tr>
                    
                       
                    
<?php

     }

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