<?php

include("../conexion.php");

extract($_POST);

$sql = "SELECT reportePlataId FROM Citas WHERE citaId = '$no_cita'";

$result = mysqli_query($conexion, $sql);

if($result){
    $mostrar = mysqli_fetch_array($result);

    echo $mostrar['reportePlataId'];
}

?>