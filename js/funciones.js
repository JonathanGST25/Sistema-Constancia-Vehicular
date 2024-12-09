/*INHABILITAR FECHAS VENCIDAS A LA ACTUAL
document.body.onload = (function () {
  var fecha = new Date();
  var anio = fecha.getFullYear();
  var dia = fecha.getDate();
  var _mes = fecha.getMonth(); //viene con valores de 0 al 11
  _mes = _mes + 1; //ahora lo tienes de 1 al 12
  if (_mes < 10) {
    //ahora le agregas un 0 para el formato date
    var mes = "0" + _mes;
  } else {
    var mes = _mes.toString;
  }

  let fecha_minimo = anio + "-" + mes + "-" + dia;

  document.getElementById("fechaHorario").setAttribute("min", fecha_minimo);
});*/

//EVITAR ENVÍO DE FORMULARIO
(function () {
  "use strict";

  var formDelegacion = document.getElementById("formulario_delegacion");

  formDelegacion.addEventListener("submit", function (event) {
    if (!formDelegacion.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }

    $("#formulario_delegacion").addClass("was-validated");

    if (formDelegacion.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      //OBTENER DATOS DE LOS CAMPOS
      let horaInicio = document.getElementById("horaInicio").value;
      let horaFin = document.getElementById("horaFin").value;
      let intervaloCita = document.getElementById("intervaloCita").value;
      let cantidadCitas = document.getElementById("cantidadCitas").value;
      let folioConstancia = document.getElementById("folioConstancia").value;
      let folioCita = document.getElementById("folioCitas").value;
      let delegacionId = document.getElementById("delegacionId").value;
      let fecha = document.getElementById("fechaHorario").value;
      let costoUnitario = document.getElementById("costoConstancia").value;

      //CONVERTIR A FORMATO 00:00:00
      horaInicio = horaInicio;
      horaFin = horaFin;

      let ruta =
        "inicio=" +
        horaInicio +
        "&fin=" +
        horaFin +
        "&intervalo=" +
        intervaloCita +
        "&cantidad=" +
        cantidadCitas +
        "&folioConstancia=" +
        folioConstancia +
        "&folioCitas=" +
        folioCita +
        "&delegacionId=" +
        delegacionId +
        "&fechaCita=" + 
        fecha + 
        "&costoUnitario=" + 
        costoUnitario;

      $.ajax({
        url: "./php/controladores/actualizar_delegaciones.php",
        type: "POST",
        data: ruta,
      })
        .done(function (res) {
          //ACTIVAR ALERTA SUCCESS
          $("#alerta_horario").attr("hidden", false);
          var alert_horario = document.getElementById("alerta_horario");
          alert_horario.innerHTML += res;
        })
        .fail(function () {
          //ACTIVAR ALERTA ERROR
          $("#error_horario").attr("hidden", false);
          document.getElementById("error_horario").innerHTML +=
            "Surgió un problema al realizar el registro";
        })
        .always(function () {
          console.log("complete");
        });
    }
  });
})();

window.onload = function(){
  $("#gestion_delegaciones").addClass("active");
}





