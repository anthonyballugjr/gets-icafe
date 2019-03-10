<?php
include_once "config/database.php";
include_once "classes/medTechClass.php";
require('fpdf/fpdf.php');


$database= new Database();
$db = $database->getConnection();

// if(isset($_GET['recordID'])){
//     $medtech->recordID = $_GET['recordID'];
//     $recID = $_GET['recordID'];
//     $medtech->xxxx();

//     $image = $medtech->image;
//     $uploadedBy = $medtech->uploadedBy;
//     $serviceType = $medtech->serviceType;
//     $recordedBy = $medtech->recordedBy;
//     $conductedBy = $medtech->conductedBy;
//     $uploadedBy = $medtech->uploadedBy;
//     $uploadTime = $medtech->uploadTime;
//     $dateTimeConducted = $medtech->dateTimeConducted;
//     $doctorRemarks = $medtech->doctorRemarks;
//     $prescription = $medtech->prescription;
//     $message = $medtech->message;
//     $image = $medtech->image;
// }



if(isset($_POST['download'])){
    $medtech = new MedTech($db);
	$medtech->recordID = $_POST['recordID'];
	$medtech->xxxx();

	// $serviceType = $medtech->serviceType;

	$uploadedBy = $_POST['from'];
	$serviceType = $_POST['serviceType'];
	$recordedBy = $_POST['recordedBy'];
	$dateTimeConducted = $_POST['dateTimeConducted'];
	$message = $_POST['message'];
	$dateUploaded = $_POST['dateUploaded'];
	$image = $medtech->image;
	$uploadedBy = $medtech->uploadedBy;
	$uploadTime = $medtech->uploadTime;
	$doctorRemarks = $medtech->doctorRemarks;
	$prescription = $medtech->prescription;
}

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('Pictures/qa2.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(50,10,'Qiambao-Abansi Diagnostic Laboratory',0,0,'C');
    // Line break
    $this->Ln(20);
}
// Page footer
function Footer(){
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}



$pdf = new PDF();
$pdf->AddPage();
$pdf->setFont('Arial','B', 12);
// $pdf->Cell(95,10, $pdf->Image('Pictures/qa2.png',10,10,30,30));
$pdf->Cell(95, 10, '', 0,0,'C');
$pdf->Cell(95, 10, '', 0,1,'C');
$pdf->Cell(95, 10, '', 0,0,'C');
$pdf->Cell(95, 10, '', 0,1,'C');
$pdf->Cell(95, 10, 'Service Type: ', 0,0,'R');
$pdf->Cell(95, 10, $serviceType, 0,1, 'L');
$pdf->Cell(95, 10, 'Recorded by:',0,0,'R');
$pdf->Cell(95, 10, $recordedBy,0,1,'L');
$pdf->Cell(95, 10, 'Date Conducted:',0,0,'R');
$pdf->Cell(95, 10, $dateTimeConducted,0,1,'L');
$pdf->Cell(95, 10, 'Uploaded by:',0,0,'R');
$pdf->Cell(95, 10, $uploadedBy,0,1,'L');
$pdf->Cell(95, 10, 'Time uploaded:',0,0,'R');
$pdf->Cell(95, 10, $uploadTime,0,1,'L');
$pdf->Cell(95, 10, 'Message:',0,0,'R');
$pdf->Cell(95, 10, $message,0,1,'L');
$pdf->Cell(200, 50, 'REFER TO NEXT PAGE FOR LAB RESULTS',0,0,'C');
$pdf->AddPage();
$pdf->Cell(95,10, $pdf->Image('records/'.$image,15,40,180 ,200));
$pdf->output();

?>