<?php
include ('conexion.php');
 require('seguridad.php');



$sql="INSERT INTO insumos(nombre,medida,cantidad,buenas,danadas,id_taller)
 VALUES('".$_REQUEST['nombre']."','".$_REQUEST['medida']."','".$_REQUEST['cantidad']."','".$_REQUEST['buenas']."','".$_REQUEST['danadas']."','1')";

pg_query($sql);

?>

<script language="javascript">
//alert ("Agregado con Exito!");
location .href='insumos.php?correcto=si';

</script>
