<?php

//INCLUIR CONEXIÓN
include('../conexion.php');

//EXTRAER VARIABLES QUE SE MANDAN
extract($_POST);

//CONSULTAR PARA RECUPERAR LA RESPUESTA DE PLATAFORMA MÉXICO DE UNA CITA
$sql = "SELECT Catalogo_Plata_Reporte.descripcion FROM Citas, Catalogo_Plata_Reporte WHERE Citas.reportePlataId = Catalogo_Plata_Reporte.reportePlataId AND Citas.citaId = '$no_cita'";
$result = mysqli_query($conexion, $sql);

if($result){
    $consulta = mysqli_fetch_array($result);

    //OBTENER RESPUESTA
    $descripcion = $consulta['descripcion'];

    echo $descripcion;
}

?>