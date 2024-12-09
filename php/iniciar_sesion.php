<?php

include("./conexion.php");

$user = $_REQUEST['usuario'];
$password = $_REQUEST['password'];

$sql = "SELECT * FROM Usuarios";
$result = mysqli_query($conexion,$sql);

$bandera = FALSE;

if($result){
    while($consulta = mysqli_fetch_array($result)){
        if($user == $consulta['usuario'] && $password == $consulta['passwrd']){
            session_start(); 
            $_SESSION['usuarioId']=$consulta['usuarioId'];
            $_SESSION['delegacionId']=$consulta['delegacionId'];
            $_SESSION['rolUsuario']=$consulta['rolUsuarioId'];
            $bandera = TRUE;
            $rolUsuarioId = $consulta['rolUsuarioId'];
        }
    }

    if($bandera){     

        if($rolUsuarioId == 1 || $rolUsuarioId == 2){
            header('Location: ../gestionCitas.php');
        }else if($rolUsuarioId == 3 ){
            header('Location: ../gestionPlataforma.php');
        }
    }else{
        header('Location: ../constancia.php?login=false');
    }

}else{
    header('Location: ../constancia.php?login=false');
}

?>