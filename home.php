<?php
session_start();
$delegacionId = 0;
if ($_SESSION['usuarioId']) {
    $delegacionId = $_SESSION['delegacionId'];
    $rol = $_SESSION['rolUsuario'];
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="./index.php";
    </script>';
}
include("./php/conexion.php");
$usuarioId = $_SESSION['usuarioId'];

//CONSULTAR USUARIO
$sql = "SELECT * FROM Usuarios WHERE usuarioId = '$usuarioId'";
$result = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($result);
$usuario = $mostrar['usuarioNombre'] . " " . $mostrar['usuarioPaterno'] . " " . $mostrar['usuarioMaterno'];

//CONSULTAR ROL USUARIO
$sql = "SELECT Catalogo_Roles_Usuarios.descripcion FROM Usuarios, Catalogo_Roles_Usuarios WHERE Usuarios.rolUsuarioId = Catalogo_Roles_Usuarios.rolUsuarioId AND Usuarios.usuarioId = '$usuarioId'";
$resultado = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($resultado);
$rolUsuario = $mostrar['descripcion'];

//CONSULTAR DELEGACION
$delegacion = "SELECT * FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$resultDelegacion = mysqli_query($conexion, $delegacion);
$consultaDelegacion = mysqli_fetch_array($resultDelegacion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Identificación Vehicular | FGE</title>
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/app.css" rel="stylesheet">
    <link href="./fullcalendar/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <STYLE>
        A {
            text-decoration: none;
        }

        fieldset,
        legend {
            all: revert;
        }

        .reset {
            all: revert;
        }
    </STYLE>
    <div class="wrapper">
        <?php include("dash_mod.php") ?>

        <div class="main">
            <?php include("super_mod.php") ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="card">
                        <div class="card-body px-5 m-auto">
                            <div class="card mb-3" style="width: 100%;">
                                <img src="./img/photos/fiscalia.jpeg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="alert alert-light" role="alert">
                                        <p class="text-secondary" style="font-size: 18px">La Fiscalía General del Estado de Guerrero, le ofrece el Sistema de Constancia de Identificación Vehicular.</p>
                                        <p class="text-secondary" style="font-size: 18px">El presente módulo tiene como objetivo llevar el Control de Citas para trámite de la Constancia de Identificación Vehicular.</p>
                                        <p class="text-secondary" style="font-size: 18px">El Sistema Ofrece:</p>
                                    </div>

                                    <div class="row mx-auto form-group">
                                        <div class="alert alert-warning col-xxl-3 text-center" role="alert" style="vertical-align: middle;">
                                            <label>Gestión de Citas</label>
                                        </div>
                                    </div>

                                    <div class="row mx-auto form-group">
                                        <div class="alert alert-primary col-xxl-3 text-center" role="alert">
                                            Búsqueda y Filtrado de Citas
                                        </div>
                                    </div>

                                    <div class="row mx-auto form-group">
                                        <div class="alert alert-success col-xxl-3 text-center" role="alert">
                                            Envío de Solicitudes a Plataforma México
                                        </div>
                                    </div>

                                    <div class="row mx-auto form-group">
                                        <div class="alert alert-secondary col-xxl-3 text-center" role="alert">
                                            Expedición de Constancia Vehicular.
                                        </div>
                                    </div>

                                    <div class="alert alert-secondary col-xxl-4 float-end" role="alert" style="border: 1px solid blue;">
                                        <label class="text-black">Delegacion: </label> <?php echo $consultaDelegacion['delegacionNombre'] ?><br>
                                        <label class="text-black">Dirección: </label> <?php echo $consultaDelegacion['delegacionDomicilio'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <div class="text-muted text-center text-secondary">
                Copyright © 2023 <br />
                Todos los derechos reservados
            </div>
        </div>

    </div>


    <script src="./js/app.js"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        window.onload = function() {
            $("#home").addClass("active");
        }
    </script>
</body>


</html>