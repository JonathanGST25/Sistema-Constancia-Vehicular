<!-- MODAL CARGAS DATOS DE CITA -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Información de la cita</h1>

                <div class="dropdown">
                    <button class="btn btn-secondary" style="background-color: #495057;" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-mdb-toggle="dropdown">
                        Opciones
                        <span><i class="bi bi-chevron-down"></i></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item nav-link" onclick="enviarDatosPlataforma()" id="btnEnviarPlataforma">Enviar información a Plataforma México</a>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="generarConstanciaIdentificacion()" id="btnGenerarConstancia">Imprimir Constancia Vehicular</a>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="finalizarModal()" data-bs-dismiss="modal">Cerrar modal</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal-body">

                <div class="alert alert-info" role="alert" id="divInformacion" style="display: block;">
                    Favor de verificar que la información del registro de la cita coincida con la información de la factura y documentos del propietario del vehículo.
                </div>

                <div class="alert alert-warning" role="alert" id="divReportePlata" style="display: none; background: #e6b68b;">
                    <label class="text-black" id="labelReportePlata">RESULTADO DE PLATAFORMA MÉXICO:</label>
                </div>

                <div class="alert alert-danger" role="alert" id="divEstatusCita" style="display: none;">
                    <label class="text-red" id="labelEstatusCita">EL ESTADO ACTUAL DE LA CITA ES "CANCELADA"</label>
                </div>

                <div class="card">
                    <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse" style="background-color: #002d72;">
                        <a class="card-link text-white">Datos del solicitante</a>
                    </div>
                    <div id="collapse" class="collapse-show">
                        <div class="card-body">
                            <div class="row mt-3 mx-auto form-group">
                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Nombre<p class="fw-normal" id="nombreActor"></p></label>
                                </div>
                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Apellido Paterno<p class="fw-normal" id="paternoActor"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Apellido Materno<p class="fw-normal" id="maternoActor"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">CURP<p class="fw-normal" id="curpActor"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">RFC<p class="fw-normal" id="rfcActor"></p></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1" style="background-color: #002d72;">
                        <a class="card-link text-white">Datos del vehículo</a>
                    </div>
                    <div id="collapse1" class="collapse show">
                        <div class="card-body">
                            <div class="row mt-3 mx-auto form-group">
                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Marca<p class="fw-normal" id="marcaVehiculo"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Modelo<p class="fw-normal" id="modeloVehiculo"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Tipo<p class="fw-normal" id="tipoVehiculo"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Año<p class="fw-normal" id="anioVehiculo"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Número de Serie<p class="fw-normal" id="numeroSerie"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Número de Placas<p class="fw-normal" id="numeroPlacas"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Número de Motor<p class="fw-normal" id="numeroMotor"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Pais<p class="fw-normal" id="pais"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Cilindraje<p class="fw-normal" id="cilindraje"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Estado<p class="fw-normal" id="estado"></p></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2" style="background-color: #002d72;">
                        <a class="card-link text-white">Información de la cita</a>
                    </div>
                    <div id="collapse2" class="collapse show">
                        <div class="card-body">
                            <div class="row mt-3 mx-auto form-group">
                                <input type="text" name="citaId" id="citaId" hidden>
                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Folio<p class="fw-normal" id="folio"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-sm-12">
                                    <label class="fw-bold">Fecha de Registro<p class="fw-normal" id="fechaRegistro"></p></label>
                                </div>

                                <div class="col-xxl-3  col-md-6 col-sm-12">
                                    <label class="fw-bold">Fecha de la Cita<p class="fw-normal" id="fechaCita"></p></label>
                                </div>

                                <div class="col-xxl-3 col-md-6 col-12">
                                    <label class="fw-bold">Hora de Atención<p class="fw-normal" id="hora"></p></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" id="contenedorEstadoCita">
                    <div class="card-header text-white" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3" style="background-color: #002d72;">
                        <a class="card-link text-white">Estado de la cita</a>
                    </div>
                    <div id="collapse3" class="collapse show">
                        <div class="card-body">
                            <div class="row mt-3 mx-auto form-group">
                                <div class="col-xxl-12 col-md-6 col-sm-6 mb-2 aling-items-center" id="contenederSelectEstadoCita">
                                    <label>Si por algún motivo no se presentaron a la cita, tiene documentación incompleta o alteraciones en los datos del vehículo (Número de: serie, motor o placas) selecciona una de las siguientes opciones:</label>
                                    <div class="col-xxl-6 col-md-8 col-sm-12" id="contenederSelectOpciones">
                                        <select class="form-select form-select-sm mt-2" aria-label=".form-select-sm example" id="observacionesCita" name="observacionesCita" required style="display: block;">
                                            <option selected value="">Selecciona..</option>
                                            <option value="Documentación incompleta">Documentación incompleta</option>
                                            <option value="No. de serie, placas o motor distintos a la información registrada.">No. de serie, placas o motor distintos a la información registrada.</option>
                                            <option value="No se presentó a la cita en el horario indicado.">No se presentó a la cita en el horario indicado.</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary px-3" onclick="cancelarCita()" id="btnGuardarEstadoCita">Guardar</button>
                <button type="button" class="btn btn-success px-3" onclick="generarConstanciaValidacion()" id="btnImprimirConstanciaValidacion">Validar</button>
                <button type="button" class="btn btn-danger px-3" data-bs-dismiss="modal" onclick="finalizarModal()">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->