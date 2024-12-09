<?php

include("../conexion.php");

extract($_POST);

$sql = "SELECT descripcion FROM Citas, Catalogo_Plata_Reporte WHERE citaId = '$no_cita' AND Catalogo_Plata_Reporte.reportePlataId = Citas.reportePlataId";


$result = mysqli_query($conexion, $sql);

if($result){
    $mostrar = mysqli_fetch_array($result);

    echo $mostrar['descripcion'];
}

?>