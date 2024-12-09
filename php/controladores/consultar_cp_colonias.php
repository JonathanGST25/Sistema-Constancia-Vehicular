<?php
include("../conexion.php");

$idMunicipio = $_REQUEST['municipioId'];

$sql = "SELECT cp FROM Catalogo_Colonia WHERE municipioId = '$idMunicipio' GROUP BY cp";

//CONVERT TO UTF8
mysqli_set_charset($conexion, 'utf8');
$result = mysqli_query($conexion, $sql);

if($result){

    echo '<option value="">-- Seleccione --</option>';
    while($consulta = mysqli_fetch_array($result)){
        if(is_numeric($consulta['cp'])){
            echo '<option value="'.$consulta['cp'].'">'.$consulta['cp'].'</option>';
        }
    }  
}

?>