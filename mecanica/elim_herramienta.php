<?php
    require("seguridad.php");
    require("conexion.php");

    $id=$_REQUEST['id'];

 #   echo $id;

    # Eliminamos logicamente el usuario

    pg_query("UPDATE herramientas SET estatus='0' WHERE id_herramienta='".$id."'");
    $sqlx="SELECT * FROM herramientas WHERE id_herramienta='".$id."' ";
    $queryx=pg_query($sqlx);
    $array=pg_fetch_assoc($queryx);
    $nb=$array['n_b'];
    pg_query("UPDATE numero_bien SET estatus='0' WHERE id_nb='".$nb."'");


    //pg_query("DELETE FROM maquinas WHERE id_maquina='".$id."'");
#   Actualizamos los rerigistros y los obtenemos

    $sql="SELECT * FROM herramientas WHERE estatus='1' ";
    $query=pg_query($sql);

    date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Eliminación','Herramientas','".$_SESSION['nom_usuario']."',1)");

    header("Location:herramientas.php?elim_maq=si");

    # Creamos nuestra vista y la devolvemos al ajax
?>
<!--    <div class="dataTable_wrapper">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
            <thead>
                <tr>
                    <th>Nombre de usuario</th>
                    <th>Contraseña</th>
                    <th>Privilegio</th>
                    <th>Área</th>
                    <th>Acciónes</th>
                </tr>
            </thead>
            <tbody>        
>
<?php            
/*            while ($array=pg_fetch_assoc($query))
            {
*/
?>
             <tr class="odd gradeX">
                    <td align="center">><?php# echo $array["nom_usuario"];?></td>
                    <td align="center">><?php# echo $array["contrasena"];?><</td>
                    <td align="center"><?php# echo $array["privilegio"];?></td>
                    <td align="center"><?php# echo $array["area"];?></td>
                    <td align="center">
                        <a href="javascript:editar_usuario(<?php # echo $array['id'];?>);">
                            <button class="btn btn-default" title="Modificar">
                                <span class="fa fa-file-text-o"></span>
                            </button>
                        </a>

                        <a href="javascript:eliminar_usuario(<?php # echo $array['id'];?>);">
                            <button class="btn btn-danger" title="Eliminar">
                                <span class="fa fa-trash-o"></span>
                            </button>
                        </a>
                                    
                            <button class="btn btn-primary" title="Ver">
                                <span class="fa fa-search-plus"></span>
                            </button>
                    </td>
                </tr>
<?php
#               }
?>
            </tbody>
        </table>
    </div>

    <link href="assets/css/3/dataTables.bootstrap.css" rel="stylesheet">
    
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

            -->