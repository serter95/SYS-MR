<?php
require ('seguridad.php');
require ('conexion.php');

  $id=$_REQUEST['id'];
  
  $sql="SELECT * FROM prestamo WHERE id_herramienta='".$id."' AND estatus=1 AND estado_prestamo='Activo'";
  $query=pg_query($sql);
  $num=pg_num_rows($query);
  while($array=pg_fetch_assoc($query)){
    //$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
     //$encontrado=$encontrado."<option value='".$fila['id_insumos']."'>".$fila['nombre']."</option>";
    //$contando_seg+=$array["seguimiento"];
    //$fecha=$array['realizado'];
    $f=explode("-", $array['realizado']);
    $fecha=$f[2]."/".$f[1]."/".$f[0];

      $sql2="SELECT * FROM personal WHERE id='".$array['id_personal']."'";
      $query2=pg_query($sql2);
      $array2=pg_fetch_assoc($query2);
      $nombre=$array2["nombres"]." ".$array2["apellidos"];

  ?>

    <tr class="odd gradeX">
                              <td align="center"><?php echo  $contando+=1;?></td>
                               <td align="center"><?php echo $nombre; ?></td>
                              <td align="center"><?php echo $array['responsable'];?></td>
                              <td align="center"><?php echo $fecha; ?></td>
                          

                              <td align="center">
                               <?php  if($array['seguimiento']!='100'){ ?>

                                <a href="javascript:Devoluciones(<?php echo $array['id_prestamo'];?>);">

                                           <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                                  </button>
                                </a>

                               
                                 <?php }else{
                                  echo "Concluido";
                                 } ?>
                              </td>
                            
                            </tr>
                          <?php
                      
              }
                  
          /* if ($num!=0)
        {     
          $num=$num*100;
          if($num==$contando_seg){
              $sql="UPDATE convenios SET estado='concluido' WHERE id_convenio='".$id."' AND estatus=1";
              pg_query($sql);
          ?>
          <script type="text/javascript">
             $('#convenio_concluido').modal({
                                show:true,
                                backdrop:'static'
                            });
             $('#agregar_clau').hide();
          </script>
          <?php

          }
        }*/
    #array("modelo"=>$modelo);

?>

