<?php
session_start(); 
if ($_SESSION["g2tr1sv"] != "SI")
{   
header("Location:../../salir.php");
}
include("../conexion.php");
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

//$cadconex="host='localhost' port='5432' dbname='maquinas' user='postgres' password='1234'";

//$cadconex="dbname=prueba host=localhost port=5432 user=postgres password=12345";
//$conexion = pg_connect($cadconex);

//$datos = pg_query ($conexion, "SELECT * FROM usuario");
//$datos = pg_query ($conexion, "SELECT * FROM usuario");
$datos=pg_query("SELECT * FROM maquinas m, numero_bien n WHERE m.n_b=n.id_nb AND estatus='1' ORDER BY codigo ASC");



$columnas=pg_num_fields($datos);

//$fila=pg_fetch_assoc($datos);

ob_start();
  include(dirname(__FILE__).'/lol.php');
  
?>
	


<?php 
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('P', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_maquinas_'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>