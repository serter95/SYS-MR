<?php

$db_servidor="";

$db_usuario="root";

$db_contrasena="";

$db_db="login3";


$dbh=mysql_connect($db_servidor,$db_usuario,$db_contrasena)
 or die('Error con la conexion a la Base de Datos Debido a:'.mysql_error());

mysql_select_db($db_db,$dbh);
?>
