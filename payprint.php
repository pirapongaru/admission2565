<?php
session_start();
if ($_GET['std_id'] == '') {
    header("Location: pay.php");
  }


// include('includes/config.php');



// connect config
define('DB_HOST','localhost');
define('DB_USER','mb');
define('DB_PASS','l3iw');
define('DB_NAME','65regis3');
// Establish database connection.
try
{
$dbcon = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}


$std_id = $_GET['std_id'];
$std_class = $_GET['std_class'];
$sql = "SELECT * FROM $std_class INNER JOIN registype ON $std_class.std_type=registype.type_id WHERE std_id='$std_id'";
$query = $dbcon->prepare($sql);
// $query->bindParam(':std_id', $std_id, PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_OBJ);
if ($row->std_status != 4) {
    header("Location: pay.php");
  }


// $sql = "SELECT * FROM stdentm1 WHERE std_id=:std_id ";
// $query = $dbcon->prepare($sql);
// $query->bindParam(':std_id', $std_id, PDO::PARAM_STR);
// $query->execute();
// $row = $query->fetch(PDO::FETCH_OBJ);

// include 'tcpdf/configme.php';
require_once('tcpdf/configme.php');

// create new PDF document
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
// $pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('ใบชำระเงิน');
// $pdf->setSubject('TCPDF Tutorial');
// $pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
// $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
// $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
// $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'tcpdf/lang/eng.php')) {
	require_once(dirname(__FILE__).'tcpdf/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('thsarabun', '', 18);

// add a page
$pdf->AddPage();

// set BG
// $pdf->Image('imgs/bgpayin.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// $pdf->Image('imgs/bgpayin.jpg', 0, 0, 205, 280, '', '', '', false, 300, '', false, false, 0);


// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$pdf->Image('img/bgpayin.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

// qr
// SKR
// $bankcode= '0994000114869';
// $subfix ='01';
// SPR
// $bankcode= '099400023728';



$bankcode= '0994000114869';
$subfix ='03';
$ref1 = $row->std_id;
$ref2 = $row->std_type;
$money= 10000;
$qrgen = "https://chart.googleapis.com/chart?cht=qr&chl=%7C" . $bankcode. $subfix . "%0A" . $ref1 . "%0A" . $ref2 . "%0A" . $money . "&chs=500x500&choe=UTF-8&chld=L|0";

$pdf->Image($qrgen, 150, 109, 44, 44, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();



// $pdf->Image('images/std.png', 10, 50, 40, 40, '', '', 'T', false, 300, '', false, false, 1, false, false, false);

// Add Text
$pdf->SetTextColor(0,0,204);
$pdf->SetXY(129, 21);
$pdf->SetFont('thsarabun', '', 16);
$pdf->writeHTML($row->std_prefix .$row->std_fname . '&nbsp;' . $row->std_lname, true, false, true, false, 'L');

$pdf->SetFont('thsarabun', '', 18);
$pdf->SetXY(129, 29);
$pdf->writeHTML($ref1, true, false, true, false, 'L');

$pdf->SetXY(129, 37.5);
$pdf->writeHTML($ref2, true, false, true, false, 'L');

$pdf->SetXY(15, 72);
$pdf->SetFont('thsarabun', '', 18);
$pdf->writeHTML('( '.$row->type_name.' )', true, false, true, false, 'L');


// $pdf->SetTextColor(0,0,0);

// $pdf->SetXY(30, 65);
// $pdf->writeHTML($ref2, true, false, true, false, 'L');
// $pdf->Image('images/std.png', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
// print a block of text using Write()

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('payin.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
