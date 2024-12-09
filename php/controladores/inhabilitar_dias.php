<?php

include('../conexion.php');

extract($_POST);

if($bandera == 1){
    $sql = "INSERT INTO Catalogo_Dias_Extraordinarios(fecha_extraordinaria, delegacionId) VALUES ('$fecha','$delegacionId')";

    $result = mysqli_query($conexion, $sql);

    if($result){
        echo 'Día inhabilitado correctactamente.';
    }
}


if($bandera == 2){
    $sql = "DELETE FROM Catalogo_Dias_Extraordinarios WHERE fecha_extraordinaria = '$fecha' AND delegacionId = '$delegacionId'";

    $result = mysqli_query($conexion, $sql);

    if($result){
        echo 'Día habilitado correctamente';
    }
}
