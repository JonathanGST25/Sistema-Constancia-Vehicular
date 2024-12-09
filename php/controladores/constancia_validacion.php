<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

include("../conexion.php");

//require_once('./pdf/fpdf/fpdf.php');
require_once('../../pdf/fpdf/fpdf.php');
require_once('../../pdf/fpdf/FPDI-2.3.7/src/autoload.php');

$pdf = new FPDI('P','mm','Letter');
$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0);
$pdf->setSourceFile('../../pdf/constancia-validacion.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
$pdf->AddPage();
$pdf->useImportedPage($pageId);

//REALIZAR CONSULTA A LA BASE DE DATOS
extract($_GET);

$sql = "SELECT nombreActor, paternoActor, maternoActor,curpActor,rfcActor, Catalogo_Marca.descripcion AS marca, Catalogo_Modelo.descripcion AS modelo, Catalogo_Tipo.descripcion AS
tipoVehiculo, Catalogo_Anio.anio, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, Vehiculos.numeroMotor, Catalogo_Pais.descripcion AS pais, Vehiculos.cilindraje, 
Catalogo_Estado.descripcion AS estado, Citas.fechaRegistro, Citas.fechaCita, Catalogo_Horarios.horaCita, Citas.folioCita FROM Citas, Actores,Catalogo_Tipo_Persona, Vehiculos, Catalogo_Marca, Catalogo_Modelo, Catalogo_Tipo, Catalogo_Anio, Catalogo_Pais, 
Catalogo_Cilindraje, Catalogo_Estado, Catalogo_Horarios WHERE Citas.citaId = $citaId AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND 
Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' AND Citas.vehiculoId =Vehiculos.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND Catalogo_Modelo.modeloId = 
Vehiculos.modeloId AND Catalogo_Tipo.tipoId = Vehiculos.tipoId AND Catalogo_Anio.anioId = Vehiculos.anioId AND Vehiculos.paisId = Catalogo_Pais.paisId AND 
Catalogo_Estado.estadoId = Vehiculos.estadoId AND Citas.horarioId = Catalogo_Horarios.id";

$result = mysqli_query($conexion, $sql);

$consulta = mysqli_fetch_array($result);

$pdf->SetXY(30,109);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0);
$pdf->Cell(0,2,$consulta['marca']);
$pdf->SetXY(94,109);
$pdf->Cell(0,2,$consulta['modelo']);
$pdf->SetXY(170,108.8);
$pdf->Cell(0,2,$consulta['tipoVehiculo']);

$pdf->SetXY(27,122.5);
$pdf->Cell(0,2,$consulta['anio']);
$pdf->SetXY(81.5,122.5);
$pdf->Cell(0,2,$consulta['numeroPlacas']);
$pdf->SetXY(156.5,122.5);
$pdf->Cell(0,2,$consulta['numeroSerie']);
$pdf->SetXY(50,135.5);
$pdf->Cell(0,2,$consulta['numeroMotor']);

$pdf->SetXY(33,155.6);
$pdf->Cell(0,2,$consulta['nombreActor']);
$pdf->SetXY(139,155.6);
$pdf->Cell(0,2,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$consulta['paternoActor']));
$pdf->SetXY(49,166.6);
$pdf->Cell(0,2,$consulta['maternoActor']);
$pdf->SetXY(106,166.3);
$pdf->Cell(0,2,$consulta['curpActor']);
$pdf->SetXY(167,166.3);
$pdf->Cell(0,2,$consulta['rfcActor']);

$pdf->SetXY(57,257);
$pdf->Cell(0,2,date('d-m-Y'));
$pdf->SetXY(165,257);
$pdf->Cell(0,2,$consulta['folioCita']);

$sql = "INSERT INTO Bit_Constancia(constanciaId,usuarioId,accion) VALUES ('$citaId', '$usuarioId', 'IMPRIMIR CONSTANCIA VALIDACIÓN')";
$result = mysqli_query($conexion,$sql);

$pdf->Output('', $consulta['folioCita'].'.pdf',TRUE);

?>