<?php
	require('seguridad.php');
	require('conexion.php');

	$id_personal=$_POST['id_personal'];
    $id_periodo=$_POST['id_periodo'];

	$query=pg_query("SELECT * FROM personal WHERE id='$id_personal' AND area='Robotica' AND estatus=1");

    $con=pg_query("SELECT * FROM periodo WHERE id_periodo='$id_periodo'");
    $conx=pg_fetch_assoc($con);

?>
	<div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre y Apellido</th>
                            <th>C.I</th>
                            <th>Periodo</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
	while ($array=pg_fetch_assoc($query))
	{
        $nom=explode(' ', $array['nombres']);
        $ape=explode(' ', $array['apellidos']);
        $nomApe=$nom[0].' '.$ape[0];

?>
	                    <tr>
                            <td align="center"><?php echo $nomApe; ?></td>
                            <td align="center"><?php echo $array['ci']; ?></td>
                            <td align="center"><?php echo $conx['tipo']; ?></td>
                            <td align="center"><?php echo $array['cargo']; ?></td>
                        </tr>
<?php
    }
?>
                    
                        <tr>
                          <td colspan="4">
                            <table cellpadding="50px" cellspacing="50px" border="2" width="100%">
                              <tr>
                                <th width="16%" class="tit">Hora</th>
                                <th width="16%" class="tit">Lunes</th>
                                <th width="16%" class="tit">Martes</th>
                                <th width="16%" class="tit">Miercoles</th>
                                <th width="16%" class="tit">Jueves</th>
                                <th width="16%" class="tit">Viernes</th>
                              </tr>

<?php
    $query=pg_query("SELECT * FROM horas h, disponibilidad_persona d WHERE h.id_horas=d.id_horas AND 
        d.id_personal='$id_personal' AND d.id_periodo='$id_periodo' AND h.taller=2 AND d.taller=2 AND
        d.estatus=1 AND h.estatus=1 ORDER BY h.numero_bloque ASC");
    $num=pg_num_rows($query);
    
    while($array2=pg_fetch_assoc($query))
    {
      $en=explode(' ', $array2['entrada']);
      $sa=explode(' ', $array2['salida']);

      $entrada[]=$en[0];
      $salida[]=$sa[0];
      $lunes[]=$array2['lunes'];
      $martes[]=$array2['martes'];
      $miercoles[]=$array2['miercoles'];
      $jueves[]=$array2['jueves'];
      $viernes[]=$array2['viernes'];
    }
    for ($i=1; $i <=$num ; $i++)
    { 
      $j=$i-1;

      if ($i==7)
      {
 ?>
  <tr>
    <td align="center" colspan="6">
      <b>Hora de Almuerzo</b>
    </td>
  </tr>
  <?php
      }
  ?>
  <tr>
    <td align="center"><b><?php echo $entrada[$j].' a '.$salida[$j];?></b></td>
    <td align="center"><button id="lunes_<?php echo $i; ?>_D" value="<?php echo $lunes[$j]; ?>" class="boton_horas"></button></td>

    <td align="center"><button id="martes_<?php echo $i; ?>_D" value="<?php echo $martes[$j]; ?>" class="boton_horas"></button></td>

    <td align="center"><button id="miercoles_<?php echo $i; ?>_D" value="<?php echo $miercoles[$j]; ?>" class="boton_horas"></button></td>

    <td align="center"><button id="jueves_<?php echo $i; ?>_D" value="<?php echo $jueves[$j]; ?>" class="boton_horas"></button></td>

    <td align="center"><button id="viernes_<?php echo $i; ?>_D" value="<?php echo $viernes[$j]; ?>" class="boton_horas"></button></td>
  </tr>
  <?php
    }
  ?>
</table>
</td>
</tr>
                   
                   </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel --> 

<script type="text/javascript">

function detalleDeDisp (datos)
{
    for (var i = 1; i <= datos; i++)
    {
        var j=i-1;

        var lunes=document.getElementById('lunes_'+i+'_D').value;
        var martes=document.getElementById('martes_'+i+'_D').value;
        var miercoles=document.getElementById('miercoles_'+i+'_D').value;
        var jueves=document.getElementById('jueves_'+i+'_D').value;
        var viernes=document.getElementById('viernes_'+i+'_D').value;

        //alert("Lunes_"+i+"_D ="+lunes);

        // LUNES 
        if (lunes==1)
        { 
            $('#lunes_'+i+'_D').removeClass("boton_horas").addClass("seleccionado");
            //alert("lunes_"+i+"= "+datos[5][j]+" SELECCIONADO");
        }
        else
        { 
            $('#lunes_'+i+'_D').removeClass("seleccionado").addClass("boton_horas");
            //alert("lunes_"+i+"= "+datos[5][j]+" NO SELECCIONADO"); 
        }
        
        // MARTES
        if (martes==1) 
        { 
            $('#martes_'+i+'_D').removeClass("boton_horas").addClass("seleccionado"); 
        }
        else 
        { 
            $('#martes_'+i+'_D').removeClass("seleccionado").addClass("boton_horas"); 
        }

        // MIERCOLES
        if (miercoles==1) 
        { 
            $('#miercoles_'+i+'_D').removeClass("boton_horas").addClass("seleccionado"); 
        }
        else 
        { 
            $('#miercoles_'+i+'_D').removeClass("seleccionado").addClass("boton_horas"); 
        }

        // JUEVES
        if (jueves==1) 
        { 
            $('#jueves_'+i+'_D').removeClass("boton_horas").addClass("seleccionado"); 
        }
        else 
        { 
            $('#jueves_'+i+'_D').removeClass("seleccionado").addClass("boton_horas"); 
        }
        
        // VIERNES
        if (viernes==1) 
        { 
            $('#viernes_'+i+'_D').removeClass("boton_horas").addClass("seleccionado"); 
        }
        else 
        { 
            $('#viernes_'+i+'_D').removeClass("seleccionado").addClass("boton_horas"); 
        }
    };
} 

detalleDeDisp(<?php echo $num; ?>)

</script>