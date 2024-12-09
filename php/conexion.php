<?php
$server ="localhost";
$user = "root";
$password= "199925";
$db = "fge_constancia_vhclo";

$conexion = new mysqli($server,$user,$password,$db);

if($conexion->connect_errno){
    die("La conexión ha fallado".$conexion->connect_errno);
}

//CREDENCIALES
//10.1.83.122
//sistemasdgti
//BDS157EM23
//FGE_cnstncia_vhclo
?>