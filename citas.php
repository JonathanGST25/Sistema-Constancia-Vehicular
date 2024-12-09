<?php
//INCLUIR CONEXIÓN
include("./php/conexion.php");
mysqli_set_charset($conexion, 'utf8');
//CONSULTAS PARA LLENAR LOS SELECTS CON INFORMACIÓN
$colores = "SELECT * FROM Catalogo_Color";
$resultColores = mysqli_query($conexion, $colores);

$municipios = "SELECT * FROM Catalogo_Municipio WHERE estadoId = 12";
$resultMunicipios = mysqli_query($conexion, $municipios);

$marcaVehiculo = "SELECT * FROM Catalogo_Marca";
$resultMarcaVehiculo = mysqli_query($conexion, $marcaVehiculo);

$paises = "SELECT * FROM Catalogo_Pais";
$resultPaises = mysqli_query($conexion, $paises);

$estados = "SELECT * FROM Catalogo_Estado";
$resultEstado = mysqli_query($conexion, $estados);

$tipoVehiculo = "SELECT * FROM Catalogo_Tipo";
$resultTipoVeh = mysqli_query($conexion, $tipoVehiculo);

$anioVehiculo = "SELECT * FROM Catalogo_Anio";
$resultAnioVeh = mysqli_query($conexion, $anioVehiculo);

$claseVehiculo = "SELECT * FROM Catalogo_Clase";
$resultClaseVeh = mysqli_query($conexion, $claseVehiculo);

$cilindrajeVehiculo = "SELECT * FROM Catalogo_Cilindraje";
$resultCilindrajeVeh = mysqli_query($conexion, $cilindrajeVehiculo);

$idDelegacion = 0;
if ($_REQUEST['idDelegacion'] != "") {
    $idDelegacion = $_REQUEST['idDelegacion'];

    $conexion->set_charset("utf8");
    $sql = "SELECT * FROM Delegaciones WHERE delegacionId = '$idDelegacion'";

    $result = mysqli_query($conexion, $sql);

    $delegacion = "SELECT * FROM Delegaciones WHERE delegacionId = '$idDelegacion'";
    $resultDelegacion = mysqli_query($conexion, $delegacion);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="http://noantecedentespenales.guerrero.gob.mx:8075/citas/images/logo_fiscalia.ico">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<script src="https://kit.fontawesome.com/d7dee1abd2.js" crossorigin="anonymous"></script>-->
    <script src="./css/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/locale/es.min.js"></script>
    <link href="./style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/locale/es.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Servicio de citas para la Constancia de Identificación Vehicular - Site</title>
</head>

<body>
    <STYLE>
        A {
            text-decoration: none;
        }

        .css-class-to-highlight a {
            background-color: #1478F7 !important;
            border-color: #014799;
            color: white !important;
        }
    </STYLE>
    <div class="container-fluid">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <img src="./img/logo_fiscalia.png" style="width: 100px; display: inline-block" />
                    <br />
                    <div style="display: inline-block">
                        <h2 style="color: #014799; font-weight: 1000">
                            FISCALÍA GENERAL
                        </h2>
                        <h4 style="color: #014799; font-weight: bold">
                            DEL ESTADO DE GUERRERO
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div id="content">
                <div class="container">
                    <!-- INFORMACIÓN -->
                    <br />
                    <h3 class="text-center">
                        Trámite de cita para CONSTANCIA DE IDENTIFICACIÓN VEHICULAR
                    </h3>
                    <br />
                    <input hidden type="text" name="deleg" id="deleg" value="<?php echo $_REQUEST['idDelegacion'] ?>">
                    <?php
                    if ($result) {
                        while ($consulta = mysqli_fetch_array($result)) {
                    ?>
                            <h5 style="font-weight: bold;"><?php echo $consulta['delegacionNombre'] ?></h5>
                            <h5>Dirección: <?php echo $consulta['delegacionDomicilio'] ?></h5>
                    <?php
                        }
                    }
                    ?>
                    </br>
                    <p>Los campos marcados con <span class="text-danger">*</span> son obligatorios.</p>
                    <?php
                    if (isset($_GET['banderaCita']) && $_GET['banderaCita'] == "false") {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <strong>Información:</strong>
                            Estimado (a): <?php echo $_GET['nombreSolicitante'] ?>, usted ya cuenta con una cita registrada para el vehículo con: No. de serie <?php echo $_GET['numeroSerie'] ?>,
                            No. de placas <?php echo $_GET['numeroPlacas'] ?> y No. de motor <?php echo $_GET['numeroMotor'] ?>. Se podrá realizar el trámite de una nueva cita un día después de la fecha de la cita registrada.
                            <br>
                            <a href="php/acusecitacp.php?curpActor=<?php echo $_GET['curpSolicitante'] ?>&delegacionId=<?php echo $_GET['idDelegacion'] ?>&numeroSerie=<?php echo $_GET['numeroSerie'] ?>&numeroPlacas=<?php echo $_GET['numeroPlacas'] ?>&numeroMotor=<?php echo $_GET['numeroMotor'] ?>" target="_blank" style="text-decoration-line: underline;"> Volver a descargar acuse</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; border-color: #bee5eb;">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                                <use xlink:href="#info-fill" />
                            </svg>
                            <strong>Importante:</strong>
                            Los datos deben ser ingresados cuidadosamente, verificando que la información sea la correcta.
                        </div>
                    <?php
                    }
                    ?>

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </symbol>
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                        </symbol>
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </symbol>
                    </svg>

                    <!-- FIN INFORMACIÓN -->
                    <!-- data-bs-toggle="tab" -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="solicitante-tab" data-bs-target="#solicitante-tab-pane" type="button" role="tab" aria-controls="solicitante-tab-pane" aria-selected="true">SOLICITANTE</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="propietario-tab" data-bs-target="#propietario-tab-pane" type="button" role="tab" aria-controls="propietario-tab-pane" aria-selected="false" hidden>PROPIETARIO</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="vehiculo-tab" data-bs-target="#vehiculo-tab-pane" type="button" role="tab" aria-controls="vehiculo-tab-pane" aria-selected="false" hidden>VEHÍCULO</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cita-tab" data-bs-target="#cita-tab-pane" type="button" role="tab" aria-controls="cita-tab-pane" aria-selected="false" hidden> INFORMACIÓN CITA</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- MENU SOLICITANTE -->
                        <div class="tab-pane fade show active" id="solicitante-tab-pane" role="tabpanel" aria-labelledby="solicitante-tab" tabindex="0">

                            <form action="" class="needs-validation" novalidate id="formulario_solicitante" name="formulario_solicitante">
                                <!-- DATOS SOLICITANTE -->
                                <div class="row" style="margin-top: 10px">
                                    <div class="h5 text-secondary">
                                        SOLICITANTE <span class="text-secondary" style="font-size: 16px;">(Datos de la persona que presentará con el vehículo).</span>
                                    </div>
                                    <div class="col-sm-3 form-group contenedor">
                                        <br class="hidden-xs">
                                        <p class="h4" style="color: #800000;"><i class="fa fa-user"></i> Datos personales</p>
                                    </div>

                                    <div class="col-sm-9 contenedorB" style="border-left: 1px solid #cccccc">
                                        <div class="row form-group">

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="nombreSolicitante">Nombre(s) <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" data-val="true" id="nombreSolicitante" maxlength="60" name="nombreSolicitante" type="text" value="" onkeypress="isText()" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su nombre.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="apellidoPaSolicitante">Apellido Paterno <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="apellidoPaSolicitante" maxlength="20" name="apellidoPaSolicitante" onkeypress="isText()" type="text" value="" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su apellido paterno.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="apellidoMaSolicitante">Apellido Materno <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="apellidoMaSolicitante" maxlength="20" name="apellidoMaSolicitante" onkeypress="isText()" type="text" value="" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su apellido materno.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="curpSolicitante">CURP <span class="text-danger">*</span></label>
                                                <input autocomplete="off" class="form-control" style="text-transform:uppercase;" id="curpSolicitante" minlength="18" maxlength="18" name="curpSolicitante" type="text" value="" required>
                                                <div class="invalid-feedback" pattern="^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$" title="La CURP se conforma por: 1 caracter carácter alfabético del primer apellido, 1 vocal no inicial del primer apellido, 1 carácter alfabético del segundo apellido, 1 carácter alfabético del primer nombre, 2 últimos dígitos del año de nacimiento, 2 dígitos del mes de nacimiento, 2 dígitos del día de nacimiento, 1 carácter H o M, 2 caracteres alfabeticos correspondiente a la clave de la entidad federativa de nacimiento, 1 consonante no inicial del primer apellido, 1 consonante no inicial del segundo apellido, 1 consonante no inicial del nombre, 2 dígitos para evitar duplicidades">
                                                    Favor de ingresar su CURP (18 caracteres).
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-8">
                                                <label for="rfcSolicitante">RFC <span class="text-danger">*</span></label>
                                                <input autocomplete="off" class="form-control" style="text-transform:uppercase;" data-val="true" id="rfcSolicitante" minlength="12" maxlength="13" name="rfcSolicitante" type="text" value="" required pattern="^(((?!(([CcKk][Aa][CcKkGg][AaOo])|([Bb][Uu][Ee][YyIi])|([Kk][Oo](([Gg][Ee])|([Jj][Oo])))|([Cc][Oo](([Gg][Ee])|([Jj][AaEeIiOo])))|([QqCcKk][Uu][Ll][Oo])|((([Ff][Ee])|([Jj][Oo])|([Pp][Uu]))[Tt][Oo])|([Rr][Uu][Ii][Nn])|([Gg][Uu][Ee][Yy])|((([Pp][Uu])|([Rr][Aa]))[Tt][Aa])|([Pp][Ee](([Dd][Oo])|([Dd][Aa])|([Nn][Ee])))|([Mm](([Aa][Mm][OoEe])|([Ee][Aa][SsRr])|([Ii][Oo][Nn])|([Uu][Ll][Aa])|([Ee][Oo][Nn])|([Oo][Cc][Oo])))))[A-Za-zñÑ&][aeiouAEIOUxX]?[A-Za-zñÑ&]{2}(((([02468][048])|([13579][26]))0229)|(\d{2})((02((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))31)))[a-zA-Z1-9]{2}[\dAa])|([Xx][AaEe][Xx]{2}010101000))$" title="El RFC se conforma por: 3 o 4 caracteres del nombre o razon social, 2 digitos del año nacimiento, 2 digitos del mes nacimiento, 2 digitos del dia nacimiento, 3 caracteres que conforman la homoclave">
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su RFC (13 caracteres).
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-8" style="position:relative;">
                                                <label style="margin-top: 25px; line-height: 16px;">
                                                    <input id="opcionPropietario" name="opcionPropietario" type="checkbox">
                                                    <input name="opcionPropietario" type="hidden" value="false"> Si usted es el propietario del vehículo a presentar, marque esta opción.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <!-- DOMICILIO SOLICITANTE-->
                                <div class="row panelAddressData">
                                    <div class="col-sm-3 form-group contenedor">
                                        <br class="hidden-xs">
                                        <p class="h4" style="color: #800000;"><i class="fa fa-map-marker"></i> Domicilio</p>
                                    </div>
                                    <div class="col-sm-9 contenedorB" style="border-left: 1px solid #cccccc">

                                        <div class="row form-group">
                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="calleSolicitante">Calle <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" data-val="true" id="calleSolicitante" required maxlength="50" name="calleSolicitante" type="text" value="">
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el nombre de su calle.
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="numeroExterior">Número Exterior <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" data-val="true" id="numeroExterior" maxlength="7" name="numeroExterior" type="text" value="" onkeypress="return isNumber(event)" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el número exterior.
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="numeroInterior">Número Interior</label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="numeroInterior" maxlength="5" name="numeroInterior" type="text" value="" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>

                                        <div class="row form-group">

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="municipioSolicitante">Municipio <span class="text-danger">*</span></label>
                                                <select required class="form-select panel-address text-align-left" data-val="true" id="municipioSolicitante" name="municipioSolicitante">
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultMunicipios) {
                                                        while ($consultaMunicipios = mysqli_fetch_array($resultMunicipios)) {
                                                    ?>
                                                            <option value="<?php echo $consultaMunicipios['municipioId'] ?>"><?php echo $consultaMunicipios['descripcion'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar un opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="localidadSolicitante">Localidad <span class="text-danger">*</span></label>
                                                <input id="localidad" name="TownName" type="hidden" value="">
                                                <select class="form-select panel-address text-align-left" data-val="true" required id="localidadSolicitante" name="localidadSolicitante">
                                                    <option selected="selected" value="">-- Seleccione --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar un opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="codigoPostal">C.P. <span class="text-danger">*</span></label>
                                                <select class="form-select panel-address text-align-left" data-val="true" id="codigoPostal" name="codigoPostal" style="margin-left:-2px;  border-radius: 3px;" required>
                                                    <option selected="selected" value="">-- Seleccione --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                        Favor de seleccionar un opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-4 col-sm-6">
                                                <label for="coloniaSolicitante">Colonia <span class="text-danger">*</span></label>
                                                <select class="form-select panel-address text-align-center" id="coloniaSolicitante" name="coloniaSolicitante" required>
                                                    <option selected="selected" value="">-- Seleccione --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar un opción.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                </br>
                                <center>
                                    <button type="submit" class="btn btn-primary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnSolicitante">Siguiente &gt;</button>
                                </center>
                                <!-- FIN DATOS SOLICITANTE -->
                            </form>
                        </div>
                        <!-- FIN MENU SOLICITANTE -->

                        <!-- MENU PROPIETARIO -->
                        <div class="tab-pane fade" id="propietario-tab-pane" role="tabpanel" aria-labelledby="propietario-tab" tabindex="0">
                            <!-- DATOS DEL PROPIETARIO -->
                            <form action="" class="needs-validation" novalidate id="formulario_propietario">
                                <div class="row" style="margin-top: 10px">
                                    <div class="h5 text-secondary">
                                        PROPIETARIO <span class="text-secondary" style="font-size: 16px;">(Información que contiene la factura).</span>
                                    </div>
                                    <div class="col-sm-3 form-group contenedor">
                                        <br class="hidden-xs">
                                        <p class="h4" style="color: #800000;"><i class="fa fa-user"></i> Datos propietario</p>
                                    </div>

                                    <div class="col-sm-9 contenedorB" style="border-left: 1px solid #cccccc">
                                        <div class="row form-group">
                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="tipoPersona">Tipo de Persona <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="tipoPersona" name="tipoPersona" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <option value="FISICA">FISICA</option>
                                                    <option value="MORAL">MORAL</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar una opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="nombrePropietario">Nombre(s) o Razón Social <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" data-val="true" id="nombrePropietario" maxlength="60" name="nombrePropietario" type="text" value="" onkeypress="isText()" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el nombre.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="apellidoPaPropietario">Apellido Paterno<span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="apellidoPaPropietario" maxlength="20" name="apellidoPaPropietario" onkeypress="isText()" type="text" value="" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su apellido paterno.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="apellidoMaPropietario">Apellido Materno <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="apellidoMaPropietario" maxlength="20" name="apellidoMaPropietario" onkeypress="isText()" type="text" value="" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su apellido materno.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="curpPropietario">CURP <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" id="curpPropietario" minlength="18" maxlength="18" name="curpPropietario" type="text" value="" pattern="^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM]{1}(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$" title="La CURP se conforma por: 1 caracter carácter alfabético del primer apellido, 1 vocal no inicial del primer apellido, 1 carácter alfabético del segundo apellido, 1 carácter alfabético del primer nombre, 2 últimos dígitos del año de nacimiento, 2 dígitos del mes de nacimiento, 2 dígitos del día de nacimiento, 1 carácter H o M, 2 caracteres alfabeticos correspondiente a la clave de la entidad federativa de nacimiento, 1 consonante no inicial del primer apellido, 1 consonante no inicial del segundo apellido, 1 consonante no inicial del nombre, 2 dígitos para evitar duplicidades" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su CURP (18 caracteres).
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-">
                                                <label for="rfcPropietario">RFC <span class="text-danger">*</span></label>
                                                <input autocomplete="off" style="text-transform:uppercase;" class="form-control" data-val="true" id="rfcPropietario" minlength="12" maxlength="13" name="rfcPropietario" type="text" value="" pattern="^(((?!(([CcKk][Aa][CcKkGg][AaOo])|([Bb][Uu][Ee][YyIi])|([Kk][Oo](([Gg][Ee])|([Jj][Oo])))|([Cc][Oo](([Gg][Ee])|([Jj][AaEeIiOo])))|([QqCcKk][Uu][Ll][Oo])|((([Ff][Ee])|([Jj][Oo])|([Pp][Uu]))[Tt][Oo])|([Rr][Uu][Ii][Nn])|([Gg][Uu][Ee][Yy])|((([Pp][Uu])|([Rr][Aa]))[Tt][Aa])|([Pp][Ee](([Dd][Oo])|([Dd][Aa])|([Nn][Ee])))|([Mm](([Aa][Mm][OoEe])|([Ee][Aa][SsRr])|([Ii][Oo][Nn])|([Uu][Ll][Aa])|([Ee][Oo][Nn])|([Oo][Cc][Oo])))))[A-Za-zñÑ&][aeiouAEIOUxX]?[A-Za-zñÑ&]{2}(((([02468][048])|([13579][26]))0229)|(\d{2})((02((0[1-9])|1\d|2[0-8]))|((((0[13456789])|1[012]))((0[1-9])|((1|2)\d)|30))|(((0[13578])|(1[02]))31)))[a-zA-Z1-9]{2}[\dAa])|([Xx][AaEe][Xx]{2}010101000))$" title="El RFC se conforma por: 4 caracteres del nombre o razon social, 2 digitos del año nacimiento, 2 digitos del mes nacimiento, 2 digitos del dia nacimiento, 3 caracteres que conforman la homoclave" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar su RFC (12 o 13 caracteres).
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                </br>
                                <center>
                                    <button type="button" class="btn btn-secondary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnRegresarSolicitante">&lt; Anterior</button>
                                    <button type="submit" class="btn btn-primary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnPropietario">Siguiente &gt;</button>
                                </center>
                            </form>
                            <!-- FIN DATOS DEL PROPIETARIO -->
                        </div>
                        <!-- FIN MENU PROPIETARIO-->

                        <!-- MENU VEHICULO -->
                        <div class="tab-pane fade" id="vehiculo-tab-pane" role="tabpanel" aria-labelledby="vehiculo-tab" tabindex="0">
                            <!-- DATOS DEL VEHÍCULO -->
                            <form action="" class="needs-validation" novalidate id="formulario_vehiculo">
                                <br>
                                <div class="row panelAddressData">
                                    <div class="col-sm-3 form-group contenedor">
                                        <br class="hidden-xs">
                                        <p class="h4 blue-title" style="color: #800000;"><i class="fa fa-car" aria-hidden="true"></i> Datos del vehículo</p>
                                    </div>
                                    <div class="col-sm-9 contenedorB" style="border-left: 1px solid #cccccc">
                                        <div class="row form-group">

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="marca">Marca <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="marca" name="marca" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultMarcaVehiculo) {
                                                        while ($consultaMarcaVehiculo = mysqli_fetch_array($resultMarcaVehiculo)) {
                                                    ?>
                                                            <option value="<?php echo $consultaMarcaVehiculo['marcaId'] ?>"><?php echo $consultaMarcaVehiculo['descripcion'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar una opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="modelo">Modelo <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="modelo" name="modelo" required>
                                                    <option selected="selected" value="">-- Seleccione --</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el modelo del vehículo.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="tipo">Tipo <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="tipo" name="tipo" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultTipoVeh) {
                                                        while ($consultaTipoVeh = mysqli_fetch_array($resultTipoVeh)) {
                                                    ?>
                                                            <option value="<?php echo $consultaTipoVeh['tipoId'] ?>"><?php echo $consultaTipoVeh['descripcion'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el tipo del vehículo.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="año">Año modelo <span style="color: red;">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="año" name="año" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultAnioVeh) {
                                                        while ($consultaAnioVeh = mysqli_fetch_array($resultAnioVeh)) {
                                                    ?>
                                                            <option value="<?php echo $consultaAnioVeh['anioId'] ?>"><?php echo $consultaAnioVeh['anio'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar una opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="clase">Clase <span style="color: red;">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="clase" name="clase" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultClaseVeh) {
                                                        while ($consultaClaseVeh = mysqli_fetch_array($resultClaseVeh)) {
                                                    ?>
                                                            <option value="<?php echo $consultaClaseVeh['claseId'] ?>"><?php echo $consultaClaseVeh['clase'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de seleccionar una opción.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="color">Color</label>
                                                <input autocomplete="off" class="form-control" data-val="true" id="color" style="text-transform:uppercase;" onkeypress="isText()" name="color" type="text">
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="serie">Serie VIN <span class="text-danger">*</span></label>
                                                <input autocomplete="off" class="form-control" data-val="true" id="serie" maxlength="17" minlength="7" style="text-transform:uppercase;" name="serie" type="text" value="" pattern="[A-Za-z0-9]+" title="El número de serie solo debe contener números y letras" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el número de serie.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="placas">Placas <span class="text-danger">*</span></label>
                                                <input autocomplete="off" class="form-control" data-val="true" id="placas" style="text-transform:uppercase;" maxlength="17" minlength="7" name="placas" type="text" value="" pattern="[A-Za-z0-9]+" title="El número de placas solo debe contener números y letras" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el número de placas.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="motor">Número de motor <span class="text-danger">*</span></label>
                                                <input autocomplete="off" class="form-control" data-val="true" id="motor" maxlength="17" minlength="10" style="text-transform:uppercase;" name="motor" type="text" value="" pattern="[A-Za-z0-9]+" title="El número de motor solo debe contener números y letras" required>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el número de motor.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="pais">País de origen <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="pais" name="pais" required>
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultPaises) {
                                                        while ($consultaPaises = mysqli_fetch_array($resultPaises)) {
                                                    ?>
                                                            <option value="<?php echo $consultaPaises['paisId'] ?>"><?php echo $consultaPaises['descripcion'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el país de origen.
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="cilindraje">Cilindraje</label>
                                                <input autocomplete="off" class="form-control" data-val="true" id="cilindraje" style="text-transform:uppercase;" name="cilindraje" type="text">
                                            </div>

                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label for="entidadEmplaco">Entidad que emplacó <span class="text-danger">*</span></label>
                                                <select class="form-select text-align-left" data-val="true" id="entidadEmplaco" name="entidadEmplaco">
                                                    <option value="">-- Seleccione --</option>
                                                    <?php
                                                    if ($resultEstado) {
                                                        while ($consultaEstados = mysqli_fetch_array($resultEstado)) {
                                                    ?>
                                                            <option value="<?php echo $consultaEstados['estadoId'] ?>"><?php echo $consultaEstados['descripcion'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor de ingresar el estado de origen.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                </br>
                                <center>
                                    <button type="button" class="btn btn-secondary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnRegresarPropietario">&lt; Anterior</button>
                                    <button type="submit" class="btn btn-primary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnVehiculo">Siguiente &gt;</button>
                                </center>
                            </form>
                            <!-- FIN DATOS DEL VEHÍCULO -->
                        </div>
                        <!-- FIN MENU VEHICULO -->

                        <!-- INFORMACION DE LA CITA -->
                        <div class="tab-pane fade" id="cita-tab-pane" role="tabpanel" aria-labelledby="cita-tab" tabindex="0">
                            <!-- TRAMITE -->
                            <input type="text" hidden value="<?php echo $idDelegacion ?>" id="idDelegacion">
                            <form action="" class="needs-validation" novalidate id="formulario_cita">
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-sm-3 form-group contenedor">
                                        <br class="hidden-xs">
                                        <p class="h4" style="color: #800000;"><i class="fa fa-file"></i> Trámite solicitado</p>
                                    </div>
                                    <div class="col-sm-9 contenedorB" style="border-left: 1px solid #cccccc">
                                        <div class="row">
                                            <div class="col-xs-6 col-md-3">
                                                <p class="h4">No. de cita:</p>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                                <input class="h5 cita" id="numeroCita" name="numeroCita" style="border: none;  outline: none; color: #800000;" readonly></input>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-md-3"><strong>Descripción del trámite:</strong></div>
                                            <div class="col-xs-6 col-md-4">CONSTANCIA DE IDENTIFICACION VEHICULAR</div>
                                            <!-- INPUT CON EL DATO DE LA CONSTANCIA-->
                                            <input type="text" id="tipoConstancia" name="tipoConstancia" hidden value="CONSTANCIA DE IDENTIFICACION VEHICULAR">
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-6 col-md-3">
                                                <strong>Importe total:</strong>
                                            </div>
                                            <?php
                                            if ($resultDelegacion) {
                                                while ($consultaDelegacion = mysqli_fetch_array($resultDelegacion)) {
                                            ?>
                                                    <input id="costoTotal" name="costoTotal" class="col-xs-6 col-md-4 text-right" style="border: none;  outline: none;" readonly value="$<?php echo $consultaDelegacion['precioConstancia'] ?>.00"></input>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p></p>

                                        <div class="row">
                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label form="calendario" class="form-label"><strong>Seleccionar fecha de atención <span style="color: red;">*</span></strong></label>
                                                <div class="input-group">
                                                    <input class="col-lg-4 form-control datepicker" type="text" id="calendario" value="----/--/--" readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <i class="bi bi-calendar"></i></span>
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        Favor seleccionar una fecha.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-4 col-md-6 col-sm-12">
                                                <label form="horariosDisponibles" class="form-label"><strong>Horarios disponibles <span style="color: red;">*</span></strong>
                                                </label>
                                                <select class="form-control form-select" id="horariosDisponibles" name="horariosDisponibles" required>
                                                    <option value="">Seleccione...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Favor seleccionar un horario.
                                                </div>
                                            </div>
                                            <p></p>
                                            </br>
                                            <div class="alert alert-warning col-xxl-8 col-md-12 col-sm-12 text-center" role="alert" style="color:#A00505; margin-left: 10px; margin-right: 15px;">
                                                <strong>Realizar pago en BANAMEX al No. Cuenta 70093868429</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN TRAMITE -->
                                </div>
                                </br>
                                </br>
                                <center>
                                    <button type="button" class="btn btn-secondary text-lg" style="padding: 10px 25px; font-size: 20px;" id="btnRegresarVehiculo">&lt; Anterior</button>
                                    <button type="submit" class="btn btn-primary text-lg" style="padding: 10px 25px; font-size: 20px;">Siguiente &gt;</button>
                                </center>
                            </form>
                        </div>
                        <!-- FIN INFORMACIÓN CITA -->
                    </div>

                   <?php include('./php/modal.php') ?>

                   <?php include('./php/progress-bar.php') ?>
                </div>
            </div>
            </br>
            </br>
            <div class="card-footer text-muted text-center text-secondary">
                Copyright © 2023 <br />
                Todos los derechos reservados
            </div>
        </div>
        <script src="./js/archivo.js?version=1.7"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
</body>

</html>