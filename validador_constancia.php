<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/icons/icon-48x48.png" />
    <link href="./fullcalendar/fuentes/font-inter.css" rel="stylesheet">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <script src="./css/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <title>Constancia de Identificación Vehicular | FGE</title>

    <style>
        @media screen and (max-width: 600px) {
            .contenedorB {
                border-style: hidden !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card-header">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    <img src="./img/icons/logo_fiscalia.png" style="width: 100px; display: inline-block" />
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

        <div class="container-fluid mt-3">
            <div id="content">
                <div class="container">
                    <br />
                    <h3 class="text-center">
                        Verificación de CONSTANCIA DE IDENTIFICACIÓN VEHICULAR
                    </h3>
                    <br />
                    <p>El campo marcado con <span class="text-danger">*</span> es obligatorio.</p>

                    <?php
                        if (isset($_GET['bandera']) && $_GET['bandera'] == 'true') {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        <strong>Información:</strong>
                        !CÓDIGO INCORRECTO! Favor de verificar el código de barras ingresado.
                    </div>
                    <?php
                        } else {
                    ?>
                    <div class="alert alert-info" role="alert" style="background-color: #d1ecf1; border-color: #bee5eb;">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:">
                            <use xlink:href="#info-fill" />
                        </svg>
                        <strong>Importante:</strong>
                        El código de barras debe ser ingresado correctamente para la verificación de la Constancia de Identificación Vehicular.
                    </div>
                    <?php
                        }
                    ?>

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">INFORMACIÓN</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <form action="./php/controladores/verificar_constancia_vehicular.php" method="POST" id="form_validar_constancia">
                            <div class="row" style="margin-top: 10px">
                                <div class="h5 text-secondary mt-2">
                                    Código de barras<span class="text-secondary" style="font-size: 16px;">(Código de barras que contiene la constancia en la parte inferior izquierda).</span>
                                </div>
                                <div class="col-sm-3 form-group contenedor mt-2">
                                    <br class="hidden-xs">
                                    <p class="h4" style="color: #800000;"><i class="fa fa-file"></i> Información de la constancia</p>
                                </div>

                                <div class="col-sm-9 contenedorB mt-2" style="border-left: 1px solid #cccccc">
                                    <div class="row form-group">
                                        <div class="col-sm-6 col-md-6 col-xxl-8 mt-2">
                                            <label for="codigoBarras">Código de barras <span class="text-danger">*</span></label>
                                            <input autocomplete="off" class="form-control" data-val="true" id="codigoBarras" placeholder="Ingresa el código de barras" name="codigoBarras" type="text" value="" required>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <br>
                                <center>
                                    <button type="submit" class="btn btn-primary text-lg mt-5" style="padding: 10px 25px; font-size: 20px;">Siguiente &gt;</button>
                                </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="card-footer text-muted text-center text-secondary">
            Copyright © 2023 <br />
            Todos los derechos reservados
        </div>
    </div>
    <script src="./js/javascript/3.6.1/jquery.min.js"></script>
    <script src="./js/javascript/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(window).on("load", function() {
            var currentUrl = window.location.href;

            // Obtén la nueva URL que deseas establecer
            var newUrl = './validador_constancia.php';

            // Reemplaza la URL actual con la nueva URL
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        });


        //EVITAR ENVIO DE FORMULARIO
        let formValidarConstancia = document.getElementById('form_validar_constancia');

        formValidarConstancia.addEventListener('submit', function(e){
            e.preventDefault();
            formValidarConstancia.submit();
            document.getElementById('codigoBarras').value = '';
        })
    </script>
</body>

</html>