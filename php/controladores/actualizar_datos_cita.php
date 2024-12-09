<?php

//INCLUIR CONEXIÓN
include('../conexion.php');

//EXTRAER DATOS DEL METODOS POST
extract($_POST);

//CONSULTAR LA CITA REFERENCIADA
$sql = "SELECT * FROM Citas WHERE Citas.citaId = '$citaIdModal' AND Citas.delegacionId = '$delegacionIdModal'";

$result = mysqli_query($conexion,$sql);

if($result){

    $mostrar = mysqli_fetch_array($result);
    //OBTENER VEHICULO A ACTUALIZAR
    $vehiculoId = $mostrar['vehiculoId'];

    $sql = "UPDATE Vehiculos SET numeroSerie = '$serieVinVehiculoModal', numeroPlacas = '$placasVehiculoModal', numeroMotor = '$numeroMotorVehiculoModal' WHERE Vehiculos.vehiculoId = '$vehiculoId'";

    $result = mysqli_query($conexion,$sql);

    if($result){
        echo 'La información de la cita ha sido actualizada correctamente';
    }else{
        echo 'Erro al actualizar la información de la cita';
    }
}else{
    echo 'Erro al actualizar la información de la cita';
}




?>