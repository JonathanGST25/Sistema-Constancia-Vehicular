<?php
header('Content-Type: text/html; charset=UTF-8');
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
require_once("./fpdf/fpdf.php");
require_once("./fpdf/FPDI-2.3.7/src/autoload.php");

include("./conexion.php");
mysqli_set_charset($conexion, 'utf8');

//EXTRAER VARIABLES PASADAS POR LA URL
extract($_REQUEST);

//CONSULTAR DATOS NECESARIOS PARA ELABORAR LA CONSTANCIA
$sql = "SELECT Actores.nombreActor, Actores.paternoActor, Actores.maternoActor, Delegaciones.delegacionNombre, Delegaciones.delegacionDomicilio, Citas.folioCita, Catalogo_Horarios.fechaCita, Catalogo_Horarios.horaCita FROM Actores, Catalogo_Tipo_Persona, Citas, Delegaciones, Catalogo_Horarios, Vehiculos WHERE Actores.curpActor = '$curpActor' AND  Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' AND Actores.citaId = Citas.citaId AND Citas.horarioId = Catalogo_Horarios.id AND Delegaciones.delegacionId = '$delegacionId' AND Citas.vehiculoId = Vehiculos.vehiculoId AND (Vehiculos.numeroSerie = '$numeroSerie' OR Vehiculos.numeroPlacas = '$numeroPlacas' OR Vehiculos.numeroMotor = '$numeroMotor')";
$result = mysqli_query($conexion,$sql);
$consulta = mysqli_fetch_array($result);

//METODO PARA CONVETIR FECHA TIPO DATE A TEXTO
function fechaEs($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}

//VARIABLES
$nombreCompletoSolicitante = $consulta['nombreActor'].' '.$consulta['paternoActor'].' '.$consulta['maternoActor'];
$fechaCita = fechaEs($consulta['fechaCita']);
$hora = substr($consulta['horaCita'], 0, 5);

// CREAR NUEVO PDF
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
$pdf->Cell(0,2,$consulta['folioCita']);
$pdf->SetXY(52,86.7);
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);
$pdf->Cell(0,2,$nombreCompletoSolicitante);
$pdf->SetXY(22,95);
$texto = 'En atención a su solicitud para realizar el trámite de emisión de CONSTANCIA DE IDENTIFICACIÓN VEHICULAR en la delegación '.$consulta['delegacionNombre'].' ubicada en '.$consulta['delegacionDomicilio'].', le comunicamos que su solicitud ha quedado registrada con los siguientes datos:';
$pdf->MultiCell(0,7, utf8_decode($texto), 0);

$pdf->SetXY(75,133);
$pdf->Cell(0,2,$nombreCompletoSolicitante);
$pdf->SetXY(75,142);
$pdf->Cell(0,2,$consulta['folioCita']);
$pdf->SetXY(75,151);
$pdf->Cell(0,2,utf8_decode($fechaCita).', a las '.$hora.' hrs.');

$pdf->Output('',$consulta['folioCita'].'.pdf',TRUE);
?>