//=============================================================================
//INHABILITAR CAMPOS DOMICILIO EN CASO DE TENER DOMICILIO FUERA DEL ESTADO
$("#OutState").on("change", function () {
  var bandera = document.getElementById("OutState").value;
  if (bandera == "true") {
    $("#municipioSolicitante").prop("disabled", "disabled");
    $("#localidadSolicitante").prop("disabled", "disabled");
    $("#codigoPostal").prop("disabled", "disabled");
    $("#btn-modal-search").prop("disabled", "disabled");
    $("#coloniaSolicitante").prop("disabled", "disabled");
    $("#otraColoniaSolicitante").prop("disabled", false);
    document.getElementById("OutState").value = "false";
    //REGRESAR SELECT A VALORES INICIALES
    document.getElementById("municipioSolicitante").selectedIndex = 0;
    document.getElementById("localidadSolicitante").selectedIndex = 0;
    document.getElementById("codigoPostal").selectedIndex = 0;
    document.getElementById("coloniaSolicitante").selectedIndex = 0;
  } else {
    $("#municipioSolicitante").prop("disabled", false);
    $("#localidadSolicitante").prop("disabled", false);
    $("#codigoPostal").prop("disabled", false);
    $("#btn-modal-search").prop("disabled", false);
    $("#coloniaSolicitante").prop("disabled", false);
    $("#otraColoniaSolicitante").prop("disabled", "disabled");
    document.getElementById("OutState").value = "true";
    //REGRESAR SELECT A VALORES NULOS
    document.getElementById("otraColoniaSolicitante").value = "";
  }
});
//=============================================================================
//INHABILITAR CAMPOS EN CASO DE SER PERSONA MORAL
var selectTipoPersona = document.getElementById("tipoPersona");
//ESCUCHAR CAMBIO EN SELECT TIPO DE PERSONA
selectTipoPersona.addEventListener("change", (event) => {
  var tipo = event.target.value;
  //SI LA PERSONA ES DE TIPO MORAL
  if (tipo == "MORAL") {
    $("#apellidoPaPropietario").prop("disabled", "disabled");
    $("#apellidoMaPropietario").prop("disabled", "disabled");
    $("#curpPropietario").prop("disabled", "disabled");
    //REGRESAR INPUTS A VALORES NULOS
    document.getElementById("apellidoPaPropietario").value = "";
    document.getElementById("apellidoMaPropietario").value = "";
    document.getElementById("curpPropietario").value = "";
    //SI LA PERSONA ES DE TIPO FISICA
  } else if (tipo == "FISICA") {
    $("#apellidoPaPropietario").prop("disabled", false);
    $("#apellidoMaPropietario").prop("disabled", false);
    $("#curpPropietario").prop("disabled", false);
  }
});
//=============================================================================
//ENVIOS DE FORMULARIOS
(function () {
  "use strict";

  var content = document.querySelectorAll("[tabindex]");

  //VALIDAR FORMULARIO SOLICITANTE
  var formSoli = document.getElementById("formulario_solicitante");

  formSoli.addEventListener("submit", function (event) {
    if (!formSoli.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    $("#formulario_solicitante").addClass("was-validated");

    if (formSoli.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      //INHABILITAR BOTONES REGRESAR
      $("#btnRegresarSolicitante").hide();
      $("#btnRegresarPropietario").hide();
      $("#btnRegresarVehiculo").hide();

      if ($("#opcionPropietario").is(":checked")) {
        //BORRAR CLASES DE LOS CONTENEDORES
        content.forEach((c) => {
          c.classList.remove("active");
        });

        //ACTIVAR LA PRESTAÑA DE DATOS VEHICULO
        $("#solicitante-tab").removeClass("active");
        //$("#solicitante-tab").addClass("disabled");
        $("#vehiculo-tab").addClass("active");
        $("#vehiculo-tab").attr("hidden", false);
        $("#vehiculo-tab-pane").addClass("active");
        $("#vehiculo-tab-pane").addClass("show");
      } else {
        //BORRAR CLASES DE LOS CONTENEDORES
        content.forEach((c) => {
          c.classList.remove("active");
        });

        //ACTIVAR LA PRESTAÑA DE DATOS PROPIETARIO
        $("#solicitante-tab").removeClass("active");
        //$("#solicitante-tab").addClass("disabled");
        $("#propietario-tab").addClass("active");
        $("#propietario-tab").attr("hidden", false);
        $("#propietario-tab-pane").addClass("active");
        $("#propietario-tab-pane").addClass("show");
      }
    }
  });

  //VALIDAR FORMULARIO PROPIETARIO
  var formProp = document.getElementById("formulario_propietario");

  formProp.addEventListener("submit", function (event) {
    if (!formProp.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    $("#formulario_propietario").addClass("was-validated");

    if (formProp.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      //BORRAR CLASES DE LOS CONTENEDORES
      content.forEach((c) => {
        c.classList.remove("active");
      });

      //ACTIVAR LA PRESTAÑA DE DATOS VEHICULO
      $("#propietario-tab").removeClass("active");
      //$("#propietario-tab").addClass("disabled");
      $("#vehiculo-tab").addClass("active");
      $("#vehiculo-tab").attr("hidden", false);
      $("#vehiculo-tab-pane").addClass("active");
      $("#vehiculo-tab-pane").addClass("show");
    }
  });

  //VALIDAR FORMULARIO VEHÍCULO
  var formVehiculo = document.getElementById("formulario_vehiculo");

  formVehiculo.addEventListener("submit", function (event) {
    if (!formVehiculo.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    $("#formulario_vehiculo").addClass("was-validated");

    if (formVehiculo.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      let delegacion = document.getElementById("idDelegacion").value;
      var ruta = "idDelegacion=" + delegacion;

      //CARGAR DATEPICKER
      $.ajax({
        url: "./php/controladores/consultar_fechas_horarios.php",
        type: "POST",
        data: ruta,
      })
        .done(function (res) {
          var content = [];

          content = JSON.parse(res);

          var fechas = [];

          fechas = formatMes(content);

          //DATEPICKER FECHAS
          var date = new Date();
          $(".datepicker").datepicker({
            uiLibrary: "bootstrap5",
            monthNames: [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
              "Agosto",
              "Septiembre",
              "Octubre",
              "Noviembre",
              "Diciembre",
            ],
            monthNamesShort: [
              "Ene",
              "Feb",
              "Mar",
              "Abr",
              "May",
              "Jun",
              "Jul",
              "Ago",
              "Sep",
              "Oct",
              "Nov",
              "Dic",
            ],
            dayNames: [
              "Domingo",
              "Lunes",
              "Martes",
              "Miércoles",
              "Jueves",
              "Viernes",
              "Sábado",
            ],
            dayNamesShort: ["Dom", "Lun", "Mar", "Mié", "Juv", "Vie", "Sáb"],
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"],
            weekHeader: "Sm",
            dateFormat: "yy-mm-dd",
            modal: true,
            beforeShowDay: function (date) {
              var m = date.getMonth(),
                d = date.getDate(),
                y = date.getFullYear();
              for (let i = 0; i < fechas.length; i++) {
                if ($.inArray(y + "-" + (m + 1) + "-" + d, fechas) != -1) {
                  return [true, "css-class-to-highlight", "tooltip text"];
                }
              }
              return [false];
            },
            onSelect: function (date) {
              console.log(date);
              //LLAMAR LOS HORARIOS SEGUN LA FECHA
              //let delegacionId = document.getElementById("deleg").value;
              let idDelegacion = document.getElementById("idDelegacion").value;
              $("#horariosDisponibles").load(
                "./php/controladores/consultar_horarios.php?fecha=" +
                  date +
                  "&idDelegacion=" +
                  idDelegacion
              );
            },
          });
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("complete");
        });

      //BORRAR CLASES DE LOS CONTENEDORES
      content.forEach((c) => {
        c.classList.remove("active");
      });

      //ACTIVAR LA PRESTAÑA DE DATOS CITA
      $("#vehiculo-tab").removeClass("active");
      //$("#vehiculo-tab").addClass("disabled");
      $("#cita-tab").addClass("active");
      $("#cita-tab").attr("hidden", false);
      $("#cita-tab-pane").addClass("active");
      $("#cita-tab-pane").addClass("show");

      //OBTENER EL NÚMERO DE CITA
      let idDelegacion = document.getElementById("idDelegacion").value;
      var cadena = "idDelegacion=" + idDelegacion;
      $.ajax({
        url: "./php/controladores/consultar_numero_cita.php",
        type: "POST",
        data: cadena,
      })
        .done(function (res) {
          let numeroCita = res;
          let cadena = "";

          if (Number.parseInt(numeroCita) <= 99) {
            var cita =
              "FGE-0" +
              idDelegacion +
              "-CIV-0" +
              (Number.parseInt(numeroCita) + 1) +
              "-2023";
          } else {
            var cita =
              "FGE-0" +
              idDelegacion +
              "-CIV-" +
              (Number.parseInt(numeroCita) + 1) +
              "-2023";
          }

          document.getElementById("numeroCita").value = cita;
        })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          console.log("complete");
        });
    }
  });

  //VALIDAR FORMULARIO CITA
  var formCita = document.getElementById("formulario_cita");

  formCita.addEventListener("submit", function (event) {
    if (!formCita.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    $("#formulario_cita").addClass("was-validated");

    if (formCita.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      $("#exampleModal").modal("show");

      //MANDAR DATOS A MODAL
      document.getElementById("nombreSolicitanteModal").value = document
        .getElementById("nombreSolicitante")
        .value.toUpperCase();
      document.getElementById("apellidoPaSolicitanteModal").value = document
        .getElementById("apellidoPaSolicitante")
        .value.toUpperCase();
      document.getElementById("apellidoMaSolicitanteModal").value = document
        .getElementById("apellidoMaSolicitante")
        .value.toUpperCase();
      document.getElementById("curpSolicitanteModal").value = document
        .getElementById("curpSolicitante")
        .value.toUpperCase();
      document.getElementById("rfcSolicitanteModal").value = document
        .getElementById("rfcSolicitante")
        .value.toUpperCase();

      document.getElementById("calleSolicitanteModal").value = document
        .getElementById("calleSolicitante")
        .value.toUpperCase();
      document.getElementById("numeroExtSolicitanteModal").value = document
        .getElementById("numeroExterior")
        .value.toUpperCase();
      document.getElementById("numeroIntSolicitanteModal").value = document
        .getElementById("numeroInterior")
        .value.toUpperCase();
      document.getElementById("municipioSolicitanteModal1").value = $('#municipioSolicitante option:selected').text();
      document.getElementById("municipioSolicitanteModal").value =  document.getElementById("municipioSolicitante").value.toUpperCase();
      document.getElementById("localidadSolicitanteModal1").value = $('#localidadSolicitante option:selected').text();
      document.getElementById("localidadSolicitanteModal").value = document.getElementById("localidadSolicitante").value.toUpperCase();

      document.getElementById("codigoPostalSolicitanteModal").value = document.getElementById("codigoPostal").value.toUpperCase();
      document.getElementById("coloniaSolicitanteModal1").value = $('#coloniaSolicitante option:selected').text();
      document.getElementById("coloniaSolicitanteModal").value = document.getElementById("coloniaSolicitante").value.toUpperCase();
      document.getElementById("folio").value =
        document.getElementById("numeroCita").value;

      //VERIFICAR SI EL CHECK DE PROPIETARIO ESTA SELECCIONADO
      if ($("#opcionPropietario").is(":checked")) {
        //OCULTAR DIV DE INFORMACIÓN DEL PROPIETARIO
        document.getElementById("modalPropietario").style.display = "none";
      } else {
        //MOSTRAR DATOS DEL PROPIETARIO EN MODAL
        document.getElementById("modalPropietario").style.display = "block";
        document.getElementById("tipoPersonaPropietarioModal").value = document
          .getElementById("tipoPersona")
          .value.toUpperCase();
        document.getElementById("nombrePropietarioModal").value = document
          .getElementById("nombrePropietario")
          .value.toUpperCase();
        document.getElementById("apellidoPaPropietarioModal").value = document
          .getElementById("apellidoPaPropietario")
          .value.toUpperCase();
        document.getElementById("apellidoMaPropietarioModal").value = document
          .getElementById("apellidoMaPropietario")
          .value.toUpperCase();
        document.getElementById("curpPropietarioModal").value = document
          .getElementById("curpPropietario")
          .value.toUpperCase();
        document.getElementById("rfcPropietarioModal").value = document
          .getElementById("rfcPropietario")
          .value.toUpperCase();
      }

      //MOSTRAR DATOS DEL VEHICULO EN MODAL
      document.getElementById("marcaVehiculoModal1").value =  $('#marca option:selected').text();
      document.getElementById("marcaVehiculoModal").value = document.getElementById("marca").value.toUpperCase();

      document.getElementById("modeloVehiculoModal1").value = $('#modelo option:selected').text();
      document.getElementById("modeloVehiculoModal").value = document.getElementById("modelo").value.toUpperCase();

      document.getElementById("tipoVehiculoModal1").value = $('#tipo option:selected').text().toUpperCase();
      document.getElementById("tipoVehiculoModal").value = document.getElementById("tipo").value.toUpperCase();

      document.getElementById("anioModeloVehiculoModal1").value = $('#año option:selected').text();
      document.getElementById("anioModeloVehiculoModal").value =document.getElementById("año").value.toUpperCase();

      document.getElementById("claseVehiculoModal1").value = $('#clase option:selected').text().toUpperCase();
      document.getElementById("claseVehiculoModal").value = document.getElementById("clase").value.toUpperCase();

      document.getElementById("colorVehiculoModal").value = document
        .getElementById("color")
        .value.toUpperCase();
      document.getElementById("serieVinVehiculoModal").value = document
        .getElementById("serie")
        .value.toUpperCase();
      document.getElementById("placasVehiculoModal").value = document
        .getElementById("placas")
        .value.toUpperCase();
      document.getElementById("numeroMotorVehiculoModal").value = document
        .getElementById("motor")
        .value.toUpperCase();
      document.getElementById("paisOrigenVehiculoModal1").value =  $('#pais option:selected').text();
      document.getElementById("paisOrigenVehiculoModal").value = document.getElementById("pais").value.toUpperCase();
      document.getElementById("cilindrajeVehiculoModal").value = document
        .getElementById("cilindraje")
        .value.toUpperCase();
      document.getElementById("entidadEmplacoVehiculoModal1").value = $('#entidadEmplaco option:selected').text();
      document.getElementById("entidadEmplacoVehiculoModal").value = document.getElementById("entidadEmplaco").value.toUpperCase();

      //ASIGNAR DATOS DE CITA A MODAL
      document.getElementById("fechaCitaAtencion").value =
        document.getElementById("calendario").value;
      document.getElementById("horaCitaAtencion").value =
        document.getElementById("horariosDisponibles").value;
      document.getElementById("precioConstancia").value =
        document.getElementById("costoTotal").value;
    }
  });
})();
//==============================================================================
//PRESIONAR BOTON REGRESAR MODAL
var btnRegresar = document.getElementById("regresar");

//ACTIVAR PESTAÑAS
btnRegresar.addEventListener("click", function () {
  //ACTIVAR BOTONES REGRESAR
  $("#btnRegresarSolicitante").show();
  $("#btnRegresarPropietario").show();
  $("#btnRegresarVehiculo").show();
});
//================================================================================
//ESCUCHAR CAMBIO DE SELECT
const selectElement = document.getElementById("opcionPropietario");
selectElement.addEventListener("change", (event) => {
  //VALIDAR SI EL CHECK ESTA SELECCIONADO, OCULTAMOS LA SECCIÓN PROPIETARIO Y
  //LIMPIAMOS CAMPOS
  if ($("#opcionPropietario").is(":checked")) {
    $("#propietario-tab").removeClass("active");
    $("#propietario-tab").attr("hidden", "hidden");
    $("#propietario-tab-pane").removeClass("active");
    $("#propietario-tab-pane").removeClass("show");

    //LIMPIAR FORMULARIO PROPIETARIO
    document.getElementById("tipoPersona").value = "";
    document.getElementById("nombrePropietario").value = "";
    document.getElementById("apellidoPaPropietario").value = "";
    document.getElementById("apellidoMaPropietario").value = "";
    document.getElementById("curpPropietario").value = "";
    document.getElementById("rfcPropietario").value = "";
  }
});

//===================================================================================
//AÑADIR EVENTOS A BOTONES REGRESAR PARA EDITAR DATOS DE LA CITA

//REGRESAR A SECCIÓN SOLICITANTE
var btnRegresarSolicitante = document.getElementById("btnRegresarSolicitante");
btnRegresarSolicitante.addEventListener("click", function () {
  var content = document.querySelectorAll("[tabindex]");

  //BORRAR CLASES DE LOS CONTENEDORES
  content.forEach((c) => {
    c.classList.remove("active");
  });

  //ACTIVAR LA PRESTAÑA DE DATOS SOLICITANTE
  $("#propietario-tab").removeClass("active");
  $("#solicitante-tab").addClass("active");
  $("#solicitante-tab").attr("hidden", false);
  $("#solicitante-tab-pane").addClass("active");
  $("#solicitante-tab-pane").addClass("show");
});

//REGRESAR A SECCIÓN PROPIETARIO
var btnRegresarPropietario = document.getElementById("btnRegresarPropietario");
btnRegresarPropietario.addEventListener("click", function () {
  var content = document.querySelectorAll("[tabindex]");
  if ($("#opcionPropietario").is(":checked")) {
    //BORRAR CLASES DE LOS CONTENEDORES
    content.forEach((c) => {
      c.classList.remove("active");
    });

    //ACTIVAR LA PRESTAÑA DE DATOS SOLICITANTE
    $("#vehiculo-tab").removeClass("active");
    $("#solicitante-tab").addClass("active");
    $("#solicitante-tab").attr("hidden", false);
    $("#solicitante-tab-pane").addClass("active");
    $("#solicitante-tab-pane").addClass("show");
  } else {
    //BORRAR CLASES DE LOS CONTENEDORES
    content.forEach((c) => {
      c.classList.remove("active");
    });

    //ACTIVAR LA PRESTAÑA DE DATOS PROPIETARIO
    $("#vehiculo-tab").removeClass("active");
    $("#propietario-tab").addClass("active");
    $("#propietario-tab").attr("hidden", false);
    $("#propietario-tab-pane").addClass("active");
    $("#propietario-tab-pane").addClass("show");
  }
});

//REGRESAR A SECCIÓN VEHICULO
var btnRegresarVehiculo = document.getElementById("btnRegresarVehiculo");
btnRegresarVehiculo.addEventListener("click", function () {
  var content = document.querySelectorAll("[tabindex]");

  //BORRAR CLASES DE LOS CONTENEDORES
  content.forEach((c) => {
    c.classList.remove("active");
  });

  //ACTIVAR LA PRESTAÑA DE DATOS VEHICULO
  $("#cita-tab").removeClass("active");
  $("#vehiculo-tab").addClass("active");
  $("#vehiculo-tab").attr("hidden", false);
  $("#vehiculo-tab-pane").addClass("active");
  $("#vehiculo-tab-pane").addClass("show");
});

//CAMBIO EN SELECT MUNICIPIOS
let selectMunicipioSolicitante = document.getElementById(
  "municipioSolicitante"
);

//CAMBIO EN SELECT MUNICIPIO DEL SOLICITANTE
selectMunicipioSolicitante.addEventListener("change", (e) => {
  let idMunicipio = e.target.value;
  //VALIDAR QUE EL CAMPO NO ESTE VACÍO
  if (idMunicipio != "") {
    //SE CARGAN LOS DATOS RESPECTO AL MUNICIPIO
    $("#localidadSolicitante").load(
      "./php/controladores/consultar_localidades.php?municipioId=" + idMunicipio
    );
    $("#codigoPostal").load(
      "./php/controladores/consultar_cp_colonias.php?municipioId=" + idMunicipio
    );
  }
});

//CAMBIO EN SELECT MARCA VEHICULO
let marcaVehiculo = document.getElementById("marca");
//SE ESCUCHA SI SE HA CAMBIADO DE OPCIÓN
marcaVehiculo.addEventListener("change", (e) => {
  let marcaId = e.target.value;
  //VALIDAR QUE EL CAMPO NO ESTE VACÍO
  if (marcaId != "") {
    //SE CONSULTA A LOS RESULTADOS RESPECTO AL CÓDIGO
    $("#modelo").load(
      "./php/controladores/consultar_modelos_vehiculos.php?marcaId=" + marcaId
    );
  }
});

//BOTON BUSCAR POSTAL
let btnSearchCP = document.getElementById("codigoPostal");
//SE ESCUCHA SI SE HA CAMBIADO DE OPCIÓN
btnSearchCP.addEventListener("change", (e) => {
  let cp = e.target.value;
  //VALIDAR QUE EL CAMPO NO ESTE VACÍO
  if (cp != "") {
    //SE CONSULTA LOS RESULTADOS RESPECTO AL CÓDIGO POSTAL
    $("#coloniaSolicitante").load(
      "./php/controladores/consultar_colonias.php?cp=" + cp
    );
  }
});

//METOD FORMAT YY-MM-DD SIN O EN DÍAS Y MESES
function formatMes(content) {
  var fechasMes = [];
  var fechas = [];

  for (let index = 0; index < content.length; index++) {
    var temp = content[index];
    //2023-02-08
    var tempFechaMes = temp.slice(5, 7);
    if (
      tempFechaMes == "01" ||
      tempFechaMes == "02" ||
      tempFechaMes == "03" ||
      tempFechaMes == "04" ||
      tempFechaMes == "05" ||
      tempFechaMes == "06" ||
      tempFechaMes == "07" ||
      tempFechaMes == "08" ||
      tempFechaMes == "09"
    ) {
      var fecha1 = temp.slice(0, 5);
      var fecha2 = temp.slice(6, 10);
      var fecha = fecha1 + fecha2;

      fechasMes.push(fecha);
    } else {
      var fecha = temp;
      fechasMes.push(fecha);
    }
  }

  for (let i = 0; i < fechasMes.length; i++) {
    var temp = fechasMes[i];
    var tempFechaDia = "";
    if (temp.length == 10) {
      tempFechaDia = temp.slice(8, 10);
    }

    if (temp.length == 9) {
      tempFechaDia = temp.slice(7, 9);
    }

    console.log(tempFechaDia);
    if (
      tempFechaDia == "01" ||
      tempFechaDia == "02" ||
      tempFechaDia == "03" ||
      tempFechaDia == "04" ||
      tempFechaDia == "05" ||
      tempFechaDia == "06" ||
      tempFechaDia == "07" ||
      tempFechaDia == "08" ||
      tempFechaDia == "09"
    ) {
      if (temp.length == 10) {
        var fecha1 = temp.slice(0, 8);
        var fecha2 = temp.slice(9, 10);
        var fecha = fecha1 + fecha2;
      } else {
        var fecha1 = temp.slice(0, 7);
        var fecha2 = temp.slice(8, 9);
        var fecha = fecha1 + fecha2;
      }
      fechas.push(fecha);
    } else {
      var fecha = temp;
      fechas.push(fecha);
    }
  }
  return fechas;
}

//ENVÍO DE FORMULARIO PARA REGISTRAR LA CITA
let formRegistroCita = document.getElementById("formulario_registrar_cita");

formRegistroCita.addEventListener("submit", function (event) {
  //CANCELAR EL EVENTO DE ENVÍO
  event.preventDefault();

  //MOSTRAR EL MODAL DEL PROGRESS BAR
  $("#progressModal").modal("show");

  let i = setInterval(function () {
    //AGREGAR LOS VALORES AL PROGRESS BAR
    let curvalue = parseInt(
      document.getElementById("progress").getAttribute("aria-valuenow")
    );
    if (curvalue < 100) {
      curvalue += 20;
      document
        .getElementById("progress")
        .setAttribute("aria-valuenow", curvalue);
      document
        .getElementById("progress")
        .setAttribute("style", "width: " + curvalue + "%");
    } else {
      //ENVIAR FORMULARIO
      formRegistroCita.submit();
      clearInterval(i);
      //LIMPIAR PROGESS BAR COLOCAR EN 0
      document
        .getElementById("progress")
        .setAttribute("aria-valuenow", 0);
      //LIMPIAR ANIMACIÓN DE PROGRESS BAR
      document
        .getElementById("progress")
        .setAttribute("style", "width: " + 0 + "%");
      //REINICIAR FORMULARIOS
      $("#formulario_registrar_cita").trigger("reset");
      //----------------------------------------------------------------------
      //QUITAR CLASES A INPUTS, SELECTS, RADIOS, CHECKBOX
      let form_solicitante = document.getElementById('formulario_solicitante');
      form_solicitante.classList.remove('was-validated');
      form_solicitante.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      $("#formulario_solicitante").trigger("reset");
      //----------------------------------------------------------------------
      //QUITAR CLASES A INPUTS, SELECTS, RADIOS, CHECKBOX
      let form_propietario = document.getElementById('formulario_propietario');
      form_propietario.classList.remove('was-validated');
      form_propietario.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      $("#formulario_propietario").trigger("reset");
      //----------------------------------------------------------------------
      //QUITAR CLASES A INPUTS, SELECTS, RADIOS, CHECKBOX
      let form_vehiculo = document.getElementById('formulario_vehiculo');
      form_vehiculo.classList.remove('was-validated');
      form_vehiculo.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      $("#formulario_vehiculo").trigger("reset");
      //----------------------------------------------------------------------
      //QUITAR CLASES A INPUTS, SELECTS, RADIOS, CHECKBOX
      let form_cita = document.getElementById('formulario_cita');
      form_cita.classList.remove('was-validated');
      form_cita.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
      $("#formulario_cita").trigger("reset");
      //CERRAR MODALES
      $("#progressModal").modal("hide");
      $("#exampleModal").modal("hide");
      //SELECCIONAR PESTAÑA POR DEFECTO
      var content = document.querySelectorAll("[tabindex]");
      content.forEach((c) => {
        c.classList.remove("active");
      });
      //-----------------------------------------------------------------
      //OCULTAR PESTAÑA DE CITAS
      $("#cita-tab").removeClass("active");
      $("#cita-tab").attr("hidden", true);
      //-----------------------------------------------------------------
      //OCULTAR PESTAÑA DE PROPIETARIO
      $("#propietario-tab").removeClass("active");
      $("#propietario-tab").attr("hidden", true);
      //-----------------------------------------------------------------
      //OCULTAR PESTAÑA DE VEHICULO
      $("#vehiculo-tab").removeClass("active");
      $("#vehiculo-tab").attr("hidden", true);
      //-----------------------------------------------------------------
      //ACTIVAR PESTAÑA POR DEFECTO (SOLICITANTE)
      $("#solicitante-tab").addClass("active");
      $("#solicitante-tab").attr("hidden", false);
      $("#solicitante-tab-pane").addClass("active");
      $("#solicitante-tab-pane").addClass("show");
    }
  }, 1500);
});

//FUNCIÓN PARA VALIDAR QUE EL TEXTO INGRESADO SEA UN NÚMERO
function isNumber(evt) {
  evt = evt ? evt : window.event;
  var charCode = evt.which ? evt.which : evt.keyCode;
  if ((charCode > 31 && charCode < 48) || charCode > 57) {
    return false;
  }
  return true;
}

//FUNCIÓN PARA VALIDAR QUE EL TEXTO INGRESADO SEA TEXTO
function isText() {
  if (
    (event.keyCode != 32 && event.keyCode < 65) ||
    (event.keyCode > 90 && event.keyCode < 97) ||
    (event.keyCode > 122 && event.keyCode == 249)
  )
    event.returnValue = false;
}
