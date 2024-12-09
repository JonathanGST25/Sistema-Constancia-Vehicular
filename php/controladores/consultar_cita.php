<?php

include("../conexion.php");

//OBTENER VALORES POST
extract($_POST);


$sql = "SELECT nombreActor, paternoActor, maternoActor,curpActor,rfcActor, Citas.estatusCitaId, IFNULL(Citas.estatusPlataId, 0) estatusPlataId, Catalogo_Marca.descripcion AS marca, Catalogo_Clase.clase , Catalogo_Modelo.descripcion AS modelo, Catalogo_Tipo.descripcion AS tipoVehiculo, Vehiculos.color , Catalogo_Anio.anio, Vehiculos.numeroSerie, Vehiculos.numeroPlacas, Vehiculos.numeroMotor, Catalogo_Pais.descripcion AS pais, Vehiculos.cilindraje, Catalogo_Estado.descripcion AS estado, Citas.fechaRegistro, Citas.fechaCita, Catalogo_Horarios.horaCita, Citas.folioCita, IFNULL(Citas.observaciones, '') observaciones, Citas.estadoCita FROM Citas, Actores,Catalogo_Tipo_Persona, Vehiculos, Catalogo_Clase, Catalogo_Marca, Catalogo_Modelo, Catalogo_Tipo, Catalogo_Anio, Catalogo_Pais, Catalogo_Estado, Catalogo_Horarios WHERE Citas.citaId = '$no_cita' AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId = Catalogo_Tipo_Persona.tipoPersonaId AND 
    Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' AND Citas.vehiculoId =Vehiculos.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND Catalogo_Modelo.modeloId = 
    Vehiculos.modeloId AND Catalogo_Tipo.tipoId = Vehiculos.tipoId AND Catalogo_Anio.anioId = Vehiculos.anioId AND Vehiculos.paisId = Catalogo_Pais.paisId AND Catalogo_Estado.estadoId = Vehiculos.estadoId AND Citas.horarioId = Catalogo_Horarios.id AND Catalogo_Clase.claseId = Vehiculos.claseId";

$result = mysqli_query($conexion, $sql);

if ($result) {
    $consulta = mysqli_fetch_array($result);

    if ($bandera == '1') {
        $sql = "UPDATE Citas SET estatusCitaId = 2 WHERE citaId = '$no_cita' AND estatusCitaId = 1";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            echo json_encode($consulta);
        }
    }

    if ($bandera == '2') {
        echo json_encode($consulta);
    }
}
