<?php
session_start();
$delegacionId = 0;

//VERIFICAR QUE EXISTA UNA SESIÓN INICIADA
if ($_SESSION['usuarioId']) {
    $delegacionId = $_SESSION['delegacionId'];
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="index.php";
    </script>';
}

//REFERENCIA A LA CONEXIÓN
include("php/conexion.php");
$usuarioId = $_SESSION['usuarioId'];
$conexion->set_charset("utf8");

//CONSULTAR USUARIO
$sql = "SELECT * FROM Usuarios WHERE usuarioId = '$usuarioId'";
$result = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($result);

$usuario = $mostrar['usuarioNombre'] . " " . $mostrar['usuarioPaterno'] . " " . $mostrar['usuarioMaterno'];

//CONSULTAR EL ROL DEL USUARIO
$sql = "SELECT Catalogo_Roles_Usuarios.descripcion FROM Usuarios, Catalogo_Roles_Usuarios WHERE Usuarios.rolUsuarioId = Catalogo_Roles_Usuarios.rolUsuarioId AND Usuarios.usuarioId = '$usuarioId'";
$resultado = mysqli_query($conexion, $sql);
$mostrar = mysqli_fetch_array($resultado);
$rolUsuario = $mostrar['descripcion'];

//CONSULTAR DELEGACIÓN
$delegacion = "SELECT * FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$resultDelegacion = mysqli_query($conexion, $delegacion);
$consultaDelegacion = mysqli_fetch_array($resultDelegacion)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/constancia.css" rel="stylesheet">
    <link href="./fullcalendar/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./js/javascript/jquery-ui.css">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <title>Constancia de Identificación Vehicular | FGE</title>
</head>

<body>
    <STYLE>
        A {
            text-decoration: none;
        }

        .css-class-to-highlight {
            background: blue;
            color: black;
            font: bold;
        }
    </STYLE>
    <div class="wrapper">
        <?php include("dash_mod.php") ?>
        <div class="main">
            <?php include("super_mod.php") ?>
            <main class="content">
                <div class="container-fluid p-0 col-10">
                    <div class="card">
                        <div class="card-body px-4">
                            <div class="alert alert-primary" role="alert">
                                Delegacion: <?php echo $consultaDelegacion['delegacionNombre'] ?>
                            </div>
                            <form action="" class="needs-validation" novalidate id="formulario_delegacion">
                                <div class="row mt-3 mx-auto form-group">
                                    <h5>Indicar la información correspondiente a la delegación, para su debido registro.</h5>
                                    <h6 class="text-secondary">Información de los horarios de atención</h6>
                                    <input value="<?php echo $_SESSION['delegacionId'] ?>" hidden name="delegacionId" id="delegacionId">

                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label for="horaInicio" class="form-label"> Hora de inicio</label>
                                        <input id="horaInicio" class="col-lg-4 col-sm-12 form-control" type="time" name="horaInicio" min="01:00" max="24:00" value="<?php echo $consultaDelegacion['delegacionHoraInicioAtencion'] ?>" required />
                                        <div class="invalid-feedback">
                                            Favor de seleccionar un horario.
                                        </div>
                                    </div>


                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label for="horaFin" class="form-label"> Hora de fin</label>
                                        <input id="horaFin" class="col-lg-4 col-sm-12 form-control" type="time" name="horaFin" min="01:00" max="24:00" value="<?php echo $consultaDelegacion['delegacionHoraFinAtencion'] ?>" required />
                                        <div class="invalid-feedback">
                                            Favor de seleccionar un horario.
                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label for="intervaloCita" class="form-label"> Seleccionar intervalo de atención</label>
                                        <select class="form-control form-select" id="intervaloCita" name="intervaloCita" required>
                                            <option value="<?php echo $consultaDelegacion['delegacionIntervaloTiempoAtencion'] ?>"><?php echo $consultaDelegacion['delegacionIntervaloTiempoAtencion'] ?></option>
                                            <option value="00:10:00">00:10:00</option>
                                            <option value="00:15:00">00:15:00</option>
                                            <option value="00:20:00">00:20:00</option>
                                            <option value="00:25:00">00:25:00</option>
                                            <option value="00:30:00">00:30:00</option>
                                            <option value="00:35:00">00:35:00</option>
                                            <option value="00:40:00">00:40:00</option>
                                            <option value="00:45:00">00:45:00</option>
                                            <option value="00:50:00">00:50:00</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Favor de seleccionar un intervalo.
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3 mx-auto form-group">

                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label for="cantidadCitas" class="form-label">Número de citas por intervalo</label>
                                        <select class="form-control form-select" id="cantidadCitas" name="cantidadCitas" required>
                                            <option value="<?php echo $consultaDelegacion['delegacionCitasPorHorario'] ?>"><?php echo $consultaDelegacion['delegacionCitasPorHorario'] ?></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Favor de seleccionar una cantidad.
                                        </div>
                                    </div>

                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label for="folioConstancia" class="form-label">Folio actual de las Constancias</label>
                                        <input id="folioConstancia" class="col-xxl-4 col-md-6 col-sm-12 form-control" type="text" name="folioConstancia" required value="<?php echo $consultaDelegacion['delegacionFolioConstancia'] ?>" style="background-color: #FDFAEE !important;" readonly/>
                                        <div class="invalid-feedback">
                                            Favor de ingresar un número de folio.
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-4">
                                        <label for="folioCitas" class="form-label">Folio actual de las Citas</label>
                                        <input id="folioCitas" class="col-xxl-4 col-md-6 col-sm-12 form-control" type="text" name="folioCitas" required value="<?php echo $consultaDelegacion['delegacionFolioCita'] ?>" style="background-color: #FDFAEE !important;" readonly />
                                        <div class="invalid-feedback">
                                            Favor de ingresar un número de folio.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 mx-auto form-group">
                                    <h6 class="text-secondary">Configuración de Constancia de Identificación Vehicular</h6>
                                    <div class="col-xxl-4 col-md-6 col-sm-12">
                                        <label form="costoConstancia" class="form-label">Costo unitario:</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">$</span>
                                            <input class="col-xxl-4 col-md-6 col-sm-12 form-control" type="number" name="costoConstancia" id="costoConstancia" required value="<?php echo $consultaDelegacion['precioConstancia'] ?>">
                                        </div>
                                        <div class="invalid-feedback">
                                            Favor de asignar un costo.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3 mb-3 mx-auto form-group align-items-center">
                                    <div class="mt-3 col-xxl-12 col-md-12 col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary col-xxl-3 col-md-4 col-sm-12" style="padding: 8px;">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./js/app.js"></script>
    <script src="./js/fuctions.js"></script>
    <script src="./js/javascript/3.6.1/jquery.min.js"></script>
    <script src="./js/javascript/3.2.1/jquery.min.js"></script>
    <script src="./js/javascript/jquery-ui.js"></script>
    <script src="./sweetalert/sweetalert2@11.js"></script>
        <!--<script src="./js/jquery-3.6.0.min.js"></script>-->
    <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
</body>

</html>