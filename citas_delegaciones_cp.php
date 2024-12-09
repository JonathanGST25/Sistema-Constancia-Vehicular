<?php
session_start();
$delegacionId = 0;
if ($_SESSION['usuarioId']) {
    $delegacionId = $_SESSION['delegacionId'];
} else {
    echo '<script type="text/javascript">
    alert("Sesión no iniciada");
    window.location.href="./index.php";
    </script>';
}

$pagina = 1;
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}

include("./php/conexion.php");
$usuarioId = $_SESSION['usuarioId'];
$conexion->set_charset("utf8");

//CONSULTAR DEL USUARIO LOGUEADO
$sql = "SELECT * FROM Usuarios WHERE usuarioId = '$usuarioId'";
$resultUsuario = mysqli_query($conexion, $sql);
$mostrarUsuario = mysqli_fetch_array($resultUsuario);
$usuario = $mostrarUsuario['usuarioNombre'] . " " . $mostrarUsuario['usuarioPaterno'] . " " . $mostrarUsuario['usuarioMaterno'];

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
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/constancia.css" rel="stylesheet">
    <link rel="stylesheet" href="./js/javascript/jquery-ui.css">
    <link rel="stylesheet" href="./fullcalendar/fuentes/boostrap-icons/bootstrap-icons.css">
    <link href="./fullcalendar/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">-->
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
    </STYLE>
    <div class="wrapper">
        <?php include("dash_mod.php") ?>
        <div class="main">
            <?php include("super_mod.php") ?>
            <main class="content">
                <div class="container-fluid p-0">
                    <div class="card">
                        <div class="card-body px-2">
                            <div class="alert alert-primary" role="alert">
                                Delegacion: <?php echo $consultaDelegacion['delegacionNombre'] ?>
                            </div>

                            <h5 class="text-center">Gestión de citas registradas para el trámite de Constancia de Identificación Vehicular</h5>
                            <input value="<?php echo $_SESSION['delegacionId'] ?>" hidden name="delegacionId" id="delegacionId">

                            <div class="row mx-auto form-group">
                                <div class="col-xxl-6 col-md-12 col-sm-12 mb-2 float-right d-flex">
                                    <label class="h5 mt-4">Filtrar por:</label>

                                    <!-- PICKER PARA FECHA DE REGISTRO-->
                                    <div class="form-group col-xxl-4 col-md-4 col-sm-12" style="margin-right: 5px; margin-left: 10px;">
                                        <label for="fecha-registro" class="text-secondary" style="font-size: 15px;">Fecha de registro:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input type="date" class="form-control rounded btn btn-outline-primary" id="fecha-registro" value="<?php echo isset($_GET['fechaRegistro']) ? $_GET['fechaRegistro'] : ''; ?>" />
                                        </div>
                                    </div>

                                    <!-- PICKER PARA FECHA DE LA CITA-->
                                    <div class="form-group col-xxl-4 col-md-4 col-sm-12">
                                        <label for="fecha-cita" class="text-secondary" style="font-size: 15px;">Fecha de la cita:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input type="date" class="form-control rounded btn btn-outline-success" id="fecha-cita" value="<?php echo isset($_GET['fechaCita']) ? $_GET['fechaCita'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>

                                <!--INPUT PARA REALIZAR LA BUSQUEDA-->
                                <div class="col-xxl-6 col-md-8 col-sm-6">
                                    <label for="buscarInfoVehiculo" class="text-secondary" style="font-size: 15px;">Para buscar el vehículo ingresa</label>
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded" placeholder="Número de placas, serie o motor del vehículo" aria-label="Search" aria-describedby="search-addon" name="buscarInfoVehiculo" id="buscarInfoVehiculo" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                                        <label class="input-group-text" for="inputGroupFile01"><i class="bi bi-car-front-fill"></i></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-auto form-group">
                                <div class="col-xxl-4 col-md-6 col-sm-6" style="display: flex; float: right;">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="flexRadioDefault" id="checkRegistro" <?php if (isset($_GET['idcheck']) && $_GET['idcheck'] == 'checkRegistro') echo 'checked'; ?>>
                                        <label class="form-check-label text-primary" for="inlineCheckbox1">Registro</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="flexRadioDefault" id="checkPresentacion" <?php if (isset($_GET['idcheck']) && $_GET['idcheck'] == 'checkPresentacion') echo 'checked'; ?>>
                                        <label class="form-check-label text-warning" for="inlineCheckbox">Presentación</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="flexRadioDefault" id="checkTramite" <?php if (isset($_GET['idcheck']) && $_GET['idcheck'] == 'checkTramite') echo 'checked'; ?>>
                                        <label class="form-check-label text-success" for="inlineCheckbox">Trámite</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="flexRadioDefault" id="checkConcluidas" <?php if (isset($_GET['idcheck']) && $_GET['idcheck'] == 'checkConcluido') echo 'checked'; ?>>
                                        <label class="form-check-label text-secondary" for="inlineCheckbox">Concluidas</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="flexRadioDefault" id="checkCanceladas" <?php if (isset($_GET['idcheck']) && $_GET['idcheck'] == 'checkCanceladas') echo 'checked'; ?>>
                                        <label class="form-check-label text-danger" for="inlineCheckbox">Canceladas</label>
                                    </div>
                                </div>
                            </div>

                            <!--CONTENEDOR PARA LA TABLA-->
                            <div class="row mt-3 mx-auto form-group">
                                <div class="col-xxl-12 col-md-12 col-sm-12 table-responsive" id="tabla">
                                </div>
                            </div>

                            <!-- INCLUIR MODAL PARA MOSTRAR LA CITA SELECCIONADA --->
                            <?php include('./php/modal_citas.php') ?>
                            <?php include('./php/modal_edit.php') ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="./fullcalendar/fuentes/popper.min.js"></script>
    <script src="./js/javascript/jquery-ui.js"></script>
    <script src="./fullcalendar/jquery/moment.min.js"></script>
    <script src="./sweetalert/sweetalert2@11.js"></script>
    <script src="./css/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="./js/javascript/3.2.1/jquery.min.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        //ACTIVAR PESTAÑA ACTUAL
        window.onload = function() {
            $("#gestion_citas").addClass("active");
        }

        //LIMPIAR BÚSQUEDAS ALRECARGAR LA PÁGINA
        $(window).on("load", function() {
            var currentUrl = window.location.href;

            // Obtén la nueva URL que deseas establecer
            var newUrl = './citas_delegaciones_cp.php';

            // Reemplaza la URL actual con la nueva URL
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        });

        //CARGAR REGISTROS EN LA TABLA
        $(document).ready(function() {
            // DEFINE EL TIEMPO EN MILISEGUNDOS ENTRE CADA RECARGA
            var tiempo_recarga = 1000;

            // FUNCIÓN PARA CARGAR LA TABLA DE CITAS
            function cargarTablaCitas() {
                var buscarInfoVehiculo = $('#buscarInfoVehiculo').val();
                var fechaRegistro = $('#fecha-registro').val();
                var fechaCita = $('#fecha-cita').val();

                if (fechaRegistro != '' || fechaCita != '') {
                    var url = "php/controladores/consultar_citas_delegacion_v2.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>";
                    url += "&fechaRegistro=" + fechaRegistro + "&fechaCita=" + fechaCita;
                } else if ($('#checkRegistro').is(':checked')) {
                    var url = "php/controladores/consultar_citas_delegacion_estatus.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>&bandera=1";
                } else if ($('#checkPresentacion').is(':checked')) {
                    var url = "php/controladores/consultar_citas_delegacion_estatus.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>&bandera=2";
                } else if ($('#checkTramite').is(':checked')) {
                    var url = "php/controladores/consultar_citas_delegacion_estatus.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>&bandera=3";
                } else if ($('#checkConcluidas').is(':checked')) {
                    var url = "php/controladores/consultar_citas_delegacion_estatus.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>&bandera=4";
                } else if ($('#checkCanceladas').is(':checked')) {
                    var url = "php/controladores/consultar_citas_delegacion_estatus.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>&bandera=5";
                } else {
                    var url = "php/controladores/consultar_citas_delegacion.php";
                    url += "?pagina=<?php echo $pagina ?>&delegacionId=<?php echo $delegacionId ?>";
                    url += "&search=" + buscarInfoVehiculo;
                }


                $("#tabla").load(url);
            }

            // CARGAR LA TABLA AL CARGAR LA PÁGINA
            cargarTablaCitas();

            // CARGAR LA TABLA AUTOMÁTICAMENTE CADA SEGUNDO
            setInterval(function() {
                cargarTablaCitas();
            }, tiempo_recarga);

        });

        //LIMPIAR CAMPOS DEL MODAL
        function limpiarModal() {
            document.getElementById('nombreActor').innerHTML = "";
            document.getElementById('paternoActor').innerHTML = "";
            document.getElementById('maternoActor').innerHTML = "";
            document.getElementById('curpActor').innerHTML = "";
            document.getElementById('rfcActor').innerHTML = "";
            document.getElementById('marcaVehiculo').innerHTML = "";
            document.getElementById('modeloVehiculo').innerHTML = "";
            document.getElementById('tipoVehiculo').innerHTML = "";
            document.getElementById('anioVehiculo').innerHTML = "";
            document.getElementById('numeroSerie').innerHTML = "";
            document.getElementById('numeroPlacas').innerHTML = "";
            document.getElementById('numeroMotor').innerHTML = "";
            document.getElementById('pais').innerHTML = "";
            document.getElementById('cilindraje').innerHTML = "";
            document.getElementById('estado').innerHTML = "";
            document.getElementById('folio').innerHTML = "";
            document.getElementById('fechaRegistro').innerHTML = "";
            document.getElementById('fechaCita').innerHTML = "";
            document.getElementById('hora').innerHTML = "";
            document.getElementById('citaId').value = "";
            document.getElementById('observacionesCita').selectedIndex = 0;
        }

        //IMPRIMIR CONSTANCIA
        function generarConstanciaValidacion() {
            let delegacionId = document.getElementById('delegacionId').value;
            //document.getElementById('containerplataforma').style.display = "block";
            let citaId = document.getElementById('citaId').value;
            Swal.fire({
                title: '<h5>Constancia de Validación</h5>',
                text: '¿Desea generar la constancia?',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('././php/controladores/constancia_validacion.php?delegacionId=' + delegacionId + '&citaId=' + citaId + "&usuarioId=<?php echo $usuarioId ?>");
                    $("#contenedorEstadoCita").children().prop('disabled', true);
                    $("#contenederSelectOpciones").children().prop('disabled', true);
                    $("#btnGuardarEstadoCita").prop('disabled', true);
                    //$("#btnEnviarPlataforma").prop('disabled', false);
                    $('#btnEnviarPlataforma').removeClass('disabled');

                }
            })

        }

        //OCULTAR CONTENEDOR ENVIAR A PLATAFORMA
        function finalizarModal() {
            //document.getElementById('containerplataforma').style.display = "none";
            //$("#btnEnviarPlataforma").prop('disabled', true);
            $('#btnEnviarPlataforma').addClass('disabled');
        }

        //ENVIAR DATOS A PLATAFORMA MÉXICO
        function enviarDatosPlataforma() {
            let delegacionId = document.getElementById('delegacionId').value;
            let citaId = document.getElementById('citaId').value;
            let cadena = "delegacionId=" + delegacionId + "&citaId=" + citaId + "&usuarioId=<?php echo $usuarioId ?>";

            Swal.fire({
                title: '<h5>Enviar Datos a Plataforma México</h5>',
                text: '¿Desea continuar con el envío de datos a Plataforma México?',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            url: "./php/controladores/comunicacion_plataforma.php",
                            type: "POST",
                            data: cadena,
                        })
                        .done(function(res) {
                            //$("#btnEnviarPlataforma").prop('disabled', true);
                            $('#btnEnviarPlataforma').addClass('disabled');
                            $("#contenedorEstadoCita").children().prop('disabled', true);
                            $("#btnGuardarEstadoCita").prop('disabled', true);
                            $('#btnImprimirConstanciaValidacion').addClass('disabled');
                            Swal.fire({
                                title: '<h5>' + res + '</h5>',
                                text: 'La solciitud fue enviada a Plataforma México',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 5000,
                                showCloseButton: true,
                            })
                        })
                        .fail(function() {
                            console.log('Fallo al completar la acción');
                        })
                        .always(function() {
                            console.log('Completado');
                        });
                }
            })


        }

        //FUNCIÓN PARA MOSTRAR UNA CITA EN ESPECIFICO DENTRO DE UN MODAL
        function consultarCitaEspecifica() {
            limpiarModal();
            var rows = document.getElementById('tableCitas').getElementsByTagName('tr');
            for (i = 0; i < rows.length; i++) {
                rows[i].onclick = function() {
                    var result = this.getElementsByTagName('td')[0].innerHTML;
                    var cadena = 'no_cita=' + result + "&bandera=1";

                    $.ajax({
                            url: 'php/controladores/consultar_cita.php',
                            type: "POST",
                            data: cadena,
                        })
                        .done(function(res) {
                            var data = [];
                            data = JSON.parse(res);
                            document.getElementById('nombreActor').innerHTML = data['nombreActor'];
                            document.getElementById('paternoActor').innerHTML = data['paternoActor'];
                            document.getElementById('maternoActor').innerHTML = data['maternoActor'];
                            document.getElementById('curpActor').innerHTML = data['curpActor'];
                            document.getElementById('rfcActor').innerHTML = data['rfcActor'];
                            document.getElementById('marcaVehiculo').innerHTML = data['marca'];
                            document.getElementById('modeloVehiculo').innerHTML = data['modelo'];
                            document.getElementById('tipoVehiculo').innerHTML = data['tipoVehiculo'];
                            document.getElementById('anioVehiculo').innerHTML = data['anio'];
                            document.getElementById('numeroSerie').innerHTML = data['numeroSerie'];
                            document.getElementById('numeroPlacas').innerHTML = data['numeroPlacas'];
                            document.getElementById('numeroMotor').innerHTML = data['numeroMotor'];
                            document.getElementById('pais').innerHTML = data['pais'];
                            document.getElementById('cilindraje').innerHTML = data['cilindraje'];
                            document.getElementById('estado').innerHTML = data['estado'];
                            document.getElementById('folio').innerHTML = data['folioCita'];
                            document.getElementById('fechaRegistro').innerHTML = data['fechaRegistro'];
                            document.getElementById('fechaCita').innerHTML = data['fechaCita'];
                            document.getElementById('hora').innerHTML = data['horaCita'].slice(0, 5) + " hrs";
                            document.getElementById('citaId').value = result;

                            //----------------------------- SELECCIONAR SELECT DE ESTADO CITA (PARA CANCELAR) ---------------------------------
                            const $select = document.querySelector("#observacionesCita");

                            //---------------------------- FUNCIÓN PARA LIMPIAR CONTENIDO DE SELECT ----------------------------
                            const limpiar = () => {
                                for (let i = $select.options.length; i >= 0; i--) {
                                    $select.remove(i);
                                }
                            };

                            //FUNCIÓN PARA AGREGAR CONTENIDO A SELECT
                            const agregar = (texto) => {
                                const option = document.createElement('option');
                                option.value = 1;
                                option.text = texto;
                                $select.appendChild(option);
                            };

                            //----------------------------- RECUPERAMOS EL CONTADOR DE IMPRESIONES DE CONSTANCIA ------------------------------
                            let imprmirConstancia = data['estadoCita'];

                            //---------------------------------------------- IMPRIMIR CONSTANCIA ----------------------------------------------
                            //SI EL VALOR ES 1 LA CONSTANCIA YA FUE IMPRESA SE INHABILITA LA OPCIÓN
                            if (data['estadoCita'] == '1' || data['estatusPlataId'] != 3) {
                                $('#btnGenerarConstancia').addClass('disabled');
                            } else {
                                //EN CASO DE QUE LA CONSTANCIA AÚN NO SE HA IMPRESO
                                $('#btnGenerarConstancia').removeClass('disabled');
                            }

                            //---------------------------------------- INHABILITAR TODAS LAS OPCIONES -----------------------------------------
                            document.getElementById('btnImprimirConstanciaValidacion').disabled = true;
                            $('#btnEnviarPlataforma').addClass('disabled');
                            document.getElementById('contenedorEstadoCita').style.display = 'none';
                            $("#contenederSelectEstadoCita").children().prop('disabled', true);
                            document.getElementById('contenederSelectOpciones').style.display = 'none';
                            $("#contenederSelectOpciones").children().prop('disabled', true);
                            document.getElementById('btnGuardarEstadoCita').disabled = true;
                            //document.getElementById('respObservaciones').style.display = 'none';
                            document.getElementById('divReportePlata').style.display = 'none';
                            document.getElementById('divInformacion').style.display = 'none';
                            document.getElementById('divEstatusCita').style.display = 'none';
                            document.getElementById('btnGenerarConstancia').disabled = true;

                            //--------------------------------- VARIABLE PARA OBTENER RESPUESTA DE PLATAFORMA ----------------------------------
                            let respuestaPlataforma = '';

                            //---------- VERIFICAR QUE LA CITA NO HAYA SIDO ENVIADA, CANCELADA, SE ENCUENTRE EN TRÁMITE O FINALIZADA -----------
                            if (data['estatusCitaId'] == 1 || data['estatusCitaId'] == 2) {
                                document.getElementById('btnImprimirConstanciaValidacion').disabled = false;
                                document.getElementById('contenedorEstadoCita').style.display = 'block';
                                $("#contenederSelectEstadoCita").children().prop('disabled', false);
                                document.getElementById('contenederSelectOpciones').style.display = 'block';
                                $("#contenederSelectOpciones").children().prop('disabled', false);
                                document.getElementById('btnGuardarEstadoCita').disabled = false;
                            }

                            //--------------------------------- VERIFICAR SI LA CITA YA SE ENCUENTRA CANCELADA ----------------------------------
                            if (data['estatusCitaId'] == 16 || data['estatusCitaId'] == 17) {
                                document.getElementById('contenedorEstadoCita').style.display = 'block';
                                $("#contenederSelectEstadoCita").children().prop('disabled', true);
                                document.getElementById('contenederSelectOpciones').style.display = 'block';
                                $("#contenederSelectOpciones").children().prop('disabled', true);
                                document.getElementById('divEstatusCita').style.display = 'block';
                                limpiar();
                                if (data['observaciones'] != '') {
                                    agregar(data['observaciones']);
                                } else {
                                    agregar('Selecciona..');
                                }
                            }

                            //---------------------------- VERIFICAR SI LA CONSTANCIA YA SE ENCUENTRA CULMINADA Y OBTENER RESPUESTA -------------
                            $.ajax({
                                    url: "./php/controladores/consultar_reporte_plataforma.php",
                                    type: "POST",
                                    data: cadena,
                                })
                                .done(function(res) {
                                    respuestaPlataforma = res;

                                    if (respuestaPlataforma != '') {
                                        document.getElementById('divReportePlata').style.display = 'block';
                                        $.ajax({
                                                url: './php/controladores/consultar_respuesta_plataforma.php',
                                                type: 'POST',
                                                data: cadena,
                                            })
                                            .done(function(res) {
                                                //COLOCAMOS LA RESPUESTA DE PLATAFORMA EN UNA CAJA
                                                document.getElementById('labelReportePlata').innerHTML = 'RESULTADO DE PLATAFORMA MÉXICO "' + res + '"';
                                            })
                                            .fail(function() {
                                                console.log('error');
                                            })
                                            .always(function() {
                                                console.log('complete');
                                            });

                                        //VERIFICAR SI LA CONSTANCIA YA FUE IMPRESA
                                        if (imprmirConstancia != 1) {
                                            //HABILITAMOS EL BOTÓN IMPRIMIR
                                            if (res == 1 || res == 13 || imprmirConstancia != 1) {
                                                $('#btnGenerarConstancia').removeClass('disabled');
                                            } else {
                                                //DESHABILITAMOS EL BOTÓN IMPRIMIR
                                                $('#btnGenerarConstancia').addClass('disabled');
                                            }
                                        }
                                    } else {
                                        if (data['estatusCitaId'] != 16 && data['estatusCitaId'] != 17) {
                                            document.getElementById('divInformacion').style.display = 'block';
                                        }
                                    }
                                })
                                .fail(function() {
                                    console.log('error');
                                })
                                .always(function() {
                                    console.log('complete');
                                });
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        });
                }
            }
        }

        //GENERAR CONSTANCIA
        function generarConstanciaIdentificacion() {
            Swal.fire({
                title: '<h5>Generar Constancia</h5>',
                text: '¿Desea generar la constancia de identificación vehicular?',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    //document.getElementById('btnGenerarConstancia').disabled = true;
                    $('#btnGenerarConstancia').addClass('disabled');
                    let delegacionId = document.getElementById('delegacionId').value;
                    let citaId = document.getElementById('citaId').value;
                    window.open('././php/controladores/constancia_identificacion_vehicular.php?delegacionId=' + delegacionId + "&citaId=" + citaId + "&usuarioId=<?php echo $usuarioId ?>");
                }
            })

        }

        //CANCELAR CITA
        function cancelarCita() {
            let citaId = document.getElementById('citaId').value;
            let observacionesCita = document.getElementById('observacionesCita').value;
            let cadena = "citaId=" + citaId + "&observacionesCita=" + observacionesCita + "&usuarioId=<?php echo $usuarioId ?>";

            Swal.fire({
                title: '<h5>Cancelar Cita</h5>',
                text: '¿Estás seguro de cancelar la cita actual?',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    if (document.getElementById('observacionesCita').value == '') {
                        Swal.fire('Debes seleccionar una opción', '', 'error')
                    } else {
                        $.ajax({
                                url: './php/controladores/cancelar_cita.php',
                                type: 'POST',
                                data: cadena,
                            })
                            .done(function(res) {
                                Swal.fire({
                                    icon: 'success',
                                    title: '<h5>Cita Cancelada</h5>',
                                    text: res,
                                    showConfirmButton: false,
                                    showCloseButton: true,
                                    timer: 5000
                                })
                                $("#contenedorEstadoCita").children().prop('disabled', true);
                                $("#btnGuardarEstadoCita").prop('disabled', true);
                                $("#btnImprimirConstanciaValidacion").prop('disabled', true);
                            })
                            .fail(function() {
                                console.log('Error');
                            })
                            .always(function() {
                                console.log('Complete');
                            });
                    }
                }
            })
        }

        //MOSTRAR DATOS EN INPUTS DE ACTUALIZAR DATOS
        function actualizarDatosCita() {
            var rows = document.getElementById('tableCitas').getElementsByTagName('tr');
            for (i = 0; i < rows.length; i++) {
                rows[i].onclick = function() {
                    var result = this.getElementsByTagName('td')[0].innerHTML;
                    var cadena = 'no_cita=' + result + "&bandera=2";

                    $.ajax({
                            url: 'php/controladores/consultar_cita.php',
                            type: "POST",
                            data: cadena,
                        })
                        .done(function(res) {
                            let data = [];
                            data = JSON.parse(res);
                            document.getElementById('nombreSolicitanteModal').value = data['nombreActor'];
                            document.getElementById('apellidoPaSolicitanteModal').value = data['paternoActor'];
                            document.getElementById('apellidoMaSolicitanteModal').value = data['maternoActor'];
                            document.getElementById('curpSolicitanteModal').value = data['curpActor'];
                            document.getElementById('rfcSolicitanteModal').value = data['rfcActor'];

                            document.getElementById('marcaVehiculoModal').value = data['marca'];
                            document.getElementById('modeloVehiculoModal').value = data['modelo'];
                            document.getElementById('tipoVehiculoModal').value = data['tipoVehiculo'];
                            document.getElementById('anioModeloVehiculoModal').value = data['anio'];
                            document.getElementById('claseVehiculoModal').value = data['clase'];
                            document.getElementById('colorVehiculoModal').value = data['color'];
                            document.getElementById('serieVinVehiculoModal').value = data['numeroSerie'];
                            document.getElementById('placasVehiculoModal').value = data['numeroPlacas'];
                            document.getElementById('numeroMotorVehiculoModal').value = data['numeroMotor'];
                            document.getElementById('paisOrigenVehiculoModal').value = data['pais'];
                            document.getElementById('cilindrajeVehiculoModal').value = data['cilindraje'];
                            document.getElementById('entidadEmplacoVehiculoModal').value = data['estado'];
                            document.getElementById('folioCitaModal').value = data['folioCita'];
                            document.getElementById('fechaRegistroModal').value = data['fechaRegistro'];
                            document.getElementById('fechaCitaModal').value = data['fechaCita'];
                            document.getElementById('horaCitaModal').value = data['horaCita'].slice(0, 5) + " hrs";
                            document.getElementById('citaIdModal').value = result;

                            if (data['estatusCitaId'] == 1 || data['estatusCitaId'] == 2) {
                                $('#btnActuzaliarCita').prop('disabled', false);
                                $('#serieVinVehiculoModal').prop('readOnly', false);
                                $('#placasVehiculoModal').prop('readOnly', false);
                                $('#numeroMotorVehiculoModal').prop('readOnly', false);
                            } else {
                                $('#btnActuzaliarCita').prop('disabled', true);
                                $('#serieVinVehiculoModal').prop('readOnly', true);
                                $('#placasVehiculoModal').prop('readOnly', true);
                                $('#numeroMotorVehiculoModal').prop('readOnly', true);
                            }
                        })
                        .fail(function() {
                            console.log('Error');
                        })
                        .always(function() {
                            console.log('Complete');
                        });
                }
            }
        }

        //ACTUALIZAR CITA
        $('#formulario_editar_cita').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '<h5>Actualización de información</h5>',
                text: '¿Desea actualizar la información de la cita?',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                            type: $('#formulario_editar_cita').attr('method'),
                            url: $('#formulario_editar_cita').attr('action'),
                            data: $('#formulario_editar_cita').serialize(),
                        })
                        .done(function(res) {
                            Swal.fire({
                                icon: 'success',
                                title: '<h5>Información Actualizada</h5>',
                                text: res,
                                showConfirmButton: false,
                                showCloseButton: true,
                                timer: 5000
                            })
                        })
                        .fail(function() {
                            console.log('Error');
                        })
                        .always(function() {
                            console.log('Complete');
                        });
                }
            })
        })
    </script>
</body>

</html>