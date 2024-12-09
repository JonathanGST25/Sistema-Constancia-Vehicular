<?php

include("../conexion.php");

$paisId = $_REQUEST['paisId'];

$sql = "SELECT * FROM Catalogo_Estado WHERE paisId = '$paisId'";

//CONVERT TO UTF8
mysqli_set_charset($conexion, 'utf8');
$result = mysqli_query($conexion, $sql);

if($result){

    //REGRESAR UN OPTION PARA EL SELECTS
    while($consulta = mysqli_fetch_array($result)){
        echo '<option value="'.$consulta['estadoId'].'">'.$consulta['descripcion'].'</option>';
    }

    echo '<option value="0">OTRO</option>';
}
?>