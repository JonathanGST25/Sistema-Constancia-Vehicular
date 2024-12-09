<?php
session_start();
if ($_SESSION['usuarioId']) {
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="index.php";
    </script>';
}
include("./php/conexion.php");
$usuarioId = $_SESSION['usuarioId'];

//CONSULTAR NOMBRE DE USUARIO
$sql = "SELECT * FROM Usuarios WHERE usuarioId = '$usuarioId'";
$result = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($result);

$usuario = $mostrar['usuarioNombre'] . " " . $mostrar['usuarioPaterno'] . " " . $mostrar['usuarioMaterno'];

//CONSULTAR ROL USUARIO
$sql = "SELECT Catalogo_Roles_Usuarios.descripcion FROM Usuarios, Catalogo_Roles_Usuarios WHERE Usuarios.rolUsuarioId = Catalogo_Roles_Usuarios.rolUsuarioId AND Usuarios.usuarioId = '$usuarioId'";
$resultado = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($resultado);
$rolUsuario = $mostrar['descripcion'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Identificación Vehicular | FGE</title>
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/constancia.css" rel="stylesheet">
    <link href="./css/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <STYLE>
        A {
            text-decoration: none;
        }

        .tarjetas {
            transition: all 400ms ease;
        }

        .tarjetas:hover {
            transform: translateY(-3%);
        }

        .flex-fill {
            flex: 1 1 auto !important;
        }
    </STYLE>
    <div class="wrapper">
        <?php include("dash_mod.php") ?>

        <div class="main">
            <?php include("super_mod.php") ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="card">
                        <div class="card-body px-5">
                            <h5 style="color: #083577" class="text-center">Sistema de Constancia de Identificación Vehicular</h5>

                            <div class="alert alert-primary" role="alert">
                                <label style="font-size: 18px">La Fiscalía General del Estado de Guerrero se complace en presentar el Sistema de Constancia de Identificación Vehicular.</label>
                                <label style="font-size: 18px">Un servicio de vanguardia diseñado para llevar a cabo un riguroso Control de Citas en el proceso de obtención de la Constancia de Identificación Vehicular. Este módulo se ha creado con el firme propósito de brindar una gestión eficiente y transparente en la emisión de constancias vehiculares.</label>
                            </div>

                            <label style="font-size: 18px">Nuestro sistema ofrece:</label>

                            <div class="row mt-2" style="margin-bottom: 6rem;">
                                <!-- GESTIÓN DE SOLICITUDES A PLATAFORMA MÉXICO -->
                                <div class="col-xl-3 col-md-6 mb-4" style="display: flex !important;">
                                    <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #1460CF;">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <img src="./img/icons/solicitud.png">
                                                </div>
                                                <div class="col mr-2">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #1460CF;">Gestión de solicitudes</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN DE SOLICITUDES A PLATAFORMA MÉXICO -->

                                <!-- FILTRO DE SOLICITUDES -->
                                <div class="col-xl-3 col-md-6 mb-4" style="display: flex !important;">
                                    <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #11D37B;">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <img src="./img/icons/busqueda.png">
                                                </div>
                                                <div class="col mr-2">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #11D37B;">Filtro y búsqueda de solicitudes</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN FILTRO DE SOLICITUDES -->

                                <!-- FILTRO DE SOLICITUDES -->
                                <div class="col-xl-3 col-md-6 mb-4" style="display: flex !important;">
                                    <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #58151c;">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <img src="./img/icons/informe-vehicular.png">
                                                </div>
                                                <div class="col mr-2">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #58151c;">Informe de vehículos</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- FIN FILTRO DE SOLICITUDES -->

                            </div>

                            <!--<div class="alert alert-secondary col-xxl-4 float-end" role="alert" style="border: 1px solid blue; text-align: center;">
                                <label class="text-black text-center">Gestión de Solicitudes Plataforma México</label>
                            </div>-->


                            <div class="row" style="margin-top: 3rem;">

                                <div class="col-xxl-4">
                                </div>

                                <div class="col-xxl-4">
                                </div>

                                <div class="col-xxl-4">
                                    <div class="card float-end" style="width: 20rem; padding: 10px;">
                                        <img src="./img/photos/fiscalia_n.jpeg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold text-center" style="color:#052c65">FISCALIA GENERAL DEL ESTADO DE GUERRERO</h5>
                                        </div>
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
            $("#gestionPlataforma").addClass("active");
        }
    </script>
</body>


</html>