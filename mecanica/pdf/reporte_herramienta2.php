<?php
use Dompdf\Dompdf;
use Dompdf\Options;
include('dompdf/autoload.inc.php');
ini_set("memory_limit", "-1");
// Volcamos las páginas en papel
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);
// Se carga el codigo html

ob_start();
require_once ('herramientascompleto.php');
$html = ob_get_clean();	
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>

