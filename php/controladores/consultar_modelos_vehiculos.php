<?php

include("../conexion.php");

//RECUPERAR VALOR MANDADO DE LA MARCA DEL VEHICULO
$idMarca = $_REQUEST['marcaId'];

$sql = "SELECT * FROM Catalogo_Modelo WHERE marcaId = '$idMarca'";

//CONVERT TO UTF8
mysqli_set_charset($conexion, 'utf8');
$result = mysqli_query($conexion, $sql);

if($result){

    //REGRESAR UN OPTION PARA EL SELECTS
    while($consulta = mysqli_fetch_array($result)){
        echo '<option value="'.$consulta['modeloId'].'">'.$consulta['descripcion'].'</option>';
    }

    
}
?>