<?php
session_start();
if ($_SESSION['usuarioId']) {
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

//SELECCIONAR ESTADOS DE PLATAFORMA MÉXICO
$sqlEstadosReportePlata = "SELECT * FROM Catalogo_Plata_Reporte";
$resultEstadosReportePlata = mysqli_query($conexion, $sqlEstadosReportePlata);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./css/constancia.css" rel="stylesheet">
    <link rel="stylesheet" href="./js/jquery-ui.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">-->
    <link rel="stylesheet" href="./css/boostrap-icons/bootstrap-icons.css">
    <link href="./css/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
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
                <div class="container-fluid p-0">
                    <div class="card">
                        <div class="card-body px-4">
                            <h5 class="text-center">Gestión de solicitudes de información de vehiculos en Plataforma México</h5>

                            <!-- CONTENEDOR DE INPUTS PARA BUSQUEDAS --->
                            <div class="row mx-auto form-group">
                                <div class="col-xxl-6 col-md-6 col-sm-12 mb-2 float-right d-flex">
                                    <label class="h5 mt-4">Filtrar por:</label>

                                    <!-- PICKER PARA FECHA DE REGISTRO-->
                                    <div class="form-group col-xxl-6 col-md-6" style="margin-right: 5px; margin-left: 10px;">
                                        <label for="fecha-solicitud" class="text-secondary" style="font-size: 15px;">Fecha de solicitud</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            <input type="date" class="form-control rounded btn btn-outline-primary" id="fecha-solicitud" value="<?php echo isset($_GET['fechaSolicitud']) ? $_GET['fechaSolicitud'] : ''; ?>" />
                                        </div>
                                    </div>
                                </div>

                                <!--INPUT PARA REALIZAR LA BUSQUEDA-->
                                <div class="col-xxl-6 col-md-6 col-sm-12">
                                    <label for="buscarInfoVehiculo" class="text-secondary" style="font-size: 15px;">Para buscar el vehículo ingrese</label>
                                    <div class="input-group">
                                        <input type="search" class="form-control rounded" placeholder="Número de placas, serie o motor del vehículo" aria-label="Search" aria-describedby="search-addon" name="buscarInfoVehiculo" id="buscarInfoVehiculo" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
                                        <label class="input-group-text" for="inputGroupFile01"><i class="bi bi-car-front-fill"></i></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-auto form-group d-flex">
                                <div class="col-xxl-6 col-md-12 col-sm-12 float-right d-flex">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="checkSolicitudRecibida" <?php if(isset($_GET['check']) && $_GET['check'] == 'checkRecibidas') echo 'checked'?>>
                                        <label class="form-check-label text-primary" for="inlineCheckbox1">Solicitud recibida</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="checkTramite" <?php if(isset($_GET['check']) && $_GET['check'] == 'checkTramite') echo 'checked'?>>
                                        <label class="form-check-label text-success" for="inlineCheckbox2">En trámite</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="checkConcluido" <?php if(isset($_GET['check']) && $_GET['check'] == 'checkConcluido') echo 'checked' ?>>
                                        <label class="form-check-label text-secondary" for="inlineCheckbox3">Concluido</label>
                                    </div>
                                </div>
                            </div>

                            <!--CONTENEDOR PARA LA TABLA-->
                            <div class="row mt-3 mx-auto form-group">
                                <div class="col-xxl-12 col-md-12 col-sm-12 table-responsive" id="tablaSolicitudesCitas">
                                </div>
                            </div>

                            <!-- INCLUIR MODAL PARA MOSTRAR LA CITA SELECCIONADA --->
                            <?php include('./php/modal_citas_plataforma.php') ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./css/popper.min.js"></script>
    <script src="./js/jquery/jquery.js"></script>
    <script src="./js/jquery-ui.js"></script>
    <script src="./js/jquery/moment.min.js"></script>
    <script src="./css/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="./js/3.6.1/jquery.min.js"></script>
    <script src="./js/3.2.1/jquery.min.js"></script>
    <script src="./css/sweetalert/sweetalert2@11.js"></script>
    <script src="./js/app.js"></script>
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            $("#gestion_solicitudes").addClass("active");
        }

        //LIMPIAR HISTORIAL DE BUSQUEDAS AL RECARGAR LA PÁGINA
        $(window).on("load", function() {
            var currentUrl = window.location.href;

            // Obtén la nueva URL que deseas establecer
            var newUrl = './gestion_solicitudes_plataforma.php';

            // Reemplaza la URL actual con la nueva URL
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        });

        $(document).ready(function() {
            // DEFINE EL TIEMPO EN MILISEGUNDOS ENTRE CADA RECARGA
            var tiempo_recarga = 1000;

            // FUNCIÓN PARA CARGAR LA TABLA DE CITAS
            function cargarTablaCitas() {
                var buscarInfoVehiculo = $('#buscarInfoVehiculo').val();
                var fechaSolicitud = $('#fecha-solicitud').val();

                if (fechaSolicitud != '') {
                    var url = "./php/controladores/consultar_solicitudes_plataforma_v2.php";
                    url += "?pagina=<?php echo $pagina ?>&fechaSolicitud=" + fechaSolicitud;
                } else if ($('#checkSolicitudRecibida').is(':checked')) {
                    var url = "./php/controladores/consultar_solicitudes_plataforma_recibidas.php";
                    url += "?pagina=<?php echo $pagina ?>";
                } else if ($('#checkTramite').is(':checked')) {
                    var url = "./php/controladores/consultar_solicitudes_plataforma_tramite.php";
                    url += "?pagina=<?php echo $pagina ?>";
                } else if ($('#checkConcluido').is(':checked')) {
                    var url = "./php/controladores/consultar_solicitudes_plataforma_concluido.php";
                    url += "?pagina=<?php echo $pagina ?>";
                } else {
                    var url = "php/controladores/consultar_solicitudes_plataforma.php";
                    url += "?pagina=<?php echo $pagina ?>&search=" + buscarInfoVehiculo;
                }

                $("#tablaSolicitudesCitas").load(url);
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
        }

        //FUNCIÓN PARA MOSTRAR UNA CITA EN ESPECIFICO DENTRO DE UN MODAL
        function consultarCitaEspecifica() {
            limpiarModal();
            var rows = document.getElementById('solicitudesCitas').getElementsByTagName('tr');
            for (i = 0; i < rows.length; i++) {
                rows[i].onclick = function() {
                    var result = this.getElementsByTagName('td')[0].innerHTML;
                    var cadena = 'no_cita=' + result;
                    $.ajax({
                            url: './php/controladores/consultar_cita_solicitud.php',
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
                            document.getElementById('folio').innerHTML = 'CITA' + data['delegacionId'] + "-CIV-" + result + "-2023";
                            document.getElementById('fechaRegistro').innerHTML = data['fechaRegistro'];
                            document.getElementById('fechaCita').innerHTML = data['fechaCita'];
                            document.getElementById('hora').innerHTML = data['horaCita'].slice(0, 5) + " hrs";
                            document.getElementById('delegacion').innerHTML = data['delegacionNombre'];
                            document.getElementById('delegacionSiglas').innerHTML = data['delegacionSiglas'];
                            document.getElementById('citaId').value = result;

                            if (data['reportePlataId'] != 0) {
                                document.getElementById('card-resultado-plataforma').style.display = 'block';
                                $.ajax({
                                    url: './php/controladores/consultar_respuesta_plataforma.php',
                                    type: 'POST',
                                    data: cadena,
                                }).done(function(res) {
                                    document.getElementById('reportePlata').innerHTML = res;
                                }).fail(function() {
                                    console.log('Error');
                                }).always(function() {
                                    console.log('Compelete');
                                });

                                //document.getElementById('reportePlata').innerHTML = data['reportePlata'];
                                document.getElementById('card-respuesta-plataforma').style.display = 'none';
                                document.getElementById('btnGuardarEstatusPlataforma').disabled = true
                            } else {
                                document.getElementById('card-resultado-plataforma').style.display = 'none';
                                document.getElementById('card-respuesta-plataforma').style.display = 'block';
                                document.getElementById('btnGuardarEstatusPlataforma').disabled = false
                            }
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

        //PREGUNTAR ANTES DE ENVIAR RESPUESTA DE PLATAFORMA
        let formRespPlata = document.getElementById('formulario_respuesta_plataforma');
        formRespPlata.addEventListener('submit', function() {
            event.preventDefault();
            let resp = document.getElementById('respuestaPlataforma');
            var selected = resp.options[resp.selectedIndex];
            let vehiculo = document.getElementById('numeroPlacas').textContent;
            Swal.fire({
                title: '<h5>¿Estás seguro de enviar la respuesta?</h5>',
                text: 'Se enviará la respuesta ' + selected.text + ' para el vehículo de placas ' + vehiculo,
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    //formRespPlata.submit();
                    $.ajax({
                            type: 'POST',
                            url: './php/controladores/guardar_estado_plataforma.php',
                            data: $('#formulario_respuesta_plataforma').serialize(),
                        })
                        .done(function(respuesta) {
                            let cadena = "no_cita=" + document.getElementById('citaId').value;
                            $.ajax({
                                url: './php/controladores/consultar_respuesta_plataforma.php',
                                type: 'POST',
                                data: cadena,
                            }).done(function(res) {
                                document.getElementById('reportePlata').innerHTML = res;
                            }).fail(function() {
                                console.log('Error');
                            }).always(function() {
                                console.log('Compelete');
                            });
                            document.getElementById('card-resultado-plataforma').style.display = 'block';
                            document.getElementById('card-respuesta-plataforma').style.display = 'none';
                            document.getElementById('btnGuardarEstatusPlataforma').disabled = true;
                            Swal.fire({
                                icon: 'success',
                                title: '<h5>INFORME REGISTRADO CORRECTAMENTE</h5>',
                                text: respuesta,
                                showConfirmButton: false,
                                timer: 1500,
                            })
                        })
                        .fail(function() {
                            console.log('Error..');
                        })
                        .always(function() {
                            console.log('Complete..');
                        });

                }
            })
        });
    </script>
</body>

</html>