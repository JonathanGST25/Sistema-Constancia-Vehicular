<?php

//INCLUIR CONEXION
include('../conexion.php');

//EXTRAER VARIABLES QUE SE MANDAN
extract($_POST);

//CONSULTA PARA ACTUALIZAR EL ESTADO
$sql = "UPDATE Citas SET reportePlataId = '$respuestaPlataforma' WHERE Citas.citaId = '$citaId'";

$result = mysqli_query($conexion, $sql);

if($result){

    $sql = "UPDATE Citas SET estatusPlataId = 3 WHERE Citas.citaId = '$citaId'";

    $result = mysqli_query($conexion, $sql);

    if($result){

        $sql = "UPDATE Citas SET estatusCitaId = 4 WHERE Citas.citaId = '$citaId'";

        $result = mysqli_query($conexion, $sql);

        if($result){

            $sql = "INSERT INTO Bit_Constancia(constanciaId,usuarioId,accion) VALUES ('$citaId', '$usuarioId', 'RESPUESTA PLATAFORMA MEXICO')";
            $result = mysqli_query($conexion,$sql);
            
            if($result){
                //header('Location: ../../gestion_solicitudes_plataforma.php?estatus=1');
                echo 'El resultado de la solicitud fue enviada con exito.';
            }
        }
    }
}
