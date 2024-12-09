<?php 

include("../conexion.php");

extract($_POST);


$sql = "UPDATE Citas SET estatusCitaId = 16, observaciones = '$observacionesCita' WHERE Citas.citaId = '$citaId'";

$result = mysqli_query($conexion,$sql);

if($result){

    $sql = "INSERT INTO Bit_Constancia(constanciaId,usuarioId,accion) VALUES ('$citaId', '$usuarioId', 'CANCELAR CITA')";
    $result = mysqli_query($conexion,$sql);

    if($result){
        echo 'La cita ha sido cancelada correctamente!';
    }
}
?>