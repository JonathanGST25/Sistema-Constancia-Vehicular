<?php
include("./conexion.php");
mysqli_set_charset($conexion, 'utf8');
$nombreCompleto = $_REQUEST['nombreSolicitante'] . ' ' . $_REQUEST['apellidoPaSolicitante'] . ' ' . $_REQUEST['apellidoMaSolicitante'];
$delegacionId = $_REQUEST['delegacionId'];

function fechaEs($fecha)
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
}

$fechaCitaAtencion = fechaEs($_REQUEST['fechaCita']);
$horaCitaAtencion = $_REQUEST['horaCita'];
$sql = "SELECT * FROM Catalogo_Horarios WHERE id = $horaCitaAtencion";
$result = mysqli_query($conexion, $sql);

if ($result) {
    $consulta = mysqli_fetch_array($result);
    $hora = substr($consulta['horaCita'], 0, 5);
}

$folio = $_REQUEST['folio'];
$costoTotal = $_REQUEST['costoTotal'];

$sql = "SELECT * FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$result = mysqli_query($conexion, $sql);

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
    <script src="https://kit.fontawesome.com/d7dee1abd2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Servicio de citas para la Constancia de Identificación Vehicular - Site</title>
</head>

<body onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
    <STYLE>
        A {
            text-decoration: none;
        }
    </STYLE>
    <div class="container-fluid">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <img src="../img/logo_fiscalia.png" style="width: 100px; display: inline-block" />
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

        <div class="row container-fluid">
            <div class="col-1">&nbsp;</div>
            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
                <h3 class="text-center mt-3">Cita registrada correctamente</h3>
                <p></p>
                <h5 style="text-align: left !important; color: #800000;">Folio de registro: <?php echo $folio ?></h5>
                <p></p>
                <p style="text-align: justify; font-size: 20px;">Estimado(a) <?php echo $nombreCompleto ?> su cita para el día
                    <strong style="font-size: 22px;"><?php echo $fechaCitaAtencion ?> a las <?php echo $hora ?> hrs.</strong> ¡Ha sido registrada correctamente! Favor de presentarse a la delegación:
                    <?php
                    if ($result) {
                        while ($consulta = mysqli_fetch_array($result)) {
                    ?>
                            <strong><?php echo $consulta['delegacionNombre'] ?></strong> con domicilio
                            <strong><?php echo $consulta['delegacionDomicilio'] ?></strong>
                    <?php
                        }
                    }
                    ?>
                </p>
                <p></p>
                <h4 style="text-align: justify;">Favor de estar presente <strong>15 minutos</strong> antes de la hora de su cita con los siguientes requisitos en original y copia:</h4>
                <p></p>
                <p class="text-left"></p>
                <div class=" col-xl-12" style="width: 100%;">
                    <ul class="text-left">
                        <li style="font-size: 20px;">
                            <strong>Hoja de cita (Se obtiene al realizar la cita).</strong>
                            <br>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Identificación oficial (INE).</strong>
                            <br>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Licencia de conducir (vigente).</strong>
                            <br>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Tarjetón de circulación.</strong>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Comprobante de domicilio (Luz, agua, telefonía fija de paga, predial).</strong>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Pago de tenencia.</strong>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Factura del vehículo.</strong>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>Realizar pago</strong><br>
                            <strong>Normal: </strong> $800.00 pesos<br>
                            <strong>Urgente: </strong> $950.00 pesos
                            <br>
                            En <strong>CITIBANAMEX</strong> al número de cuenta: <strong>70093868429</strong>
                            <br>A nombre de: <strong>Fiscalía General del Estado de Guerrero</strong>
                            <br>
                            <strong>Vigencia del recibo de pago 30 días naturales</strong>
                            <br>
                            <strong>Presentar original y copia del recibo de pago</strong>
                        </li>
                        <li style="font-size: 20px;">
                            <strong>No hay tolerancia de tiempo posterior a su cita.</strong>
                        </li>
                    </ul>
                </div>
                <p></p>
                <center><br>
                    <a target="_blank" href="acusecita.php?nombreCompleto=<?php echo $nombreCompleto ?>&numeroCita=<?php echo $folio ?>&fechaCita=<?php echo $fechaCitaAtencion ?>&delegacionId=<?php echo $delegacionId ?>&horaCita=<?php echo $hora ?>" class="btn btn-primary btn-lg">Imprimir Acuse de Cita <i class="fas fa-print"></i></a>
                    <br>
                    <p></p>
                    <p>
                    </p>
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12">
                        <h3 style="font-weight: bold; color: #469e23;">¡Nuevo Sistema Modernizado!</h3>
                        <p></p>
                        <p></p>
                        <h3 style="color: #061439;">Menos tiempo y menos papeleo</h3>
                        <p></p>
                        <p>
                            <img src="../img/frase_fiscalia.png" style="width: 250px;">
                        </p>
                    </div>
                </center>
            </div>
        </div>

        <div class="card-footer text-muted justify-content-center text-center text-secondary">
            Copyright © 2023 <br />
            Todos los derechos reservados
        </div>
    </div>

    <script type="text/javascript">
        <?php
        if (isset($_GET['folio']) != "") {
        ?>
            Swal.fire({
                icon: 'success',
                title: 'Cita registrada',
                text: 'La cita fue registrada correctamente!',
                showConfirmButton: false,
                timer: 1500,
            })
        <?php
        } ?>

        window.history.forward();
        function sinVueltaAtras() {
            window.history.forward();
        }
    </script>
</body>

<!--147-->

</html>