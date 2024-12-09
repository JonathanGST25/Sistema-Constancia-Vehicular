<?php
date_default_timezone_set('America/Mexico_City');
include("../conexion.php");

extract($_POST);

$fecha_solicitud = date('Y-m-d h:i:s');

$sql = "UPDATE Citas SET estatusPlataId = 1, fecha_sol_plata = '$fecha_solicitud'  WHERE citaId = '$citaId' AND delegacionId = '$delegacionId'";

$result = mysqli_query($conexion,$sql);

if($result){
    
    $sql = "UPDATE Citas SET estatusCitaId = 3 WHERE citaId = '$citaId' AND delegacionId = '$delegacionId'";

    $result = mysqli_query($conexion,$sql);

    if($result){

        $sql = "INSERT INTO Bit_Constancia(constanciaId,usuarioId,accion) VALUES ('$citaId', '$usuarioId', 'SOLICITAR INFORMACIÓN A PLATAFORMA MÉXICO')";
        $result = mysqli_query($conexion,$sql);

        if($result){
            echo 'Su solicitud ha sido enviada a Plataforma México';
        }
    }
}
