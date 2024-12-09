<?php
include("conexion.php");

extract($_POST);

//VARIABLES EN DADO CASO QUE YA EXISTA UN CITA
$nombreCompleto = $nombreSolicitanteModal.' '.$apellidoPaSolicitanteModal. ' '.$apellidoMaSolicitanteModal;

//VALIDAR QUE NO EXISTA UNA CITA EXISTENTE EN TRÁMITE PARA EL USUARIO
$sql = "SELECT COUNT(*) as citaExistente FROM Citas,Actores,Vehiculos,Catalogo_Tipo_Persona WHERE Actores.curpActor = '$curpSolicitanteModal' AND Citas.citaId = Actores.citaId AND
Citas.estatusCitaId = 1 AND Vehiculos.vehiculoId = Citas.vehiculoId AND (Vehiculos.numeroSerie = '$serieVinVehiculoModal' OR Vehiculos.numeroPlacas = '$placasVehiculoModal'
OR Vehiculos.numeroMotor = '$numeroMotorVehiculoModal') AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' 
AND Citas.delegacionId = '$delegacionId'";

$result = mysqli_query($conexion, $sql);

$mostrar = mysqli_fetch_array($result);

if ($mostrar['citaExistente'] > 0) {
    echo '<script type="text/javascript">
    alert("Usted ya cuenta con una cita existente en esta Delegación");
    window.location.href="../home.php?idDelegacion='.$delegacionId.'&banderaCita=false&nombreSolicitante='.$nombreCompleto.
    '&numeroSerie='.$serieVinVehiculoModal.'&numeroPlacas='.$placasVehiculoModal.'&numeroMotor='.$numeroMotorVehiculoModal.'&curpSolicitante='.$curpSolicitanteModal.'";
    </script>';
    die();
} else {
    //REGISTRAR VEHICULO
    $sql = "INSERT INTO Vehiculos (marcaId, modeloId, tipoId, anioId, claseId, color, numeroSerie, numeroPlacas, numeroMotor, paisId, cilindraje, estadoId) VALUES 
('$marcaVehiculoModal','$modeloVehiculoModal','$tipoVehiculoModal', '$anioModeloVehiculoModal','$claseVehiculoModal','$colorVehiculoModal','$serieVinVehiculoModal',
'$placasVehiculoModal','$numeroMotorVehiculoModal','$paisOrigenVehiculoModal','$cilindrajeVehiculoModal','$entidadEmplacoVehiculoModal')";

    if (mysqli_query($conexion, $sql)) {
        //RECUPERAR ID DEL VEHICULO INSERTADO
        $vehiculoId = mysqli_insert_id($conexion);

        $fechaRegistro = date('Y-m-d h:i:s a');
        $fechaRegistroActual = substr($fechaRegistro, 0, 10);

        $sql = "INSERT INTO Citas(delegacionId, fechaRegistro, fechaCita, horarioId , vehiculoId, estatusCitaId,folioCita) VALUES ('$delegacionId',
                '$fechaRegistroActual','$fechaCitaAtencion','$horaCitaAtencion','$vehiculoId',1,'$folio')";

        if (mysqli_query($conexion, $sql)) {

            //RECUPERAR ID DE LA CITA GENERADA
            $citaId = mysqli_insert_id($conexion);
            if($numeroIntSolicitanteModal == ''){
                $numeroIntSolicitanteModal = 0;
            }

            $sql = "INSERT INTO Domicilios(calle, numeroExterior, numeroInterior, estadoId, municipioId, localidadId, codigoPostal, coloniaId) VALUES
                    ('$calleSolicitanteModal','$numeroExtSolicitanteModal','$numeroIntSolicitanteModal',12,'$municipioSolicitanteModal','$localidadSolicitanteModal',
                    '$codigoPostalSolicitanteModal','$coloniaSolicitanteModal')";

            if (mysqli_query($conexion, $sql)) {

                //RECUPERAR ID DEL REGISTRO DEL DOMICILIO DEL SOLICITANTE
                $domicilioId = mysqli_insert_id($conexion);

                $sql = "INSERT INTO Catalogo_Tipo_Persona(tipoPersona, descripcion) VALUES ('FISICA','SOLICITANTE')";

                if (mysqli_query($conexion, $sql)) {

                    //RECUPERAR ID DEL REGISTRO TIPO DE PERSONA SOLICITANTE
                    $tipoPersonaIdSolicitante = mysqli_insert_id($conexion);

                    $sql = "INSERT INTO Actores(nombreActor, paternoActor, MaternoActor, curpActor, rfcActor, domicilioId, citaId, tipoPersonaId) VALUES 
                            ('$nombreSolicitanteModal','$apellidoPaSolicitanteModal','$apellidoMaSolicitanteModal','$curpSolicitanteModal','$rfcSolicitanteModal','$domicilioId','$citaId','$tipoPersonaIdSolicitante')";

                    if (mysqli_query($conexion, $sql)) {

                        if ($curpPropietarioModal != "") {

                            $sql = "INSERT INTO Catalogo_Tipo_Persona(tipoPersona, descripcion) VALUES ('$tipoPersonaPropietarioModal','PROPIETARIO')";

                            if (mysqli_query($conexion, $sql)) {

                                //RECUPERAR ID DEL REGISTRO TIPO DE PERSONA PROPIETARIO
                                $tipoPersonaIdPropietario = mysqli_insert_id($conexion);

                                $sql = "INSERT INTO Actores(nombreActor, paternoActor, MaternoActor, curpActor, rfcActor, citaId, tipoPersonaId) VALUES
                                        ('$nombrePropietarioModal','$apellidoPaPropietarioModal','$apellidoMaPropietarioModal','$curpPropietarioModal','$rfcPropietarioModal','$citaId','$tipoPersonaIdPropietario')";

                                if (mysqli_query($conexion, $sql)) {
                                }
                            }
                        }

                        //INCREMENTAR FOLIO CITAS DE LA DELEGACIÓN
                        $sql = "SELECT delegacionFolioCita FROM Delegaciones WHERE delegacionId = '$delegacionId'";

                        $result = mysqli_query($conexion, $sql);

                        $consulta = mysqli_fetch_array($result);

                        $folioCita = $consulta['delegacionFolioCita'];

                        $folioCita = intval($folioCita) + 1;

                        $sql = "UPDATE Delegaciones SET delegacionFolioCita = '$folioCita' WHERE delegacionId = '$delegacionId'";

                        if (mysqli_query($conexion, $sql)) {

                            //OBTENER CITAS DISPONIBLES EN HORARIO
                            $sql = "SELECT cantidadCitas FROM Catalogo_Horarios, Catalogo_Periodos WHERE Catalogo_Periodos.delegacionId = '$delegacionId' AND Catalogo_Periodos.idPeriodo = Catalogo_Horarios.idPeriodo AND id = '$horaCitaAtencion'";

                            $result = mysqli_query($conexion, $sql);

                            $consulta = mysqli_fetch_array($result);

                            $citasHorario = $consulta['cantidadCitas'];

                            $citasHorario = intval($citasHorario) + 1;

                            $sql = "UPDATE Catalogo_Horarios SET cantidadCitas = '$citasHorario' WHERE id = '$horaCitaAtencion'";

                            if (mysqli_query($conexion, $sql)) { 
                                header('Location: ./confirmarcita.php?nombreSolicitante=' . $nombreSolicitanteModal . '&apellidoPaSolicitante=' . $apellidoPaSolicitanteModal .
                                    '&apellidoMaSolicitante=' . $apellidoMaSolicitanteModal . '&fechaCita=' . $fechaCitaAtencion . '&horaCita=' . $horaCitaAtencion . '&folio=' . $folio . '&delegacionId=' . $delegacionId .
                                    '&costoTotal=' . $precioConstancia);
                                die();
                            }
                        }
                    }
                }
            }
        }
    }
    //FIN REGISTRAR
}
