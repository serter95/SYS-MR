<?php
session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{	
header("Location:../../salir.php");
}
include("../conexion.php");
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

/*$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='12345'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
$conexion = pg_connect($cadconex);

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query($conexion,"SELECT * FROM maquinas WHERE estatus='1' ORDER BY codigo ASC");

//$totales = pg_num_rows($datos);
$columnas=pg_num_fields($datos);*/

//$fila=pg_fetch_assoc($datos);

ob_start();
  include(dirname(__FILE__).'/lol3.php');
?>
	


<?php 
$content=ob_get_clean();
//$content=ob_get_contents();
//ob_end_clean();
$html2pdf= new HTML2PDF('P', 'A4','es');
//$html2pdf= new HTML2PDF('P', 'A4','fr',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_de_maquina_preventivo_codigo_'.$array["codigo"].'_'.$fechas.'.pdf','I');
?>