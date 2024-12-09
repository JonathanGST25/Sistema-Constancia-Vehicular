<?php
include("../conexion.php");

$idDelegacion = $_POST['idDelegacion'];

$sql = "SELECT delegacionFolioCita FROM Delegaciones WHERE delegacionId = '$idDelegacion'";

$result = mysqli_query($conexion, $sql);

if($result){

    $consulta = mysqli_fetch_array($result);

    echo $consulta['delegacionFolioCita'];
    
}


?>