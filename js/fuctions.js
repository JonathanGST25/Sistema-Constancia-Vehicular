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
        "&costoUnitario=" + 
        costoUnitario;

      $.ajax({
        url: "./php/controladores/actualizar_delegaciones.php",
        type: "POST",
        data: ruta,
      })
        .done(function (res) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: '<h5>Registrado</h5>',
            text: res,
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 3000
          });

          setTimeout(function() {
            window.location.reload();
        }, 3200);
        })
        .fail(function () {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: '<h5>Error</h5>',
            text: 'Surgió un problema al realizar el registro',
            showConfirmButton: false,
            allowOutsideClick: false,
            timer: 3000
          });
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





