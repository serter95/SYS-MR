<?php
session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{	
header("Location:../../salir.php");
}
include("../../conexion.php");

require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
//require_once(dirname(__FILE__).'/seguridad.php');

//$fila=pg_fetch_assoc($datos);

ob_start();
  include(dirname(__FILE__).'/insumoscompleto.php');
  
?>
	


<?php 
//$content=ob_get_clean();
$content=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');
$html2pdf= new HTML2PDF('L', 'A4','es',true,'UTF-8',array(4,4,3,3));
//array va los margenes pero no se en que formato estan
$html2pdf -> WriteHTML($content);
$html2pdf -> Output('reporte_insumos_'.$d.'-'.$m.'-'.$y.'.pdf','I');
?>