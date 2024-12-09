<?php
// Archivo guardar_dias.php

// Obtener los días seleccionados del array POST
extract($_POST);

// Conexión a la base de datos (actualiza los valores según tu configuración)
$host = 'localhost';
$username = 'root';
$password = '199925';
$database = 'fge_constancia_vhclo';

$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

//obtener datos de la delegacion
$sql = "SELECT * FROM Delegaciones WHERE delegacionId = '$delegacionId'";
$result = mysqli_query($conn, $sql);

if($result){
  $mostrar = mysqli_fetch_array($result);

  $horaInicio = $mostrar['delegacionHoraInicioAtencion'];
  $horaFin = $mostrar['delegacionHoraFinAtencion'];
  $intervalo = $mostrar['delegacionIntervaloTiempoAtencion'];
  $cantidadCoches = $mostrar['delegacionCitasPorHorario'];

  $sql = "INSERT INTO Catalogo_Periodos(delegacionId, fecha_inicio, fecha_fin, hora_inicio, hora_fin, intervalo, cantidadCoches) VALUES ('$delegacionId','$fecha_inicio', '$fecha_fin','$horaInicio', '$horaFin', '$intervalo', '$cantidadCoches')";

  $result = mysqli_query($conn, $sql);

  if ($result) {

    $idPeriodo = mysqli_insert_id($conn);

    $consulta = mysqli_query($conn, "CALL generar_horarios('$fecha_inicio', '$fecha_fin', '$horaInicio', '$horaFin', '$intervalo', 0, '$cantidadCoches' , '$idPeriodo', '$delegacionId')");

  if ($consulta) {
    echo "Días seleccionados guardados correctamente";
    $conn->close();
  }
  }
}
