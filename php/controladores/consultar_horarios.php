<?php
include("../conexion.php");

$fecha = $_REQUEST['fecha'];
$delegacionId = $_REQUEST['idDelegacion'];

$sql = "SELECT COUNT(*) AS hasExists FROM Catalogo_Dias_Extraordinarios WHERE Catalogo_Dias_Extraordinarios.delegacionId = '$delegacionId' AND Catalogo_Dias_Extraordinarios.fecha_extraordinaria = '$fecha'";

$result = mysqli_query($conexion, $sql);

if ($result) {

    $mostrar = mysqli_fetch_array($result);
    $existencia = $mostrar['hasExists'];

    if ($existencia <= 0) {


        $consultaHorarios = "SELECT COUNT(*) AS CONTADOR FROM Catalogo_Horarios, Catalogo_Periodos WHERE Catalogo_Periodos.delegacionId = '$delegacionId'
        AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Horarios.fechaCita = '$fecha' AND Catalogo_Horarios.cantidadCoches != Catalogo_Horarios.cantidadCitas";
        $resultConsultaHorarios = mysqli_query($conexion, $consultaHorarios);

        if ($resultConsultaHorarios) {

            $mostrarConsultaHorarios = mysqli_fetch_assoc($resultConsultaHorarios);
            $contador = $mostrarConsultaHorarios['CONTADOR'];

            if ($contador > 0) {
                $sql = "SELECT Catalogo_Horarios.id, Catalogo_Horarios.horaCita FROM Catalogo_Horarios, Catalogo_Periodos WHERE Catalogo_Periodos.delegacionId = '$delegacionId'
                AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND Catalogo_Horarios.fechaCita = '$fecha' AND Catalogo_Horarios.cantidadCoches != Catalogo_Horarios.cantidadCitas";

                $result = mysqli_query($conexion, $sql);
                if ($result) {
                    while ($consulta = mysqli_fetch_array($result)) {
                        echo '<option value="' . $consulta['id'] . '">' . substr($consulta['horaCita'], 0, 5) . '</option>';
                    }
                }
            } else {
                echo '<option value="">Sin disponibilidad.</option>';
            }
        }
    } else {
        echo '<option value="">Sin disponibilidad.</option>';
    }
}
