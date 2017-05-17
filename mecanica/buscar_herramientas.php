<?php
require ('seguridad.php');
require ('conexion.php');
  $num=$_REQUEST['num'];
  $sql2="SELECT * FROM tipo_usuario INNER JOIN usuario ON tipo_usuario.id_tipo = usuario.id_tipo_usuario    AND nom_usuario='".$_SESSION['nom_usuario']."' AND taller=1 LIMIT 1";
$query2=pg_query($sql2);
$array2=pg_fetch_assoc($query2);

$priv=explode('-', $array2['priv_inventario']);
$privilegio_A=$priv[0];
$privilegio_E=$priv[1];
$privilegio_M=$priv[2];
$privilegio_I=$priv[3];
?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
            <tr>
              <th width="100px">Numero del Bien</th>
              <th width="200px">Nombre</th>
              <th>Marca</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
    <tbody>
<?php 
  $sql="SELECT * FROM herramientas h, numero_bien n WHERE h.n_b=n.id_nb AND h.estatus=1 AND h.taller=1 AND h.estante='".$num."'";
  $query=pg_query($sql);
  $num=pg_num_rows($query);
  while($array=pg_fetch_assoc($query)){
     $var=$array['estado'];
                          ?>
                          <tr class="odd gradeX">
                            <td align="center" width="100px"><?php echo $array['nb'];?></td>
                            <td align="center" width="200px"><?php echo $array['nombre']; ?></td>
                            <td align="center"><?php echo $array['marca'];?></td>
                            <td align="center"><?php echo $array['estado']?></td>
                            <td align="center">
                              <?php
                              if ($privilegio_M=='M')
                              {
                               ?>    
                                    <a  <?php if ($var=='En prestamo')
                                    {
                                      ?> href="#"
                                      <?php 
                                    }
                                    else
                                    {
                                      ?>
                                      href="javascript:editar_herramientas(<?php echo $array['id_herramienta'];?>);"    
                                      <?php    
                                    }
                                    ?>
                                    >
                                    <button class="btn btn-default"
                                    <?php if ($var=='En prestamo')
                                    {
                                      ?> title="No se puede modificar la herramienta mientras este en prestamo"
                                      <?php 
                                    }
                                else
                                    {
                                      ?>
                                      title="Modificar"
                                      <?php    
                                    }
                                    ?>
                                    id="Modificar">
                                <span class="fa fa-edit"></span>
                              </button>
                            </a>

                            <?php
                          }
                          ?>
                          <?php
                          if ($privilegio_E=='E')
                          {
                            ?>
                            <?php
                            if ($var=='En prestamo')
                            {
                              ?>
                              <a href="#">
                                <button class="btn btn-default" title="No se puede eliminar la herramienta mientras este en prestamo">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                              <?php
                            }
                            else
                            {
                              ?>
                              <a href="javascript:eliminarHerramienta(<?php echo $array['id_herramienta'];?>);">
                                <button class="btn btn-default" title="Eliminar">
                                  <span class="fa fa-trash-o"></span>
                                </button>
                              </a>
                              <?php
                            }
                            ?>

                            <?php
                          }
                          ?>
                          <a href="javascript:detalleHerramienta(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Ver">
                              <span class="fa fa-search-plus"></span>
                            </button>
                          </a>

                          <a href="javascript:reportandoHerramienta(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Reporte">
                              <span class="fa fa-print"></span>
                            </button>
                          </a>
                          <?php
                          if ($array['cantidad']!=$array['cantidad_p'])
                          {
                            ?>
                            <a href="javascript:Prestamo(<?php echo $array['id_herramienta'];?>);">                
                              <button class="btn btn-default" title="Prestar Herramienta">
                                <span class="fa fa-hand-o-up"></span>
                              </button>
                            </a>
                            <?php
                            if ($array['cantidad_p']=='1'){

                             ?>
                            <a href="javascript:Devolucion(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php
                            }
                            else if($array['cantidad_p']>'1'){
                                ?>
                            <a href="javascript:DevolucionV(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php

                            }
                          }
                          else{
                            if ($array['cantidad_p']=="1"){
                            ?>
                            <a href="javascript:Devolucion(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>

                            <?php
                            }
                             else if ($array['cantidad']=="0"){
                            ?>
                           

                            <?php
                            }
                            else{
                            ?>
                           <a href="javascript:DevolucionV(<?php echo $array['id_herramienta'];?>);">                
                            <button class="btn btn-default" title="Devolver Herramienta">
                                <span class="fa fa-hand-o-down"></span>
                              </button>
                            </a>
                            <?php
                            }
                          }
                          ?>
                        </td>
                      </tr>
                      <?php               
                         }   
                                      ?>
                  </tbody>
                  </table>