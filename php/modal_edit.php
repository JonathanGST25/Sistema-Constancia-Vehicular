<div class="modal fade" id="exampleModal2" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar información de la cita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./php/controladores/actualizar_datos_cita.php" id="formulario_editar_cita" method="POST">
                    <div class="row form-group" style="margin-top: 10px">
                        <h6 class="text-secondary">Datos del solicitante</h6>

                        <input name="citaIdModal" id="citaIdModal" type="text" hidden>
                        <input type="text" name="delegacionIdModal" id="delegacionIdModal" value="<?php echo $delegacionId ?>" hidden>

                        <div class="row">
                            <div class="col-xxl-4 col-md-4 col-sm-12">
                                <label for="nombreSolicitanteModal">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombreSolicitanteModal" name="nombreSolicitanteModal" readonly>
                            </div>

                            <div class="col-xxl-4 col-md-4 col-sm-12">
                                <label for="apellidoPaSolicitanteModal">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoPaSolicitanteModal" name="apellidoPaSolicitanteModal" readonly>
                            </div>

                            <div class="col-xxl-4 col-md-4 col-sm-12">
                                <label for="apellidoMaSolicitanteModal">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoMaSolicitanteModal" name="apellidoMaSolicitanteModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-4 col-md-4 col-sm-12">
                                <label for="curpSolicitanteModal">CURP</label>
                                <input type="text" class="form-control" id="curpSolicitanteModal" name="curpSolicitanteModal" readonly>
                            </div>

                            <div class="col-xxl-4 col-md-4 col-sm-12">
                                <label for="rfcSolicitanteModal">RFC</label>
                                <input type="text" class="form-control" id="rfcSolicitanteModal" name="rfcSolicitanteModal" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group" style="margin-top: 10px">
                        <h6 class="text-secondary">Datos del vehículo</h6>

                        <div class="row">
                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="marcaVehiculoModal">Marca</label>
                                <input type="text" class="form-control" id="marcaVehiculoModal" name="marcaVehiculoModal" readonly>
                            </div>
                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="modeloVehiculoModal">Modelo</label>
                                <input type="text" class="form-control" id="modeloVehiculoModal" name="modeloVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="tipoVehiculoModal">Tipo</label>
                                <input type="text" class="form-control" id="tipoVehiculoModal" name="tipoVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="anioModeloVehiculoModal">Año modelo</label>
                                <input type="text" class="form-control" id="anioModeloVehiculoModal" name="anioModeloVehiculoModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="claseVehiculoModal">Clase</label>
                                <input type="text" class="form-control" id="claseVehiculoModal" name="claseVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="colorVehiculoModal">Color</label>
                                <input type="text" class="form-control" id="colorVehiculoModal" name="colorVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="serieVinVehiculoModal">Serie VIN</label>
                                <input type="text" class="form-control" id="serieVinVehiculoModal" name="serieVinVehiculoModal" maxlength="17" minlength="7" style="text-transform:uppercase;" pattern="[A-Za-z0-9]+" title="El número de serie solo debe contener números y letras" required>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="placasVehiculoModal">Placas</label>
                                <input type="text" class="form-control" id="placasVehiculoModal" name="placasVehiculoModal" tyle="text-transform:uppercase;" maxlength="17" minlength="7" pattern="[A-Za-z0-9]+" title="El número de placas solo debe contener números y letras" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="numeroMotorVehiculoModal">Número de motor</label>
                                <input type="text" class="form-control" id="numeroMotorVehiculoModal" name="numeroMotorVehiculoModal" maxlength="17" minlength="10" style="text-transform:uppercase;" pattern="[A-Za-z0-9]+" title="El número de motor solo debe contener números y letras" required>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="paisOrigenVehiculoModal">País de origen</label>
                                <input type="text" class="form-control" id="paisOrigenVehiculoModal" name="paisOrigenVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="cilindrajeVehiculoModal">Cilindraje</label>
                                <input type="text" class="form-control" id="cilindrajeVehiculoModal" name="cilindrajeVehiculoModal" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="entidadEmplacoVehiculoModal">Entidad que emplacó</label>
                                <input type="text" class="form-control" id="entidadEmplacoVehiculoModal" name="entidadEmplacoVehiculoModal" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group" style="margin-top: 10px">
                        <div class="row">
                            <h6 class="text-secondary">Datos de la cita</h6>
                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="numeroMotorVehiculoModal">Folio de la Cita</label>
                                <input type="text" class="form-control" id="folioCitaModal" name="folioCita" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="numeroMotorVehiculoModal">Fecha de Registro</label>
                                <input type="text" class="form-control" id="fechaRegistroModal" name="fechaRegistro" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="numeroMotorVehiculoModal">Fecha de la Cita</label>
                                <input type="text" class="form-control" id="fechaCitaModal" name="fechaCita" readonly>
                            </div>

                            <div class="col-xxl-3 col-md-3 col-sm-12">
                                <label for="numeroMotorVehiculoModal">Hora de Atención</label>
                                <input type="text" class="form-control" id="horaCitaModal" name="horaCitaModal" readonly>
                            </div>

                        </div>
                    </div>

                    <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success px-3" id="btnActuzaliarCita">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>