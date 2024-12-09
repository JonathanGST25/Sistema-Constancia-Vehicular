<!-- MODAL CARGAS DATOS DE CITA -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Información de la Cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="finalizarModal()"></button>
            </div>
            <div class="modal-body">
                <form action="php/controladores/guardar_estado_plataforma.php" method="POST" id="formulario_respuesta_plataforma">
                    <div class="alert alert-primary" role="alert">
                        Información de la cita, para su revisión previa.
                    </div>

                    <div class="card">
                        <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2" style="background-color: #002d72;">
                            <a class="card-link text-white">Datos del solicitante</a>
                        </div>
                        <div id="collapse2" class="collapse show">
                            <div class="card-body">
                                <div class="row mt-3 mx-auto form-group">

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Nombre<p class="fw-normal" id="nombreActor"></p></label>
                                    </div>
                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Apellido Paterno<p class="fw-normal" id="paternoActor"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Apellido Materno<p class="fw-normal" id="maternoActor"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">CURP<p class="fw-normal" id="curpActor"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">RFC<p class="fw-normal" id="rfcActor"></p></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3" style="background-color: #002d72;">
                            <a class="card-link text-white">Datos del vehículo</a>
                        </div>
                        <div id="collapse3" class="collapse show">
                            <div class="card-body">
                                <div class="row mt-3 mx-auto form-group">
                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Marca<p class="fw-normal" id="marcaVehiculo"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Modelo<p class="fw-normal" id="modeloVehiculo"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Tipo<p class="fw-normal" id="tipoVehiculo"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Año<p class="fw-normal" id="anioVehiculo"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Número de Serie<p class="fw-normal" id="numeroSerie"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Número de Placas<p class="fw-normal" id="numeroPlacas"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Número de Motor<p class="fw-normal" id="numeroMotor"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Pais<p class="fw-normal" id="pais"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Cilindraje<p class="fw-normal" id="cilindraje"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Estado<p class="fw-normal" id="estado"></p></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4" style="background-color: #002d72;">
                            <a class="card-link text-white">Información de la cita</a>
                        </div>
                        <div id="collapse4" class="collapse show">
                            <div class="card-body">
                                <div class="row mt-3 mx-auto form-group">
                                    <input type="text" name="citaId" id="citaId" hidden>
                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Folio<p class="fw-normal" id="folio"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Fecha de Registro<p class="fw-normal" id="fechaRegistro"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Fecha de la Cita<p class="fw-normal" id="fechaCita"></p></label>
                                    </div>

                                    <div class="col-12 col-md-6 col-xxl-3">
                                        <label class="fw-bold">Hora de Atención<p class="fw-normal" id="hora"></p></label>
                                    </div>
                                    
                                    <div class="col-12-col-md-6 col-xxl-3">
                                        <label class="fw-bold">Delegación<p class="fw-normal" id="delegacion"></p></label>
                                    </div>

                                    <div class="col-12-col-md-6 col-xxl-3">
                                        <label class="fw-bold">Siglas de la Delegación<p class="fw-normal" id="delegacionSiglas"></p></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="display: none;" id="card-resultado-plataforma">
                        <!-- display: none; -->
                        <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5" style="background-color: #002d72;">
                            <a class="card-link text-white">Resultado de consulta en Plataforma México</a>
                        </div>
                        <div id="collapse5" class="collapse show">
                            <div class="card-body">
                                <div class="col-12 col-md-6 col-xxl-6">
                                    <label class="fw-bold">El vehículo cuenta con<p class="fw-normal" id="reportePlata"></p></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="display: none;" id="card-respuesta-plataforma">
                        <input type="text" name="usuarioId" id="usuarioId" value="<?php echo $usuarioId ?>" hidden>
                        <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6" style="background-color: #002d72;">
                            <a class="card-link text-white">Registrar resultado de consulta en Plataforma México</a>
                        </div>
                        <div id="collapse6" class="collapse show">
                            <div class="card-body">
                                <label for="">Una vez realizada una búsqueda minuciosa en la base de datos de Plataforma México para el vehÍculo correspondiente a la cita previa, se obtuvo como resultado que el vehiculo cuenta con:</label>
                                <div class="col-xxl-4 mt-2 col-md-6 col-sm-12">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="respuestaPlataforma" name="respuestaPlataforma" required>
                                        <option selected value="">Selecciona..</option>
                                        <?php
                                        if ($resultEstadosReportePlata) {
                                        ?>
                                        <?php
                                            while ($consultaEstadosReportePlata = mysqli_fetch_array($resultEstadosReportePlata)) {
                                        ?>
                                                <option value="<?php echo $consultaEstadosReportePlata['reportePlataId'] ?>"><?php echo $consultaEstadosReportePlata['descripcion'] ?></option>
                                        <?php
                                            }
                                        }else{
                                        ?>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btnGuardarEstatusPlataforma">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL -->