<?php
header('Content-Type: text/html; charset=UTF-8');
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
require_once("./fpdf/fpdf.php");
require_once("./fpdf/FPDI-2.3.7/src/autoload.php");

include("./conexion.php");
mysqli_set_charset($conexion, 'utf8');
$delegacionId = $_REQUEST['delegacionId'];

$delegacion = "SELECT delegacionNombre, delegacionDomicilio FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$resultDelegaciones = mysqli_query($conexion, $delegacion);
$consultaDeleg = mysqli_fetch_array($resultDelegaciones);

$nombrecompleto = $_REQUEST['nombreCompleto'];
$numeroCita = $_REQUEST['numeroCita'];
$fechaCita = iconv("UTF-8", "ISO-8859-1//TRANSLIT",$_REQUEST['fechaCita']);
$horaCita = $_REQUEST['horaCita'];

$pdf = new FPDI('P','mm','Letter');

$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);
$pdf->setSourceFile('acuse-cita.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
$pdf->AddPage();
$pdf->useImportedPage($pageId);

$pdf->SetXY(60,77.7);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(132,13,52);
$pdf->Cell(0,2,$numeroCita);
$pdf->SetXY(52,86.7);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);
$pdf->Cell(0,2,$nombrecompleto);
$pdf->SetXY(22,95);
$texto = 'En atención a su solicitud para realizar el trámite de emisión de CONSTANCIA DE IDENTIFICACIÓN VEHICULAR en la delegación '.$consultaDeleg['delegacionNombre'].' ubicada en '.$consultaDeleg['delegacionDomicilio'].', le comunicamos que su solicitud ha quedado registrada con los siguientes datos:';
$pdf->MultiCell(0,7, utf8_decode($texto), 0);

$pdf->SetXY(75,133);
$pdf->Cell(0,2,$nombrecompleto);
$pdf->SetXY(75,142);
$pdf->Cell(0,2,$numeroCita);
$pdf->SetXY(75,151);
$pdf->Cell(0,2,$fechaCita.', a las '.$horaCita.' hrs.');
//============================================== SALIDA DEL PDF ===================================
$pdf->Output('',$numeroCita.'.pdf',TRUE);

?>