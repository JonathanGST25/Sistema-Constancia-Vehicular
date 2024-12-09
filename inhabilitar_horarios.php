<?php
session_start();
$delegacionId = 0;
if ($_SESSION['usuarioId']) {
    $delegacionId = $_SESSION['delegacionId'];
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="index.php";
    </script>';
}
include("./php/conexion.php");
$usuarioId = $_SESSION['usuarioId'];
$conexion->set_charset("utf8");

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

//CONSULTAR DELEGACIÓN
$delegacion = "SELECT * FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$resultDelegacion = mysqli_query($conexion, $delegacion);
$consultaDelegacion = mysqli_fetch_array($resultDelegacion)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/constancia.css" rel="stylesheet">
    <!--<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">-->
    <!--<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">-->
    <link href="./fullcalendar/fuentes/font-Inter.css" rel="stylesheet">
    <link rel="stylesheet" href="./fullcalendar/fullcalendar.min.css">
    <link href="./fullcalendar/fuentes/font-roboto.css" rel="stylesheet">
    <script src="./fullcalendar/fuentes/boostrap-icons/core/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./js/javascript/3.6.1/jquery.min.js"></script>
    <script src="./js/javascript/3.2.1/jquery.min.js"></script>
    <title>Constancia de Identificación Vehicular | FGE</title>

    <style>
        A {
            text-decoration: none;
        }

        .css-class-to-highlight {
            background: blue;
            color: black;
            font: bold;
        }

        .highlight {
            background-color: #BDF9D8;
        }

        .marked-event {
            background-color: #f0f0f0;
        }

        .disabled-weekend {
            background-color: #f2f2f2;
            color: #999999;
        }

        .has-event {
            background-color: #D7ECFA;
        }

        .has-not-event {
            background-color: #F6BEC4;
        }

        .has-fest {
            background-color: #F9EEAF;
        }

        .has-non-working {
            background-color: #f2f2f2;
        }

        #calendar {
            font-family: "Roboto", sans-serif;
        }

        .fc-prev-button,
        .fc-next-button {
            background-color: #ebebeb;
            color: #333;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        .fc-prev-button:hover,
        .fc-next-button:hover {
            background-color: #274cbc;
        }

        .fc-day:hover {
            background-color: #BDF9D8;
        }

        .fc-today-button {
            background-color: #ebebeb;
            color: #333;
        }

        .fc button {
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            height: 2.1em;
            padding: 0 .6em;
            font-size: 1em;
            white-space: nowrap;
            cursor: pointer;
        }

        .fc button::-moz-focus-inner {
            margin: 0;
            padding: 0;
        }

        .fc-state-default {
            border: 1px solid;
        }

        .fc-state-default.fc-corner-left {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .fc-state-default.fc-corner-right {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }

        .fc button .fc-icon {
            position: relative;
            top: -0.05em;
            margin: 0 .2em;
            vertical-align: middle;
        }

        .fc-state-default {
            background-color: #00265b;
            background-image: -moz-linear-gradient(top, #00265b, #00265b);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#00265b), to(#00265b));
            background-image: -webkit-linear-gradient(top, #00265b, #00265b);
            background-image: -o-linear-gradient(top, #00265b, #00265b);
            background-image: linear-gradient(to bottom, #00265b, #00265b);
            background-repeat: repeat-x;
            border-color: #00265b #00265b #00265b;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            color: white;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .fc-state-hover,
        .fc-state-down,
        .fc-state-active,
        .fc-state-disabled {
            color: white;
            background-color: #274cbc;
        }

        .fc-state-hover {
            color: #274cbc;
            color: white;
            text-decoration: none;
            background-position: 0 -15px;
            -webkit-transition: background-position 0.1s linear;
            -moz-transition: background-position 0.1s linear;
            -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
        }

        .fc-state-down,
        .fc-state-active {
            background-color: #274cbc;
            background-image: none;
            color: white;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .fc-state-disabled {
            cursor: default;
            background-image: none;
            opacity: 0.65;
            box-shadow: none;
        }

        fieldset,
        legend {
            all: revert;
        }

        .reset {
            all: revert;
        }

        .swal2-popup .swal2-styled:focus {
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include("dash_mod.php") ?>
        <div class="main">
            <?php include("super_mod.php") ?>
            <main class="content">
                <div class="container-fluid p-0 col-8">
                    <div class="card">
                        <div class="card-body px-0">
                            <div class="row mx-auto">
                                <center>
                                    <label class="h3 mb-2">Habilitar o Inhabilitar días de atención</label>
                                    <div class="col-xxl-10 col-md-10 col-sm-12">
                                        <div id="calendar" class="mb-2"></div>
                                        <small class="d-inline-flex mb-3 mt-3 px-2 py-1 fw-semibold text-black rounded-2" style="background-color: #F9EEAF; border: 1px solid #F7D100">Dias festivos y suspensiones</small>
                                        <small class="d-inline-flex mb-3 mt-3 px-2 py-1 fw-semibold text-black rounded-2" style="background-color: #D7ECFA; border: 1px solid #5C7BFE">Dias con horarios disponibles</small>
                                        <small class="d-inline-flex mb-3 mt-3 px-2 py-1 fw-semibold text-black rounded-2" style="background-color: #F6BEC4; border: 1px solid #FE3434">Dias con horarios ocupados</small>
                                        <small class="d-inline-flex mb-3 mt-3 px-5 py-1 fw-semibold text-black rounded-2" style="background-color: #f2f2f2; border: 1px solid #959595">Dias inhabiles</small>

                                        <div class="row form-group">
                                            <label class="text-secondary" style="text-align: left !important;">Indique la fecha a inhabilitar o habilitar</label>
                                            <div class="col-sm-12 col-md-6 col-xxl-4 mt-2">
                                                <label for="fechaInicio" class="text-secondary d-flex">Fecha</label>
                                                <input autocomplete="off" class="form-control" id="fecha" name="fecha" type="text" value="" style="background-color: #FDFAEE !important;" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="saveButton" class="btn btn-secondary mt-3 mb-4" style="background-color: #1a252f;">Inhabilitar fecha</button>
                                    <button id="btnHabilitar" class="btn btn-primary mt-3 mb-4">Habilitar fecha</button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
    <script src="./fullcalendar/fuentes/popper.min.js"></script>
    <script src="./fullcalendar/jquery/moment.min.js"></script>
    <script src="./fullcalendar/fullcalendar.min.js"></script>
    <script src="./fullcalendar/locale/es.js"></script>
    <script src="./sweetalert/sweetalert2@11.js"></script>
    <script src="./js/app.js"></script>
    <script>
        window.onload = function() {
            $("#inhabilitar_horarios").addClass("active");
        }

        $(document).ready(function() {
            var selectedDates = [];
            var events = [];
            var startDate, endDate;
            var clickCount = 0;
            let fechaActual = new Date();
            //LANZAR EVENTO ANTES DE CARGAR EL CALENDARIO PARA DAR TIEMPO AL RENDERIZADO
            let timerInterval
            Swal.fire({
                title: '<h5>Cargando Calendario</h5>',
                html: 'Cargando los componentes necesarios...',
                timer: 10000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                    console.log('terminado');
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    $('#calendar').fullCalendar({
                        //themeSystem: themeSystem,
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay',
                        },
                        height: 480,
                        aspectRatio: 2,
                        //CAMBIAR IDIOMA DEL CALENDARIO
                        locale: 'es',
                        //PERMITIR SELECCIONAR DIAS
                        selectable: true,
                        //EVENTO PARA PRESIONAR SOBRE UN DIA
                        dayClick: function(date) {
                            //CONTADOR DE CLICKS
                            clickCount++;
                            //SI EL DIA ESTA INHABILITADO NO HACER NADA
                            if ($(this).hasClass('event-disabled')) {
                                Swal.fire({
                                    position: 'center',
                                    title: '<h5>Selección no permitida.</h5>',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                //REDUCIR 1 UNIDAD AL CONTADOR AL SELECCIONAR DIAS INHABILES
                                clickCount = clickCount - 1;
                                return; // SALIR SIN HACER NADA
                            }
                            // REMOVER LA CLASE 'highlight' DE CUALQUIER DÍA PREVIAMENTE SELECCIONADO
                            $('.highlight').removeClass('highlight');
                            // TOOGLE LA SELECCIÓN DEL DÍA
                            $(this).toggleClass('highlight');
                            // AGREGAR O REMOVER LA FECHA SELECCIONADA DEL ARRAY SELECTEDATES
                            var index = selectedDates.indexOf(date.format('YYYY-MM-DD'));
                            if (index === -1) {
                                selectedDates.push(date.format('YYYY-MM-DD'));
                            } else {
                                selectedDates.splice(index, 1);
                            }
                            //RECUPERAR LA FECHA DE INICIO DEL RANGO
                            if (clickCount === 1) {
                                startDate = date.format('YYYY-MM-DD');
                                document.getElementById('fecha').value = startDate;
                                clickCount = 0;
                            }
                        },

                        //FUNCIÓN PARA CARGAR DIAS
                        dayRender: function(date, cell) {
                            //QUITAR EL MARCADOR AL DIA ACTUAL
                            if (date.isSame(moment(), 'day')) {
                                cell.removeClass('fc-today');
                            }
                            //INHABILITAR TODAS LAS FECHAS ANTERIORES A LA ACTUAL
                            if (date < fechaActual && !isSameDay(date, fechaActual)) {
                                $(cell).addClass('disabled-weekend');
                                cell.addClass('event-disabled');
                            }

                            //VERIFICA SI ES SABADO O DOMINGO PARA DESHABILITARLOS
                            if (date.isoWeekday() === 7 || date.isoWeekday() === 6) {
                                $(cell).addClass('disabled-weekend');
                                cell.addClass('event-disabled');
                            }

                            if (dateHasEvent(date)) {
                                cell.addClass('has-event');
                            }

                            if (dateNotHasEvent(date)) {
                                cell.addClass('has-not-event');
                            }

                            //INHABILITAR DIAS CON EVENTOS PARA NO VOLVER A SELECCIONAR
                            if (dateHasFest(date)) {
                                cell.addClass('event-disabled');
                            }
                            if (dateHasFest(date)) {
                                cell.addClass('has-fest');
                            }

                            if (dateNonWorking(date)) {
                                cell.addClass('has-non-working');
                            }
                        },
                    });
                }
            })

            //FUNCIÓN PARA INHABILITAR FECHAS
            $('#saveButton').click(function() {
                //HACE UN LLAMADO AL ARCHIVO DONDE SE EJECUTA LA FUNCION PARA GUARDAR LOS DIAS
                if (document.getElementById('fecha').value == '') {
                    Swal.fire({
                        position: 'center',
                        title: '<h5>Error</h5>',
                        text: 'Debe seleccionar una fecha.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    let cadena = "fecha=" + document.getElementById('fecha').value + "&delegacionId=<?php echo $delegacionId ?>&bandera=1";
                    Swal.fire({
                        title: 'Confirmación',
                        text: "¿Desea inhabilitar la fecha seleccionada?",
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                    url: './php/controladores/consultar_dias_inhabiles.php',
                                    type: 'GET',
                                    data: {
                                        date: document.getElementById('fecha').value,
                                        delegacionId: <?php echo $delegacionId ?>
                                    }
                                })
                                .done(function(respuesta) {
                                    if (respuesta == 'true') {
                                        Swal.fire({
                                            title: '<h5>Día inhabilitado</h5>',
                                            text: 'El día ya se encuentra inhabilitado',
                                            timer: 3000

                                        })
                                    } else {
                                        $.ajax({
                                            url: './php/controladores/inhabilitar_dias.php',
                                            method: 'POST',
                                            data: cadena,
                                            success: function(response) {
                                                console.log(response);
                                                Swal.fire({
                                                    title: '<h5>Día inhabilitado</h5>',
                                                    text: response,
                                                    icon: 'success',
                                                    timer: 3000

                                                })
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 3200);

                                            },
                                            error: function(xhr, status, error) {
                                                console.log(xhr.responseText);
                                                alert('Error al inhabilitar el día seleccionado.');
                                            }
                                        });
                                    }
                                })
                                .fail(function() {
                                    console.log('Error');
                                })
                                .always(function() {
                                    console.log('Complete');
                                });
                        }
                    })
                }
            });

            //HABILITAR FECHAS
            $('#btnHabilitar').click(function() {
                if (document.getElementById('fecha').value == '') {
                    Swal.fire({
                        position: 'center',
                        title: '<h5>Error</h5>',
                        text: 'Debe seleccionar una fecha.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    let cadena = "fecha=" + document.getElementById('fecha').value + "&delegacionId=<?php echo $delegacionId ?>&bandera=2";
                    Swal.fire({
                        title: 'Confirmación',
                        text: "¿Desea habilitar la fecha seleccionada?",
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                    url: './php/controladores/consultar_dias_inhabiles.php',
                                    type: 'GET',
                                    data: {
                                        date: document.getElementById('fecha').value,
                                        delegacionId: <?php echo $delegacionId ?>
                                    },
                                })
                                .done(function(respuesta) {
                                    if (respuesta == 'true') {
                                        $.ajax({
                                            url: './php/controladores/inhabilitar_dias.php',
                                            method: 'POST',
                                            data: cadena,
                                            success: function(response) {
                                                console.log(response);
                                                Swal.fire({
                                                    title: '<h5>Día habilitado</h5>',
                                                    text: response,
                                                    icon: 'success',
                                                    timer: 3000

                                                })
                                                setTimeout(function() {
                                                    window.location.reload();
                                                }, 3200);

                                            },
                                            error: function(xhr, status, error) {
                                                console.log(xhr.responseText);
                                                alert('Error al habilitar el día seleccionado.');
                                            }
                                        });
                                    } else {
                                        Swal.fire({
                                            title: '<h5>Error al habilitar el día</h5>',
                                            text: 'Asegúrese de que el día seleccionado este inhabilitado.',
                                            timer: 3000

                                        })
                                    }
                                })
                                .fail(function() {
                                    console.log('Error');
                                })
                                .always(function() {
                                    console.log('Complete');
                                });
                        }
                    })
                }
            });

            //CARGAR DIAS CON HORARIOS DISPONIBLES
            function dateHasEvent(date) {
                //BANDERA INDICANDO FALSO
                var hasEvent = false;
                //LLAMADO A TRAVES DE AJAX PARA REALIZAR LA CONSULTA
                $.ajax({
                    url: './php/controladores/cargar_horarios_disponibles.php',
                    method: 'GET',
                    data: {
                        date: date.format('YYYY-MM-DD'),
                        delegacionId: <?php echo $delegacionId ?>
                    },
                    async: false,
                    success: function(response) {
                        //CAMBIAR ESTADO DE LA BANDERA A VERDADERO
                        hasEvent = response === 'true';
                    },
                    //EN CASO DE EXISTIR ALGÚN ERROR
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error al verificar el evento');
                    }
                });
                //RETORNAR BANDERA
                return hasEvent;
            }

            function dateNotHasEvent(date) {
                //BANDERA INDICANDO FALSO
                var hasEvent = false;
                //LLAMADO A TRAVES DE AJAX PARA REALIZAR LA CONSULTA
                $.ajax({
                    url: './php/controladores/cargar_horarios_no_disponibles.php',
                    method: 'GET',
                    data: {
                        date: date.format('YYYY-MM-DD'),
                        delegacionId: <?php echo $delegacionId ?>
                    },
                    async: false,
                    success: function(response) {
                        //CAMBIAR ESTADO DE LA BANDERA A VERDADERO
                        hasEvent = response === 'true';
                    },
                    //EN CASO DE EXISTIR ALGÚN ERROR
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error al verificar el evento');
                    }
                });
                //RETORNAR BANDERA
                return hasEvent;
            }

            //CARGAR DIAS FESTIVOS
            function dateHasFest(date) {
                //BANDERA INDICANDO FALSO
                var hasEvent = false;

                $.ajax({
                    url: './php/controladores/consultar_dias_festivos.php',
                    method: 'GET',
                    data: {
                        date: date.format('YYYY-MM-DD'),
                        delegacionId: <?php echo $delegacionId ?>
                    },
                    async: false,
                    success: function(response) {
                        //CAMBIAR ESTADO DE LA BANDERA A VERDADERO
                        hasEvent = response === 'true';
                    },
                    //EN CASO DE EXISTIR ALGÚN ERROR
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error al verificar el evento');
                    }
                });
                //RETORNAR BANDERA
                return hasEvent;
            }

            //CARGAR DIAS INHABILES
            function dateNonWorking(date) {
                //BANDERA DE VALIDACIÓN
                var hasEvent = false;

                $.ajax({
                    url: './php/controladores/consultar_dias_inhabiles.php',
                    method: 'GET',
                    data: {
                        date: date.format('YYYY-MM-DD'),
                        delegacionId: <?php echo $delegacionId ?>
                    },
                    async: false,
                    success: function(response) {
                        //CAMBIAR ESTADO DE LA BANDERA A VERDADERO
                        hasEvent = response === 'true';
                    },
                    //EN CASO DE EXISTIR ALGÚN ERROR
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Error al verificar el evento');
                    }
                });
                return hasEvent;
            }

            //FUNCIÓN PARA COMPARAR SI ES EL MISMO DÍA
            function isSameDay(date1, date2) {
                return (
                    date1.toISOString().slice(0, 10) === date2.toISOString().slice(0, 10)
                );
            }
        });
    </script>
</body>

</html>