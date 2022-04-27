<?php
session_start();
if ($_GET['std_id'] == '') {
    header("Location: print.php");
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
if ($row->std_status != 1) {
    header("Location: print.php");
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
$pdf->setTitle('บัตรประจำตัวสอบ');
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
// set bacground image and photo student
$pdf->Image('img/bgcard.jpg', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
$pdf->Image('stdphoto/'.substr($std_class,-2).'/'.$std_id.'.jpg', 177, 8, 30, 30, '', '', 'T', false, 300, '', false, false, 1, false, false, false);



$pdf->Image($qrgen, 150, 109, 44, 44, '', '', '', false, 300, '', false, false, 0);
// restore auto-page-break status
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setCellPaddings(0,0,0,0);

$pdf->setPageMark();




// Add Text

$pdf->SetTextColor(0,0,0);
$pdf->SetXY(166, 6.7);
$pdf->SetFont('thsarabunb', '', 26);
$pdf->writeHTML(substr($std_class,-1), true, false, true, false, 'L');



$std_id=$row->std_id;
$pdf->SetTextColor(0,0,204);
$pdf->SetXY(49, 27);
$pdf->SetFont('thsarabunb', '', 22);
$pdf->writeHTML(substr($std_id, 0, 1) . '-' . substr($std_id, 1, 4) . '-' . substr($std_id, 5, 5) .'-' . substr($std_id, 10, 2) . '-' . substr($std_id, 12, 1), true, false, true, false, 'L');

$pdf->SetXY(59.5, 27);
$pdf->writeHTML($row->std_regisid, true, false, true, false, 'C');

$pdf->SetXY(156.5, 27);
$pdf->writeHTML($row->std_regisroom, true, false, true, false, 'L');



$pdf->SetFont('thsarabun', '', 20);
$pdf->SetXY(40, 37.7);
$pdf->writeHTML($row->std_prefix.$row->std_fname.'&nbsp;'.$row->std_lname, true, false, true, false, 'L');

$pdf->SetXY(62, 44.6);
$pdf->writeHTML($row->std_eduschool.'&nbsp;&nbsp;&nbsp;จ.'.$row->std_eduprovince, true, false, true, false, 'L');

$pdf->SetXY(42, 54.4);
$pdf->writeHTML($row->type_name, true, false, true, false, 'L');

$pdf->SetXY(15, 62);
$pdf->writeHTML($row->type_testdate, true, false, true, false, 'L');


$pdf->SetXY(0, 67);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('thsarabun', '', 10);
date_default_timezone_set('Asia/Bangkok');
$pdf->writeHTML(date("d/m/").(date("Y")+543).date(" - h:i").' น.', true, false, true, false, 'R');


// $pdf->SetTextColor(0,0,0);

// $pdf->SetXY(30, 65);
// $pdf->writeHTML($ref2, true, false, true, false, 'L');
// $pdf->Image('images/std.png', $x, $y, $w, $h, 'JPG', '', '', false, 300, '', false, false, 0, $fitbox, false, false);
// print a block of text using Write()

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($row->std_regisid.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
