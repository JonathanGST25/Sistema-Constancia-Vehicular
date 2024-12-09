<?php
session_start();
$delegacionId = 0;
if ($_SESSION['usuarioId']) {
    $delegacionId = $_SESSION['delegacionId'];
    $rol = $_SESSION['rolUsuario'];
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="./constancia.php";
    </script>';
}

//Comprobamos si esta definida la sesión 'tiempo'.
if (isset($_SESSION['tiempo'])) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 1200; //20min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if ($vida_session > $inactivo) {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("./index.php");

        exit();
    }
}
$_SESSION['tiempo'] = time();

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
    <link href="./css/constancia.css" rel="stylesheet">
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
                        <div class="card-body px-5 h-100">

                            <h5 style="color: #083577" class="text-center">Sistema de Constancia de Identificación Vehicular</h5>

                            <div class="alert alert-primary" role="alert">
                                <label style="font-size: 18px">La Fiscalía General del Estado de Guerrero se complace en presentar el Sistema de Constancia de Identificación Vehicular.</label>
                                <label style="font-size: 18px">Un servicio de vanguardia diseñado para llevar a cabo un riguroso Control de Citas en el proceso de obtención de la Constancia de Identificación Vehicular. Este módulo se ha creado con el firme propósito de brindar una gestión eficiente y transparente en la emisión de constancias vehiculares.</label>
                            </div>

                            <?php
                            if ($rol = $_SESSION['rolUsuario'] == 2) {
                            ?>

                                <div class="row mt-4" style="margin-bottom: 10rem;">
                                    <!-- GESTIÓN DE CITAS -->
                                    <div class="col-xxl-3 col-md-6 col-sm-12" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-2" style="border-left: 5px solid #1460CF;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <img src="./img/icons/gestion.png">
                                                    </div>
                                                    <div class="col mr-2">
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #1460CF; white-space: break-word;">Gestión<br> de citas</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN GESTIÓN CITAS -->

                                    <!-- FILTRADO DE CITAS -->
                                    <div class="col-xxl-3 col-md-6 col-sm-12" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #19D882;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <img src="./img/icons/filtro.png">
                                                    </div>
                                                    <div class="col mr-2">
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #19D882; white-space: break-word;">Filtrado y<br> búsqueda<br> de citas</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN FILTRADO DE CITAS -->

                                    <!-- ENVIO DE SOLICITUDES PLATAFORMA MÉXICO -->
                                    <div class="col-xxl-3 col-md-6 col-sm-12" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #FFD24D;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <img src="./img/icons/enviar-plataforma.png">
                                                    </div>
                                                    <div class="col mr-2">
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #FFD24D; white-space: break-word;">Envío de <br>datos a <br>Plataforma México</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN ENVIO DE PLATAFORMA MÉXICO -->

                                    <!-- GENERACIÓN DE CONSTANCIA VEHICULAR -->
                                    <div class="col-xxl-3 col-md-6 col-sm-12" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-2" style="border-left: 5px solid #F8384C;">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col-auto">
                                                        <img src="./img/icons/constancia.png">
                                                    </div>
                                                    <div class="col mr-2">
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #F8384C; white-space: break-word;">Expedición de <br>constancia vehicular</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- GENERACIÓN DE CONSTANCIA VEHICULAR -->

                                </div>

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
                            <?php
                            } else {
                            ?>
                                <div class="row mt-2" style="margin-bottom: 10rem;">
                                    <!-- CONFIGURACIÓN DE LA DELEGACIÓN -->
                                    <div class="col-xl-3 col-md-6" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #F8384C;">
                                            <div class="card-body">
                                                <a href="./delegaciones.php" style="text-decoration:none">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <img src="./img/icons/configuracion.png">
                                                        </div>
                                                        <div class="col mr-2">
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #F8384C;">Configuraciones generales</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN DE CONFIGURACIÓN DE DELEGACIÓN -->

                                    <!-- CONFIGURACIÓN DE HORARIOS -->
                                    <div class="col-xl-3 col-md-6" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #052c65;">
                                            <div class="card-body">
                                                <a href="./establecer_horarios.php" style="text-decoration:none">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <img src="./img/icons/horarios.png">
                                                        </div>
                                                        <div class="col mr-2">
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #052c65;">Establecer horarios de atención</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN DE CONFIGURACIÓN DE HORARIOS -->

                                    <!-- INHABILITAR DIAS DE ATENCIÓN -->
                                    <div class="col-xl-3 col-md-6" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #F4C121;">
                                            <div class="card-body">
                                                <a href="./inhabilitar_horarios.php" style="text-decoration:none">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <img src="./img/icons/deshabilitar-dias.png">
                                                        </div>
                                                        <div class="col mr-2">
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #F4C121;">Inhabilitar días de atención</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN DE INHABILITAR DIAS DE ATENCIÓN -->

                                    <!-- HABILITAR DIAS DE ATENCIÓN -->
                                    <div class="col-xl-3 col-md-6" style="display: flex !important;">
                                        <div class="flex-fill card tarjetas shadow h-70 py-1" style="border-left: 5px solid #11D37B;">
                                            <div class="card-body">
                                                <a href="./inhabilitar_horarios.php" style="text-decoration:none">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <img src="./img/icons/habilitar-dias.png">
                                                        </div>
                                                        <div class="col mr-2">
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: #11D37B;">Habilitar días de atención</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN DE HABILITAR DIAS DE ATENCIÓN -->
                                </div>

                                <!-- FOOTER -->
                                <div class="card float-end" style="width: 20rem;">
                                    <img src="./img/photos/fiscalia_n.jpeg" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text fw-bold text-center" style="color:#052c65">FISCALIA GENERAL DEL ESTADO DE GUERRERO</p>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

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
            $("#gestionCitas").addClass("active");
        }
    </script>
</body>


</html>