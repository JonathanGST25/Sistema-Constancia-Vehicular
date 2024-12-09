<?php
include("../conexion.php");

$idMunicipio = $_REQUEST['municipioId'];

$sql = "SELECT localidadId, descripcion FROM Catalogo_Localidad WHERE municipioId = '$idMunicipio'";

//CONVERT TO UTF8
mysqli_set_charset($conexion, 'utf8');
$result = mysqli_query($conexion, $sql);

if($result){

    echo '<option value="">-- Seleccione --</option>';
    while($consulta = mysqli_fetch_array($result)){
        echo '<option value="'.$consulta['localidadId'].'">'.$consulta['descripcion'].'</option>';
    }

    
}

?>