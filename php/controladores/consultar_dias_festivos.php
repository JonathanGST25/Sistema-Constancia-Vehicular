<?php

$host = 'localhost';
$username = 'root';
$password = '199925';
$database = 'fge_constancia_vhclo';

$date = $_GET['date'];

$conn = new mysqli($host, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Consulta para verificar si hay un evento en la fecha especificada
$stmt = $conn->prepare("SELECT COUNT(*) AS eventCount FROM Catalogo_Dias_Festivos WHERE fecha_festiva = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

// Obtener el resultado de la consulta
$row = $result->fetch_assoc();
$eventCount = $row['eventCount'];

$stmt->close();
$conn->close();

// Devolver la respuesta 'true' si hay un evento o 'false' si no hay evento
echo $eventCount > 0 ? 'true' : 'false';
?>