<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Mexico_City');

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

include("../conexion.php");
include('../barcode.php');
require_once('../../pdf/fpdf/fpdf.php');
require_once('../../pdf/fpdf/FPDI-2.3.7/src/autoload.php');

$pdf = new FPDI('P', 'mm', 'Letter');
$pdf->SetFont('Arial', '', 11);
$pdf->SetTextColor(0);
$pdf->setSourceFile('../../pdf/constancia_identificacion.pdf');
$pageId = $pdf->importPage(1, PdfReader\PageBoundaries::MEDIA_BOX);
$pdf->AddPage();
$pdf->useImportedPage($pageId);

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//RECUPERAR VALORES
extract($_GET);

$hoy = date('d-m-Y');

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

/*$sql = "SELECT nombreActor, paternoActor, maternoActor,curpActor,rfcActor, Catalogo_Marca.descripcion AS marca, Catalogo_Modelo.descripcion AS modelo, Catalogo_Tipo.descripcion AS
tipoVehiculo, Catalogo_Anio.anio, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, Vehiculos.numeroMotor, Catalogo_Pais.descripcion AS pais, Vehiculos.cilindraje, 
Catalogo_Estado.descripcion AS estado, Citas.fechaRegistro, Citas.fechaCita, Catalogo_Horarios.horaCita, Catalogo_Clase.clase, Vehiculos.color, Citas.folioCita, Citas.delegacionId FROM Citas, Actores,Catalogo_Tipo_Persona, Vehiculos,
Catalogo_Marca, Catalogo_Modelo, Catalogo_Tipo, Catalogo_Anio, Catalogo_Pais, Catalogo_Cilindraje, Catalogo_Estado, Catalogo_Horarios, Catalogo_Clase WHERE Citas.citaId = '$citaId' 
AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' AND Citas.vehiculoId = 
Vehiculos.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND Catalogo_Modelo.modeloId = Vehiculos.modeloId AND Catalogo_Tipo.tipoId = Vehiculos.tipoId AND 
Catalogo_Anio.anioId = Vehiculos.anioId AND Vehiculos.paisId = Catalogo_Pais.paisId AND Catalogo_Estado.estadoId =
Vehiculos.estadoId AND Citas.horarioId = Catalogo_Horarios.id AND Catalogo_Clase.claseId = Vehiculos.claseId";*/

//$result = mysqli_query($conexion, $sql);

$consulta = mysqli_query($conexion, "CALL generar_constancia_vehicular('$citaId')");

if (mysqli_num_rows($consulta) != 0) {

    $consulta = mysqli_fetch_array($consulta);
    mysqli_next_result($conexion);

    $codigoSeguridad = $consulta['numeroSerie'] . $consulta['numeroPlacas'] . $consulta['numeroMotor'] . $consulta['folioCita'] . $consulta['fechaCita'] . $consulta['delegacionId'] . $consulta['fechaRegistro'];

    $fechaActual = fechaEs($hoy);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(11, 59, 125);
    $pdf->SetXY(55, 104);
    $pdf->Cell(0, 2, $consulta['marca']);
    $pdf->SetXY(55, 108.6);
    $pdf->Cell(0, 2, $consulta['modelo']);
    $pdf->SetXY(55, 113.2);
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
    $pdf->Cell(0, 2, utf8_decode($consulta['nombreActor']));
    $pdf->SetXY(53, 160.2);
    $pdf->Cell(0, 2, utf8_decode($consulta['paternoActor']));
    $pdf->SetXY(53, 165);
    $pdf->Cell(0, 2, utf8_decode($consulta['maternoActor']));
    $pdf->SetXY(53, 169.5);
    $pdf->Cell(0, 2, utf8_decode($consulta['curpActor']));
    $pdf->SetXY(53, 174.5);
    $pdf->Cell(0, 2, utf8_decode($consulta['rfcActor']));

    $nombreSol = $consulta['nombreActor'];
    $apellidoPaSol = $consulta['paternoActor'];
    $apellidoMaSol = $consulta['maternoActor'];
    $curpSol = $consulta['curpActor'];


    $sql2 = "SELECT COUNT(*) as conteo FROM Citas, Actores, Catalogo_Tipo_Persona WHERE Citas.citaId = '$citaId' AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'PROPIETARIO'";
    $resultado = mysqli_query($conexion, $sql2);
    $mostrar = mysqli_fetch_array($resultado);

    if ($mostrar['conteo'] > 0) {
        $sql2 = "SELECT  IFNULL(nombreActor, NULL) nombreActor, IFNULL(paternoActor, '') paternoActor, IFNULL(maternoActor, '') maternoActor, IFNULL(curpActor, '') curpActor, IFNULL(rfcActor, '') rfcActor FROM Citas, Actores, Catalogo_Tipo_Persona 
    WHERE Citas.citaId = '$citaId' AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'PROPIETARIO'";
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
        $pdf->SetXY(150, 173.2);
        $pdf->Cell(0, 2, utf8_decode($mostrar['rfcActor']));
    } else {
        $pdf->SetXY(150, 155.7);
        $pdf->Cell(0, 2, utf8_decode($consulta['nombreActor']));
        $pdf->SetXY(150, 160.2);
        $pdf->Cell(0, 2, utf8_decode($consulta['paternoActor']));
        $pdf->SetXY(150, 164.5);
        $pdf->Cell(0, 2, utf8_decode($consulta['maternoActor']));
        $pdf->SetXY(150, 168.7);
        $pdf->Cell(0, 2, utf8_decode($consulta['curpActor']));
        $pdf->SetXY(150, 173.2);
        $pdf->Cell(0, 2, utf8_decode($consulta['rfcActor']));
    }

    $pdf->SetFont('Arial', 'B', 7.7);
    $pdf->SetTextColor(0);
    $pdf->SetXY(113, 191.9);
    $pdf->Cell(0, 2, utf8_decode($fechaActual));

    $consultarFolio = "SELECT COUNT(*) as contador FROM Constancia_Vehicular, Citas WHERE Citas.citaId = Constancia_Vehicular.citaId AND  Constancia_Vehicular.citaId = '$citaId' AND Citas.delegacionId = '$delegacionId'";
    $resultadoConsultarFolio = mysqli_query($conexion, $consultarFolio);
    $mostrarConsultaFolio = mysqli_fetch_array($resultadoConsultarFolio);

    if ($mostrarConsultaFolio['contador'] > 0) {
        $delegacion = "SELECT constanciaId FROM Constancia_Vehicular WHERE Constancia_Vehicular.citaId = '$citaId'";
        $resultDelegacion = mysqli_query($conexion, $delegacion);

        $consultaDelegacion = mysqli_fetch_array($resultDelegacion);
    } else {
        $sql = $delegacion = "SELECT delegacionFolioConstancia, delegacionAnioConstancia FROM Delegaciones WHERE delegacionId = '$delegacionId'";
        $result = mysqli_query($conexion, $sql);
        $mostrar = mysqli_fetch_array($result);
        $fecha_registro = date("Y-m-d");
        $nuevoFolio = ($mostrar['delegacionFolioConstancia'] + 1);

        $fecha = substr($hoy, 0, 2) . substr($hoy, 3, 2) . substr($hoy, 6, 4);

        if ($mostrar['delegacionFolioConstancia'] <= 9) {
            $folioConstancia = 'FGE-CIV-0' . $delegacionId . '-000' . $nuevoFolio . '-' . $fecha;
        } else if ($mostrar['delegacionFolioConstancia'] <= 99) {
            $folioConstancia = 'FGE-CIV-0' . $delegacionId . '-00' . $nuevoFolio . '-' . $fecha;
        } else if ($mostrar['delegacionFolioConstancia'] <= 999) {
            $folioConstancia = 'FGE-CIV-0' . $delegacionId . '-0' . $nuevoFolio . '-' . $fecha;
        } else {
            $folioConstancia = 'FGE-CIV-0' . $delegacionId . '-' . $nuevoFolio . '-' . $fecha;
        }


        $expresiones = array("-", "_");
        $folio = str_replace($expresiones, "", $folioConstancia);
        $revFolio = strrev($folio) . generateRandomString(4);
        barcode('../../img/codigos/' . $revFolio . '.png', $revFolio, 20, 'horizontal', 'code128', true);

        $codigoSeguridad = $codigoSeguridad . $folioConstancia . $revFolio . generateRandomString(160);
        $folioSeguridad = str_replace($expresiones, "", $codigoSeguridad);

        $sql = "INSERT INTO Constancia_Vehicular(constanciaId,citaId, constanciaFechaRegistro, constanciaEstatus, constanciaFolio, constanciaAnio, codigoVerificacion, codigoSeguridad) VALUES ('$folioConstancia','$citaId', '$fecha_registro', 4, '$folioConstancia', '$mostrar[delegacionAnioConstancia]', '$revFolio', '$folioSeguridad')";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            $actualizarCita = "UPDATE Citas SET estadoCita = 1 WHERE citaId = '$citaId'";
            mysqli_query($conexion, $actualizarCita);

            $delegacion = "UPDATE Delegaciones SET delegacionFolioConstancia = '$nuevoFolio' WHERE delegacionId = '$delegacionId'";
            $resultDelegacion = mysqli_query($conexion, $delegacion);
            if ($resultDelegacion) {
                $delegacion = "SELECT constanciaId FROM Constancia_Vehicular WHERE Constancia_Vehicular.citaId = '$citaId'";
                $resultDelegacion = mysqli_query($conexion, $delegacion);

                $consultaDelegacion = mysqli_fetch_array($resultDelegacion);
            }
        }
    }

    $codigoBarras = "SELECT Constancia_Vehicular.constanciaId, Constancia_Vehicular.codigoVerificacion, Constancia_Vehicular.codigoSeguridad FROM Constancia_Vehicular, Citas WHERE Citas.citaId = Constancia_Vehicular.citaId AND  Constancia_Vehicular.citaId = '$citaId' AND Citas.delegacionId = '$delegacionId'";
    $resultCodigo = mysqli_query($conexion, $codigoBarras);
    $mostrarCodigo = mysqli_fetch_array($resultCodigo);

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(138, 13, 52);

    $pdf->SetXY(150.5, 217.1);
    $pdf->Cell(0, 2, $consultaDelegacion['constanciaId']);

    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetXY(150, 42.5);
    $pdf->Cell(0, 2, $consultaDelegacion['constanciaId']);

    $pdf->Image('../../img/codigos/' . $mostrarCodigo['codigoVerificacion'] . '.png', 3, 213.3, 50, 0, 'PNG');

    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 6.5);
    $pdf->SetXY(10, 255);
    $pdf->MultiCell(0, 2, $mostrarCodigo['codigoSeguridad'], 0, 'C');

    $sql = "INSERT INTO Bit_Constancia(constanciaId,usuarioId,accion) VALUES ('$citaId', '$usuarioId', 'IMPRIMIR CONSTANCIA VEHICULAR')";
    $result = mysqli_query($conexion, $sql);

    $pdf->Output('', $mostrarCodigo['constanciaId'] . '.pdf', TRUE);
}else{
    echo 'Error..';
}

?>