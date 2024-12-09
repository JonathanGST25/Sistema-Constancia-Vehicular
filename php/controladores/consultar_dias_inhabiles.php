<?php

include('../conexion.php');

extract($_GET);

$sql = "SELECT COUNT(*) hasEvent FROM Catalogo_Dias_Extraordinarios WHERE fecha_extraordinaria = '$date' AND delegacionId = '$delegacionId'";

$result = mysqli_query($conexion, $sql);

if($result){

    $mostrar = mysqli_fetch_array($result);

    $eventCount = $mostrar['hasEvent'];

    echo $eventCount > 0 ? 'true' : 'false';

}

?>