<?php
session_start(); 
if ($_SESSION["g2tr1sv"] != "SI")
{   
	header("Location:../../salir.php");
}
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');

include('../conexion.php');

$datos=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Robotica' ORDER BY ci ASC");
$columnas=pg_num_fields($datos);

//$fila=pg_fetch_assoc($datos);

ob_start();

	date_default_timezone_set('America/Caracas');
	$hoy=date('d/m/Y');

  include(dirname(__FILE__).'/rep_personal.php');
  
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('L', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array da los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);

$fecha=explode('/', $hoy);

	$d=$fecha[0];
	$m=$fecha[1];
	$y=$fecha[2];

$html2pdf -> Output('reporte_personal_'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>