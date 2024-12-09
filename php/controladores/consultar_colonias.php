<?php

include("../conexion.php");

$cp = $_REQUEST['cp'];

//CONVERT TO UTF8
mysqli_set_charset($conexion, 'utf8');

$sql = "SELECT * FROM Catalogo_Colonia WHERE cp = '$cp'";

$result = mysqli_query($conexion, $sql);

if($result){

    echo '<option value="">-- Seleccione --</option>';
    while($consulta = mysqli_fetch_array($result)){
        echo '<option value="'.$consulta['coloniaId'].'">'.$consulta['descripcion'].'</option>';
    }  
}

?>