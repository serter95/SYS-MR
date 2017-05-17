<?php
require ('seguridad.php');
require ('conexion.php');

  $id=$_REQUEST['id'];
  
  $sql="SELECT * FROM clausulas WHERE id_convenio='".$id."' AND estatus=1 ORDER BY id_clausula ASC";
  $query=pg_query($sql);
  $num=pg_num_rows($query);
  while($array=pg_fetch_assoc($query)){
    //$insumo2=$insumo2."<tr><td>".$encontrado2["_insumo"]."</td><td>".$encontrado2["nb"]."</td><td>".$encontrado2["nombre"]."</td></tr>";
     //$encontrado=$encontrado."<option value='".$fila['id_insumos']."'>".$fila['nombre']."</option>";
    $contando_seg+=$array["seguimiento"];

  ?>

    <tr class="odd gradeX">
                              <td align="center"><?php echo  $contando+=1;?></td>
                              <td align="center"><?php echo $array['contenido'];?></td>
                              <td align="center"><?php echo $array['seguimiento']." %"; ?></td>
                          

                              <td align="center">
                               <?php  if($array['seguimiento']!='100'){ ?>

                                <a href="javascript:editar_clausula(<?php echo $array['id_clausula'];?>);">

                                  <button class="btn btn-default" title="Modificar" id="Modificar">
                                    <span class="fa fa-edit"></span>
                                  </button>
                                </a>

                                <a href="javascript:eliminarClausula(<?php echo $array['id_clausula'];?>);">
                                  <button class="btn btn-default" title="Eliminar">
                                    <span class="fa fa-trash-o"></span>
                                  </button>
                                </a>
                                <a href="javascript:seguirClausula(<?php echo $array['id_clausula'];?>);">
                                  <button class="btn btn-default" title="Seguimiento">
                                    <span class="fa fa-check-square-o"></span>
                                  </button>
                                </a>
                                 <?php }else{
                                  echo "Concluido";
                                 } ?>
                              </td>
                            
                            </tr>
                          <?php
                      
              }
        if ($num!=0)
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
        }
    #array("modelo"=>$modelo);

?>

