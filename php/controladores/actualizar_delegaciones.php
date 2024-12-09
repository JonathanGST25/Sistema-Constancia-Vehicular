<?php

include("../conexion.php");

extract($_POST);

$sql = "UPDATE Delegaciones SET delegacionHoraInicioAtencion = '$inicio', delegacionHoraFinAtencion = '$fin', delegacionIntervaloTiempoAtencion = '$intervalo', 
delegacionCitasPorHorario = '$cantidad', delegacionFolioConstancia = '$folioConstancia', delegacionFolioCita = '$folioCitas', precioConstancia = '$costoUnitario' WHERE delegacionId = '$delegacionId'";

$result = mysqli_query($conexion, $sql);

if ($result) {
    echo 'Información registrada correctamente';
} else {
    echo 'Error al actualizar la información';
}

?>