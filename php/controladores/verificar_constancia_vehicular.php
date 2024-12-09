<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

include("../conexion.php");
mysqli_set_charset($conexion, 'utf8');
require_once('../../pdf/fpdf/fpdf.php');
require_once('../../pdf/fpdf/FPDI-2.3.7/src/autoload.php');

$pdf = new FPDI('P', 'mm', 'Letter');
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0);
$pdf->setSourceFile('../../pdf/constancia_validador.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
$pdf->AddPage();
$pdf->useImportedPage($pageId);

//FUNCIÓN PARA CAMBIAR EL FORMATO DE FECHA
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

//RECUPERAR VALORES
extract($_POST);

//LLAMAR PROCEDIMIENTO PARA VALDAR LA CONSTANCIA
$consulta = mysqli_query($conexion, "CALL validar_constancia('$codigoBarras')");

if (mysqli_num_rows($consulta) != 0) {

    $consulta = mysqli_fetch_array($consulta);

    //OBTENER FECHA ACTUAL PARA LA EXPEDICIÓN DE LA CONSTANCIA
    $hoy = date('d-m-Y');

    $fechaActual = fechaEs($hoy);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(11, 59, 125);
    $pdf->SetXY(55, 104);
    $pdf->Cell(0, 2, $consulta['marca']);
    $pdf->SetXY(55, 108.6);
    $pdf->Cell(0, 2, $consulta['modelo']);
    $pdf->SetXY(55, 113.3);
    $pdf->Cell(0, 2, $consulta['tipoVehiculo']);
    $pdf->SetXY(55, 117.8);
    $pdf->Cell(0, 2, $consulta['anio']);
    $pdf->SetXY(55, 122.3);
    $pdf->Cell(0, 2, $consulta['clase']);
    $pdf->SetXY(55, 127);
    $pdf->Cell(0, 2, $consulta['color']);
    $pdf->SetXY(55, 131.6);
    $pdf->Cell(0, 2, $consulta['numeroPlacas']);
    $pdf->SetXY(55, 136.5);
    $pdf->Cell(0, 2, $consulta['numeroMotor']);

    $pdf->SetXY(149, 103.5);
    $pdf->Cell(0, 2, $consulta['pais']);
    $pdf->SetXY(149, 108.5);
    $pdf->Cell(0, 2, $consulta['cilindraje']);
    $pdf->SetXY(149, 117);
    $pdf->Cell(0, 2, utf8_decode($consulta['estado']));
    $pdf->SetXY(149, 124.5);
    $pdf->Cell(0, 2, $consulta['numeroSerie']);

    $pdf->SetXY(53, 155.7);
    $pdf->Cell(0, 2, $consulta['nombreActor']);
    $pdf->SetXY(53, 160.2);
    $pdf->Cell(0, 2, $consulta['paternoActor']);
    $pdf->SetXY(53, 165);
    $pdf->Cell(0, 2, $consulta['maternoActor']);
    $pdf->SetXY(53, 169.5);
    $pdf->Cell(0, 2, $consulta['curpActor']);
    $pdf->SetXY(53, 174.5);
    $pdf->Cell(0, 2, $consulta['rfcActor']);

    $nombreSol = $consulta['nombreActor'];
    $apellidoPaSol = $consulta['paternoActor'];
    $apellidoMaSol = $consulta['maternoActor'];
    $curpSol = $consulta['curpActor'];

    mysqli_close($conexion);

    //CREAR NUEVA CONEXIÓN
    $server = "localhost";
    $user = "root";
    $password = "199925";
    $db = "fge_constancia_vhclo";

    $conexion = new mysqli($server, $user, $password, $db);
    mysqli_set_charset($conexion, 'utf8');

    if ($conexion->connect_errno) {
        die("La conexión ha fallado" . $conexion->connect_errno);
    }

    $sql = "SELECT * FROM Citas, Actores, Catalogo_Tipo_Persona, Constancia_Vehicular WHERE Constancia_Vehicular.codigoVerificacion = '$codigoBarras' AND Constancia_Vehicular.citaId = Citas.citaId AND Constancia_Vehicular.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'PROPIETARIO'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) != 0) {

        $sql2 = "SELECT  IFNULL(nombreActor, NULL) nombreActor, IFNULL(paternoActor, '') paternoActor, IFNULL(maternoActor, '') maternoActor, IFNULL(curpActor, '') curpActor, IFNULL(rfcActor, '') rfcActor FROM Citas, Actores, Catalogo_Tipo_Persona, Constancia_Vehicular WHERE Citas.citaId = Constancia_Vehicular.citaId AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'PROPIETARIO' AND Constancia_Vehicular.codigoVerificacion = '$codigoBarras'";
        $resultado = mysqli_query($conexion, $sql2);
        $mostrar = mysqli_fetch_array($resultado);
        $pdf->SetXY(150, 155.7);
        $pdf->Cell(0, 2, utf8_decode($mostrar['nombreActor']));
        $pdf->SetXY(150, 160.3);
        $pdf->Cell(0, 2, utf8_decode($mostrar['paternoActor']));
        $pdf->SetXY(150, 164.5);
        $pdf->Cell(0, 2, utf8_decode($mostrar['maternoActor']));
        $pdf->SetXY(150, 168.7);
        $pdf->Cell(0, 2, utf8_decode($mostrar['curpActor']));
        $pdf->SetXY(150, 173.3);
        $pdf->Cell(0, 2, utf8_decode($mostrar['rfcActor']));
    } else {

        $pdf->SetXY(150, 155.7);
        $pdf->Cell(0, 2, utf8_decode($consulta['nombreActor']));
        $pdf->SetXY(150, 159.7);
        $pdf->Cell(0, 2, utf8_decode($consulta['paternoActor']));
        $pdf->SetXY(150, 164.3);
        $pdf->Cell(0, 2, utf8_decode($consulta['maternoActor']));
        $pdf->SetXY(150, 168.7);
        $pdf->Cell(0, 2, utf8_decode($consulta['curpActor']));
        $pdf->SetXY(150, 173.3);
        $pdf->Cell(0, 2, utf8_decode($consulta['rfcActor']));
    }

    $pdf->SetFont('Arial', 'B', 7.7);
    $pdf->SetTextColor(0);
    $pdf->SetXY(113, 191.9);
    $pdf->Cell(0, 2, utf8_decode($fechaActual));

    $delegacion = "SELECT constanciaId, codigoVerificacion, codigoSeguridad FROM Constancia_Vehicular WHERE Constancia_Vehicular.codigoVerificacion = '$codigoBarras'";
    $resultDelegacion = mysqli_query($conexion, $delegacion);
    $consultaDelegacion = mysqli_fetch_array($resultDelegacion);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(138, 13, 52);

    $pdf->SetXY(150.5, 217.1);
    $pdf->Cell(0, 2, $consultaDelegacion['constanciaId']);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetXY(150, 42.5);
    $pdf->Cell(0, 2, $consultaDelegacion['constanciaId']);

    $pdf->Image('../../img/codigos/' . $consultaDelegacion['codigoVerificacion'] . '.png', 3, 213.3, 50, 0, 'PNG');

    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 6.5);
    $pdf->SetXY(10, 255);
    $pdf->MultiCell(0, 2, $consultaDelegacion['codigoSeguridad'], 0, 'C');

    $pdf->Output('', 'ConstanciaDeIdentificaciónVehicular.pdf', TRUE);
} else {
    header('Location: ../../validador_constancia.php?bandera=true');
    die();
}
