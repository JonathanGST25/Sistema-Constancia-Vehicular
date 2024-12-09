<?php

//INCLUIR CONEXION
include("../conexion.php");

//OBTENER VALORES POST
extract($_POST);

$sql = "SELECT Actores.nombreActor, Actores.paternoActor, Actores.maternoActor, Actores.curpActor, Actores.rfcActor, Citas.delegacionId, Citas.estatusCitaId, Citas.estatusPlataId, IFNULL(Citas.reportePlataId,0) reportePlataId, 
Catalogo_Marca.descripcion AS marca, Catalogo_Modelo.descripcion AS modelo, Catalogo_Tipo.descripcion AS tipoVehiculo, Catalogo_Anio.anio, Vehiculos.numeroSerie, Vehiculos.numeroPlacas,
Vehiculos.numeroMotor, Catalogo_Pais.descripcion AS pais, Vehiculos.cilindraje, Catalogo_Estado.descripcion AS estado, Citas.fechaRegistro, Citas.fechaCita, Catalogo_Horarios.horaCita, delegacionNombre, delegacionSiglas FROM Citas, Actores, Catalogo_Tipo_Persona, Vehiculos, Catalogo_Marca, Catalogo_Modelo, Catalogo_Tipo, Catalogo_Anio, Catalogo_Pais,
Catalogo_Cilindraje, Catalogo_Estado, Catalogo_Horarios, Delegaciones WHERE Citas.citaId = '$no_cita' AND Citas.citaId = Actores.citaId AND Actores.tipoPersonaId
= Catalogo_Tipo_Persona.tipoPersonaId AND Catalogo_Tipo_Persona.descripcion = 'SOLICITANTE' AND Citas.vehiculoId =Vehiculos.vehiculoId AND Catalogo_Marca.marcaId = Vehiculos.marcaId AND 
Catalogo_Modelo.modeloId = Vehiculos.modeloId AND Catalogo_Tipo.tipoId = Vehiculos.tipoId AND Catalogo_Anio.anioId = Vehiculos.anioId AND Vehiculos.paisId = Catalogo_Pais.paisId AND 
Catalogo_Estado.estadoId = Vehiculos.estadoId AND Citas.horarioId = Catalogo_Horarios.id AND Delegaciones.delegacionId = Citas.delegacionId";

$result = mysqli_query($conexion, $sql);

if($result){
    $consulta = mysqli_fetch_array($result);
    $sql = "UPDATE Citas SET estatusPlataId = 2 WHERE citaId = '$no_cita' AND estatusPlataId = 1";
    $result = mysqli_query($conexion, $sql);

    if($result){
        echo json_encode($consulta);
    }
    
}

?>