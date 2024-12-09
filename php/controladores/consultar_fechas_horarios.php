<?php
include("../conexion.php");

$delegacionId = $_POST['idDelegacion'];

$sql = "SELECT fechaCita FROM Catalogo_Periodos, Catalogo_Horarios WHERE Catalogo_Periodos.delegacionId = '$delegacionId' AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND fechaCita BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) GROUP BY fechaCita";

$result = mysqli_query($conexion, $sql);

if($result){

    $arreglo = [];
    while($consulta = mysqli_fetch_array($result)){
        array_push($arreglo, $consulta['fechaCita']);
    }

    print_r (json_encode($arreglo));
}

?>