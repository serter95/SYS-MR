<?php
session_start(); 
if ($_SESSION["g1tr2sv"] != "SI")
{   
	header("Location:../../../../salir.php");
}
//require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
require_once('tcpdf_include.php');
include('../../../conexion.php');


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		date_default_timezone_set('America/Caracas');
	$hoy=date('d/m/Y');
		// Logo
		$image_file = K_PATH_IMAGES.'upta.jpg';
		$this->Image($image_file, 10, 10, 25, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', '', 10);
		// Title
		 $this->Ln();    
		$this->Cell(0, 15, $hoy, 0, false, 'R', 0, '', 0, false, 'M', 'M');

		$this->SetFont('helvetica', 'B', 10);

			 $this->Ln(5);    
		$this->Cell(0, 15, "REPÚBLICA BOLIVARIANA DE VENEZUELA", 0, false, 'C', 0, '', 0, false, 'M', 'M');
			 $this->Ln(5);    
		$this->Cell(0, 15, "MINISTERIO DEL PODER POPULAR PARA LA EDUCACIÓN UNIVERSITARIA, CIENCIA Y TECNOLOGÍA", 0, false, 'C', 0, '', 0, false, 'M', 'M');
 			$this->Ln(5);    
		$this->Cell(0, 15, "UNIVERSIDAD POLITÉCNICA TERRITORIAL DE ARAGUA", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);    
		$this->Cell(0, 15, '"FEDERICO BRITO FIGUEROA"', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Ln(5);    
		$this->Cell(0, 15, 'TALLER DE METALMECÁNICA', 0, false, 'C', 0, '', 0, false, 'M', 'M');

	}

	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'I', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}


// create new PDF document
$pdf = new MYPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nelson Soto');
$pdf->SetTitle('Herramientas');
$pdf->SetSubject('Reporte de Herramientas');
$pdf->SetKeywords('Mecanica, Reporte, Herramientas');

//$bar=file_get_contents('nombre_del_fichero_externo')
  //     include("membrete.php");
//       $bar=membrete();

      // echo $bar;

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(20);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
	require_once(dirname(__FILE__).'/lang/spa.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
$pdf->SetFont('times', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$datos=pg_query("SELECT * FROM personal WHERE estatus='1' AND area='Mecanica' ORDER BY ci ASC");
$columnas=pg_num_fields($datos);

//$fila=pg_fetch_assoc($datos);

ob_start();

	date_default_timezone_set('America/Caracas');
	$hoy=date('d/m/Y');

  include(dirname(__FILE__).'/herramientascompleto.php');
  
//$content=ob_get_clean();
$html=ob_get_contents();
ob_end_clean();
//$html2pdf= new HTML2PDF('P', 'A4','es');


$fecha=explode('/', $hoy);

	$d=$fecha[0];
	$m=$fecha[1];
	$y=$fecha[2];


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

//$html2pdf -> Output('reporte_personal_'.$d.'-'.$m.'-'.$y.'.pdf','I');
$pdf->Output('reporte_herramientas_'.$d.'-'.$m.'-'.$y.'estante='.$estante.'.pdf', 'I');
?>