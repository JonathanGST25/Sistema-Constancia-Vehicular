<!-- Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Verificación de datos</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formulario_registrar_cita" action="./php/registrarcita.php" method="POST">
                <div class="modal-body">
                    <center>
                        <div class="alert alert-primary col-sm-12 col-md-10 col-xxl-8" role="alert">
                            <h5><strong>Por favor verifique que los datos ingresados sean correctos.</strong></h5>
                        </div>
                    </center>
                    <input type="text" hidden name="fechaCitaAtencion" id="fechaCitaAtencion">
                    <input type="text" hidden name="horaCitaAtencion" id="horaCitaAtencion">
                    <input type="text" hidden name="folio" id="folio">
                    <input type="text" hidden name="tipoPersonaSolicitante" id="tipoPersonaSolicitante" value="FISICA">
                    <input type="text" hidden name="delegacionId" id="delegacionId" value="<?php echo $_REQUEST['idDelegacion'] ?>">
                    <input type="text" hidden name="precioConstancia" id="precioConstancia">

                    <div class="row form-group" style="margin-top: 10px">
                        <h6 class="text-secondary">Datos del solicitante</h6>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="nombreSolicitanteModal">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombreSolicitanteModal" name="nombreSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="apellidoPaSolicitanteModal">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoPaSolicitanteModal" name="apellidoPaSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="apellidoMaSolicitanteModal">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoMaSolicitanteModal" name="apellidoMaSolicitanteModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="curpSolicitanteModal">CURP</label>
                                <input type="text" class="form-control" id="curpSolicitanteModal" name="curpSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="rfcSolicitanteModal">RFC</label>
                                <input type="text" class="form-control" id="rfcSolicitanteModal" name="rfcSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="calleSolicitanteModal">Calle</label>
                                <input type="text" class="form-control" id="calleSolicitanteModal" name="calleSolicitanteModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="numeroExtSolicitanteModal">Número Exterior</label>
                                <input type="text" class="form-control" id="numeroExtSolicitanteModal" name="numeroExtSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="numeroIntSolicitanteModal">Número Interior</label>
                                <input type="text" class="form-control" id="numeroIntSolicitanteModal" name="numeroIntSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="municipioSolicitanteModal">Municipio</label>
                                <input type="text" class="form-control" id="municipioSolicitanteModal" name="municipioSolicitanteModal" hidden>
                                <input type="text" class="form-control" id="municipioSolicitanteModal1" name="municipioSolicitanteModal1" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="localidadSolicitanteModal">Localidad</label>
                                <input type="text" class="form-control" id="localidadSolicitanteModal" name="localidadSolicitanteModal" hidden>
                                <input type="text" class="form-control" id="localidadSolicitanteModal1" name="localidadSolicitanteModal1" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="codigoPostalSolicitanteModal">C.P.</label>
                                <input type="text" class="form-control" id="codigoPostalSolicitanteModal" name="codigoPostalSolicitanteModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4">
                                <label for="coloniaSolicitanteModal">Colonia</label>
                                <input type="text" class="form-control" id="coloniaSolicitanteModal" name="coloniaSolicitanteModal" hidden>
                                <input type="text" class="form-control" id="coloniaSolicitanteModal1" name="coloniaSolicitanteModal1" readonly>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="row form-group" style="margin-top: 10px" id="modalPropietario">
                        <h6 class="text-secondary" id="labelSolicitanteModal">Datos del propietario</h6>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4" id="tipoPersonaPropietarioMod">
                                <label for="tipoPersonaPropietarioModal">Tipo de persona</label>
                                <input type="text" class="form-control" id="tipoPersonaPropietarioModal" name="tipoPersonaPropietarioModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4" id="nombrePropietarioMod">
                                <label for="nombrePropietarioModal">Nombre(s) o Razón Social</label>
                                <input type="text" class="form-control" id="nombrePropietarioModal" name="nombrePropietarioModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4" id="apellidoPaPropietarioMod">
                                <label for="apellidoPaPropietarioModal">Apellido Paterno</label>
                                <input type="text" class="form-control" id="apellidoPaPropietarioModal" name="apellidoPaPropietarioModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xxl-4" id="apellidoMaPropietarioMod">
                                <label for="apellidoMaPropietarioModal">Apellido Materno</label>
                                <input type="text" class="form-control" id="apellidoMaPropietarioModal" name="apellidoMaPropietarioModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4" id="curpPropietarioMod">
                                <label for="curpPropietarioModal">CURP</label>
                                <input type="text" class="form-control" id="curpPropietarioModal" name="curpPropietarioModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-4 col-xxl-4" id="rfcPropietarioMod">
                                <label for="rfcPropietarioModal">RFC</label>
                                <input type="text" class="form-control" id="rfcPropietarioModal" name="rfcPropietarioModal" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group" style="margin-top: 10px">
                        <h6 class="text-secondary">Datos del vehículo</h6>
                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="marcaVehiculoModal">Marca</label>
                                <input type="text" class="form-control" id="marcaVehiculoModal" name="marcaVehiculoModal" hidden>
                                <input type="text" class="form-control" id="marcaVehiculoModal1" name="marcaVehiculoModal1" readonly>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="modeloVehiculoModal">Modelo</label>
                                <input type="text" class="form-control" id="modeloVehiculoModal" name="modeloVehiculoModal" hidden>
                                <input type="text" class="form-control" id="modeloVehiculoModal1" name="modeloVehiculoModal1" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="tipoVehiculoModal">Tipo</label>
                                <input type="text" class="form-control" id="tipoVehiculoModal" name="tipoVehiculoModal" hidden>
                                <input type="text" class="form-control" id="tipoVehiculoModal1" name="tipoVehiculoModal1" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="anioModeloVehiculoModal">Año modelo</label>
                                <input type="text" class="form-control" id="anioModeloVehiculoModal" name="anioModeloVehiculoModal" hidden>
                                <input type="text" class="form-control" id="anioModeloVehiculoModal1" name="anioModeloVehiculoModal1" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="claseVehiculoModal">Clase</label>
                                <input type="text" class="form-control" id="claseVehiculoModal" name="claseVehiculoModal" hidden>
                                <input type="text" class="form-control" id="claseVehiculoModal1" name="claseVehiculoModal1" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="colorVehiculoModal">Color</label>
                                <input type="text" class="form-control" id="colorVehiculoModal" name="colorVehiculoModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="serieVinVehiculoModal">Serie VIN</label>
                                <input type="text" class="form-control" id="serieVinVehiculoModal" name="serieVinVehiculoModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="placasVehiculoModal">Placas</label>
                                <input type="text" class="form-control" id="placasVehiculoModal" name="placasVehiculoModal" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="numeroMotorVehiculoModal">Número de motor</label>
                                <input type="text" class="form-control" id="numeroMotorVehiculoModal" name="numeroMotorVehiculoModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="paisOrigenVehiculoModal">País de origen</label>
                                <input type="text" class="form-control" id="paisOrigenVehiculoModal" name="paisOrigenVehiculoModal" hidden>
                                <input type="text" class="form-control" id="paisOrigenVehiculoModal1" name="paisOrigenVehiculoModal1" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="cilindrajeVehiculoModal">Cilindraje</label>
                                <input type="text" class="form-control" id="cilindrajeVehiculoModal" name="cilindrajeVehiculoModal" readonly>
                            </div>

                            <div class="col-sm-12 col-md-3 col-xxl-3">
                                <label for="entidadEmplacoVehiculoModal">Entidad que emplacó</label>
                                <input type="text" class="form-control" id="entidadEmplacoVehiculoModal" name="entidadEmplacoVehiculoModal" hidden>
                                <input type="text" class="form-control" id="entidadEmplacoVehiculoModal1" name="entidadEmplacoVehiculoModal1" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="regresar" style="padding: 7px;">Regresar</button>
                    <button type="submit" class="btn btn-primary">Registrar cita</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL -->