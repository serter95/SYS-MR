<?php
include ('conexion.php');
 require('seguridad.php');



$sql="INSERT INTO insumos(nombre,medida,cantidad,buenas,danadas,taller)
 VALUES('".$_REQUEST['nombre']."','".$_REQUEST['medida']."','".$_REQUEST['cantidad']."','".$_REQUEST['buenas']."','".$_REQUEST['danadas']."','1')";

pg_query($sql);

date_default_timezone_set('America/Caracas');

          $hoy=date('Y-m-d h:i:s');

          pg_query("INSERT INTO auditoria (fecha,accion_realizada,modulo,nom_usuario,taller)
              VALUES('$hoy','Registro','Insumos','".$_SESSION['nom_usuario']."',1)");

?>

<script language="javascript">
//alert ("Agregado con Exito!");
location .href='insumos.php?correcto=si';

</script>
