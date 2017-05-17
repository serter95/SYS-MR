<?php
require ('seguridad.php');
require ('conexion.php');

  
  $sql="SELECT * FROM graficas";
  $query=pg_query($sql);
  while($array=pg_fetch_assoc($query)){
    //$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
     //$encontrado=$encontrado."<option value='".$fila['id_insumos']."'>".$fila['nombre']."</option>";
  //  $contando_seg+=$array["seguimiento"];

    $fecha=$array['fecha'];
    $f=explode('-', $fecha);
    $fecha=$f[2].'/'.$f[1].'/'.$f[0];
  ?>

    <tr class="odd gradeX">
                              <td align="center"><?php echo $fecha;?></td>
                              <td align="center"><?php echo $array['hora']; ?></td>
                          

                              <td align="center">

                                <a href="javascript:muestraGrafica(<?php echo $array['id_grafica'];?>);">

                                  <button class="btn btn-default" title="Ver" id="Detalle">
                                    <span class="fa fa-search-plus"></span>
                                  </button>
                                </a>

                                <a href="javascript:eliminarGrafica(<?php echo $array['id_grafica'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                               
                                 
                              </td>
                            
                            </tr>
                          <?php
                      
              }
        
    #array("modelo"=>$modelo);

?>

